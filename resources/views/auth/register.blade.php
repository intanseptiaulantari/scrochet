<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seya's Crochet</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Gradasi sesuai Landing Page */
        .bg-custom-gradient {
            background: radial-gradient(circle at top left, #240031 0%, #000000 100%);
        }
        .text-gold { color: #D4AF37; }
        .bg-gold { background-color: #D4AF37; }
        .border-gold { border-color: #D4AF37; }

        /* Layer gambar dengan opacity rendah */
        .bg-overlay {
            background-image: url('/images/bg-register.png');
            background-size: cover;
            background-position: center;
            opacity: 0.15;
        }

        /* Input field dengan warna abu-abu sesuai desain sebelumnya */
        .input-field { background-color: #D9D9D9; color: #333; }
    </style>
</head>
<body class="bg-custom-gradient min-h-screen flex items-center justify-center relative overflow-hidden">

    <div class="absolute inset-0 bg-overlay z-0"></div>

    <div class="relative z-10 bg-black/40 backdrop-blur-sm p-10 w-full max-w-md border border-white/10 shadow-2xl rounded-xl">
        <div class="flex flex-col items-center">
            <div class="w-24 h-24 flex items-center justify-center">
                <img src="{{ asset('images/logo-gold.png') }}" alt="Logo" class="w-full h-full object-contain">
            </div>

            <form action="/register" method="POST" class="w-full space-y-5">
                @csrf
                <input type="text" name="username" placeholder="Username" required
                    class="input-field w-full py-3 px-4 rounded focus:outline-none focus:ring-2 focus:ring-gold">

                <input type="email" name="email" placeholder="Email" required
                    class="input-field w-full py-3 px-4 rounded focus:outline-none focus:ring-2 focus:ring-gold">

                <input type="text" name="address" placeholder="Address" required
                    class="input-field w-full py-3 px-4 rounded focus:outline-none focus:ring-2 focus:ring-gold">

                <input type="password" name="password" placeholder="Password" required
                    class="input-field w-full py-3 px-4 rounded focus:outline-none focus:ring-2 focus:ring-gold">

                <div class="flex justify-center pt-4">
                    <button type="submit" class="bg-gold text-black font-bold py-3 px-12 rounded-full hover:bg-yellow-600 transition duration-300 shadow-lg">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
