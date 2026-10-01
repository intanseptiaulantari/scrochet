<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seya's Crochet</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .bg-shop {
            background: linear-gradient(rgba(26, 0, 36, 0.85), rgba(26, 0, 36, 0.85)),
                        url("{{ asset('images/bg-register.png') }}");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .text-gold { color: #D4AF37; }
        .bg-purple-form { background-color: #2e003e; } /* Ungu lebih cerah sedikit agar kontras */
        input:focus { outline: none; border: 1px solid #D4AF37; }
    </style>
</head>
<body class="bg-shop min-h-screen text-white font-sans">

    <nav class="flex items-center justify-between px-12 py-6">
        <div class="w-24 h-24 flex items-center justify-center">
            <img src="{{ asset('images/logo-gold.png') }}" alt="Logo" class="w-full h-full object-contain">
        </div>
        <div class="hidden md:flex space-x-8 text-gold font-medium">
            <a href="/dashboard" class="hover:text-white">Home</a>
            <a href="/collections" class="hover:text-white">Collections</a>
            <a href="/account" class="hover:text-white">My Account</a>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto px-12 mt-4">
        <a href="javascript:history.back()" class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gold/20 text-gold hover:bg-gold hover:text-black transition mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
        <h1 class="text-gold text-4xl italic mb-8 font-serif">Order Product</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-start">

            <div class="flex flex-col sm:flex-row items-center gap-6">
                <div class="w-48 h-48 rounded-xl overflow-hidden border-2 border-gold/30 shadow-2xl">
                    <img src="{{ asset($product->image) }}" class="w-full h-full object-cover">
                </div>
                <div class="text-center sm:text-left">
                    <h2 class="text-gold text-2xl font-bold uppercase tracking-wider mb-3">{{ $product->name }}</h2>
                    <div class="inline-flex items-center bg-gray-200 text-black rounded-lg overflow-hidden">
                        <button onclick="updateQty(-1)" class="px-4 py-2 hover:bg-gray-300 font-bold text-xl">-</button>
                        <input type="number" id="qty" value="1" class="w-12 text-center bg-transparent font-bold text-lg" readonly>
                        <button onclick="updateQty(1)" class="px-4 py-2 hover:bg-gray-300 font-bold text-xl">+</button>
                    </div>
                </div>
            </div>

            <div class="bg-purple-form p-8 rounded-2xl shadow-2xl border border-gold/20 relative">
                <div class="absolute top-4 right-4 w-12 h-12 opacity-30">
                    <img src="{{ asset('images/logo-gold.png') }}" class="w-full h-full object-contain">
                </div>

                <form action="{{ route('order.complete') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" id="input_qty" value="1">
                    <input type="hidden" name="points_used" id="input_points_used" value="0">
                    <input type="hidden" name="final_price" id="input_final_price" value="{{ $product->price }}">

                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label class="text-gold text-xs font-bold uppercase tracking-tighter">Customer Name</label>
                            <input type="text" value="{{ $user->username }}" class="w-full bg-gray-200 text-black p-2.5 rounded-lg mt-1 font-medium" readonly>
                        </div>

                        <div>
                            <label class="text-gold text-xs font-bold uppercase tracking-tighter">Shipping Address</label>
                            <input type="text" value="{{ $user->address }}" class="w-full bg-gray-200 text-black p-2.5 rounded-lg mt-1 font-medium" readonly>
                        </div>

                        <div>
                            <label class="text-gold text-xs font-bold uppercase tracking-tighter">Price</label>
                            <input type="text" id="display_price" value="Rp. {{ number_format($product->price, 0, ',', '.') }}" class="w-full bg-gray-200 text-black p-2.5 rounded-lg mt-1 font-bold" readonly>
                        </div>

                        <div>
                            <label class="text-gold text-xs font-bold uppercase tracking-tighter">Notes</label>
                            <textarea name="notes" placeholder="Example: Send as a gift..." rows="2" class="w-full bg-gray-200 text-black p-2.5 rounded-lg mt-1 focus:ring-1 focus:ring-gold"></textarea>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label class="text-gold text-xs font-bold uppercase">Payment Method</label>
                        <div class="flex gap-8">
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input type="radio" name="payment" value="COD" checked class="w-4 h-4 accent-gold">
                                <span class="text-sm group-hover:text-gold transition">COD (Cash on Delivery)</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input type="radio" name="payment" value="Transfer" class="w-4 h-4 accent-gold">
                                <span class="text-sm group-hover:text-gold transition">Bank Transfer</span>
                            </label>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-white/10 mt-6 space-y-2">
                        <div class="flex justify-between items-center">
                            <label class="flex items-center gap-2 text-sm cursor-pointer">
                                <input type="checkbox" id="use_point_checkbox" class="w-4 h-4 accent-gold" onchange="calculate()">
                                <span>Use My Points</span>
                            </label>
                            <span class="text-red-400 font-bold">-Rp. {{ number_format($user->points ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-red-600 font-black text-lg uppercase tracking-widest">Total Price</span>
                            <span class="text-red-600 font-black text-2xl" id="total_val">Rp. {{ number_format($product->price, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-[#D4AF37] text-black font-bold py-3 rounded-lg mt-6 hover:bg-yellow-600 transition">
                        Complete Order
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const pricePerItem = {{ $product->price }};
        const userPoints = {{ $user->points ?? 0 }};

        function updateQty(val) {
            let qtyInput = document.getElementById('qty');
            let currentQty = parseInt(qtyInput.value);
            let newQty = currentQty + val;

            if (newQty > 0) {
                qtyInput.value = newQty;
                document.getElementById('input_qty').value = newQty;
                calculate();
            }
        }

        function calculate() {
            const qty = parseInt(document.getElementById('qty').value);
            const isUsingPoint = document.getElementById('use_point_checkbox').checked;

            let basePrice = pricePerItem * qty;
            let pointsToUse = isUsingPoint ? userPoints : 0;
            let finalPrice = basePrice - pointsToUse;

            if(finalPrice < 0) finalPrice = 0;

            document.getElementById('display_price').value = "Rp. " + basePrice.toLocaleString('id-ID');
            document.getElementById('total_val').innerText = "Rp. " + finalPrice.toLocaleString('id-ID');

            document.getElementById('input_points_used').value = pointsToUse;
            document.getElementById('input_final_price').value = finalPrice;
        }
    </script>
</body>
</html>
