<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seya's Crochet</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@1,600&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .font-playfair { font-family: 'Playfair Display', serif; }
        .bg-custom-gradient {
            background: radial-gradient(circle at top left, #240031 0%, #000000 100%);
        }
        .text-gold { color: #D4AF37; }
        .border-gold { border-color: #D4AF37; }
        .bg-gold { background-color: #D4AF37; }
    </style>
</head>
<body class="bg-custom-gradient min-h-screen text-white overflow-x-hidden">

    <header class="p-8">
        <div class="w-24 h-24 flex items-center justify-center">
            <img src="{{ asset('images/logo-gold.png') }}" alt="Logo" class="w-full h-full object-contain">
        </div>
    </header>

    <main class="container mx-auto px-6 flex flex-col lg:flex-row items-center justify-between mt-10">
        <div class="lg:w-1/2 space-y-6">
            <h1 class="text-6xl lg:text-7xl font-playfair italic text-gold leading-tight">
                Your Best Palace
            </h1>
            <p class="text-2xl lg:text-3xl text-gold/80 font-light tracking-wide">
                To Search Handmade
            </p>

            <div class="flex items-center gap-4 pt-6">
                @if(auth()->check())
                    <a href="{{ route('dashboard') }}" class="flex-1 md:flex-none text-center bg-[#D4AF37] text-black px-10 py-3 rounded-md font-bold text-lg hover:bg-[#b8952e] transition shadow-lg">
                        Shop Now
                    </a>
                @else
                    <a href="{{ route('register') }}" class="flex-1 md:flex-none text-center bg-[#D4AF37] text-black px-10 py-3 rounded-md font-bold text-lg hover:bg-[#b8952e] transition shadow-lg">
                        Shop Now
                    </a>
                @endif
                <a href="{{ route('register') }}" class="flex-1 md:flex-none text-center border-2 border-[#D4AF37] text-[#D4AF37] px-10 py-3 rounded-md font-bold text-lg hover:bg-[#D4AF37] hover:text-black transition">
                    Register
                </a>
            </div>
        </div>

        <div class="lg:w-1/2 mt-16 lg:mt-0 relative">
            <div class="rounded-lg overflow-hidden shadow-2xl border border-white/10">
                <img src="/images/bg-register.png" alt="Crochet Display" class="w-full object-cover shadow-inner">
            </div>
        </div>
    </main>

</body>
</html>
