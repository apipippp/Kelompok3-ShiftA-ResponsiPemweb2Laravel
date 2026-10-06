<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Daftar Drop Point
        </h2>
    </x-slot>


    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">


                <a href="{{ route('drop_points.create') }}"
                   class="bg-blue-500 text-white px-4 py-2 rounded">
                    Tambah Posko
                </a>


                <table class="mt-5 w-full border">

                    <tr class="border">
                        <th class="border p-2">Nama</th>
                        <th class="border p-2">Kota</th>
                        <th class="border p-2">PIC</th>
                        <th class="border p-2">Aksi</th>
                    </tr>


                    @foreach($dropPoints as $dropPoint)

                    <tr class="border">

                        <td class="border p-2">
                            {{ $dropPoint->name }}
                        </td>

                        <td class="border p-2">
                            {{ $dropPoint->city }}
                        </td>

                        <td class="border p-2">
                            {{ $dropPoint->pic_name }}
                        </td>

                        <td class="border p-2 space-x-2">

                        <a href="{{ route('drop_points.show',$dropPoint->id) }}"
                        class="text-green-600">
                            Detail
                        </a>


                        <a href="{{ route('drop_points.edit',$dropPoint->id) }}"
                        class="text-blue-600">
                            Edit
                        </a>


                        <form action="{{ route('drop_points.destroy',$dropPoint->id) }}"
                            method="POST"
                            class="inline">

                            @csrf
                            @method('DELETE')

                            <button class="text-red-600">
                                Hapus
                            </button>

                        </form>

                    </td>
                    </tr>

                    @endforeach


                </table>


            </div>

        </div>

    </div>


</x-app-layout>