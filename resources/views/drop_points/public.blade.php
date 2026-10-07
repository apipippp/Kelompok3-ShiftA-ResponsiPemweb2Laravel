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

    {{-- Navbar --}}
    <nav class="sticky top-0 z-50 border-b border-gray-100 bg-white/95 shadow-sm backdrop-blur">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">

            <a href="/" class="text-2xl font-bold tracking-tight text-dark-green">
                Lemari Peduli
            </a>

            <div class="flex items-center gap-3">

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
                        Dashboard
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
                    Salurkan pakaian layak pakai melalui posko pengumpulan
                    Lemari Peduli. Temukan lokasi, jam operasional, dan
                    kontak PIC sebelum datang.
                </p>

            </div>

        </div>

    </section>


    {{-- Intro --}}
    <section class="py-12 md:py-16">

        <div class="mx-auto max-w-7xl px-6">

            <div class="max-w-2xl">

                <p class="text-sm font-semibold uppercase tracking-widest text-sage">
                    Titik Pengumpulan
                </p>

                <h2 class="mt-2 text-2xl font-bold text-dark-green md:text-3xl">
                    Pilih posko untuk menyalurkan donasimu
                </h2>

                <p class="mt-3 leading-7 text-gray-600">
                    Setiap posko memiliki informasi lengkap mengenai alamat,
                    PIC, jam operasional, dan lokasi Google Maps agar proses
                    penyaluran donasi menjadi lebih mudah.
                </p>

            </div>


            {{-- Daftar Posko --}}
            <div class="mt-10">

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

                                    <div class="flex items-start justify-between gap-4">

                                        <div>

                                            <p class="text-xs font-semibold uppercase tracking-wide text-sage">
                                                Posko Donasi
                                            </p>

                                            <h3 class="mt-1 text-xl font-bold leading-snug text-dark-green">
                                                {{ $dropPoint->name }}
                                            </h3>

                                        </div>

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

                    {{-- Empty State --}}
                    <div class="rounded-2xl border border-dashed border-gray-300 bg-white px-6 py-16 text-center">

                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-green-50 text-2xl text-dark-green">
                            ♡
                        </div>

                        <h2 class="mt-5 text-xl font-bold text-dark-green">
                            Belum Ada Posko
                        </h2>

                        <p class="mx-auto mt-2 max-w-md leading-6 text-gray-500">
                            Saat ini belum tersedia titik posko pengumpulan.
                            Silakan cek kembali beberapa saat lagi.
                        </p>

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
    <footer class="bg-white border-t border-gray-100 py-8">

        <div class="mx-auto max-w-7xl px-6 text-center">

            <p class="text-sm text-gray-500">
                © {{ date('Y') }} Lemari Peduli.
                Bersama berbagi, bersama peduli.
            </p>

        </div>

    </footer>

</body>
</html>