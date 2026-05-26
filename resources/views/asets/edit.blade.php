@extends('layouts.master')

@section('content')

<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h4>Edit Aset</h4>
    </div>

    <div class="card-body">
        <form action="{{ route('asets.update', $aset->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Kode Barang</label>

                <input type="text"
                       name="kode_barang"
                       class="form-control"
                       value="{{ old('kode_barang', $aset->kode_barang) }}">

                @error('kode_barang')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Barang</label>

                <input type="text"
                       name="nama_barang"
                       class="form-control"
                       value="{{ old('nama_barang', $aset->nama_barang) }}">

                @error('nama_barang')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Kategori</label>

                <select name="kategori_id" class="form-select">
                    <option value="">-- Pilih Kategori --</option>

                    @foreach($kategoris as $kat)
                        <option value="{{ $kat->id }}"
                            {{ old('kategori_id', $aset->kategori_id) == $kat->id ? 'selected' : '' }}>

                            {{ $kat->nama_kategori }}
                        </option>
                    @endforeach
                </select>

                @error('kategori_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Jumlah</label>

                <input type="number"
                       name="jumlah"
                       class="form-control"
                       value="{{ old('jumlah', $aset->jumlah) }}">

                @error('jumlah')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Kondisi</label>

                <select name="kondisi" class="form-select">
                    <option value="">-- Pilih Kondisi --</option>

                    <option value="Baik"
                        {{ old('kondisi', $aset->kondisi) == 'Baik' ? 'selected' : '' }}>
                        Baik
                    </option>

                    <option value="Rusak Ringan"
                        {{ old('kondisi', $aset->kondisi) == 'Rusak Ringan' ? 'selected' : '' }}>
                        Rusak Ringan
                    </option>

                    <option value="Rusak Berat"
                        {{ old('kondisi', $aset->kondisi) == 'Rusak Berat' ? 'selected' : '' }}>
                        Rusak Berat
                    </option>
                </select>

                @error('kondisi')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Foto Baru</label>

                <input type="file"
                       name="foto"
                       class="form-control">

                @error('foto')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            @if($aset->foto)
                <div class="mb-3">
                    <label class="form-label">Foto Saat Ini</label>
                    <br>

                    <img src="{{ asset('uploads/' . $aset->foto) }}"
                         width="120"
                         class="rounded border shadow-sm">
                </div>
            @endif

            <button class="btn btn-primary">
                Update
            </button>

            <a href="{{ route('asets.index') }}"
               class="btn btn-secondary">
                Batal
            </a>
        </form>
    </div>
</div>

@endsection