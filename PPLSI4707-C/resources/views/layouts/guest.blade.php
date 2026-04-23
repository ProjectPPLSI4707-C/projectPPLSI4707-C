<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistem Informasi Koperasi Simpan Pinjam - Platform manajemen koperasi modern">
    <title>@yield('title', 'Koperasi Simpan Pinjam')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-navy-900 via-navy-800 to-navy-950 flex items-center justify-center p-4 font-sans antialiased">

    {{-- Background decorative elements --}}
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-accent-500/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-accent-400/10 rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-navy-700/20 rounded-full blur-3xl"></div>
    </div>

    <div class="w-full max-w-md relative z-10 animate-scale-in">
        {{-- Logo & Title --}}
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-accent-400 to-accent-600 rounded-2xl shadow-lg shadow-accent-500/30 mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Koperasi Simpan Pinjam</h1>
            <p class="text-navy-300 text-sm mt-1">Sistem Informasi Manajemen Koperasi</p>
        </div>

        {{-- Alert Messages --}}
        @if(session('success'))
            <div class="mb-4 p-4 bg-accent-500/10 border border-accent-500/30 rounded-xl text-accent-300 text-sm animate-fade-in">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        {{-- Content Card --}}
        <div class="glass rounded-2xl shadow-2xl shadow-black/20 p-8">
            @yield('content')
        </div>

        {{-- Footer --}}
        <p class="text-center text-navy-400 text-xs mt-6">&copy; {{ date('Y') }} Koperasi Simpan Pinjam. All rights reserved.</p>
    </div>

</body>
</html>
