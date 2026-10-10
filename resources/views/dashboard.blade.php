<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-sage/20 text-forest text-[10px] font-extrabold uppercase tracking-[0.2em] mb-2 border border-sage/30">
                    <span>{{ $user->role === 'admin' ? '🛡️ Administrator' : '🌱 Donatur Aktif' }}</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-forest tracking-tight leading-tight">
                    {{ $user->role === 'admin' ? __('Panel Kendali Eksekutif') : __('Portal Kebaikan Donatur') }}
                </h1>
                <p class="text-xs text-gray-500 mt-1">
                    {{ $user->role === 'admin'
                        ? 'Pengawasan operasional donasi, verifikasi kurasi pakaian, posko, dan penyaluran.'
                        : 'Kelola kontribusi sosial Anda dan pantau perjalanan pakaian secara real-time.' }}
                </p>
            </div>
            <div class="flex items-center space-x-3">
                @if ($user->role === 'admin')
                    <a href="{{ route('donations.index') }}"
                       class="btn-island bg-forest text-white hover:bg-dark-green shadow-ambient-sm group">
                        <span>Verifikasi Donasi</span>
                        <span class="w-6 h-6 rounded-full bg-white/20 flex items-center justify-center transition-transform group-hover:translate-x-0.5">
                            ✓
                        </span>
                    </a>
                @else
                    <a href="{{ route('donations.create') }}"
                       class="btn-island bg-forest text-white hover:bg-dark-green shadow-ambient-sm group">
                        <span>Donasikan Pakaian</span>
                        <span class="w-6 h-6 rounded-full bg-white/20 flex items-center justify-center transition-transform group-hover:translate-x-0.5">
                            +
                        </span>
                    </a>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

        {{-- ======================================================== --}}
        {{-- 1. DASHBOARD KHUSUS ADMINISTRATOR                        --}}
        {{-- ======================================================== --}}
        @if ($user->role === 'admin')

            <!-- Metric Cards (Double-Bezel Architecture) -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">

                <!-- Metric 1: Total Donasi -->
                <div class="bezel-outer">
                    <a href="{{ route('donations.index') }}" class="bezel-inner p-6 bg-white block space-y-3 hover:border-forest/20 transition-all duration-300">
                        <div class="flex items-center justify-between text-xs font-bold text-gray-500 uppercase tracking-wider">
                            <span>Pakaian Masuk</span>
                            <span class="text-lg">👕</span>
                        </div>
                        <h3 class="text-3xl sm:text-4xl font-extrabold text-forest tracking-tight">
                            {{ number_format($totalDonations) }}
                        </h3>
                        <p class="text-[11px] text-gray-400 font-semibold">
                            pcs pakaian • Kelola Donasi →
                        </p>
                    </a>
                </div>

                <!-- Metric 2: Total Disalurkan -->
                <div class="bezel-outer">
                    <a href="{{ route('admin.distributions.index') }}" class="bezel-inner p-6 bg-white block space-y-3 hover:border-forest/20 transition-all duration-300">
                        <div class="flex items-center justify-between text-xs font-bold text-gray-500 uppercase tracking-wider">
                            <span>Pakaian Disalurkan</span>
                            <span class="text-lg">📦</span>
                        </div>
                        <h3 class="text-3xl sm:text-4xl font-extrabold text-forest tracking-tight">
                            {{ number_format($totalDistributedItems) }}
                        </h3>
                        <p class="text-[11px] text-gray-400 font-semibold">
                            pcs pakaian • Kelola Penyaluran →
                        </p>
                    </a>
                </div>

                <!-- Metric 3: Kegiatan Penyaluran -->
                <div class="bezel-outer">
                    <a href="{{ route('admin.distributions.index') }}" class="bezel-inner p-6 bg-white block space-y-3 hover:border-forest/20 transition-all duration-300">
                        <div class="flex items-center justify-between text-xs font-bold text-gray-500 uppercase tracking-wider">
                            <span>Kegiatan Serah Terima</span>
                            <span class="text-lg">🤝</span>
                        </div>
                        <h3 class="text-3xl sm:text-4xl font-extrabold text-forest tracking-tight">
                            {{ number_format($totalDistributions) }}
                        </h3>
                        <p class="text-[11px] text-gray-400 font-semibold">
                            dokumentasi bantuan tersimpan
                        </p>
                    </a>
                </div>

                <!-- Metric 4: Posko Aktif -->
                <div class="bezel-outer">
                    <a href="{{ route('admin.drop-points.index') }}" class="bezel-inner p-6 bg-white block space-y-3 hover:border-forest/20 transition-all duration-300">
                        <div class="flex items-center justify-between text-xs font-bold text-gray-500 uppercase tracking-wider">
                            <span>Titik Posko Drop-Off</span>
                            <span class="text-lg">📍</span>
                        </div>
                        <h3 class="text-3xl sm:text-4xl font-extrabold text-forest tracking-tight">
                            {{ number_format($totalDropPoints) }}
                        </h3>
                        <p class="text-[11px] text-gray-400 font-semibold">
                            lokasi aktif di database • Kelola Posko →
                        </p>
                    </a>
                </div>

            </div>

            <!-- 3 Modul Kelola Utama (1:1 Selaras dengan Anggota Tim) -->
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-base font-extrabold text-forest uppercase tracking-wider">
                        Modul Pengelolaan Sistem
                    </h2>
                    <span class="text-xs text-gray-400 font-semibold">Shift A Kelompok 3</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    <!-- Modul 1: Afif (Donasi Pakaian) -->
                    <div class="bezel-outer">
                        <div class="bezel-inner p-7 bg-white flex flex-col justify-between h-full space-y-6">
                            <div class="space-y-2">
                                <span class="px-3 py-1 rounded-full bg-forest text-white text-[10px] font-extrabold uppercase tracking-wider">
                                    Modul Donasi • Afif
                                </span>
                                <h3 class="text-xl font-bold text-forest">Kelola Donasi Pakaian</h3>
                                <p class="text-xs text-gray-500 leading-relaxed font-normal">
                                    Tinjau berkas foto pakaian yang diajukan donatur, verifikasi status 1-klik, dan terbitkan nomor resi resmi.
                                </p>
                            </div>
                            <a href="{{ route('donations.index') }}"
                               class="btn-island bg-forest text-white hover:bg-dark-green w-full justify-between shadow-ambient-sm group">
                                <span>Buka Kelola Donasi</span>
                                <span class="w-7 h-7 rounded-full bg-white/20 flex items-center justify-center transition-transform group-hover:translate-x-1">→</span>
                            </a>
                        </div>
                    </div>

                    <!-- Modul 2: Nurul (Titik Posko) -->
                    <div class="bezel-outer">
                        <div class="bezel-inner p-7 bg-white flex flex-col justify-between h-full space-y-6">
                            <div class="space-y-2">
                                <span class="px-3 py-1 rounded-full bg-sage/20 text-forest text-[10px] font-extrabold uppercase tracking-wider border border-sage/30">
                                    Modul Posko • Nurul
                                </span>
                                <h3 class="text-xl font-bold text-forest">Kelola Titik Posko</h3>
                                <p class="text-xs text-gray-500 leading-relaxed font-normal">
                                    Tambah posko drop-off baru, perbarui jam operasional, atur kontak PIC WhatsApp, dan tautan Google Maps.
                                </p>
                            </div>
                            <a href="{{ route('admin.drop-points.index') }}"
                               class="btn-island bg-forest text-white hover:bg-dark-green w-full justify-between shadow-ambient-sm group">
                                <span>Buka Kelola Posko</span>
                                <span class="w-7 h-7 rounded-full bg-white/20 flex items-center justify-center transition-transform group-hover:translate-x-1">→</span>
                            </a>
                        </div>
                    </div>

                    <!-- Modul 3: Faizal (Penyaluran Bantuan) -->
                    <div class="bezel-outer">
                        <div class="bezel-inner p-7 bg-white flex flex-col justify-between h-full space-y-6">
                            <div class="space-y-2">
                                <span class="px-3 py-1 rounded-full bg-sand text-warm-brown text-[10px] font-extrabold uppercase tracking-wider">
                                    Modul Penyaluran • Faizal
                                </span>
                                <h3 class="text-xl font-bold text-forest">Kelola Penyaluran</h3>
                                <p class="text-xs text-gray-500 leading-relaxed font-normal">
                                    Catat serah terima bantuan ke panti asuhan atau korban bencana lengkap dengan unggahan foto dokumentasi.
                                </p>
                            </div>
                            <a href="{{ route('admin.distributions.index') }}"
                               class="btn-island bg-forest text-white hover:bg-dark-green w-full justify-between shadow-ambient-sm group">
                                <span>Buka Penyaluran</span>
                                <span class="w-7 h-7 rounded-full bg-white/20 flex items-center justify-center transition-transform group-hover:translate-x-1">→</span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        {{-- ======================================================== --}}
        {{-- 2. DASHBOARD KHUSUS DONATUR (WARM CITIZEN EXPERIENCE)     --}}
        {{-- ======================================================== --}}
        @else

            <!-- Hero Banner Sambutan Donatur (Double-Bezel) -->
            <div class="bezel-outer">
                <div class="bezel-inner p-8 sm:p-10 bg-white flex flex-col md:flex-row md:items-center justify-between gap-8 relative overflow-hidden">
                    <div class="space-y-3 max-w-2xl">
                        <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-sage/20 text-forest text-[10px] font-extrabold uppercase tracking-[0.2em] border border-sage/30">
                            <span>🌱</span>
                            <span>Ruang Kebaikan Donatur</span>
                        </div>
                        <h2 class="text-3xl sm:text-4xl font-extrabold text-forest tracking-tight leading-tight">
                            Halo, {{ $user->name }}!
                        </h2>
                        <p class="text-xs sm:text-sm text-gray-600 leading-relaxed">
                            Punya pakaian bersih di lemari yang jarang dipakai? Jangan biarkan menumpuk menjadi limbah. Jadikan pakaian tersebut kehangatan baru bagi saudara kita.
                        </p>
                        <div class="pt-2 flex flex-wrap items-center gap-4">
                            <a href="{{ route('donations.create') }}"
                               class="btn-island bg-forest text-white hover:bg-dark-green shadow-ambient-lg group">
                                <span>👕 Donasikan Pakaian Sekarang</span>
                                <span class="w-7 h-7 rounded-full bg-white/20 flex items-center justify-center transition-transform duration-500 ease-luxury group-hover:translate-x-0.5">
                                    +
                                </span>
                            </a>
                            <a href="{{ route('donations.index') }}"
                               class="inline-flex items-center px-6 py-3 rounded-full bg-cream hover:bg-sand border border-black/5 text-xs font-bold text-forest transition shadow-2xs">
                                Riwayat Donasi Saya
                            </a>
                        </div>
                    </div>

                    <div class="hidden sm:flex w-28 h-28 rounded-full bg-sand/60 p-2 flex-shrink-0 items-center justify-center border border-black/5">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-full h-full object-contain">
                    </div>
                </div>
            </div>

            <!-- Bento Row: Ringkasan Kontribusi & Widget Lacak Resi -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                <!-- Kontribusi Card (Col 5) -->
                <div class="lg:col-span-5 bezel-outer">
                    <div class="bezel-inner p-7 bg-white flex flex-col justify-between h-full space-y-6">
                        <div>
                            <span class="text-[10px] font-extrabold uppercase tracking-widest text-gray-400 block">
                                Dampak Kebaikan Anda
                            </span>
                            <div class="flex items-baseline gap-2 mt-2">
                                <span class="text-4xl sm:text-5xl font-black text-forest tracking-tight">{{ $myTotalItems }}</span>
                                <span class="text-sm font-bold text-gray-500">Pcs Pakaian</span>
                            </div>
                            <p class="text-xs text-gray-400 mt-1">Total potong pakaian yang telah diajukan.</p>
                        </div>

                        <!-- Mini Status Pills -->
                        <div class="grid grid-cols-3 gap-2.5 pt-4 border-t border-black/[0.04]">
                            <div class="p-3 rounded-2xl bg-amber-50 border border-amber-200/60 text-center space-y-0.5">
                                <span class="block text-xl font-black text-amber-700">{{ $myPending }}</span>
                                <span class="text-[9px] font-bold text-amber-900 uppercase">Menunggu</span>
                            </div>
                            <div class="p-3 rounded-2xl bg-blue-50 border border-blue-200/60 text-center space-y-0.5">
                                <span class="block text-xl font-black text-blue-700">{{ $myVerified }}</span>
                                <span class="text-[9px] font-bold text-blue-900 uppercase">Di Posko</span>
                            </div>
                            <div class="p-3 rounded-2xl bg-emerald-50 border border-emerald-200/60 text-center space-y-0.5">
                                <span class="block text-xl font-black text-emerald-700">{{ $myDistributed }}</span>
                                <span class="text-[9px] font-bold text-emerald-900 uppercase">Tersalurkan</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Widget Lacak Cepat (Col 7) -->
                <div class="lg:col-span-7 bezel-outer">
                    <div class="bezel-inner p-7 bg-white flex flex-col justify-between h-full space-y-6">
                        <div class="space-y-1">
                            <span class="text-[10px] font-extrabold uppercase tracking-widest text-warm-brown block">
                                Pelacakan Resi Cepat
                            </span>
                            <h3 class="text-xl font-bold text-forest">Lacak Paket Pakaian Donasi Anda</h3>
                            <p class="text-xs text-gray-500 leading-relaxed">
                                Ingin tahu perjalanan baju Anda? Masukkan nomor resi paket untuk melihat timeline verifikasi dan penyaluran langsung.
                            </p>
                        </div>

                        <form action="{{ route('donations.track') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                            <div class="relative flex-1">
                                <input type="text"
                                       name="code"
                                       required
                                       placeholder="Contoh: DON-{{ date('Ymd') }}-XXXX"
                                       class="w-full text-xs font-mono font-bold text-forest uppercase ps-10 pe-4 py-3 rounded-2xl border-gray-200 focus:border-sage focus:ring focus:ring-sage/20 transition">
                                <span class="absolute start-3.5 top-3 text-sm text-gray-400">🏷️</span>
                            </div>
                            <button type="submit"
                                    class="btn-island bg-forest text-white hover:bg-dark-green shadow-ambient-sm justify-center">
                                <span>Cek Status Resi</span>
                                <span class="text-xs">🔍</span>
                            </button>
                        </form>
                    </div>
                </div>

            </div>

            <!-- Riwayat Donasi Terakhir & Shortcut Posko -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                <!-- Riwayat Terakhir (Col 8) -->
                <div class="lg:col-span-8 bezel-outer">
                    <div class="bezel-inner p-7 bg-white space-y-5 h-full">
                        <div class="flex items-center justify-between border-b border-black/[0.04] pb-4">
                            <h3 class="text-base font-bold text-forest">Riwayat Donasi Pakaian Terakhir</h3>
                            <a href="{{ route('donations.index') }}" class="text-xs font-bold text-warm-brown hover:text-forest transition">
                                Buka Semua ({{ $myDonations->count() }}) →
                            </a>
                        </div>

                        @if ($myDonations->count() > 0)
                            <div class="divide-y divide-black/[0.04]">
                                @foreach ($myDonations as $donation)
                                    <div class="py-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                        <div class="space-y-1">
                                            <div class="flex items-center space-x-2">
                                                <span class="font-mono font-bold text-xs text-forest bg-cream px-2.5 py-0.5 rounded-lg border border-sand">
                                                    {{ $donation->tracking_code }}
                                                </span>
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold border {{ $donation->status_badge_class }}">
                                                    {{ $donation->status_label }}
                                                </span>
                                            </div>
                                            <p class="text-xs text-gray-800 font-bold">
                                                {{ $donation->clothing_type }} • <span class="text-forest font-black">{{ $donation->quantity }} Pcs</span> ({{ $donation->condition_label }})
                                            </p>
                                            <p class="text-[11px] text-gray-400">
                                                Metode: {{ $donation->delivery_method_label }} • {{ $donation->created_at->format('d M Y') }}
                                            </p>
                                        </div>

                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('donations.show', $donation) }}"
                                               class="px-3.5 py-1.5 rounded-full bg-sage/20 text-forest text-xs font-bold hover:bg-forest hover:text-white transition">
                                                Detail
                                            </a>
                                            <a href="{{ route('donations.print', $donation) }}"
                                               target="_blank"
                                               class="px-3.5 py-1.5 rounded-full border border-warm-brown/40 text-warm-brown text-xs font-bold hover:bg-warm-brown hover:text-white transition">
                                                Cetak Label
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="py-12 text-center space-y-3">
                                <span class="text-4xl block">📦</span>
                                <h4 class="font-bold text-forest text-sm">Belum Ada Donasi Pakaian</h4>
                                <p class="text-xs text-gray-500 max-w-sm mx-auto">
                                    Mulai langkah kebaikan Anda hari ini dengan mendonasikan pakaian layak pakai pertama.
                                </p>
                                <a href="{{ route('donations.create') }}"
                                   class="btn-island bg-forest text-white hover:bg-dark-green mt-2 shadow-ambient-sm">
                                    <span>Ajukan Donasi Sekarang</span>
                                    <span>+</span>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Shortcut Posko & Transparansi (Col 4) -->
                <div class="lg:col-span-4 space-y-6">
                    <div class="bezel-outer">
                        <div class="bezel-inner p-6 bg-white space-y-3">
                            <span class="text-2xl block">📍</span>
                            <h4 class="font-bold text-forest text-base">Antar Langsung ke Posko</h4>
                            <p class="text-xs text-gray-500 leading-relaxed font-normal">
                                Cari posko drop-off terdekat di kotamu dan kontak petugas untuk jadwal penyerahan.
                            </p>
                            <a href="{{ route('posko.public') }}"
                               class="btn-island bg-sand/60 text-forest hover:bg-sand w-full justify-between mt-2 border border-black/5">
                                <span>Buka Daftar Posko</span>
                                <span>→</span>
                            </a>
                        </div>
                    </div>

                    <div class="bezel-outer">
                        <div class="bezel-inner p-6 bg-white space-y-3">
                            <span class="text-2xl block">🤝</span>
                            <h4 class="font-bold text-forest text-base">Transparansi Bantuan</h4>
                            <p class="text-xs text-gray-500 leading-relaxed font-normal">
                                Dokumentasi foto penyerahan pakaian kepada panti asuhan dan warga prasejahtera.
                            </p>
                            <a href="{{ route('laporan.public') }}"
                               class="btn-island bg-sand/60 text-forest hover:bg-sand w-full justify-between mt-2 border border-black/5">
                                <span>Lihat Laporan Penyaluran</span>
                                <span>→</span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>

        @endif

    </div>
</x-app-layout>
