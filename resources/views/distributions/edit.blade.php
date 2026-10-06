<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Penyaluran
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="rounded-xl bg-white p-6 shadow">

                <form
                    action="{{ route('admin.distributions.update', $distribution) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="space-y-6"
                >
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="mb-2 block font-medium">
                            Nama Penerima
                        </label>

                        <input
                            type="text"
                            name="recipient_name"
                            value="{{ old('recipient_name', $distribution->recipient_name) }}"
                            class="w-full rounded-lg border-gray-300"
                        >

                        @error('recipient_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mb-2 block font-medium">
                            Tanggal Penyaluran
                        </label>

                        <input
                            type="date"
                            name="distribution_date"
                            value="{{ old('distribution_date', $distribution->distribution_date->format('Y-m-d')) }}"
                            class="w-full rounded-lg border-gray-300"
                        >
                    </div>

                    <div>
                        <label class="mb-2 block font-medium">
                            Jumlah Pakaian
                        </label>

                        <input
                            type="number"
                            name="items_count"
                            value="{{ old('items_count', $distribution->items_count) }}"
                            min="1"
                            class="w-full rounded-lg border-gray-300"
                        >
                    </div>

                    <div>
                        <label class="mb-2 block font-medium">
                            Foto Saat Ini
                        </label>

                        <img
                            src="{{ asset('storage/' . $distribution->proof_photo) }}"
                            class="mb-3 h-40 rounded-lg object-cover"
                            alt="Dokumentasi"
                        >

                        <label class="mb-2 block font-medium">
                            Ganti Foto
                        </label>

                        <input
                            type="file"
                            name="proof_photo"
                            accept="image/*"
                            class="w-full"
                        >
                    </div>

                    <div>
                        <label class="mb-2 block font-medium">
                            Keterangan
                        </label>

                        <textarea
                            name="description"
                            rows="5"
                            class="w-full rounded-lg border-gray-300"
                        >{{ old('description', $distribution->description) }}</textarea>
                    </div>

                    <div class="flex gap-3">
                        <a
                            href="{{ route('admin.distributions.index') }}"
                            class="rounded-lg bg-gray-300 px-5 py-3"
                        >
                            Kembali
                        </a>

                        <button
                            type="submit"
                            class="rounded-lg bg-dark-green px-5 py-3 text-white"
                        >
                            Update
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>