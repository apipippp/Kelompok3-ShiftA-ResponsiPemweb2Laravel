<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Lemari Peduli - Platform Donasi Pakaian Bekas Layak Pakai</title>

    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-cream text-gray-800 selection:bg-sage selection:text-white">

    <!-- 1. NAVBAR UTAMA -->
    <header class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-sage/20 transition duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">

            <!-- Logo & Brand Name -->
            <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                <img src="{{ asset('images/logo.png') }}"
                     alt="Lemari Peduli Logo"
                     class="h-12 w-auto object-contain group-hover:scale-105 transition duration-200">
                <div class="flex flex-col">
                    <span class="font-black text-xl text-dark-green tracking-tight leading-tight">Lemari Peduli</span>
                    <span class="text-[11px] font-semibold text-warm-brown uppercase tracking-widest">Eco Wardrobe</span>
                </div>
            </a>

            <!-- Nav Links Desktop -->
            <nav class="hidden md:flex items-center space-x-8 text-sm font-semibold text-gray-700">
                <a href="#tentang" class="hover:text-dark-green transition">Tentang Kami</a>
                <a href="#alur" class="hover:text-dark-green transition">Cara Donasi</a>
                <a href="#panduan" class="hover:text-dark-green transition">Panduan Kelayakan</a>
                <a href="{{ route('donations.track') }}" class="text-warm-brown hover:text-dark-green flex items-center space-x-1 transition font-bold">
                    <span>🔍 Lacak Resi</span>
                </a>
            </nav>

            <!-- Auth Buttons -->
            <div class="flex items-center space-x-3 text-sm font-semibold">
                @auth
                    <a href="{{ route('donations.index') }}"
                       class="hidden sm:inline-block text-dark-green hover:text-sage transition font-bold">
                        Donasi Saya
                    </a>
                    <a href="{{ route('dashboard') }}"
                       class="px-5 py-2.5 bg-dark-green text-white rounded-xl hover:bg-sage transition shadow-sm font-bold flex items-center space-x-2">
                        <span>Dashboard</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="px-4 py-2 text-dark-green hover:text-sage transition font-bold">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}"
                       class="px-5 py-2.5 bg-dark-green text-white rounded-xl hover:bg-sage transition shadow-sm font-bold">
                        Daftar Donatur
                    </a>
                @endauth
            </div>

        </div>
    </header>

    <!-- 2. HERO SECTION -->
    <section class="relative overflow-hidden pt-12 pb-20 lg:pt-20 lg:pb-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">

                <!-- Teks Hero (Kiri) -->
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    <div class="inline-flex items-center space-x-2 px-3.5 py-1.5 rounded-full bg-sage/20 border border-sage/40 text-dark-green text-xs font-bold uppercase tracking-wider">
                        <span>🌱</span>
                        <span>Kurangi Limbah Tekstil • Bantu Sesama</span>
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-dark-green tracking-tight leading-[1.15]">
                        Beri Kehidupan Kedua <br class="hidden sm:inline">
                        untuk <span class="text-warm-brown underline decoration-sage decoration-4 underline-offset-4">Pakaianmu</span>.
                    </h1>

                    <p class="text-base sm:text-lg text-gray-600 max-w-2xl mx-auto lg:mx-0 leading-relaxed font-normal">
                        Lemari Peduli menjembatani masyarakat yang ingin mendonasikan pakaian bekas layak pakai kepada mereka yang membutuhkan, lengkap dengan sistem pelacakan resi transparan dan terpercaya.
                    </p>

                    <!-- Tombol Aksi -->
                    <div class="pt-2 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                        <a href="{{ route('donations.create') }}"
                           class="w-full sm:w-auto px-8 py-4 bg-dark-green text-white rounded-2xl font-bold text-base hover:bg-sage hover:shadow-lg transition duration-200 flex items-center justify-center space-x-2">
                            <span>Mulai Donasi Sekarang</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>

                        <a href="{{ route('donations.track') }}"
                           class="w-full sm:w-auto px-7 py-4 bg-white border-2 border-sage text-dark-green rounded-2xl font-bold text-base hover:bg-cream transition duration-200 flex items-center justify-center space-x-2">
                            <span>Lacak Nomor Resi</span>
                            <svg class="w-4 h-4 text-warm-brown" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </a>
                    </div>

                    <!-- Trust Badge -->
                    <div class="pt-4 flex items-center justify-center lg:justify-start space-x-6 text-xs text-gray-500 font-semibold">
                        <div class="flex items-center space-x-1.5">
                            <span class="text-dark-green font-bold text-base">✓</span>
                            <span>100% Bebas Biaya</span>
                        </div>
                        <div class="flex items-center space-x-1.5">
                            <span class="text-dark-green font-bold text-base">✓</span>
                            <span>Resi & Tracking Transparan</span>
                        </div>
                        <div class="flex items-center space-x-1.5">
                            <span class="text-dark-green font-bold text-base">✓</span>
                            <span>Penyaluran Tepat Sasaran</span>
                        </div>
                    </div>
                </div>

                <!-- Ilustrasi / Logo Showcase Card (Kanan) -->
                <div class="lg:col-span-5 flex justify-center">
                    <div class="relative w-full max-w-md">
                        <!-- Background Glow Accent -->
                        <div class="absolute -inset-4 bg-gradient-to-r from-sage/30 to-warm-brown/20 rounded-3xl blur-2xl opacity-70"></div>

                        <!-- Main Showcase Card -->
                        <div class="relative bg-white rounded-3xl shadow-xl border border-sage/40 p-8 space-y-6">
                            <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                                <div class="flex items-center space-x-3">
                                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-12 h-12 object-contain">
                                    <div>
                                        <h3 class="font-extrabold text-dark-green text-lg leading-tight">Lemari Peduli</h3>
                                        <span class="text-xs text-warm-brown font-semibold">Kebaikan Berkelanjutan</span>
                                    </div>
                                </div>
                                <span class="px-2.5 py-1 bg-sage/20 text-dark-green rounded-full text-xs font-bold">
                                    Aktif
                                </span>
                            </div>

                            <!-- Mockup Resi Tracking Preview -->
                            <div class="bg-cream/40 rounded-2xl p-5 border border-sage/30 space-y-3">
                                <div class="flex items-center justify-between text-xs">
                                    <span class="font-mono font-bold text-dark-green">DON-SAMPLE-2026</span>
                                    <span class="px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-bold">
                                        Telah Disalurkan
                                    </span>
                                </div>
                                <div class="text-xs text-gray-600">
                                    <p class="font-bold text-gray-800">5 Pcs Pakaian Anak & Dewasa</p>
                                    <p class="text-[11px] text-gray-500 mt-0.5">Diserahkan ke Panti Asuhan Kasih Ibu</p>
                                </div>
                                <div class="h-1.5 w-full bg-gray-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-dark-green w-full rounded-full"></div>
                                </div>
                            </div>

                            <!-- Kutipan Makna -->
                            <p class="text-xs text-gray-500 italic text-center leading-relaxed">
                                "Pakaian yang tidak lagi Anda kenakan bisa menjadi kehangatan berharga bagi saudaramu yang memerlukan."
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 3. LIVE STATISTIK METRICS -->
    <section class="py-10 bg-white border-y border-sage/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">

                <div class="p-4 space-y-1">
                    <span class="text-3xl sm:text-4xl font-black text-dark-green">
                        {{ number_format($totalClothing ?? 0) }}+
                    </span>
                    <p class="text-xs sm:text-sm font-semibold text-gray-600">Potong Pakaian Terkumpul</p>
                </div>

                <div class="p-4 space-y-1">
                    <span class="text-3xl sm:text-4xl font-black text-warm-brown">
                        {{ number_format($totalDonors ?? 0) }}
                    </span>
                    <p class="text-xs sm:text-sm font-semibold text-gray-600">Donatur Terdaftar</p>
                </div>

                <div class="p-4 space-y-1">
                    <span class="text-3xl sm:text-4xl font-black text-dark-green">
                        100%
                    </span>
                    <p class="text-xs sm:text-sm font-semibold text-gray-600">Transparansi Lacak Resi</p>
                </div>

                <div class="p-4 space-y-1">
                    <span class="text-3xl sm:text-4xl font-black text-warm-brown">
                        Gratis
                    </span>
                    <p class="text-xs sm:text-sm font-semibold text-gray-600">Layanan Sosial Tanpa Biaya</p>
                </div>

            </div>
        </div>
    </section>

    <!-- 4. ALUR & CARA KERJA DONASI -->
    <section id="alur" class="py-20 bg-cream/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto space-y-3 mb-16">
                <span class="text-xs font-bold uppercase tracking-wider text-warm-brown bg-warm-brown/10 px-3 py-1 rounded-full">
                    Sederhana & Mudah
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-dark-green tracking-tight">
                    4 Langkah Mudah Berdonasi Pakaian
                </h2>
                <p class="text-sm text-gray-600">
                    Hanya butuh beberapa menit dari meja Anda untuk menyebarkan kebaikan bagi lingkungan dan masyarakat.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                <!-- Step 1 -->
                <div class="bg-white rounded-2xl p-6 border border-sage/30 shadow-sm relative space-y-4 hover:border-dark-green transition">
                    <div class="w-12 h-12 rounded-xl bg-sage/20 text-dark-green font-black text-xl flex items-center justify-center">
                        1
                    </div>
                    <h3 class="font-bold text-lg text-dark-green">Sortir & Bersihkan</h3>
                    <p class="text-xs text-gray-600 leading-relaxed">
                        Pilih pakaian bekas Anda yang masih dalam kondisi layak pakai. Cuci hingga bersih dan keringkan sebelum dikemas.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="bg-white rounded-2xl p-6 border border-sage/30 shadow-sm relative space-y-4 hover:border-dark-green transition">
                    <div class="w-12 h-12 rounded-xl bg-sage/20 text-dark-green font-black text-xl flex items-center justify-center">
                        2
                    </div>
                    <h3 class="font-bold text-lg text-dark-green">Isi Formulir Online</h3>
                    <p class="text-xs text-gray-600 leading-relaxed">
                        Ajukan donasi di platform Lemari Peduli, masukkan jumlah pakaian, kondisi, dan dapatkan nomor resi pelacakan unik.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="bg-white rounded-2xl p-6 border border-sage/30 shadow-sm relative space-y-4 hover:border-dark-green transition">
                    <div class="w-12 h-12 rounded-xl bg-sage/20 text-dark-green font-black text-xl flex items-center justify-center">
                        3
                    </div>
                    <h3 class="font-bold text-lg text-dark-green">Kemas & Beri Resi</h3>
                    <p class="text-xs text-gray-600 leading-relaxed">
                        Masukkan pakaian ke dalam kardus/plastik pelindung, lalu cetak atau tuliskan nomor resi Anda pada permukaan paket.
                    </p>
                </div>

                <!-- Step 4 -->
                <div class="bg-white rounded-2xl p-6 border border-sage/30 shadow-sm relative space-y-4 hover:border-dark-green transition">
                    <div class="w-12 h-12 rounded-xl bg-sage/20 text-dark-green font-black text-xl flex items-center justify-center">
                        4
                    </div>
                    <h3 class="font-bold text-lg text-dark-green">Antar atau Kirim</h3>
                    <p class="text-xs text-gray-600 leading-relaxed">
                        Serahkan langsung ke posko drop-off terdekat atau kirim melalui ekspedisi kurir. Pantau status paket secara live.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- 5. PANDUAN KELAYAKAN PAKAIAN -->
    <section id="panduan" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto space-y-3 mb-16">
                <span class="text-xs font-bold uppercase tracking-wider text-dark-green bg-sage/20 px-3 py-1 rounded-full">
                    Standar Kualitas
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-dark-green tracking-tight">
                    Panduan Kelayakan Pakaian Donasi
                </h2>
                <p class="text-sm text-gray-600">
                    Demi menjaga martabat para penerima manfaat, pastikan pakaian yang Anda kirim memenuhi kriteria berikut.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">

                <!-- Pakaian Diterima -->
                <div class="bg-emerald-50/70 rounded-3xl p-8 border border-emerald-200 space-y-5">
                    <div class="flex items-center space-x-3 text-emerald-800">
                        <span class="w-8 h-8 rounded-full bg-emerald-200 flex items-center justify-center font-black">✓</span>
                        <h3 class="font-black text-lg">Pakaian yang Diterima</h3>
                    </div>
                    <ul class="space-y-3 text-sm text-emerald-900">
                        <li class="flex items-start space-x-2">
                            <span>•</span>
                            <span>Kaos, kemeja, celana, rok, dan jaket dalam kondisi bersih.</span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <span>•</span>
                            <span>Pakaian bayi, balita, anak, dan seragam sekolah lengkap.</span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <span>•</span>
                            <span>Jahitan masih kuat, kancing lengkap, ritsleting berfungsi.</span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <span>•</span>
                            <span>Baju ibadah / mukena / sarung yang suci dan wangi.</span>
                        </li>
                    </ul>
                </div>

                <!-- Pakaian Tidak Diterima -->
                <div class="bg-rose-50/70 rounded-3xl p-8 border border-rose-200 space-y-5">
                    <div class="flex items-center space-x-3 text-rose-800">
                        <span class="w-8 h-8 rounded-full bg-rose-200 flex items-center justify-center font-black">✕</span>
                        <h3 class="font-black text-lg">Pakaian yang Ditolak</h3>
                    </div>
                    <ul class="space-y-3 text-sm text-rose-900">
                        <li class="flex items-start space-x-2">
                            <span>•</span>
                            <span>Pakaian dalam (underwear), kaos kaki bekas, pakaian renang.</span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <span>•</span>
                            <span>Pakaian robek parah, bolong besar, atau kain rapuh lapuk.</span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <span>•</span>
                            <span>Terkontaminasi noda membandel seperti cat, minyak, atau jamur.</span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <span>•</span>
                            <span>Pakaian basah, berbau apek, atau kotor belum dicuci.</span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </section>

    <!-- 6. SEKSI PENYALURAN (DOKUMENTASI & TRANSPARANSI - SIAP DIINTEGRASIKAN FAIZAL) -->
    <section class="py-20 bg-cream/40 border-t border-sage/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto space-y-3 mb-12">
                <span class="text-xs font-bold uppercase tracking-wider text-warm-brown bg-warm-brown/10 px-3 py-1 rounded-full">
                    Transparansi & Bukti Nyata
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-dark-green tracking-tight">
                    Laporan Penyaluran Pakaian
                </h2>
                <p class="text-sm text-gray-600">
                    Setiap paket pakaian yang terkumpul disalurkan secara berkala ke panti asuhan, korban bencana, dan masyarakat prasejahtera.
                </p>
            </div>

            <!-- Kartu Bukti Penyaluran Preview -->
            <div class="bg-white rounded-3xl p-8 border border-sage/30 shadow-sm max-w-3xl mx-auto text-center space-y-4">
                <span class="text-4xl block">🤝📦</span>
                <h3 class="text-xl font-bold text-dark-green">Dokumentasi Serah Terima Bantuan</h3>
                <p class="text-xs sm:text-sm text-gray-500 max-w-lg mx-auto leading-relaxed">
                    Data dokumentasi serah terima pakaian disajikan secara terbuka untuk memastikan seluruh amanah pakaian tersalurkan tepat sasaran.
                </p>
                <div class="pt-2">
                    <a href="{{ route('donations.track') }}"
                       class="inline-flex items-center px-5 py-2.5 rounded-xl bg-warm-brown text-white text-xs font-bold hover:bg-dark-green transition shadow-sm">
                        Lacak Status Bantuan Anda Sekarang →
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- 7. CTA BOTTOM BANNER -->
    <section class="py-16 bg-dark-green text-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-16 h-16 mx-auto object-contain brightness-0 invert">
            <h2 class="text-3xl sm:text-4xl font-black tracking-tight">
                Punya Pakaian Menumpuk di Lemari?
            </h2>
            <p class="text-cream/90 text-sm sm:text-base max-w-xl mx-auto leading-relaxed">
                Jangan biarkan berakhir menjadi limbah di tempat pembuangan. Ubah pakaian tersebut menjadi senyuman dan berkah bagi sesama.
            </p>
            <div class="pt-2">
                <a href="{{ route('donations.create') }}"
                   class="inline-block px-8 py-4 bg-sage text-dark-green font-black rounded-2xl hover:bg-cream hover:text-dark-green transition duration-200 shadow-lg text-base">
                    Donasikan Sekarang — Gratis & Berkelanjutan
                </a>
            </div>
        </div>
    </section>

    <!-- 8. FOOTER -->
    <footer class="bg-white border-t border-sage/20 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">

                <div class="flex items-center space-x-3">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-auto object-contain">
                    <div>
                        <span class="font-black text-lg text-dark-green tracking-tight">Lemari Peduli</span>
                        <p class="text-xs text-gray-500">Platform Donasi Pakaian Bekas Layak Pakai</p>
                    </div>
                </div>

                <div class="text-center md:text-right text-xs text-gray-500 space-y-1">
                    <p class="font-semibold text-gray-700">Praktikum Pemrograman Web II — Shift A (Tim 3)</p>
                    <p>Afif Nur Rahman (H1H024016) • Nurul Maftuhah (H1H024002) • M. Faizal Khabibi (H1H024003)</p>
                </div>

            </div>
            <div class="mt-8 pt-6 border-t border-gray-100 text-center text-xs text-gray-400">
                &copy; {{ date('Y') }} Lemari Peduli. Dibuat dengan cinta & kepedulian lingkungan.
            </div>
        </div>
    </footer>

</body>
</html>
