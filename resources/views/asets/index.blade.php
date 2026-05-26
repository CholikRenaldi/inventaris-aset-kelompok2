@extends('layouts.master')

@section('content')

<h2 class="mb-4">
    Data Inventaris Aset
</h2>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="d-flex justify-content-between mb-3">

    <form action="{{ route('asets.index') }}"
          method="GET"
          class="d-flex">

        <input type="text"
               name="search"
               class="form-control me-2"
               placeholder="Cari kode / nama barang"
               value="{{ request('search') }}">

        <button class="btn btn-primary">
            Cari
        </button>
    </form>

    <div>
        <a href="{{ route('asets.create') }}"
           class="btn btn-success">
            + Tambah Data
        </a>

        <a href="{{ route('asets.pdf') }}"
           class="btn btn-danger">
            Cetak Laporan PDF
        </a>
    </div>

</div>

<div class="table-responsive">

    <table class="table table-bordered table-striped table-hover">

        <thead class="table-dark">
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Jumlah</th>
                <th>Kondisi</th>
                <th>Foto</th>
                <th width="170">Aksi</th>
            </tr>
        </thead>

        <tbody>

            @forelse($data as $item)
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
                            <img src="{{ asset('uploads/' . $item->foto) }}"
                                 width="80"
                                 class="rounded">
                        @else
                            Tidak ada
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('asets.edit', $item->id) }}"
                           class="btn btn-primary btn-sm">
                            Edit
                        </a>

                        <form action="{{ route('asets.destroy', $item->id) }}"
                              method="POST"
                              class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin hapus?')">
                                Hapus
                            </button>
                        </form>
                    </td>

                </tr>

            @empty
                <tr>
                    <td colspan="7" class="text-center">
                        Data tidak ditemukan
                    </td>
                </tr>
            @endforelse

        </tbody>

    </table>

</div>

<div class="mt-3">
    {{ $data->appends(request()->query())->links() }}
</div>

@endsection