<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seya's Crochet</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .bg-custom-gradient { background: radial-gradient(circle at top left, #240031 0%, #000000 100%); }
        .text-gold { color: #D4AF37; }
        .bg-gold { background-color: #D4AF37; }
        .card-gold { background-color: #D4AF37; border-radius: 12px; }

        /* Animasi Transisi Slider */
        .slider-item { display: none; transition: opacity 0.5s ease-in-out; }
        .slider-item.active { display: block; }
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

    <div class="px-12 mb-12">
        <div class="w-full h-100 rounded-2xl overflow-hidden relative border border-white/10 group">

            <div class="slider-item active h-full w-full">
                <img src="{{ asset('images/home-1.png') }}" class="w-full h-full object-cover">
            </div>
            <div class="slider-item h-full w-full">
                <img src="{{ asset('images/home-2.png') }}" class="w-full h-full object-cover">
            </div>
            <div class="slider-item h-full w-full">
                <img src="{{ asset('images/home-3.png') }}" class="w-full h-full object-cover">
            </div>

            <div class="absolute inset-0 flex items-center justify-between px-6 opacity-0 group-hover:opacity-100 transition-opacity">
                <button onclick="changeSlide(-1)" class="bg-black/50 text-gold w-12 h-12 rounded-full flex items-center justify-center text-3xl hover:bg-gold hover:text-black">❮</button>
                <button onclick="changeSlide(1)" class="bg-black/50 text-gold w-12 h-12 rounded-full flex items-center justify-center text-3xl hover:bg-gold hover:text-black">❯</button>
            </div>
        </div>
    </div>

    <div class="px-12 grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
        <div class="bg-[#1a0024] p-8 rounded-xl flex flex-col items-center">
            <h3 class="text-gold mb-4 uppercase tracking-widest text-sm">shopping chart</h3>
            <div class="w-48 h-48">
                <canvas id="shoppingChart"></canvas>
            </div>
        </div>

        <div class="flex flex-col items-center justify-center space-y-4">
            <h3 class="text-gold text-2xl font-bold uppercase tracking-widest">Your Point</h3>
            <span class="text-gold text-7xl font-light">{{ auth()->user()->points ?? 0 }}</span>
            <a href="/collections" class="bg-gold text-black px-10 py-2 rounded-lg font-bold hover:bg-yellow-600 transition uppercase">
                Shop Now
            </a>
        </div>
    </div>

    <div id="products" class="px-12 mb-12">
        <h3 class="text-gold text-2xl font-semibold mb-8">Most Viewed Product</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($products as $product)
            <div class="card-gold p-4 text-black shadow-xl">
                <div class="bg-[#240031] rounded-lg overflow-hidden mb-4 aspect-square">
                    <img src="{{ asset($product->image) }}" class="w-full h-full object-cover">
                </div>
                <h4 class="font-bold text-xl uppercase italic">{{ $product->name }}</h4>
                <p class="text-sm mb-4 text-black/80">{{ Str::limit($product->description, 60) }}</p>
                <div class="flex justify-between items-center mt-auto">
                    <span class="text-red-700 font-extrabold text-lg">Rp. {{ number_format($product->price, 0, ',', '.') }}</span>
                    <div class="flex gap-2">
                        <form action="{{ route('buy.product', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-[#6b21a8] text-white px-5 py-2 rounded-full text-xs font-bold hover:bg-purple-900 transition">
                                Buy Now
                            </button>
                        </form>
                        <form action="{{ route('basket.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="border border-black p-2 rounded-lg hover:bg-black hover:text-gold transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-right mt-10">
            <a href="{{ route('collections') }}" class="text-gold hover:text-white transition text-lg font-semibold">
                View More...
            </a>
        </div>
    </div>

    <script>
        // Logika Slider
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slider-item');

        function changeSlide(direction) {
            slides[currentSlide].classList.remove('active');
            currentSlide = (currentSlide + direction + slides.length) % slides.length;
            slides[currentSlide].classList.add('active');
        }

        // Auto-play Slider (Ganti tiap 5 detik)
        setInterval(() => {
            changeSlide(1);
        }, 5000);

        // Di dalam dashboard.blade.php
        const ctx = document.getElementById('shoppingChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($chartData['labels']) !!},
                datasets: [{
                    data: {!! json_encode($chartData['data']) !!},
                    backgroundColor: ['#D4AF37', '#6b21a8', '#4b0082', '#9333ea'],
                    borderWidth: 0
                }]
            },
            options: {
                cutout: '80%',
                plugins: { legend: { display: false } }
            }
        });

    </script>
</body>
</html>
