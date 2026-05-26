@extends('layouts.master')

@section('content')

<div class="card shadow">

    <div class="card-header bg-dark text-white">
        <h4>Dashboard</h4>
    </div>

    <div class="card-body">

        <h5>
            Selamat Datang, {{ Auth::user()->name }}
        </h5>

        <p>
            Sistem Inventaris Aset
        </p>

    </div>

</div>

@endsection