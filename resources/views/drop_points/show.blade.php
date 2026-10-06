<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-xl">
        Detail Drop Point
    </h2>
</x-slot>


<div class="py-12">

<div class="max-w-3xl mx-auto bg-white p-6 shadow">


<h2 class="text-xl font-bold">
{{ $dropPoint->name }}
</h2>


<p class="mt-3">
Alamat:
{{ $dropPoint->address }}
</p>


<p>
Kota:
{{ $dropPoint->city }}
</p>


<p>
PIC:
{{ $dropPoint->pic_name }}
</p>


<p>
Nomor:
{{ $dropPoint->pic_phone }}
</p>


<p>
Jam Operasional:
{{ $dropPoint->operating_hours }}
</p>


@if($dropPoint->photo)

<img src="{{ asset('storage/'.$dropPoint->photo) }}"
     class="mt-4 w-64">

@endif


@if($dropPoint->maps_url)

<a href="{{ $dropPoint->maps_url }}"
target="_blank"
class="text-blue-600">
Lihat Google Maps
</a>

@endif


</div>

</div>

</x-app-layout>