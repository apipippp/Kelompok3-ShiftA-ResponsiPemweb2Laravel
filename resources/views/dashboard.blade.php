<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Admin
        </h2>
    </x-slot>

    <div class="bg-cream py-10">

        <div class="mx-auto max-w-7xl px-6">

            <div class="mb-8">
                <h1 class="text-3xl font-bold text-dark-green">
                    Dashboard Lemari Peduli
                </h1>

                <p class="mt-2 text-gray-600">
                    Ringkasan aktivitas pengelolaan donasi dan penyaluran pakaian.
                </p>
            </div>

            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                <!-- 1. Donasi (Afif) -->
                <a href="{{ route('donations.index') }}" class="block rounded-2xl bg-white p-6 shadow hover:shadow-md hover:border-dark-green border border-transparent transition">
                    <div class="flex items-center justify-between text-sm text-gray-500">
                        <span>Total Donasi Masuk</span>
                        <span>👕</span>
                    </div>
                    <h3 class="mt-2 text-3xl font-bold text-dark-green">
                        {{ $totalDonations }}
                    </h3>
                    <p class="mt-1 text-xs text-gray-400">
                        pcs pakaian • Kelola Donasi →
                    </p>
                </a>

                <!-- 2. Disalurkan (Faizal) -->
                <a href="{{ route('admin.distributions.index') }}" class="block rounded-2xl bg-white p-6 shadow hover:shadow-md hover:border-dark-green border border-transparent transition">
                    <div class="flex items-center justify-between text-sm text-gray-500">
                        <span>Total Pakaian Disalurkan</span>
                        <span>📦</span>
                    </div>
                    <h3 class="mt-2 text-3xl font-bold text-dark-green">
                        {{ $totalDistributedItems }}
                    </h3>
                    <p class="mt-1 text-xs text-gray-400">
                        pcs pakaian • Kelola Laporan →
                    </p>
                </a>

                <!-- 3. Kegiatan Penyaluran (Faizal) -->
                <a href="{{ route('admin.distributions.index') }}" class="block rounded-2xl bg-white p-6 shadow hover:shadow-md hover:border-dark-green border border-transparent transition">
                    <div class="flex items-center justify-between text-sm text-gray-500">
                        <span>Kegiatan Penyaluran</span>
                        <span>🤝</span>
                    </div>
                    <h3 class="mt-2 text-3xl font-bold text-dark-green">
                        {{ $totalDistributions }}
                    </h3>
                    <p class="mt-1 text-xs text-gray-400">
                        kegiatan serah terima
                    </p>
                </a>

                <!-- 4. Posko Aktif (Nurul) -->
                <a href="{{ route('admin.drop-points.index') }}" class="block rounded-2xl bg-white p-6 shadow hover:shadow-md hover:border-dark-green border border-transparent transition">
                    <div class="flex items-center justify-between text-sm text-gray-500">
                        <span>Titik Posko Drop-Off</span>
                        <span>📍</span>
                    </div>
                    <h3 class="mt-2 text-3xl font-bold text-dark-green">
                        {{ $totalDropPoints }}
                    </h3>
                    <p class="mt-1 text-xs text-gray-400">
                        titik posko aktif • Kelola Posko →
                    </p>
                </a>
            </div>

            <!-- Quick Actions untuk Seluruh Modul Tim -->
            <div class="mt-8 grid gap-6 md:grid-cols-2 lg:grid-cols-4">

                <!-- Modul 1: Afif (Donasi) -->
                <div class="rounded-2xl bg-white p-6 shadow flex flex-col justify-between border-t-4 border-dark-green">
                    <div>
                        <span class="text-xs font-bold text-dark-green uppercase tracking-wider">Modul Afif</span>
                        <h3 class="text-xl font-bold text-dark-green mt-1">
                            Kelola Donasi
                        </h3>
                        <p class="mt-2 text-sm text-gray-600 leading-relaxed">
                            Verifikasi pengajuan pakaian dari donatur, ubah status, dan cetak label resi.
                        </p>
                    </div>
                    <a
                        href="{{ route('donations.index') }}"
                        class="mt-5 block text-center rounded-xl bg-dark-green px-5 py-2.5 text-sm font-semibold text-white hover:bg-sage transition"
                    >
                        Kelola Donasi Pakaian
                    </a>
                </div>

                <!-- Modul 2: Nurul (Posko) -->
                <div class="rounded-2xl bg-white p-6 shadow flex flex-col justify-between border-t-4 border-sage">
                    <div>
                        <span class="text-xs font-bold text-sage uppercase tracking-wider">Modul Nurul</span>
                        <h3 class="text-xl font-bold text-dark-green mt-1">
                            Kelola Posko
                        </h3>
                        <p class="mt-2 text-sm text-gray-600 leading-relaxed">
                            Tambah, edit, dan hapus titik posko pengumpulan pakaian drop-off.
                        </p>
                    </div>
                    <a
                        href="{{ route('admin.drop-points.index') }}"
                        class="mt-5 block text-center rounded-xl bg-dark-green px-5 py-2.5 text-sm font-semibold text-white hover:bg-sage transition"
                    >
                        Kelola Titik Posko
                    </a>
                </div>

                <!-- Modul 3: Faizal (Penyaluran) -->
                <div class="rounded-2xl bg-white p-6 shadow flex flex-col justify-between border-t-4 border-warm-brown">
                    <div>
                        <span class="text-xs font-bold text-warm-brown uppercase tracking-wider">Modul Faizal</span>
                        <h3 class="text-xl font-bold text-dark-green mt-1">
                            Kelola Penyaluran
                        </h3>
                        <p class="mt-2 text-sm text-gray-600 leading-relaxed">
                            Catat penyerahan baju ke panti/korban dan unggah foto bukti dokumentasi.
                        </p>
                    </div>
                    <a
                        href="{{ route('admin.distributions.index') }}"
                        class="mt-5 block text-center rounded-xl bg-dark-green px-5 py-2.5 text-sm font-semibold text-white hover:bg-sage transition"
                    >
                        Kelola Data Penyaluran
                    </a>
                </div>

                <!-- Pratinjau Publik (Buka di Tab Baru) -->
                <div class="rounded-2xl bg-white p-6 shadow flex flex-col justify-between border-t-4 border-gray-400">
                    <div>
                        <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">Pratinjau Publik</span>
                        <h3 class="text-xl font-bold text-dark-green mt-1">
                            Lihat Laporan Publik
                        </h3>
                        <p class="mt-2 text-sm text-gray-600 leading-relaxed">
                            Lihat galeri transparansi yang dapat diakses oleh masyarakat umum.
                        </p>
                    </div>
                    <a
                        href="{{ route('laporan.public') }}"
                        target="_blank"
                        class="mt-5 block text-center rounded-xl bg-warm-brown px-5 py-2.5 text-sm font-semibold text-white hover:bg-dark-green transition"
                    >
                        Buka Halaman Publik ↗
                    </a>
                </div>

            </div>

        </div>

    </div>

</x-app-layout>
