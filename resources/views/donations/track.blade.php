<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Lacak Status Donasi - Lemari Peduli</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-cream text-gray-800 min-h-screen flex flex-col justify-between">

    <!-- Navbar Sederhana -->
    <header class="bg-white/80 backdrop-blur border-b border-sage/20 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center space-x-2.5">
                <span class="p-2 bg-sage/20 text-dark-green rounded-xl text-xl font-bold">👕</span>
                <span class="font-extrabold text-xl text-dark-green tracking-tight">Lemari Peduli</span>
            </a>

            <div class="flex items-center space-x-3 text-sm font-semibold">
                @auth
                    <a href="{{ route('donations.index') }}" class="text-dark-green hover:text-sage transition">Donasi Saya</a>
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-dark-green text-white rounded-xl hover:bg-sage transition">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-dark-green hover:text-sage transition">Masuk</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 bg-dark-green text-white rounded-xl hover:bg-sage transition">Daftar Donatur</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Konten Utama -->
    <main class="flex-grow py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto space-y-8">

            <!-- Hero Title -->
            <div class="text-center space-y-3">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-sage/20 text-dark-green border border-sage/30">
                    🔍 Pelacakan Resi Publik
                </span>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-dark-green tracking-tight">
                    Lacak Perjalanan Pakaian Donasi Anda
                </h1>
                <p class="text-sm sm:text-base text-gray-600 max-w-xl mx-auto">
                    Ketahui status terkini paket pakaian yang telah Anda serahkan secara transparan mulai dari pengajuan hingga disalurkan.
                </p>
            </div>

            <!-- Form Pencarian Resi -->
            <div class="bg-white rounded-2xl shadow-sm border border-sage/40 p-6 sm:p-8">
                <form action="{{ route('donations.track') }}" method="GET" class="space-y-4">
                    <label for="code" class="block text-sm font-bold text-gray-700">
                        Masukkan Nomor Resi / Kode Tracking Donasi
                    </label>

                    <div class="flex flex-col sm:flex-row gap-3">
                        <div class="relative flex-1">
                            <input type="text"
                                   id="code"
                                   name="code"
                                   value="{{ request('code') }}"
                                   required
                                   placeholder="Contoh: DON-20261006-XXXX"
                                   class="w-full font-mono text-base font-bold text-dark-green uppercase ps-11 pe-4 py-3 rounded-xl border-gray-300 focus:border-sage focus:ring focus:ring-sage/20 transition">
                            <span class="absolute start-3.5 top-3.5 text-gray-400 text-lg">🏷️</span>
                        </div>

                        <button type="submit"
                                class="px-7 py-3 bg-dark-green text-white font-bold rounded-xl hover:bg-sage transition shadow-sm flex items-center justify-center space-x-2">
                            <span>Lacak Status</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                    <p class="text-xs text-gray-500">
                        *Kode tracking dapat dilihat pada riwayat donasi atau pada lembar resi paket Anda.
                    </p>
                </form>
            </div>

            <!-- Hasil Pencarian -->
            @if (request()->has('code'))
                @if ($donation)
                    <!-- Kartu Hasil Ditemukan -->
                    <div class="bg-white rounded-2xl shadow-sm border-2 border-sage/40 overflow-hidden space-y-6 p-6 sm:p-8 animate-fade-in">

                        <!-- Header Hasil -->
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between border-b border-gray-100 pb-5 gap-3">
                            <div>
                                <span class="text-xs font-mono text-warm-brown uppercase tracking-wider font-bold">Kode Tracking Valid</span>
                                <h3 class="text-2xl font-black text-dark-green font-mono mt-0.5">
                                    {{ $donation->tracking_code }}
                                </h3>
                                <p class="text-xs text-gray-400 mt-1">
                                    Diajukan pada {{ $donation->created_at->format('d F Y, H:i') }} WIB
                                </p>
                            </div>
                            <div>
                                <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold border {{ $donation->status_badge_class }}">
                                    {{ $donation->status_label }}
                                </span>
                            </div>
                        </div>

                        <!-- Stepper Timeline -->
                        @php
                            $steps = [
                                'menunggu' => ['label' => 'Diajukan', 'desc' => 'Menunggu verifikasi admin'],
                                'diverifikasi' => ['label' => 'Diverifikasi', 'desc' => 'Disetujui untuk dikirim'],
                                'diterima' => ['label' => 'Diterima Posko', 'desc' => 'Pakaian disortir di posko'],
                                'disalurkan' => ['label' => 'Disalurkan', 'desc' => 'Diterima yang membutuhkan'],
                            ];
                            $statusOrder = ['menunggu' => 1, 'diverifikasi' => 2, 'diterima' => 3, 'disalurkan' => 4, 'dibatalkan' => 0];
                            $currentLevel = $statusOrder[$donation->status] ?? 1;
                        @endphp

                        @if ($donation->status === 'dibatalkan')
                            <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-sm">
                                🚫 <strong>Donasi Telah Dibatalkan:</strong> Pengajuan ini tidak diproses lebih lanjut oleh posko.
                            </div>
                        @else
                            <div>
                                <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-4">
                                    Tahapan Perjalanan Donasi
                                </h4>
                                <div class="grid grid-cols-1 sm:grid-cols-4 gap-3">
                                    @foreach ($steps as $key => $s)
                                        @php
                                            $level = $statusOrder[$key];
                                            $done = $currentLevel >= $level;
                                            $active = $currentLevel === $level;
                                        @endphp
                                        <div class="p-3.5 rounded-xl border {{ $active ? 'bg-sage/15 border-dark-green' : ($done ? 'bg-cream/40 border-sage/40' : 'bg-gray-50 border-gray-200 opacity-60') }}">
                                            <div class="flex items-center space-x-2 mb-1">
                                                <span class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold {{ $done ? 'bg-dark-green text-white' : 'bg-gray-300 text-gray-700' }}">
                                                    {{ $done && !$active ? '✓' : $level }}
                                                </span>
                                                <span class="text-xs font-bold {{ $active ? 'text-dark-green' : ($done ? 'text-gray-900' : 'text-gray-500') }}">
                                                    {{ $s['label'] }}
                                                </span>
                                            </div>
                                            <p class="text-[11px] text-gray-500 ps-8">
                                                {{ $s['desc'] }}
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Ringkasan Paket Donasi -->
                        <div class="bg-cream/30 rounded-xl p-5 border border-sage/20 grid grid-cols-2 sm:grid-cols-4 gap-4 text-xs">
                            <div>
                                <span class="text-gray-500 block mb-0.5">Nama Donatur</span>
                                <span class="font-bold text-gray-800 text-sm">{{ $donation->donor_name }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500 block mb-0.5">Jenis Pakaian</span>
                                <span class="font-bold text-gray-800 text-sm">{{ $donation->clothing_type }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500 block mb-0.5">Jumlah Donasi</span>
                                <span class="font-bold text-dark-green text-sm">{{ $donation->quantity }} Potong</span>
                            </div>
                            <div>
                                <span class="text-gray-500 block mb-0.5">Metode</span>
                                <span class="font-semibold text-gray-800">{{ $donation->delivery_method_label }}</span>
                            </div>
                        </div>

                        <!-- Catatan jika ada -->
                        @if ($donation->notes)
                            <div class="text-xs text-gray-600 bg-gray-50 p-4 rounded-xl border border-gray-200">
                                <span class="font-bold text-gray-700 block mb-1">Catatan / Update Petugas:</span>
                                <p class="whitespace-pre-line">{{ $donation->notes }}</p>
                            </div>
                        @endif

                    </div>
                @else
                    <!-- Alert Tidak Ditemukan -->
                    <div class="bg-white rounded-2xl border border-rose-200 p-8 text-center space-y-3">
                        <span class="text-4xl block">🔍❌</span>
                        <h4 class="text-lg font-bold text-rose-800">Kode Tracking Tidak Ditemukan</h4>
                        <p class="text-xs text-gray-500 max-w-md mx-auto">
                            Kode <span class="font-mono font-bold text-gray-800">"{{ request('code') }}"</span> tidak terdaftar di sistem Lemari Peduli. Mohon periksa kembali nomor resi yang Anda masukkan.
                        </p>
                    </div>
                @endif
            @endif

        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-sage/20 py-6 text-center text-xs text-gray-500">
        <div class="max-w-7xl mx-auto px-4">
            <p>&copy; {{ date('Y') }} <strong>Lemari Peduli</strong> — Praktikum Pemrograman Web II (Tim 3 Shift A)</p>
        </div>
    </footer>

</body>
</html>
