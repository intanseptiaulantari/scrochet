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
        .bg-purple-box { background-color: #240031; }
    </style>
</head>
<body class="bg-custom min-h-screen text-white font-sans">

    <nav class="flex items-center justify-between px-12 py-6">
        <div class="w-24 h-24 flex items-center justify-center">
            <img src="{{ asset('images/logo-gold.png') }}" alt="Logo" class="w-full h-full object-contain">
        </div>
        <div class="hidden md:flex space-x-10 text-gold font-medium items-center">
            <a href="/dashboard">Home</a>
            <a href="/collections">Collections</a>
            <a href="/account" class="text-white border-b border-gold">My Account</a>
            <a href="/basket" class="text-gold hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </a>
        </div>
    </nav>
    <div class="max-w-6xl mx-auto px-2 mt-2">
        <a href="javascript:history.back()" class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gold/20 text-gold hover:bg-gold hover:text-black transition mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
    </div>

    <div class="max-w-6xl mx-auto px-12 mt-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-start">
            <h2 class="text-gold italic font-serif text-2xl mb-6">My Account</h2>
            <div class="space-y-4 text-left">
                <div>
                    <label class="text-white text-xs font-bold block mb-1">Username</label>
                    <input type="text" value="{{ $user->username }}" class="w-full bg-[#D1D5DB] p-2 rounded text-black font-semibold" readonly>
                </div>
                <div>
                    <label class="text-white text-xs font-bold block mb-1">Address</label>
                    <input type="text" value="{{ $user->address }}" class="w-full bg-[#D1D5DB] p-2 rounded text-black font-semibold" readonly>
                </div>
                <div>
                    <label class="text-white text-xs font-bold block mb-1">Email</label>
                    <input type="email" value="{{ $user->email }}" class="w-full bg-[#D1D5DB] p-2 rounded text-black font-semibold" readonly>
                </div>
            </div>
            <form action="{{ route('logout.delete') }}" method="POST" class="mt-8">
                @csrf
                <button type="submit" class="bg-red-600 text-white font-bold py-2 px-10 rounded-full uppercase text-xs">Log Out</button>
            </form>
        </div>
    </div>
</body>
</html>
