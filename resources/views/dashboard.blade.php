<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-extrabold text-2xl text-dark-green leading-tight">
                    {{ $user->role === 'admin' ? __('Dashboard Admin') : __('Dashboard Donatur') }}
                </h2>
                <p class="text-xs text-gray-500 mt-0.5">
                    {{ $user->role === 'admin'
                        ? 'Pusat kendali dan ringkasan seluruh aktivitas sistem Lemari Peduli.'
                        : 'Pantau kontribusi dan perjalanan donasi pakaian Anda.' }}
                </p>
            </div>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider {{ $user->role === 'admin' ? 'bg-dark-green text-white' : 'bg-sage/20 text-dark-green border border-sage/40' }}">
                Role: {{ ucfirst($user->role) }}
            </span>
        </div>
    </x-slot>

    <div class="bg-cream/40 min-h-[calc(100vh-140px)] py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- ======================================================== --}}
            {{-- 1. TAMPILAN KHUSUS ADMINISTRATOR                         --}}
            {{-- ======================================================== --}}
            @if ($user->role === 'admin')

                <!-- Banner Header Admin -->
                <div class="bg-white rounded-3xl p-6 sm:p-8 border border-sage/30 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div class="space-y-1">
                        <div class="inline-flex items-center space-x-1.5 px-2.5 py-0.5 rounded-full bg-dark-green text-white text-[11px] font-bold uppercase tracking-wider">
                            <span>🛡️</span>
                            <span>Panel Kendali Sistem</span>
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-extrabold text-dark-green tracking-tight">
                            Selamat Datang, {{ $user->name }}
                        </h1>
                        <p class="text-sm text-gray-600 max-w-2xl">
                            Kelola data donasi pakaian, titik posko pengumpulan, dan dokumentasi penyaluran bantuan secara terintegrasi.
                        </p>
                    </div>

                    <div class="flex items-center space-x-3 flex-shrink-0">
                        <a href="{{ route('donations.index') }}"
                           class="px-5 py-2.5 bg-dark-green text-white text-xs font-bold rounded-xl hover:bg-sage transition shadow-sm">
                            Verifikasi Donasi Masuk
                        </a>
                    </div>
                </div>

                <!-- 4 Kartu Metrik Sistem (Bisa Diklik) -->
                <div class="grid gap-4 sm:gap-6 grid-cols-2 lg:grid-cols-4">
                    <a href="{{ route('donations.index') }}" class="block rounded-2xl bg-white p-5 sm:p-6 shadow-sm hover:shadow-md hover:border-dark-green border border-sage/20 transition">
                        <div class="flex items-center justify-between text-xs text-gray-500 font-semibold">
                            <span>Total Pakaian Masuk</span>
                            <span class="text-lg">👕</span>
                        </div>
                        <h3 class="mt-2 text-2xl sm:text-3xl font-black text-dark-green">
                            {{ $totalDonations }}
                        </h3>
                        <p class="mt-1 text-[11px] text-gray-400">
                            pcs pakaian • Kelola Donasi →
                        </p>
                    </a>

                    <a href="{{ route('admin.distributions.index') }}" class="block rounded-2xl bg-white p-5 sm:p-6 shadow-sm hover:shadow-md hover:border-dark-green border border-sage/20 transition">
                        <div class="flex items-center justify-between text-xs text-gray-500 font-semibold">
                            <span>Total Pakaian Disalurkan</span>
                            <span class="text-lg">📦</span>
                        </div>
                        <h3 class="mt-2 text-2xl sm:text-3xl font-black text-dark-green">
                            {{ $totalDistributedItems }}
                        </h3>
                        <p class="mt-1 text-[11px] text-gray-400">
                            pcs pakaian • Kelola Penyaluran →
                        </p>
                    </a>

                    <a href="{{ route('admin.distributions.index') }}" class="block rounded-2xl bg-white p-5 sm:p-6 shadow-sm hover:shadow-md hover:border-dark-green border border-sage/20 transition">
                        <div class="flex items-center justify-between text-xs text-gray-500 font-semibold">
                            <span>Kegiatan Penyaluran</span>
                            <span class="text-lg">🤝</span>
                        </div>
                        <h3 class="mt-2 text-2xl sm:text-3xl font-black text-dark-green">
                            {{ $totalDistributions }}
                        </h3>
                        <p class="mt-1 text-[11px] text-gray-400">
                            kegiatan serah terima bantuan
                        </p>
                    </a>

                    <a href="{{ route('admin.drop-points.index') }}" class="block rounded-2xl bg-white p-5 sm:p-6 shadow-sm hover:shadow-md hover:border-dark-green border border-sage/20 transition">
                        <div class="flex items-center justify-between text-xs text-gray-500 font-semibold">
                            <span>Titik Posko Drop-Off</span>
                            <span class="text-lg">📍</span>
                        </div>
                        <h3 class="mt-2 text-2xl sm:text-3xl font-black text-dark-green">
                            {{ $totalDropPoints }}
                        </h3>
                        <p class="mt-1 text-[11px] text-gray-400">
                            lokasi posko aktif • Kelola Posko →
                        </p>
                    </a>
                </div>

                <!-- 3 Menu Aksi Utama (1:1 Selaras dengan Navbar) -->
                <div>
                    <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-4">
                        Modul Pengelolaan Sistem
                    </h3>

                    <div class="grid gap-6 md:grid-cols-3">
                        <!-- Modul 1: Afif -->
                        <div class="rounded-3xl bg-white p-6 shadow-sm border border-sage/30 flex flex-col justify-between border-t-4 border-t-dark-green">
                            <div>
                                <span class="text-[11px] font-bold text-dark-green uppercase tracking-wider">Modul Donasi</span>
                                <h4 class="text-lg font-bold text-dark-green mt-1">Kelola Donasi Pakaian</h4>
                                <p class="mt-2 text-xs text-gray-600 leading-relaxed">
                                    Verifikasi pengajuan pakaian dari donatur, ubah status tiket, dan cetak label resi paket.
                                </p>
                            </div>
                            <a href="{{ route('donations.index') }}"
                               class="mt-6 block text-center rounded-xl bg-dark-green px-4 py-2.5 text-xs font-bold text-white hover:bg-sage transition shadow-sm">
                                Buka Kelola Donasi →
                            </a>
                        </div>

                        <!-- Modul 2: Nurul -->
                        <div class="rounded-3xl bg-white p-6 shadow-sm border border-sage/30 flex flex-col justify-between border-t-4 border-t-sage">
                            <div>
                                <span class="text-[11px] font-bold text-sage uppercase tracking-wider">Modul Posko</span>
                                <h4 class="text-lg font-bold text-dark-green mt-1">Kelola Titik Posko</h4>
                                <p class="mt-2 text-xs text-gray-600 leading-relaxed">
                                    Tambah, edit, dan hapus titik posko pengumpulan pakaian drop-off di berbagai kota.
                                </p>
                            </div>
                            <a href="{{ route('admin.drop-points.index') }}"
                               class="mt-6 block text-center rounded-xl bg-dark-green px-4 py-2.5 text-xs font-bold text-white hover:bg-sage transition shadow-sm">
                                Buka Kelola Posko →
                            </a>
                        </div>

                        <!-- Modul 3: Faizal -->
                        <div class="rounded-3xl bg-white p-6 shadow-sm border border-sage/30 flex flex-col justify-between border-t-4 border-t-warm-brown">
                            <div>
                                <span class="text-[11px] font-bold text-warm-brown uppercase tracking-wider">Modul Penyaluran</span>
                                <h4 class="text-lg font-bold text-dark-green mt-1">Kelola Penyaluran</h4>
                                <p class="mt-2 text-xs text-gray-600 leading-relaxed">
                                    Catat penyerahan baju ke panti/korban bencana dan kelola bukti foto dokumentasi.
                                </p>
                            </div>
                            <a href="{{ route('admin.distributions.index') }}"
                               class="mt-6 block text-center rounded-xl bg-dark-green px-4 py-2.5 text-xs font-bold text-white hover:bg-sage transition shadow-sm">
                                Buka Kelola Penyaluran →
                            </a>
                        </div>
                    </div>
                </div>

            {{-- ======================================================== --}}
            {{-- 2. TAMPILAN KHUSUS DONATUR                                --}}
            {{-- ======================================================== --}}
            @else

                <!-- Banner Donatur -->
                <div class="bg-white rounded-3xl p-6 sm:p-8 border border-sage/30 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div class="space-y-2">
                        <div class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-full bg-sage/20 text-dark-green text-xs font-bold uppercase tracking-wider">
                            <span>🌱</span>
                            <span>Donatur Lemari Peduli</span>
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-extrabold text-dark-green tracking-tight">
                            Halo, {{ $user->name }}!
                        </h1>
                        <p class="text-xs sm:text-sm text-gray-600 max-w-xl leading-relaxed">
                            Terima kasih telah bergabung. Setiap potong pakaian yang Anda sumbangkan memberikan kehangatan dan kehidupan baru bagi saudara kita yang membutuhkan.
                        </p>
                    </div>

                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 flex-shrink-0">
                        <a href="{{ route('donations.create') }}"
                           class="px-6 py-3 bg-dark-green text-white text-xs font-bold rounded-2xl hover:bg-sage transition shadow-sm flex items-center justify-center space-x-2">
                            <span>+ Ajukan Donasi Baru</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                        <a href="{{ route('donations.track') }}"
                           class="px-5 py-3 bg-cream border border-warm-brown/40 text-warm-brown text-xs font-bold rounded-2xl hover:bg-warm-brown hover:text-white transition flex items-center justify-center space-x-1.5">
                            <span>🔍 Lacak Resi</span>
                        </a>
                    </div>
                </div>

                <!-- 4 Kartu Statistik Donatur Pribadi -->
                <div class="grid gap-4 sm:gap-6 grid-cols-2 lg:grid-cols-4">
                    <div class="rounded-2xl bg-white p-5 border border-sage/20 shadow-sm">
                        <div class="flex items-center justify-between text-xs text-gray-500">
                            <span>Total Pakaian Anda</span>
                            <span>👕</span>
                        </div>
                        <h3 class="mt-2 text-3xl font-black text-dark-green">
                            {{ $myTotalItems }}
                        </h3>
                        <p class="mt-1 text-[11px] text-gray-400">potong pakaian disumbangkan</p>
                    </div>

                    <div class="rounded-2xl bg-white p-5 border border-amber-200 shadow-sm">
                        <div class="flex items-center justify-between text-xs text-amber-700">
                            <span>Menunggu Verifikasi</span>
                            <span>⏳</span>
                        </div>
                        <h3 class="mt-2 text-3xl font-black text-amber-600">
                            {{ $myPending }}
                        </h3>
                        <p class="mt-1 text-[11px] text-gray-400">pengajuan donasi aktif</p>
                    </div>

                    <div class="rounded-2xl bg-white p-5 border border-blue-200 shadow-sm">
                        <div class="flex items-center justify-between text-xs text-blue-700">
                            <span>Diverifikasi / Di Posko</span>
                            <span>📍</span>
                        </div>
                        <h3 class="mt-2 text-3xl font-black text-blue-600">
                            {{ $myVerified }}
                        </h3>
                        <p class="mt-1 text-[11px] text-gray-400">siap disalurkan</p>
                    </div>

                    <div class="rounded-2xl bg-white p-5 border border-emerald-200 shadow-sm">
                        <div class="flex items-center justify-between text-xs text-emerald-700">
                            <span>Telah Disalurkan</span>
                            <span>🎉</span>
                        </div>
                        <h3 class="mt-2 text-3xl font-black text-emerald-600">
                            {{ $myDistributed }}
                        </h3>
                        <p class="mt-1 text-[11px] text-gray-400">telah sampai ke penerima</p>
                    </div>
                </div>

                <!-- Kartu Aksi Cepat & Riwayat Terakhir -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    <!-- Kolom Kiri (2 Kolom): Riwayat Donasi Terakhir -->
                    <div class="lg:col-span-2 bg-white rounded-3xl p-6 border border-sage/30 shadow-sm space-y-4">
                        <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                            <h3 class="font-bold text-dark-green text-base">Riwayat Donasi Terakhir Anda</h3>
                            <a href="{{ route('donations.index') }}" class="text-xs font-semibold text-warm-brown hover:text-dark-green transition">
                                Lihat Semua Donasi →
                            </a>
                        </div>

                        @if ($myDonations->count() > 0)
                            <div class="divide-y divide-gray-100 text-sm">
                                @foreach ($myDonations as $donation)
                                    <div class="py-3.5 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                        <div class="space-y-1">
                                            <div class="flex items-center space-x-2">
                                                <span class="font-mono font-bold text-xs text-dark-green bg-cream px-2 py-0.5 rounded border border-sage/30">
                                                    {{ $donation->tracking_code }}
                                                </span>
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold border {{ $donation->status_badge_class }}">
                                                    {{ $donation->status_label }}
                                                </span>
                                            </div>
                                            <p class="text-xs text-gray-700 font-semibold">
                                                {{ $donation->clothing_type }} • <span class="text-dark-green">{{ $donation->quantity }} Pcs</span> ({{ $donation->condition_label }})
                                            </p>
                                            <p class="text-[11px] text-gray-400">
                                                Diajukan pada {{ $donation->created_at->format('d M Y, H:i') }} WIB
                                            </p>
                                        </div>

                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('donations.show', $donation) }}"
                                               class="px-3 py-1.5 rounded-lg bg-sage/20 text-dark-green text-xs font-semibold hover:bg-dark-green hover:text-white transition">
                                                Lihat Tracking
                                            </a>
                                            <a href="{{ route('donations.print', $donation) }}"
                                               target="_blank"
                                               class="px-3 py-1.5 rounded-lg border border-warm-brown/40 text-warm-brown text-xs font-semibold hover:bg-warm-brown hover:text-white transition">
                                                Label Paket
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="py-12 text-center space-y-3">
                                <span class="text-4xl block">📦</span>
                                <h4 class="font-bold text-dark-green text-sm">Belum Ada Donasi Pakaian</h4>
                                <p class="text-xs text-gray-500 max-w-sm mx-auto">
                                    Anda belum pernah mengajukan donasi pakaian. Mulai donasikan pakaian layak pakai Anda hari ini!
                                </p>
                                <a href="{{ route('donations.create') }}"
                                   class="inline-block mt-2 px-5 py-2.5 bg-dark-green text-white text-xs font-bold rounded-xl hover:bg-sage transition">
                                    Ajukan Pakaian Pertama
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Kolom Kanan (1 Kolom): Akses Cepat Posko & Laporan -->
                    <div class="space-y-6">
                        <!-- Card Cari Posko -->
                        <div class="bg-white rounded-3xl p-6 border border-sage/30 shadow-sm space-y-3">
                            <span class="text-2xl">📍</span>
                            <h4 class="font-bold text-dark-green text-base">Cari Posko Drop-Off Terdekat</h4>
                            <p class="text-xs text-gray-600 leading-relaxed">
                                Ingin mengantar pakaian langsung? Temukan lokasi posko Lemari Peduli di kotamu beserta kontak WhatsApp petugas.
                            </p>
                            <a href="{{ route('posko.public') }}"
                               class="inline-block w-full text-center py-2.5 rounded-xl bg-sage/20 text-dark-green text-xs font-bold hover:bg-dark-green hover:text-white transition">
                                Buka Daftar Posko →
                            </a>
                        </div>

                        <!-- Card Transparansi Penyaluran -->
                        <div class="bg-white rounded-3xl p-6 border border-sage/30 shadow-sm space-y-3">
                            <span class="text-2xl">🤝</span>
                            <h4 class="font-bold text-dark-green text-base">Transparansi Penyaluran</h4>
                            <p class="text-xs text-gray-600 leading-relaxed">
                                Lihat dokumentasi dan bukti foto serah terima pakaian donasi yang telah dibagikan ke panti asuhan dan warga.
                            </p>
                            <a href="{{ route('laporan.public') }}"
                               class="inline-block w-full text-center py-2.5 rounded-xl border border-warm-brown text-warm-brown text-xs font-bold hover:bg-warm-brown hover:text-white transition">
                                Lihat Galeri Penyaluran →
                            </a>
                        </div>
                    </div>

                </div>

            @endif

        </div>
    </div>
</x-app-layout>
