<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seya's Crochet</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .bg-custom {
            background: linear-gradient(rgba(26, 0, 36, 0.9), rgba(26, 0, 36, 0.9)),
                        url("{{ asset('images/bg-register.png') }}");
            background-size: cover; background-attachment: fixed;
        }
        .text-gold { color: #D4AF37; }
        .bg-card { background-color: #D4AF37; } /* Kuning emas untuk kartu sesuai gambar */
    </style>
</head>
<body class="bg-custom min-h-screen text-white">

    <nav class="flex items-center justify-between px-12 py-6">
        <div class="w-16 h-16"><img src="{{ asset('images/logo-gold.png') }}" class="w-full h-full object-contain"></div>
        <div class="hidden md:flex space-x-10 text-gold font-medium">
            <a href="/dashboard">Home</a>
            <a href="/collections">Collections</a>
            <a href="/account">My Account</a>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto px-12 mt-4">
        <a href="javascript:history.back()" class="text-gold text-sm font-bold flex items-center gap-1 mb-2">
            <span class="text-lg">❮</span> Back
        </a>

        <div class="flex justify-between items-end mb-10">
            <h1 class="text-gold text-4xl italic font-serif mx-auto">My Basket</h1>
            <a href="{{ route('collections') }}" class="bg-[#6b21a8] text-white px-6 py-2 rounded-full text-xs font-bold hover:bg-purple-800 transition">
                Add Collections
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($items as $item)
            <div class="bg-card p-4 rounded-lg flex gap-4 items-center shadow-lg text-black">
                <div class="w-24 h-24 bg-black rounded overflow-hidden">
                    <img src="{{ asset($item->product->image) }}" class="w-full h-full object-cover">
                </div>
                <div class="grow">
                    <h4 class="font-bold text-sm">{{ $item->product->name }}</h4>
                    <p class="text-[10px] leading-tight">Quantity: ...</p>
                    <p class="text-[10px] leading-tight">Notes:</p>

                    <div class="flex gap-2 mt-4">
                        <a href="{{ route('shop.show', $item->product_id) }}" class="bg-[#4ade80] text-black text-[10px] font-bold py-1 px-4 rounded-full hover:bg-green-500 transition">
                            Checkout
                        </a>
                        <form action="{{ route('basket.delete', $item->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white text-[10px] font-bold py-1 px-4 rounded-full hover:bg-red-800 transition">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-2 text-center py-20 italic text-gold/50">Your basket is empty.</div>
            @endforelse
        </div>
    </div>
</body>
</html>
