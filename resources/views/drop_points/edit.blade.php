<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800">
        Edit Drop Point
    </h2>
</x-slot>


<div class="py-12">

<div class="max-w-4xl mx-auto bg-white p-6 shadow rounded">


<form action="{{ route('drop_points.update',$dropPoint->id) }}"
method="POST"
enctype="multipart/form-data">

@csrf
@method('PUT')


<div class="mb-3">
<label>Nama Posko</label>
<input type="text"
name="name"
value="{{ $dropPoint->name }}"
class="border rounded w-full p-2">
</div>


<div class="mb-3">
<label>Alamat</label>
<textarea name="address"
class="border rounded w-full p-2">{{ $dropPoint->address }}</textarea>
</div>


<div class="mb-3">
<label>Kota</label>
<input type="text"
name="city"
value="{{ $dropPoint->city }}"
class="border rounded w-full p-2">
</div>


<div class="mb-3">
<label>PIC</label>
<input type="text"
name="pic_name"
value="{{ $dropPoint->pic_name }}"
class="border rounded w-full p-2">
</div>


<div class="mb-3">
<label>No HP PIC</label>
<input type="text"
name="pic_phone"
value="{{ $dropPoint->pic_phone }}"
class="border rounded w-full p-2">
</div>


<div class="mb-3">
<label>Jam Operasional</label>
<input type="text"
name="operating_hours"
value="{{ $dropPoint->operating_hours }}"
class="border rounded w-full p-2">
</div>


<div class="mb-3">
<label>Foto Baru (opsional)</label>
<input type="file"
name="photo">
</div>


<div class="mb-3">
<label>Google Maps</label>
<input type="text"
name="maps_url"
value="{{ $dropPoint->maps_url }}"
class="border rounded w-full p-2">
</div>


<button class="bg-blue-600 text-white px-4 py-2 rounded">
Update
</button>


</form>


</div>

</div>

</x-app-layout>