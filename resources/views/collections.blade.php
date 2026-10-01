<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seya's Crochet</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .bg-custom-gradient { background: radial-gradient(circle at top left, #1a0024 0%, #000000 100%); }
        .text-gold { color: #D4AF37; }
        .card-gold { background-color: #D4AF37; border-radius: 8px; transition: transform 0.3s; }
        .card-gold:hover { transform: translateY(-5px); }
    </style>
</head>
<body class="bg-custom-gradient min-h-screen text-white font-sans">

    <nav class="flex items-center justify-between px-12 py-6">
        <div class="w-24 h-24 flex items-center justify-center">
            <img src="{{ asset('images/logo-gold.png') }}" alt="Logo" class="w-full h-full object-contain">
        </div>
        <div class="hidden md:flex space-x-8 text-gold font-medium">
            <a href="/dashboard" class="hover:text-white">Home</a>
            <a href="/collections" class="hover:text-white">Collections</a>
            <a href="/account" class="hover:text-white">My Account</a>
            <a href="/basket" class="text-gold hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </a>
        </div>
    </nav>
    <div class="max-w-6xl mx-auto px-12 mt-4">
        <a href="javascript:history.back()" class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gold/20 text-gold hover:bg-gold hover:text-black transition mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
    </div>
    <div class="text-center mb-16">
        <h1 class="text-gold text-5xl italic font-serif" style="font-family: 'Playfair Display', serif;">Our Products</h1>
    </div>

    <div class="max-w-6xl mx-auto px-12 pb-20">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            @foreach($products as $product)
            <div class="card-gold p-4 flex flex-col h-full">
                <div class="bg-[#1a0024] rounded shadow-inner overflow-hidden mb-4 aspect-square">
                    <img src="{{ asset($product->image) }}" class="w-full h-full object-cover">
                </div>

                <div class="grow">
                    <h4 class="text-black font-bold text-lg mb-1">{{ $product->name }}</h4>
                    <p class="text-black/70 text-xs mb-4">{{ Str::limit($product->description, 40) }}</p>
                </div>

                <div class="mt-auto">
                    <div class="text-right mb-3">
                        <span class="text-red-600 font-bold text-sm">Rp. {{ number_format($product->price, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <form action="{{ route('buy.product', $product->id) }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit" class="bg-[#6b21a8] text-white px-6 py-1.5 rounded-full text-xs font-bold hover:bg-purple-900 transition w-3/4">
                                <a href="{{ route('shop.show', $product->id) }}" class="...">Buy Now</a>
                            </button>
                        </form>
                        <form action="{{ route('basket.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="border border-black p-2 rounded-lg hover:bg-black hover:text-gold transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</body>
</html>
