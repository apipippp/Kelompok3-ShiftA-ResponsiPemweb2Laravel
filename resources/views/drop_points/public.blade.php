<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Posko Pengumpulan - Lemari Peduli</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-cream text-gray-800">
    @if (Auth::check() && Auth::user()->role === 'admin')
        <div class="bg-dark-green text-white px-6 py-2.5 text-xs flex justify-between items-center shadow-sm">
            <span class="font-medium">
                🛡️ Mode Pratinjau Publik (Login: <strong>{{ Auth::user()->name }}</strong>)
            </span>
            <a href="{{ route('dashboard') }}" class="font-bold bg-white/20 hover:bg-white/30 px-3 py-1 rounded-lg transition">
                ← Kembali ke Dashboard Admin
            </a>
        </div>
    @endif

    {{-- Navbar --}}
    <nav class="sticky top-0 z-50 border-b border-gray-100 bg-white/95 shadow-sm backdrop-blur">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">

            <a
                href="/"
                class="text-2xl font-bold tracking-tight text-dark-green"
            >
                Lemari Peduli
            </a>

            <div class="flex items-center gap-3">

                <a
                    href="{{ route('donations.index') }}"
                    class="hidden text-sm font-medium text-gray-600 transition hover:text-dark-green md:block"
                >
                    Donasi Saya
                </a>

                <a
                    href="/laporan"
                    class="hidden text-sm font-medium text-gray-600 transition hover:text-dark-green md:block"
                >
                    Laporan Penyaluran
                </a>

                @auth

                    <a
                        href="{{ route('dashboard') }}"
                        class="rounded-xl bg-dark-green px-5 py-2.5 text-sm font-semibold text-white transition hover:opacity-90"
                    >
                        {{ Auth::user()->role === 'admin' ? 'Dashboard Admin' : 'Portal Donatur' }}
                    </a>
                @else

                    <a
                        href="{{ route('login') }}"
                        class="rounded-xl px-4 py-2.5 text-sm font-medium text-gray-600 transition hover:bg-gray-100"
                    >
                        Login
                    </a>

                    <a
                        href="{{ route('register') }}"
                        class="rounded-xl bg-dark-green px-5 py-2.5 text-sm font-semibold text-white transition hover:opacity-90"
                    >
                        Daftar
                    </a>

                @endauth

            </div>

        </div>
    </nav>


    {{-- Hero --}}
    <section class="relative overflow-hidden bg-dark-green">

        <div class="absolute -right-20 -top-20 h-72 w-72 rounded-full bg-white/5"></div>
        <div class="absolute -bottom-32 -left-20 h-80 w-80 rounded-full bg-white/5"></div>

        <div class="relative mx-auto max-w-7xl px-6 py-20 md:py-24">

            <div class="max-w-3xl">

                <span class="inline-block rounded-full bg-white/10 px-4 py-2 text-sm font-medium text-green-100">
                    Posko Pengumpulan Donasi
                </span>

                <h1 class="mt-6 text-4xl font-bold leading-tight text-white md:text-5xl">
                    Temukan Posko
                    <span class="text-green-200">
                        Terdekat
                    </span>
                </h1>

                <p class="mt-5 max-w-2xl text-base leading-7 text-green-100 md:text-lg">
                    Temukan lokasi posko, jam operasional, dan kontak PIC
                    untuk menyalurkan pakaian layak pakai.
                </p>

            </div>

        </div>

    </section>


    {{-- Daftar Posko --}}
    <section class="py-12 md:py-16">

        <div class="mx-auto max-w-7xl px-6">

            {{-- Section Heading --}}
            <div class="mb-7">

                <p class="text-sm font-semibold uppercase tracking-widest text-sage">
                    Titik Pengumpulan
                </p>

                <div class="mt-2 flex flex-col justify-between gap-3 md:flex-row md:items-end">

                    <div>
                        <h2 class="text-2xl font-bold text-dark-green md:text-3xl">
                            Cari Posko
                        </h2>

                        <p class="mt-1 text-sm text-gray-500">
                            Temukan posko berdasarkan nama, alamat, atau kota.
                        </p>
                    </div>

                </div>

            </div>


            {{-- Search & Filter --}}
            <div class="mb-10 rounded-2xl border border-gray-100 bg-white p-4 shadow-sm md:p-5">

                <form
                    action="{{ route('posko.public') }}"
                    method="GET"
                    class="grid gap-3 md:grid-cols-[1fr_200px_auto_auto]"
                >

                    {{-- Search --}}
                    <div>

                        <label
                            for="search"
                            class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-gray-500"
                        >
                            Cari Posko
                        </label>

                        <div class="relative">

                            <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                🔍
                            </span>

                            <input
                                type="text"
                                id="search"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Nama posko, alamat, atau kota..."
                                class="w-full rounded-xl border-gray-200 bg-gray-50 py-3 pl-11 pr-4 text-sm transition focus:border-sage focus:bg-white focus:ring-sage"
                            >

                        </div>

                    </div>


                    {{-- Filter Kota --}}
                    <div>

                        <label
                            for="city"
                            class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-gray-500"
                        >
                            Kota
                        </label>

                        <select
                            id="city"
                            name="city"
                            class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm transition focus:border-sage focus:bg-white focus:ring-sage"
                        >

                            <option value="">
                                Semua Kota
                            </option>

                            @foreach ($cities as $city)

                                <option
                                    value="{{ $city }}"
                                    {{ request('city') == $city ? 'selected' : '' }}
                                >
                                    {{ $city }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Tombol Cari --}}
                    <div class="flex items-end">

                        <button
                            type="submit"
                            class="w-full rounded-xl bg-pink-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-pink-700 md:w-auto"
                        >
                            Cari
                        </button>

                    </div>


                    {{-- Tombol Reset --}}
                    <div class="flex items-end">

                        <a
                            href="{{ route('posko.public') }}"
                            class="w-full rounded-xl border border-gray-200 px-5 py-3 text-center text-sm font-semibold text-gray-600 transition hover:bg-gray-50 md:w-auto"
                        >
                            Reset
                        </a>

                    </div>

                </form>

            </div>


            {{-- Judul Hasil --}}
            <div class="mb-5 flex items-center justify-between">

                <div>

                    <h3 class="text-lg font-bold text-dark-green">
                        Posko Tersedia
                    </h3>

                    @if(request('search') || request('city'))

                        <p class="mt-1 text-sm text-gray-500">
                            Menampilkan hasil pencarian
                            @if(request('search'))
                                untuk "<span class="font-medium text-gray-700">{{ request('search') }}</span>"
                            @endif

                            @if(request('city'))
                                di
                                <span class="font-medium text-gray-700">
                                    {{ request('city') }}
                                </span>
                            @endif
                        </p>

                    @endif

                </div>

                @if($dropPoints->count() > 0)

                    <span class="rounded-full bg-green-50 px-3 py-1 text-xs font-semibold text-dark-green">
                        {{ $dropPoints->count() }} Posko
                    </span>

                @endif

            </div>


            {{-- Daftar Posko --}}
            <div>

                @if($dropPoints->count() > 0)

                    <div class="grid grid-cols-1 gap-7 md:grid-cols-2 lg:grid-cols-3">

                        @foreach($dropPoints as $dropPoint)

                            <article
                                class="group overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl"
                            >

                                {{-- Foto --}}
                                @if($dropPoint->photo)

                                    <img
                                        src="{{ asset('storage/' . $dropPoint->photo) }}"
                                        alt="{{ $dropPoint->name }}"
                                        class="h-52 w-full object-cover transition duration-500 group-hover:scale-105"
                                    >

                                @else

                                    <div class="flex h-52 items-center justify-center bg-sage">

                                        <div class="text-center text-white">

                                            <div class="text-3xl">
                                                ♡
                                            </div>

                                            <p class="mt-2 text-sm font-medium">
                                                Lemari Peduli
                                            </p>

                                        </div>

                                    </div>

                                @endif


                                {{-- Content --}}
                                <div class="p-6">

                                    {{-- Nama Posko --}}
                                    <div>

                                        <p class="text-xs font-semibold uppercase tracking-wide text-sage">
                                            Posko Donasi
                                        </p>

                                        <h3 class="mt-1 text-xl font-bold leading-snug text-dark-green">
                                            {{ $dropPoint->name }}
                                        </h3>

                                    </div>


                                    {{-- Detail --}}
                                    <div class="mt-5 space-y-4">

                                        {{-- Alamat --}}
                                        <div class="flex gap-3">

                                            <div class="mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-green-50 text-dark-green">
                                                📍
                                            </div>

                                            <div>

                                                <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                                                    Alamat
                                                </p>

                                                <p class="mt-1 text-sm leading-5 text-gray-600">
                                                    {{ $dropPoint->address }}
                                                </p>

                                                <p class="mt-1 text-sm font-medium text-dark-green">
                                                    {{ $dropPoint->city }}
                                                </p>

                                            </div>

                                        </div>


                                        {{-- PIC --}}
                                        <div class="flex gap-3">

                                            <div class="mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-green-50 text-dark-green">
                                                👤
                                            </div>

                                            <div>

                                                <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                                                    PIC Posko
                                                </p>

                                                <p class="mt-1 text-sm font-medium text-gray-700">
                                                    {{ $dropPoint->pic_name }}
                                                </p>

                                                <p class="mt-1 text-sm text-gray-500">
                                                    {{ $dropPoint->pic_phone }}
                                                </p>

                                            </div>

                                        </div>


                                        {{-- Jam Operasional --}}
                                        <div class="flex gap-3">

                                            <div class="mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-green-50 text-dark-green">
                                                🕐
                                            </div>

                                            <div>

                                                <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                                                    Jam Operasional
                                                </p>

                                                <p class="mt-1 text-sm leading-5 text-gray-600">
                                                    {{ $dropPoint->operating_hours }}
                                                </p>

                                            </div>

                                        </div>

                                    </div>


                                    {{-- Buttons --}}
                                    <div class="mt-6 grid grid-cols-2 gap-3">

                                        @if($dropPoint->maps_url)

                                            <a
                                                href="{{ $dropPoint->maps_url }}"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="rounded-xl bg-dark-green px-4 py-3 text-center text-sm font-semibold text-white transition hover:opacity-90"
                                            >
                                                Lihat Maps
                                            </a>

                                        @else

                                            <div></div>

                                        @endif


                                        @if($dropPoint->pic_phone)

                                            <a
                                                href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $dropPoint->pic_phone) }}"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="rounded-xl border border-sage px-4 py-3 text-center text-sm font-semibold text-sage transition hover:bg-sage hover:text-white"
                                            >
                                                Hubungi PIC
                                            </a>

                                        @endif

                                    </div>

                                </div>

                            </article>

                        @endforeach

                    </div>

                @else

                    {{-- Empty Search Result --}}
                    <div class="rounded-2xl border border-dashed border-gray-300 bg-white px-6 py-16 text-center">

                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-green-50 text-2xl text-dark-green">
                            🔍
                        </div>

                        <h2 class="mt-5 text-xl font-bold text-dark-green">
                            Posko Tidak Ditemukan
                        </h2>

                        <p class="mx-auto mt-2 max-w-md leading-6 text-gray-500">
                            Tidak ada posko yang sesuai dengan pencarianmu.
                            Coba gunakan kata kunci atau kota yang berbeda.
                        </p>

                        <a
                            href="{{ route('posko.public') }}"
                            class="mt-5 inline-block rounded-xl bg-dark-green px-5 py-3 text-sm font-semibold text-white transition hover:opacity-90"
                        >
                            Tampilkan Semua Posko
                        </a>

                    </div>

                @endif

            </div>

        </div>

    </section>


    {{-- CTA --}}
    <section class="px-6 pb-16">

        <div class="mx-auto max-w-7xl">

            <div class="overflow-hidden rounded-3xl bg-dark-green px-6 py-10 text-center md:px-12 md:py-14">

                <p class="text-sm font-semibold uppercase tracking-widest text-green-200">
                    Bersama Lemari Peduli
                </p>

                <h2 class="mt-3 text-2xl font-bold text-white md:text-3xl">
                    Satu pakaian layak pakai,
                    satu kesempatan untuk berbagi.
                </h2>

                <p class="mx-auto mt-3 max-w-2xl leading-6 text-green-100">
                    Temukan posko terdekat dan salurkan pakaian layak pakai
                    untuk membantu mereka yang membutuhkan.
                </p>

            </div>

        </div>

    </section>


    {{-- Footer --}}
    <footer class="border-t border-gray-100 bg-white py-8">

        <div class="mx-auto max-w-7xl px-6 text-center">

            <p class="text-sm text-gray-500">
                © {{ date('Y') }} Lemari Peduli.
                Bersama berbagi, bersama peduli.
            </p>

        </div>

    </footer>

</body>
</html>