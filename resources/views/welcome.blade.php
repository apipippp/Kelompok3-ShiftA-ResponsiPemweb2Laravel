<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Lemari Peduli — Sustainable Garment Circulation</title>

    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&display=swap" rel="stylesheet">

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-cream text-gray-800 selection:bg-sage selection:text-white min-h-[100dvh] flex flex-col justify-between">

    <!-- ======================================================== -->
    <!-- 1. FLUID ISLAND NAVIGATION (FLOATING DETACHED GLASS PILL) -->
    <!-- ======================================================== -->
    <div class="sticky top-4 z-50 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto w-full transition-all duration-500 ease-luxury">
        <header x-data="{ open: false }" class="fluid-glass rounded-3xl sm:rounded-full px-4 sm:px-6 py-2 transition-all duration-500 ease-luxury">
            <div class="flex items-center justify-between h-14">

                <!-- Logo & Brand Identifier -->
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <div class="w-10 h-10 rounded-full bg-sand/60 p-1 flex items-center justify-center border border-black/5 group-hover:scale-105 transition-transform duration-500 ease-luxury shadow-inner">
                        <img src="{{ asset('images/logo.png') }}"
                             alt="Lemari Peduli"
                             width="40"
                             height="40"
                             class="w-full h-full object-contain">
                    </div>
                    <div class="flex flex-col">
                        <span class="font-extrabold text-base text-forest tracking-tight leading-tight">Lemari Peduli</span>
                        <span class="text-[9px] font-bold text-warm-brown uppercase tracking-widest">Eco Wardrobe</span>
                    </div>
                </a>

                <!-- Desktop Navigation Pills -->
                <nav class="hidden lg:flex items-center space-x-1 xl:space-x-2">
                    <a href="#tentang" class="px-4 py-2 rounded-full text-xs font-semibold text-gray-600 hover:text-forest hover:bg-sand/40 transition-all duration-300">
                        Tentang Kami
                    </a>
                    <a href="#alur" class="px-4 py-2 rounded-full text-xs font-semibold text-gray-600 hover:text-forest hover:bg-sand/40 transition-all duration-300">
                        Alur Donasi
                    </a>
                    <a href="#panduan" class="px-4 py-2 rounded-full text-xs font-semibold text-gray-600 hover:text-forest hover:bg-sand/40 transition-all duration-300">
                        Kurasi Pakaian
                    </a>
                    <a href="{{ route('posko.public') }}" class="px-4 py-2 rounded-full text-xs font-semibold text-gray-600 hover:text-forest hover:bg-sand/40 transition-all duration-300">
                        Titik Posko
                    </a>
                    <a href="{{ route('laporan.public') }}" class="px-4 py-2 rounded-full text-xs font-semibold text-gray-600 hover:text-forest hover:bg-sand/40 transition-all duration-300">
                        Penyaluran
                    </a>
                    <a href="{{ route('donations.track') }}" class="px-4 py-2 rounded-full text-xs font-bold text-warm-brown hover:text-forest hover:bg-warm-brown-light transition-all duration-300 flex items-center gap-1.5">
                        <span>🔍 Lacak Resi</span>
                    </a>
                </nav>

                <!-- Auth Island Action -->
                <div class="flex items-center space-x-3">
                    @auth
                        <a href="{{ route('dashboard') }}"
                           class="btn-island bg-forest text-white hover:bg-dark-green shadow-ambient-sm group">
                            <span>{{ Auth::user()->role === 'admin' ? 'Dashboard Admin' : 'Portal Donatur' }}</span>
                            <span class="w-7 h-7 rounded-full bg-white/15 flex items-center justify-center transition-transform duration-500 ease-luxury group-hover:translate-x-0.5 group-hover:-translate-y-0.5">
                                <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </span>
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="hidden sm:inline-block px-4 py-2 text-xs font-bold text-forest hover:text-sage transition-colors duration-300">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}"
                           class="btn-island bg-forest text-white hover:bg-dark-green shadow-ambient-sm group">
                            <span>Mulai Donasi</span>
                            <span class="w-7 h-7 rounded-full bg-white/15 flex items-center justify-center transition-transform duration-500 ease-luxury group-hover:translate-x-0.5 group-hover:-translate-y-0.5">
                                <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </span>
                        </a>
                    @endauth

                    <!-- Mobile Trigger -->
                    <button @click="open = ! open"
                            class="lg:hidden w-10 h-10 rounded-full bg-sand/50 border border-black/5 flex items-center justify-center text-forest hover:bg-sand transition">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

            </div>

            <!-- Mobile Drawer -->
            <div :class="{'block': open, 'hidden': ! open}" class="hidden lg:hidden pt-4 pb-3 border-t border-black/5 space-y-1">
                <a href="#tentang" @click="open = false" class="block px-4 py-2 rounded-xl text-xs font-bold text-forest hover:bg-sand/40">Tentang Kami</a>
                <a href="#alur" @click="open = false" class="block px-4 py-2 rounded-xl text-xs font-bold text-forest hover:bg-sand/40">Alur Donasi</a>
                <a href="#panduan" @click="open = false" class="block px-4 py-2 rounded-xl text-xs font-bold text-forest hover:bg-sand/40">Kurasi Pakaian</a>
                <a href="{{ route('posko.public') }}" class="block px-4 py-2 rounded-xl text-xs font-bold text-forest hover:bg-sand/40">Titik Posko</a>
                <a href="{{ route('laporan.public') }}" class="block px-4 py-2 rounded-xl text-xs font-bold text-forest hover:bg-sand/40">Laporan Penyaluran</a>
                <a href="{{ route('donations.track') }}" class="block px-4 py-2 rounded-xl text-xs font-bold text-warm-brown hover:bg-warm-brown-light">🔍 Lacak Nomor Resi</a>
            </div>
        </header>
    </div>

    <!-- ======================================================== -->
    <!-- 2. EDITORIAL HERO SECTION (SPLIT CASSETTE ARCHITECTURE) -->
    <!-- ======================================================== -->
    <section class="relative pt-16 pb-24 lg:pt-24 lg:pb-36 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">

                <!-- Left Column: Typography Statement -->
                <div class="lg:col-span-7 space-y-8 text-center lg:text-left">
                    <div class="inline-flex items-center space-x-2 px-3.5 py-1.5 rounded-full bg-sage/20 border border-sage/40 text-forest text-[10px] font-extrabold uppercase tracking-[0.25em]">
                        <span>🌱</span>
                        <span>Sirkulasi Pakaian Berkelanjutan</span>
                    </div>

                    <h1 class="text-4xl sm:text-6xl lg:text-7xl font-extrabold tracking-[-0.03em] text-forest leading-[1.08]">
                        Beri napas baru bagi pakaianmu. <br>
                        <span class="text-warm-brown italic font-normal">Hangatkan</span> sesama.
                    </h1>

                    <p class="text-base sm:text-lg text-gray-600 max-w-xl mx-auto lg:mx-0 leading-relaxed font-normal">
                        Lemari Peduli adalah infrastruktur sosial modern yang menjembatani pakaian bekas layak pakai menuju panti asuhan, korban bencana, dan masyarakat prasejahtera dengan transparansi nomor resi terdesentralisasi.
                    </p>

                    <!-- Nested CTA Island Buttons -->
                    <div class="pt-2 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                        <a href="{{ route('donations.create') }}"
                           class="w-full sm:w-auto btn-island bg-forest text-white hover:bg-dark-green shadow-ambient-lg group">
                            <span class="text-sm">Donasikan Pakaian Sekarang</span>
                            <span class="w-9 h-9 rounded-full bg-white/15 flex items-center justify-center transition-transform duration-500 ease-luxury group-hover:translate-x-1 group-hover:-translate-y-0.5">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </span>
                        </a>

                        <a href="{{ route('donations.track') }}"
                           class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-full bg-white hover:bg-cream border border-black/10 text-forest font-bold text-xs tracking-wider transition-all duration-300 shadow-ambient-sm active:scale-[0.98]">
                            <span>Lacak Nomor Resi</span>
                            <span class="text-warm-brown">🔍</span>
                        </a>
                    </div>

                    <!-- Trust Metrics Micro -->
                    <div class="pt-4 flex flex-wrap items-center justify-center lg:justify-start gap-6 text-xs text-gray-500 font-semibold">
                        <div class="flex items-center space-x-2">
                            <span class="w-5 h-5 rounded-full bg-sage/20 text-forest flex items-center justify-center text-[10px] font-bold">✓</span>
                            <span>100% Layanan Sosial Bebas Biaya</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="w-5 h-5 rounded-full bg-sage/20 text-forest flex items-center justify-center text-[10px] font-bold">✓</span>
                            <span>Pelacakan Tiket Resi Real-Time</span>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Double-Bezel Showcase Cassette -->
                <div class="lg:col-span-5 flex justify-center">
                    <div class="w-full max-w-md bezel-outer">
                        <div class="bezel-inner p-8 sm:p-10 space-y-6 relative overflow-hidden bg-white">
                            <!-- Background Watermark -->
                            <div class="absolute -right-8 -top-8 w-40 h-40 bg-sage/10 rounded-full blur-2xl pointer-events-none"></div>

                            <div class="flex items-center justify-between border-b border-black/[0.04] pb-5">
                                <div class="flex items-center space-x-3">
                                    <div class="w-12 h-12 rounded-2xl bg-sand/60 p-2 flex items-center justify-center border border-black/5">
                                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-full h-full object-contain">
                                    </div>
                                    <div>
                                        <h3 class="font-extrabold text-forest text-base leading-tight">Lemari Peduli</h3>
                                        <p class="text-[10px] text-warm-brown font-bold uppercase tracking-wider">Tiket Donasi Terverifikasi</p>
                                    </div>
                                </div>
                                <span class="px-3 py-1 rounded-full bg-sage/20 text-forest text-[10px] font-extrabold tracking-wider uppercase">
                                    Aktif
                                </span>
                            </div>

                            <!-- Interactive Mock Card -->
                            <div class="p-5 rounded-2xl bg-cream/50 border border-sand space-y-3 shadow-2xs">
                                <div class="flex items-center justify-between text-xs">
                                    <span class="font-mono font-extrabold text-forest text-xs">DON-202610-SAMPLE</span>
                                    <span class="px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800 text-[9px] font-extrabold uppercase">
                                        Tersalurkan
                                    </span>
                                </div>
                                <div class="text-xs text-gray-700">
                                    <p class="font-bold text-gray-900">10 Potong Pakaian Anak & Dewasa</p>
                                    <p class="text-[11px] text-gray-500 mt-0.5">Diserahkan ke Panti Asuhan Kasih Ibu</p>
                                </div>
                                <div class="h-1.5 w-full bg-black/5 rounded-full overflow-hidden">
                                    <div class="h-full bg-forest w-full rounded-full"></div>
                                </div>
                            </div>

                            <!-- Micro Feature List -->
                            <div class="space-y-2.5 pt-2 text-xs text-gray-600">
                                <div class="flex items-center space-x-2">
                                    <span class="text-forest font-bold">📍</span>
                                    <span>Drop-off posko atau kirim via ekspedisi kurir</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span class="text-forest font-bold">🏷️</span>
                                    <span>Label kardus otomatis siap cetak PDF</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span class="text-forest font-bold">🤝</span>
                                    <span>Bukti dokumentasi foto serah terima transparan</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ======================================================== -->
    <!-- 3. LIVE METRIC BENTO STRIP (REAL DATABASE DRIVEN)        -->
    <!-- ======================================================== -->
    <section class="py-12 bg-white/60 border-y border-black/[0.04]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 sm:gap-8">

                <div class="p-4 sm:p-6 text-center space-y-1 border-r border-black/[0.04] last:border-none">
                    <span class="text-3xl sm:text-5xl font-black text-forest tracking-tight">
                        {{ number_format($totalClothing ?? 0) }}+
                    </span>
                    <p class="text-xs sm:text-sm font-bold text-gray-600">Pakaian Terkumpul (pcs)</p>
                </div>

                <div class="p-4 sm:p-6 text-center space-y-1 md:border-r border-black/[0.04]">
                    <span class="text-3xl sm:text-5xl font-black text-warm-brown tracking-tight">
                        {{ number_format($totalDonors ?? 0) }}
                    </span>
                    <p class="text-xs sm:text-sm font-bold text-gray-600">Donatur Terdaftar</p>
                </div>

                <div class="p-4 sm:p-6 text-center space-y-1 border-r border-black/[0.04]">
                    <span class="text-3xl sm:text-5xl font-black text-forest tracking-tight">
                        {{ number_format($totalDistributed ?? 0) }}
                    </span>
                    <p class="text-xs sm:text-sm font-bold text-gray-600">Pakaian Disalurkan (pcs)</p>
                </div>

                <div class="p-4 sm:p-6 text-center space-y-1">
                    <span class="text-3xl sm:text-5xl font-black text-warm-brown tracking-tight">
                        {{ number_format($totalDropPoints ?? 0) }}
                    </span>
                    <p class="text-xs sm:text-sm font-bold text-gray-600">Titik Posko Drop-Off</p>
                </div>

            </div>
        </div>
    </section>

    <!-- ======================================================== -->
    <!-- 4. ASYMMETRICAL BENTO GRID: 4 TAHAPAN SIKLUS DONASI       -->
    <!-- ======================================================== -->
    <section id="alur" class="py-28 lg:py-36 bg-cream">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">

            <div class="text-center max-w-2xl mx-auto space-y-3">
                <span class="inline-flex items-center px-3.5 py-1 rounded-full bg-sand text-warm-brown text-[10px] font-extrabold uppercase tracking-[0.2em]">
                    Sirkulasi Kebaikan
                </span>
                <h2 class="text-3xl sm:text-5xl font-extrabold text-forest tracking-tight">
                    Alur Kerja Lemari Peduli
                </h2>
                <p class="text-sm sm:text-base text-gray-600 leading-relaxed font-normal">
                    Dirancang dengan efisiensi tinggi tanpa birokrasi rumit, menjembatani niat baik Anda menuju tangan penerima secara bertanggung jawab.
                </p>
            </div>

            <!-- Asymmetrical Bento Grid -->
            <div class="grid grid-cols-12 gap-6 lg:gap-8">

                <!-- Bento 1 (Large - Col 7) -->
                <div class="col-span-12 lg:col-span-7 bezel-outer">
                    <div class="bezel-inner p-8 sm:p-10 space-y-4 bg-white flex flex-col justify-between h-full">
                        <div class="flex items-center justify-between">
                            <span class="w-10 h-10 rounded-2xl bg-forest text-white font-black text-sm flex items-center justify-center">01</span>
                            <span class="text-[10px] font-extrabold uppercase tracking-widest text-warm-brown">Tahap Kurasi</span>
                        </div>
                        <div class="space-y-2">
                            <h3 class="text-2xl font-bold text-forest">Pilah & Bersihkan Pakaian</h3>
                            <p class="text-xs sm:text-sm text-gray-600 leading-relaxed max-w-lg">
                                Sortir pakaian di lemari Anda yang sudah jarang dipakai namun masih dalam kondisi layak pakai. Cuci hingga bersih, keringkan, dan kemas rapi dalam kardus atau plastik bening.
                            </p>
                        </div>
                        <div class="p-4 rounded-2xl bg-cream/50 border border-sand text-xs text-gray-500 font-semibold flex items-center space-x-3">
                            <span class="text-xl">🧺</span>
                            <span>Kaus, kemeja, celana, jaket, seragam sekolah, dan perlengkapan ibadah.</span>
                        </div>
                    </div>
                </div>

                <!-- Bento 2 (Stacked - Col 5) -->
                <div class="col-span-12 lg:col-span-5 bezel-outer">
                    <div class="bezel-inner p-8 sm:p-10 space-y-4 bg-white flex flex-col justify-between h-full">
                        <div class="flex items-center justify-between">
                            <span class="w-10 h-10 rounded-2xl bg-forest text-white font-black text-sm flex items-center justify-center">02</span>
                            <span class="text-[10px] font-extrabold uppercase tracking-widest text-warm-brown">Tahap Registrasi</span>
                        </div>
                        <div class="space-y-2">
                            <h3 class="text-2xl font-bold text-forest">Formulir Digital & Resi</h3>
                            <p class="text-xs sm:text-sm text-gray-600 leading-relaxed">
                                Isi formulir donasi secara online dengan menentukan estimasi jumlah potong dan kondisi pakaian. Sistem langsung menerbitkan nomor resi unik.
                            </p>
                        </div>
                        <div class="font-mono text-xs font-bold bg-forest text-cream p-3 rounded-xl text-center">
                            DON-{{ date('Ymd') }}-XXXX
                        </div>
                    </div>
                </div>

                <!-- Bento 3 (Stacked - Col 5) -->
                <div class="col-span-12 lg:col-span-5 bezel-outer">
                    <div class="bezel-inner p-8 sm:p-10 space-y-4 bg-white flex flex-col justify-between h-full">
                        <div class="flex items-center justify-between">
                            <span class="w-10 h-10 rounded-2xl bg-forest text-white font-black text-sm flex items-center justify-center">03</span>
                            <span class="text-[10px] font-extrabold uppercase tracking-widest text-warm-brown">Tahap Pelabelan</span>
                        </div>
                        <div class="space-y-2">
                            <h3 class="text-2xl font-bold text-forest">Cetak Label Siap Kirim</h3>
                            <p class="text-xs sm:text-sm text-gray-600 leading-relaxed">
                                Manfaatkan fitur cetak label paket donasi otomatis untuk ditempelkan pada paket agar petugas posko dapat memindai identitas pengiriman.
                            </p>
                        </div>
                        <div class="p-3 bg-warm-brown-light border border-warm-brown/20 rounded-xl text-xs text-warm-brown font-bold text-center">
                            🖨️ Label Pengiriman Resmi & Barcode
                        </div>
                    </div>
                </div>

                <!-- Bento 4 (Large - Col 7) -->
                <div class="col-span-12 lg:col-span-7 bezel-outer">
                    <div class="bezel-inner p-8 sm:p-10 space-y-4 bg-white flex flex-col justify-between h-full">
                        <div class="flex items-center justify-between">
                            <span class="w-10 h-10 rounded-2xl bg-forest text-white font-black text-sm flex items-center justify-center">04</span>
                            <span class="text-[10px] font-extrabold uppercase tracking-widest text-warm-brown">Tahap Penyerahan</span>
                        </div>
                        <div class="space-y-2">
                            <h3 class="text-2xl font-bold text-forest">Antar ke Posko atau Kirim Ekspedisi</h3>
                            <p class="text-xs sm:text-sm text-gray-600 leading-relaxed max-w-lg">
                                Pilih metode pengiriman yang paling nyaman bagi Anda: antar langsung ke posko terdekat atau kirimkan via kurir (JNE/J&T/SiCepat). Lacak status paket dari ponsel Anda kapan saja.
                            </p>
                        </div>
                        <div class="flex flex-wrap gap-2 pt-2">
                            <span class="px-3 py-1.5 rounded-full bg-sage/20 text-forest text-xs font-bold">📍 Posko Drop-Off Terdekat</span>
                            <span class="px-3 py-1.5 rounded-full bg-sand text-warm-brown text-xs font-bold">📦 Paket JNE / J&T / SiCepat</span>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- ======================================================== -->
    <!-- 5. PANDUAN KELAYAKAN KURASI (EDITORIAL LUXURY COMPARISON) -->
    <!-- ======================================================== -->
    <section id="panduan" class="py-28 lg:py-36 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">

            <div class="text-center max-w-2xl mx-auto space-y-3">
                <span class="inline-flex items-center px-3.5 py-1 rounded-full bg-sage/20 text-forest text-[10px] font-extrabold uppercase tracking-[0.2em]">
                    Standar Kualitas
                </span>
                <h2 class="text-3xl sm:text-5xl font-extrabold text-forest tracking-tight">
                    Kurasi Pakaian Layak Pakai
                </h2>
                <p class="text-sm sm:text-base text-gray-600 leading-relaxed font-normal">
                    Menjaga martabat dan kenyamanan penerima manfaat adalah prioritas kami.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">

                <!-- Card Diterima -->
                <div class="bezel-outer">
                    <div class="bezel-inner p-8 sm:p-10 bg-white space-y-6 h-full">
                        <div class="flex items-center space-x-3 text-emerald-800">
                            <span class="w-9 h-9 rounded-full bg-emerald-100 flex items-center justify-center font-black text-sm">✓</span>
                            <h3 class="font-extrabold text-xl text-forest">Kategori yang Diterima</h3>
                        </div>

                        <ul class="space-y-4 text-xs sm:text-sm text-gray-700">
                            <li class="flex items-start space-x-3">
                                <span class="text-emerald-600 font-bold">•</span>
                                <span>Kaus, kemeja, celana, rok, dan jaket dalam kondisi bersih dan harum.</span>
                            </li>
                            <li class="flex items-start space-x-3">
                                <span class="text-emerald-600 font-bold">•</span>
                                <span>Pakaian bayi, balita, anak-anak, dan seragam sekolah lengkap.</span>
                            </li>
                            <li class="flex items-start space-x-3">
                                <span class="text-emerald-600 font-bold">•</span>
                                <span>Jahitan masih utuh, kancing lengkap, ritsleting berfungsi normal.</span>
                            </li>
                            <li class="flex items-start space-x-3">
                                <span class="text-emerald-600 font-bold">•</span>
                                <span>Pakaian ibadah seperti mukena, sarung, sajadah, dan gamis bersih.</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Card Ditolak -->
                <div class="bezel-outer">
                    <div class="bezel-inner p-8 sm:p-10 bg-white space-y-6 h-full">
                        <div class="flex items-center space-x-3 text-rose-800">
                            <span class="w-9 h-9 rounded-full bg-rose-100 flex items-center justify-center font-black text-sm">✕</span>
                            <h3 class="font-extrabold text-xl text-forest">Kategori yang Ditolak</h3>
                        </div>

                        <ul class="space-y-4 text-xs sm:text-sm text-gray-700">
                            <li class="flex items-start space-x-3">
                                <span class="text-rose-600 font-bold">•</span>
                                <span>Pakaian dalam (*underwear*), pakaian renang, dan kaus kaki bekas.</span>
                            </li>
                            <li class="flex items-start space-x-3">
                                <span class="text-rose-600 font-bold">•</span>
                                <span>Pakaian yang sobek parah, bolong besar, atau serat kain lapuk.</span>
                            </li>
                            <li class="flex items-start space-x-3">
                                <span class="text-rose-600 font-bold">•</span>
                                <span>Terkontaminasi noda membandel seperti cat, oli, atau jamur pakaian.</span>
                            </li>
                            <li class="flex items-start space-x-3">
                                <span class="text-rose-600 font-bold">•</span>
                                <span>Pakaian basah, kotor, atau berbau apek yang belum dicuci.</span>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- ======================================================== -->
    <!-- 6. TITIK POSKO PREVIEW (INTEGRASI MODUL NURUL)           -->
    <!-- ======================================================== -->
    <section class="py-24 bg-cream/50 border-t border-black/[0.04]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div>
                    <span class="inline-flex items-center px-3.5 py-1 rounded-full bg-sand text-warm-brown text-[10px] font-extrabold uppercase tracking-[0.2em]">
                        Posko Fisik
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-forest tracking-tight mt-2">
                        Titik Posko Drop-Off Terdekat
                    </h2>
                    <p class="text-xs sm:text-sm text-gray-600 mt-1">
                        Antarkan pakaian langsung ke posko terdekat di kotamu.
                    </p>
                </div>
                <a href="{{ route('posko.public') }}"
                   class="inline-flex items-center gap-2 text-xs font-bold text-forest hover:text-dark-green transition group">
                    <span>Lihat Semua Titik Posko ({{ $totalDropPoints }})</span>
                    <span class="transition-transform group-hover:translate-x-1">→</span>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse ($sampleDropPoints as $point)
                    <div class="bezel-outer">
                        <div class="bezel-inner p-6 sm:p-7 space-y-4 bg-white flex flex-col justify-between h-full">
                            <div class="space-y-2">
                                <span class="px-3 py-1 rounded-full bg-sage/20 text-forest text-[10px] font-extrabold uppercase">
                                    {{ $point->city }}
                                </span>
                                <h3 class="font-bold text-lg text-forest">{{ $point->name }}</h3>
                                <p class="text-xs text-gray-500 leading-relaxed">{{ $point->address }}</p>
                            </div>
                            <div class="pt-4 border-t border-black/[0.04] flex items-center justify-between text-xs">
                                <span class="text-gray-500">🕒 {{ $point->operating_hours }}</span>
                                @if ($point->pic_phone)
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $point->pic_phone) }}"
                                       target="_blank"
                                       class="font-bold text-forest hover:text-sage transition flex items-center gap-1">
                                        <span>WhatsApp PIC</span>
                                        <span>↗</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12 bg-white rounded-3xl border border-sand text-gray-400 text-xs">
                        Belum ada posko terdaftar di database.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- ======================================================== -->
    <!-- 7. LAPORAN PENYALURAN PREVIEW (INTEGRASI MODUL FAIZAL)    -->
    <!-- ======================================================== -->
    <section class="py-24 bg-white border-t border-black/[0.04]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div>
                    <span class="inline-flex items-center px-3.5 py-1 rounded-full bg-sage/20 text-forest text-[10px] font-extrabold uppercase tracking-[0.2em]">
                        Akuntabilitas & Transparansi
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-forest tracking-tight mt-2">
                        Dokumentasi Penyaluran Bantuan
                    </h2>
                    <p class="text-xs sm:text-sm text-gray-600 mt-1">
                        Laporan serah terima pakaian kepada panti asuhan, korban bencana, dan masyarakat prasejahtera.
                    </p>
                </div>
                <a href="{{ route('laporan.public') }}"
                   class="inline-flex items-center gap-2 text-xs font-bold text-forest hover:text-dark-green transition group">
                    <span>Lihat Galeri Penyaluran Lengkap</span>
                    <span class="transition-transform group-hover:translate-x-1">→</span>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse ($recentDistributions as $dist)
                    <div class="bezel-outer">
                        <div class="bezel-inner overflow-hidden bg-white flex flex-col justify-between h-full">
                            @if ($dist->proof_photo)
                                <div class="h-48 w-full bg-sand/30 overflow-hidden">
                                    <img src="{{ asset('storage/' . $dist->proof_photo) }}"
                                         alt="Dokumentasi"
                                         class="w-full h-full object-cover">
                                </div>
                            @else
                                <div class="h-48 w-full bg-sand/20 flex items-center justify-center text-4xl">
                                    🤝
                                </div>
                            @endif

                            <div class="p-6 space-y-3 flex-1 flex flex-col justify-between">
                                <div class="space-y-1">
                                    <span class="text-[10px] font-bold text-warm-brown uppercase">
                                        {{ $dist->distribution_date ? \Carbon\Carbon::parse($dist->distribution_date)->format('d F Y') : '-' }}
                                    </span>
                                    <h3 class="font-bold text-base text-forest leading-snug">{{ $dist->recipient_name }}</h3>
                                    <p class="text-xs text-gray-500 line-clamp-2 leading-relaxed">{{ $dist->description }}</p>
                                </div>

                                <div class="pt-3 border-t border-black/[0.04] text-xs font-bold text-forest flex items-center justify-between">
                                    <span>Tersalurkan:</span>
                                    <span class="px-2.5 py-0.5 bg-sage/20 rounded-full">{{ $dist->items_count }} pcs</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12 bg-cream/40 rounded-3xl border border-sand text-gray-400 text-xs">
                        Laporan dokumentasi penyaluran pakaian disajikan secara terbuka.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- ======================================================== -->
    <!-- 8. CINEMATIC INVERTED ISLAND CTA                         -->
    <!-- ======================================================== -->
    <section class="py-20 bg-cream">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="rounded-[3rem] bg-forest text-white p-10 sm:p-16 text-center space-y-8 relative overflow-hidden shadow-ambient-lg">
                <!-- Background Radial Mesh -->
                <div class="absolute -top-24 -left-24 w-72 h-72 bg-sage/20 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-24 -right-24 w-72 h-72 bg-warm-brown/20 rounded-full blur-3xl pointer-events-none"></div>

                <div class="relative z-10 max-w-2xl mx-auto space-y-4">
                    <div class="w-16 h-16 rounded-2xl bg-white/10 p-2 mx-auto flex items-center justify-center border border-white/15">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-full h-full object-contain brightness-0 invert">
                    </div>

                    <h2 class="text-3xl sm:text-5xl font-extrabold tracking-tight">
                        Lemari Anda Bisa Mengubah Kehidupan Seseorang.
                    </h2>

                    <p class="text-cream/80 text-xs sm:text-sm leading-relaxed max-w-lg mx-auto font-normal">
                        Jangan biarkan pakaian bersih Anda berakhir di tempat pembuangan. Mulai langkah kebaikan Anda sekarang juga secara gratis dan bermakna.
                    </p>

                    <div class="pt-4">
                        <a href="{{ route('donations.create') }}"
                           class="btn-island bg-white text-forest hover:bg-cream transition shadow-xl group">
                            <span class="text-sm font-bold">Donasikan Pakaian Sekarang</span>
                            <span class="w-8 h-8 rounded-full bg-forest text-white flex items-center justify-center transition-transform duration-500 ease-luxury group-hover:translate-x-1 group-hover:-translate-y-0.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ======================================================== -->
    <!-- 9. MINIMALIST EDITORIAL FOOTER                           -->
    <!-- ======================================================== -->
    <footer class="bg-white border-t border-black/[0.04] py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            <div class="flex flex-col md:flex-row items-center justify-between gap-8">

                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-full bg-sand/60 p-1 flex items-center justify-center border border-black/5">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-full h-full object-contain">
                    </div>
                    <div>
                        <span class="font-extrabold text-base text-forest tracking-tight">Lemari Peduli</span>
                        <p class="text-[10px] text-gray-500">Sustainable Garment Circulation Platform</p>
                    </div>
                </div>

                <div class="text-center md:text-right text-xs text-gray-500 space-y-1">
                    <p class="font-bold text-forest">Praktikum Pemrograman Web II — Shift A (Tim 3)</p>
                    <p class="text-[11px] text-gray-400">
                        Afif Nur Rahman (H1H024016) • Nurul Maftuhah (H1H024002) • M. Faizal Khabibi (H1H024003)
                    </p>
                </div>

            </div>

            <div class="pt-8 border-t border-black/[0.04] flex flex-col sm:flex-row items-center justify-between text-[11px] text-gray-400 gap-4">
                <p>&copy; {{ date('Y') }} Lemari Peduli. Engineered with clean architecture and sustainable purpose.</p>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('donations.track') }}" class="hover:text-forest transition">Lacak Resi</a>
                    <a href="{{ route('posko.public') }}" class="hover:text-forest transition">Titik Posko</a>
                    <a href="{{ route('laporan.public') }}" class="hover:text-forest transition">Laporan Penyaluran</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
