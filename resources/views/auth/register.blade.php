@extends('layouts.master')

@section('content')

<h2 class="mb-4">
    Dashboard
</h2>

<div class="card shadow">
    
    <div class="card-body">

        <h4>
            Selamat Datang, {{ Auth::user()->name }}
        </h4>

        <p>
            Anda berhasil login ke aplikasi inventaris aset.
        </p>

    </div>

</div>

@endsection