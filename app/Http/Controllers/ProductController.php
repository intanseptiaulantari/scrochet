<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\Basket;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->take(4)->get();
        return view('landing', compact('products'));
    }

    public function dashboard()
    {
        $user = auth()->user();
        $products = Product::take(3)->get();

        $orders = Order::where('user_id', $user->id)->with('product')->get();

        if ($orders->isEmpty()) {
            $chartData = ['labels' => ['No Data'], 'data' => [1]];
        } else {
            $groupedData = $orders->groupBy(function($order) {
                return $order->product?->name ?? 'Unknown Item';
            })->map(function($group) {
                return $group->count();
            });

            $chartData = [
                'labels' => $groupedData->keys()->toArray(),
                'data' => $groupedData->values()->toArray()
            ];
        }

        return view('dashboard', compact('products', 'chartData'));
    }

    public function buyProduct($id)
    {
        $user = auth()->user();
        $product = Product::findOrFail($id);

        return view('shop', compact('user', 'product'));
    }

    public function collections()
    {
        $products = Product::all();
        return view('collections', compact('products'));
    }

    public function showShop($id) {
        $product = Product::findOrFail($id);
        $user = auth()->user();
        return view('shop', compact('product', 'user'));
    }

    public function completeOrder(Request $request) {
        $user = auth()->user();

        Order::create([
            'user_id' => $user->id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'total_price' => $request->final_price,
            'status' => 'success',
        ]);

        $user->points = ($user->points - ($request->points_used ?? 0)) + 500;
    $user->save();

        return redirect()->route('dashboard')->with('success', 'Order Completed!');
    }

    public function cancelOrder($id) {
        $order = \App\Models\Order::findOrFail($id);
        $order->delete(); // Menghapus data dari database
        return back()->with('success', 'Order cancelled successfully.');
    }

    public function addToBasket($id) {
        Basket::create([
            'user_id' => auth()->id(),
            'product_id' => $id,
            'quantity' => 1
        ]);
        return redirect()->route('basket.show')->with('success', 'Added to basket!');
    }

    public function showBasket() {
        $items = Basket::where('user_id', auth()->id())->with('product')->get();
        return view('basket', compact('items'));
    }

    public function deleteBasket($id) {
        Basket::findOrFail($id)->delete();
        return back();
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
