<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-extrabold text-2xl text-dark-green leading-tight">
                    {{ $user->role === 'admin' ? __('Panel Kendali Administrator') : __('Portal Donatur') }}
                </h2>
                <p class="text-xs text-gray-500 mt-0.5">
                    {{ $user->role === 'admin'
                        ? 'Pusat kendali dan pengelolaan seluruh aktivitas sistem Lemari Peduli.'
                        : 'Selamat datang di ruang kebaikan Anda bersama Lemari Peduli.' }}
                </p>
            </div>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider {{ $user->role === 'admin' ? 'bg-dark-green text-white shadow-sm' : 'bg-sage/20 text-dark-green border border-sage/40' }}">
                {{ $user->role === 'admin' ? '🛡️ Administrator' : '🌱 Donatur Aktif' }}
            </span>
        </div>
    </x-slot>

    <div class="bg-cream/40 min-h-[calc(100vh-140px)] py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- ======================================================== --}}
            {{-- 1. TAMPILAN KHUSUS ADMINISTRATOR (DATA & KELOLA SISTEM)  --}}
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
            {{-- 2. TAMPILAN KHUSUS DONATUR (PORTAL KEBAIKAN WARGA)       --}}
            {{-- ======================================================== --}}
            @else

                <!-- 1. Hero Card Sambutan Hangat Donatur -->
                <div class="bg-gradient-to-br from-dark-green to-[#274426] rounded-3xl p-6 sm:p-10 text-white shadow-md relative overflow-hidden">
                    <div class="relative z-10 max-w-2xl space-y-3">
                        <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-sage/30 text-cream text-xs font-bold uppercase tracking-wider backdrop-blur-sm">
                            <span>🌱</span>
                            <span>Ruang Donasi Anda</span>
                        </div>
                        <h1 class="text-3xl sm:text-4xl font-black tracking-tight leading-tight">
                            Halo, {{ $user->name }}!
                        </h1>
                        <p class="text-sm text-cream/90 leading-relaxed">
                            Punya pakaian bersih di lemari yang sudah jarang dipakai? Jangan biarkan menumpuk. Jadikan pakaian tersebut berkah dan kehangatan baru bagi saudara kita.
                        </p>
                        <div class="pt-3 flex flex-wrap items-center gap-3">
                            <a href="{{ route('donations.create') }}"
                               class="px-6 py-3.5 bg-sage text-dark-green font-black text-sm rounded-2xl hover:bg-cream transition shadow-md flex items-center space-x-2">
                                <span>👕 Donasikan Pakaian Sekarang</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                            <a href="{{ route('donations.index') }}"
                               class="px-5 py-3.5 bg-white/10 hover:bg-white/20 text-white font-bold text-sm rounded-2xl transition border border-white/20">
                                Riwayat Donasi Saya
                            </a>
                        </div>
                    </div>

                    <!-- Watermark Logo Accent -->
                    <div class="absolute -right-6 -bottom-6 opacity-10 pointer-events-none hidden sm:block">
                        <span class="text-[200px]">👕</span>
                    </div>
                </div>

                <!-- 2. Ringkasan Kontribusi & Widget Lacak Resi -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    <!-- Kartu Ringkasan Kontribusi Donatur -->
                    <div class="bg-white rounded-3xl p-6 border border-sage/30 shadow-sm flex flex-col justify-between space-y-4">
                        <div>
                            <span class="text-xs font-bold text-gray-500 uppercase tracking-wider block">Kontribusi Kebaikan Anda</span>
                            <div class="flex items-baseline space-x-2 mt-2">
                                <span class="text-4xl font-black text-dark-green">{{ $myTotalItems }}</span>
                                <span class="text-sm font-bold text-gray-600">Potong Pakaian</span>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">
                                Total pakaian yang telah Anda ajukan melalui akun ini.
                            </p>
                        </div>

                        <!-- Progress Mini Status -->
                        <div class="pt-3 border-t border-gray-100 grid grid-cols-3 gap-2 text-center">
                            <div class="p-2 rounded-xl bg-amber-50 border border-amber-100">
                                <span class="block text-lg font-black text-amber-600">{{ $myPending }}</span>
                                <span class="text-[10px] text-amber-800 font-semibold">Menunggu</span>
                            </div>
                            <div class="p-2 rounded-xl bg-blue-50 border border-blue-100">
                                <span class="block text-lg font-black text-blue-600">{{ $myVerified }}</span>
                                <span class="text-[10px] text-blue-800 font-semibold">Di Posko</span>
                            </div>
                            <div class="p-2 rounded-xl bg-emerald-50 border border-emerald-100">
                                <span class="block text-lg font-black text-emerald-600">{{ $myDistributed }}</span>
                                <span class="text-[10px] text-emerald-800 font-semibold">Tersalurkan</span>
                            </div>
                        </div>
                    </div>

                    <!-- Widget Lacak Nomor Resi Cepat -->
                    <div class="lg:col-span-2 bg-white rounded-3xl p-6 border border-sage/30 shadow-sm flex flex-col justify-between space-y-4">
                        <div>
                            <span class="text-xs font-bold text-warm-brown uppercase tracking-wider block">Pelacakan Paket Mandiri</span>
                            <h3 class="text-lg font-bold text-dark-green mt-1">Lacak Status Paket Donasi Anda</h3>
                            <p class="text-xs text-gray-600 mt-1">
                                Ingin tahu paket pakaian Anda sudah sampai di posko atau disalurkan? Masukkan kode tracking resi Anda di sini:
                            </p>
                        </div>

                        <form action="{{ route('donations.track') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                            <div class="relative flex-1">
                                <input type="text"
                                       name="code"
                                       required
                                       placeholder="Contoh: DON-20261006-XXXX"
                                       class="w-full text-sm font-mono font-bold text-dark-green uppercase ps-10 pe-4 py-2.5 rounded-xl border-gray-300 focus:border-sage focus:ring focus:ring-sage/20 transition">
                                <span class="absolute start-3 top-2.5 text-sm text-gray-400">🏷️</span>
                            </div>
                            <button type="submit"
                                    class="px-5 py-2.5 bg-dark-green text-white text-xs font-bold rounded-xl hover:bg-sage transition shadow-sm flex items-center justify-center space-x-1.5 flex-shrink-0">
                                <span>Cek Status</span>
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
                        </form>
                    </div>

                </div>

                <!-- 3. Alur 4 Langkah Donasi (Panduan Praktis) -->
                <div class="bg-white rounded-3xl p-6 sm:p-8 border border-sage/30 shadow-sm space-y-4">
                    <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                        <div>
                            <h3 class="font-bold text-dark-green text-base">Panduan Cara Donasi</h3>
                            <p class="text-xs text-gray-500">Hanya butuh 4 langkah mudah untuk menyelesaikan proses donasi.</p>
                        </div>
                        <a href="{{ route('donations.create') }}" class="text-xs font-bold text-dark-green hover:underline">
                            Mulai Donasi →
                        </a>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 pt-2">
                        <div class="p-4 rounded-2xl bg-cream/30 border border-sage/20 space-y-2">
                            <span class="w-7 h-7 rounded-lg bg-sage/30 text-dark-green font-black text-xs flex items-center justify-center">1</span>
                            <h4 class="font-bold text-xs text-gray-800">Pilih & Cuci Bersih</h4>
                            <p class="text-[11px] text-gray-500 leading-relaxed">Pastikan pakaian bekas masih layak pakai, tidak sobek parah, dan bersih.</p>
                        </div>

                        <div class="p-4 rounded-2xl bg-cream/30 border border-sage/20 space-y-2">
                            <span class="w-7 h-7 rounded-lg bg-sage/30 text-dark-green font-black text-xs flex items-center justify-center">2</span>
                            <h4 class="font-bold text-xs text-gray-800">Isi Formulir Online</h4>
                            <p class="text-[11px] text-gray-500 leading-relaxed">Klik tombol donasi, masukkan jumlah potong dan dapatkan nomor resi unik.</p>
                        </div>

                        <div class="p-4 rounded-2xl bg-cream/30 border border-sage/20 space-y-2">
                            <span class="w-7 h-7 rounded-lg bg-sage/30 text-dark-green font-black text-xs flex items-center justify-center">3</span>
                            <h4 class="font-bold text-xs text-gray-800">Cetak / Tulis Resi</h4>
                            <p class="text-[11px] text-gray-500 leading-relaxed">Tempelkan label resi di kardus atau plastik paket pakaian Anda.</p>
                        </div>

                        <div class="p-4 rounded-2xl bg-cream/30 border border-sage/20 space-y-2">
                            <span class="w-7 h-7 rounded-lg bg-sage/30 text-dark-green font-black text-xs flex items-center justify-center">4</span>
                            <h4 class="font-bold text-xs text-gray-800">Serahkan ke Posko</h4>
                            <p class="text-[11px] text-gray-500 leading-relaxed">Antar langsung ke titik posko terdekat atau kirim via ekspedisi kurir.</p>
                        </div>
                    </div>
                </div>

                <!-- 4. Paket Donasi Aktif & Informasi Posko -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    <!-- Riwayat Donasi Terakhir Kamu -->
                    <div class="lg:col-span-2 bg-white rounded-3xl p-6 border border-sage/30 shadow-sm space-y-4">
                        <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                            <h3 class="font-bold text-dark-green text-base">Donasi Pakaian Terakhir Anda</h3>
                            <a href="{{ route('donations.index') }}" class="text-xs font-semibold text-warm-brown hover:text-dark-green transition">
                                Buka Semua ({{ $myDonations->count() }}) →
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
                                            <p class="text-xs text-gray-800 font-bold">
                                                {{ $donation->clothing_type }} • <span class="text-dark-green font-black">{{ $donation->quantity }} Pcs</span> ({{ $donation->condition_label }})
                                            </p>
                                            <p class="text-[11px] text-gray-400">
                                                Metode: {{ $donation->delivery_method_label }} • Diajukan {{ $donation->created_at->format('d M Y') }}
                                            </p>
                                        </div>

                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('donations.show', $donation) }}"
                                               class="px-3 py-1.5 rounded-xl bg-sage/20 text-dark-green text-xs font-bold hover:bg-dark-green hover:text-white transition">
                                                Lihat Tracking
                                            </a>
                                            <a href="{{ route('donations.print', $donation) }}"
                                               target="_blank"
                                               class="px-3 py-1.5 rounded-xl border border-warm-brown/40 text-warm-brown text-xs font-bold hover:bg-warm-brown hover:text-white transition">
                                                Cetak Resi
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="py-12 text-center space-y-3">
                                <span class="text-5xl block">📦</span>
                                <h4 class="font-bold text-dark-green text-sm">Belum Ada Riwayat Donasi</h4>
                                <p class="text-xs text-gray-500 max-w-sm mx-auto">
                                    Anda belum pernah mengajukan pakaian. Mari salurkan pakaian layak pakai Anda hari ini untuk membantu sesama.
                                </p>
                                <a href="{{ route('donations.create') }}"
                                   class="inline-block mt-2 px-6 py-2.5 bg-dark-green text-white text-xs font-bold rounded-xl hover:bg-sage transition shadow-sm">
                                    Ajukan Donasi Sekarang
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Kartu Panduan & Posko Terdekat -->
                    <div class="space-y-6">
                        <!-- Card Cari Posko -->
                        <div class="bg-white rounded-3xl p-6 border border-sage/30 shadow-sm space-y-3">
                            <span class="text-2xl">📍</span>
                            <h4 class="font-bold text-dark-green text-base">Antar Langsung ke Posko?</h4>
                            <p class="text-xs text-gray-600 leading-relaxed">
                                Temukan titik posko pengumpulan Lemari Peduli di kotamu beserta kontak WhatsApp petugas untuk jadwal serah terima.
                            </p>
                            <a href="{{ route('posko.public') }}"
                               class="inline-block w-full text-center py-2.5 rounded-xl bg-sage/20 text-dark-green text-xs font-bold hover:bg-dark-green hover:text-white transition">
                                Buka Lokasi Posko →
                            </a>
                        </div>

                        <!-- Card Transparansi Penyaluran -->
                        <div class="bg-white rounded-3xl p-6 border border-sage/30 shadow-sm space-y-3">
                            <span class="text-2xl">🤝</span>
                            <h4 class="font-bold text-dark-green text-base">Transparansi Bantuan</h4>
                            <p class="text-xs text-gray-600 leading-relaxed">
                                Bukti dokumentasi dan foto serah terima pakaian kepada panti asuhan, korban bencana, dan warga prasejahtera.
                            </p>
                            <a href="{{ route('laporan.public') }}"
                               class="inline-block w-full text-center py-2.5 rounded-xl border border-warm-brown text-warm-brown text-xs font-bold hover:bg-warm-brown hover:text-white transition">
                                Buka Galeri Penyaluran →
                            </a>
                        </div>
                    </div>

                </div>

            @endif

        </div>
    </div>
</x-app-layout>
