<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function myAccount()
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('register')->with('error', 'Please login first');
        }

        $orders = Order::where('user_id', $user->id)
                    ->with('product')
                    ->latest()
                    ->get();

        $chartData = [
            'labels' => $orders->groupBy('product.name')->keys(),
            'data' => $orders->groupBy('product.name')->map->count()->values()
        ];

        return view('account', compact('user', 'orders', 'chartData'));
    }

    public function logoutAndDelete(Request $request)
    {
        $user = Auth::user();

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($user) {
            $user->delete();
        }

        return redirect('/')->with('success', 'Account deleted and logged out.');
    }
}
