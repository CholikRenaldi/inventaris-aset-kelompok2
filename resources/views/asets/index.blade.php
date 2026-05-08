@extends('layouts.master')

@section('content')

<h2>Data Inventaris Aset</h2>

@if(session('success'))
<p class="success">{{ session('success') }}</p>
@endif



<table>

<tr>
<th>Kode</th>
<th>Nama</th>
<th>Kategori</th>
<th>Jumlah</th>
<th>Kondisi</th>
<th>Foto</th>
<th>Aksi</th>

</tr>

@foreach($data as $item)

<tr>
<td>{{ $item->kode_barang }}</td>
<td>{{ $item->nama_barang }}</td>
<td>
    {{ $item->kategori->nama_kategori ?? 'Tanpa Kategori' }}
</td>
<td>{{ $item->jumlah }}</td>
<td>{{ $item->kondisi }}</td>
<td>
@if($item->foto)
    <img src="{{ asset('uploads/'.$item->foto) }}" width="80">
@else
    Tidak ada
@endif
</td>

<td>

<a href="{{ route('asets.edit',$item->id) }}" class="btn btn-edit">
Edit
</a>

<form action="{{ route('asets.destroy',$item->id) }}"
method="POST"
style="display:inline">

@csrf
@method('DELETE')

<button
class="btn btn-delete"
onclick="return confirm('Yakin hapus?')">

Hapus

</button>

</form>

</td>
</tr>

@endforeach


</table>
<a href="{{ route('asets.create') }}" class="btn btn-add">+ Tambah Data</a>
@endsection