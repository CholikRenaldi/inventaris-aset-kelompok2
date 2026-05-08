@extends('layouts.master')

@section('content')

<h2>Tambah Aset</h2>

<form action="{{ route('asets.store') }}" method="POST" enctype="multipart/form-data">

@csrf

<label>Kode Barang</label>
<input type="text" name="kode_barang">

@error('kode_barang')
<p style="color:red">{{ $message }}</p>
@enderror


<label>Nama Barang</label>
<input type="text" name="nama_barang" value="{{ old('nama_barang') }}">



<label>Kategori</label>
<select name="kategori_id" required>

<option value="">-- Pilih Kategori --</option>

@foreach($kategoris as $kat)
<option value="{{ $kat->id }}">
    {{ $kat->nama_kategori }}
</option>
@endforeach

</select>


<label>Jumlah</label>
<input type="number" name="jumlah" value="{{ old('jumlah') }}">


<label>Kondisi</label>
<select name="kondisi">
<option value="Baik">Baik</option>
<option value="Rusak Ringan">Rusak Ringan</option>
<option value="Rusak Berat">Rusak Berat</option>
</select>


<label>Foto</label>
<input type="file" name="foto">

<button class="btn btn-add">Simpan</button>

<a href="{{ route('asets.index') }}" class="btn btn-cancel">
Batal
</a>

</form>

@endsection