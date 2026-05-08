@extends('layouts.master')

@section('content')

<h2>Edit Aset</h2>

<form action="{{ route('asets.update',$aset->id) }}" method="POST" enctype="multipart/form-data">

@csrf
@method('PUT')

<label>Kode Barang</label>
<input type="text" name="kode_barang" value="{{ old('kode_barang', $aset->kode_barang) }}">

@error('kode_barang')
<p style="color:red">{{ $message }}</p>
@enderror


<label>Nama Barang</label>
<input type="text" name="nama_barang" value="{{ old('nama_barang', $aset->nama_barang) }}">


<label>Kategori</label>
<select name="kategori_id" required>

<option value="">-- Pilih Kategori --</option>

@foreach($kategoris as $kat)
<option value="{{ $kat->id }}"
    {{ old('kategori_id', $aset->kategori_id) == $kat->id ? 'selected' : '' }}>
    {{ $kat->nama_kategori }}
</option>
@endforeach

</select>


<label>Jumlah</label>
<input type="number" name="jumlah" value="{{ old('jumlah', $aset->jumlah) }}">


<label>Kondisi</label>
<select name="kondisi">

<option value="Baik" {{ old('kondisi', $aset->kondisi)=='Baik'?'selected':'' }}>
Baik
</option>

<option value="Rusak Ringan" {{ old('kondisi', $aset->kondisi)=='Rusak Ringan'?'selected':'' }}>
Rusak Ringan
</option>

<option value="Rusak Berat" {{ old('kondisi', $aset->kondisi)=='Rusak Berat'?'selected':'' }}>
Rusak Berat
</option>

</select>


{{-- 🔥 FOTO --}}
<label>Foto</label>
<input type="file" name="foto">

<br><br>

{{-- tampilkan foto lama --}}
@if($aset->foto)
    <img src="{{ asset('uploads/'.$aset->foto) }}" width="100">
@endif


<br><br>

<button class="btn btn-edit">Update</button>

<a href="{{ route('asets.index') }}" class="btn btn-cancel">
Batal
</a>

</form>

@endsection