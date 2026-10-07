<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Tambah Drop Point
    </h2>
</x-slot>


<div class="py-12">

<div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

<div class="bg-white p-6 shadow rounded">


<form action="{{ route('admin.drop-points.store') }}"
      method="POST"
      enctype="multipart/form-data">

@csrf


<div class="mb-3">
<label>Nama Posko</label>
<input type="text"
       name="name"
       class="border rounded w-full p-2">
</div>


<div class="mb-3">
<label>Alamat</label>
<textarea name="address"
          class="border rounded w-full p-2"></textarea>
</div>


<div class="mb-3">
<label>Kota</label>
<input type="text"
       name="city"
       class="border rounded w-full p-2">
</div>


<div class="mb-3">
<label>Nama PIC</label>
<input type="text"
       name="pic_name"
       class="border rounded w-full p-2">
</div>


<div class="mb-3">
<label>No HP PIC</label>
<input type="text"
       name="pic_phone"
       class="border rounded w-full p-2">
</div>


<div class="mb-3">
<label>Jam Operasional</label>
<input type="text"
       name="operating_hours"
       class="border rounded w-full p-2">
</div>


<div class="mb-3">
<label>Foto Posko</label>
<input type="file"
       name="photo">
</div>


<div class="mb-3">
<label>Google Maps URL</label>
<input type="text"
       name="maps_url"
       class="border rounded w-full p-2">
</div>


<button class="bg-blue-600 text-white px-4 py-2 rounded">
Simpan
</button>


</form>

</div>

</div>

</div>

</x-app-layout>