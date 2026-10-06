<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Label Pengiriman - {{ $donation->tracking_code }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600,700,800&family=libre-barcode-39-extended-text&display=swap" rel="stylesheet" />

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                background: white !important;
                padding: 0 !important;
            }
            .label-card {
                border: 2px solid black !important;
                box-shadow: none !important;
                page-break-inside: avoid;
            }
        }
    </style>
</head>
<body class="bg-gray-100 font-sans text-gray-900 py-8 px-4">

    <!-- Top Action Bar (Disembunyikan saat cetak) -->
    <div class="no-print max-w-2xl mx-auto mb-6 flex items-center justify-between bg-white p-4 rounded-xl shadow-sm border border-gray-200">
        <div class="flex items-center space-x-2">
            <span class="text-xl">🖨️</span>
            <div>
                <h3 class="font-bold text-sm text-gray-800">Lembar Siap Cetak</h3>
                <p class="text-xs text-gray-500">Gunakan kertas A4 / A5 atau potong sesuai garis batas label.</p>
            </div>
        </div>
        <div class="flex items-center space-x-3">
            <button onclick="window.print()"
                    class="px-5 py-2 bg-dark-green text-white font-bold text-xs rounded-lg hover:bg-sage transition shadow flex items-center space-x-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                <span>Cetak Label Sekarang</span>
            </button>
            <button onclick="window.close()"
                    class="px-4 py-2 border border-gray-300 text-gray-700 font-semibold text-xs rounded-lg hover:bg-gray-50 transition">
                Tutup
            </button>
        </div>
    </div>

    <!-- Container Label Paket Pengiriman -->
    <div class="max-w-2xl mx-auto">

        <!-- Garis Batas Gunting -->
        <div class="border-2 border-dashed border-gray-400 p-2 rounded-2xl bg-white label-card">

            <div class="border-2 border-black rounded-xl p-6 space-y-5">

                <!-- Header Brand & Ekspedisi -->
                <div class="flex items-start justify-between border-b-2 border-black pb-4">
                    <div class="flex items-center space-x-3">
                        <span class="text-3xl">👕</span>
                        <div>
                            <h1 class="text-2xl font-black tracking-tight text-black uppercase">LEMARI PEDULI</h1>
                            <p class="text-xs font-semibold text-gray-700">Platform Donasi Pakaian Layak Pakai</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="inline-block px-3 py-1 bg-black text-white text-xs font-black uppercase rounded">
                            {{ $donation->delivery_method === 'antar_posko' ? 'DROP-OFF POSKO' : 'PAKET EKSPEDISI' }}
                        </span>
                        <p class="text-[10px] text-gray-500 mt-1">Dicetak: {{ now()->format('d/m/Y H:i') }} WIB</p>
                    </div>
                </div>

                <!-- Box Resi & Barcode Simulation -->
                <div class="text-center bg-gray-50 p-4 rounded-lg border border-black space-y-1">
                    <span class="text-[10px] tracking-widest uppercase font-bold text-gray-600 block">NOMOR RESI PELACAKAN</span>
                    <div class="font-mono text-2xl font-black tracking-wider text-black">
                        {{ $donation->tracking_code }}
                    </div>
                    <!-- Barcode Visual Pattern -->
                    <div class="font-mono text-xl tracking-tighter text-black select-none opacity-80 pt-1">
                        |||||||||||| | |||||| |||||||| ||||||| | |||||||||
                    </div>
                </div>

                <!-- 2 Kolom: Pengirim (Donatur) & Penerima (Posko) -->
                <div class="grid grid-cols-2 gap-4 border-b-2 border-black pb-5">
                    <!-- Pengirim -->
                    <div class="border-r-2 border-black pr-4 space-y-1">
                        <span class="text-[10px] uppercase font-black tracking-wider bg-gray-200 px-1.5 py-0.5 rounded">
                            PENGIRIM (DONATUR)
                        </span>
                        <div class="pt-1">
                            <h3 class="font-bold text-sm text-black">{{ $donation->donor_name }}</h3>
                            <p class="font-mono text-xs text-gray-800">Telp: {{ $donation->donor_phone }}</p>
                        </div>
                    </div>

                    <!-- Penerima -->
                    <div class="space-y-1">
                        <span class="text-[10px] uppercase font-black tracking-wider bg-black text-white px-1.5 py-0.5 rounded">
                            TUJUAN / PENERIMA
                        </span>
                        <div class="pt-1">
                            <h3 class="font-bold text-sm text-black">Posko Pengumpulan Lemari Peduli</h3>
                            <p class="text-xs text-gray-700">Hubungi Petugas Posko / drop-off terdekat.</p>
                            <p class="text-[11px] font-mono text-gray-600">Lacak online di: lemaripeduli.com/tracking</p>
                        </div>
                    </div>
                </div>

                <!-- Rincian Isi Paket Pakaian -->
                <div class="space-y-2">
                    <span class="text-[10px] uppercase font-black tracking-wider text-gray-600 block">
                        RINCIAN BARANG DONASI
                    </span>
                    <table class="w-full text-xs border border-black">
                        <thead class="bg-gray-100 border-b border-black font-bold">
                            <tr>
                                <th class="p-2 text-left">Jenis Pakaian</th>
                                <th class="p-2 text-center">Jumlah</th>
                                <th class="p-2 text-center">Kondisi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="p-2 font-bold">{{ $donation->clothing_type }}</td>
                                <td class="p-2 text-center font-bold font-mono">{{ $donation->quantity }} Pcs</td>
                                <td class="p-2 text-center">{{ $donation->condition_label }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Catatan Pengirim jika ada -->
                @if ($donation->notes)
                    <div class="p-2.5 bg-gray-50 border border-gray-300 rounded text-xs text-gray-700">
                        <strong class="text-black">Catatan Donatur:</strong> {{ $donation->notes }}
                    </div>
                @endif

                <!-- Instruksi Penempelan -->
                <div class="pt-3 border-t border-dashed border-black text-[10px] text-gray-500 flex items-center justify-between">
                    <span>✂️ Gunting dan tempelkan label ini di permukaan luar paket pakaian.</span>
                    <span class="font-bold text-black uppercase">Lemari Peduli Shift A</span>
                </div>

            </div>

        </div>

    </div>

</body>
</html>
