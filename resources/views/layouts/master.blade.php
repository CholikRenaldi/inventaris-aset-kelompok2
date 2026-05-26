<!DOCTYPE html>
<html>

<head>

<title>Inventaris Aset</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    font-family:'Segoe UI', Arial, sans-serif;
    background:#f5f6fa;
}

/* Navbar */
.custom-navbar{
    background:#1e293b;
    padding:14px 0;
}

/* Brand */
.navbar-brand{
    color:white !important;
    font-size:22px;
    font-weight:bold;
}

/* Menu */
.nav-link-custom{
    color:#cbd5e1;
    text-decoration:none;
    margin-right:25px;
    font-weight:500;
    padding-bottom:18px;
    transition:0.2s;
    position:relative;
}

/* Hover */
.nav-link-custom:hover{
    color:white;
}

/* Menu aktif */
.nav-active{
    color:white !important;
}

.nav-active::after{
    content:'';
    position:absolute;
    left:0;
    bottom:0;
    width:100%;
    height:3px;
    background:#4f46e5;
    border-radius:10px;
}

/* User */
.user-text{
    color:white;
    margin-right:10px;
}

/* Card */
.card{
    border-radius:12px;
}

/* Tabel */
.table img{
    object-fit:cover;
}

.pagination{
    justify-content:center;
}

</style>

</head>

<body>

<nav class="navbar navbar-expand-lg custom-navbar shadow-sm">

<div class="container">

<!-- Logo -->
<a class="navbar-brand" href="#">
Inventaris Aset
</a>

<!-- Menu -->
<div class="d-flex align-items-center">

<a href="{{ route('dashboard') }}"
class="nav-link-custom {{ request()->routeIs('dashboard') ? 'nav-active' : '' }}">

Dashboard

</a>

<a href="{{ route('asets.index') }}"
class="nav-link-custom {{ request()->routeIs('asets.*') ? 'nav-active' : '' }}">

Data Aset

</a>

</div>

<!-- User -->
<div class="d-flex align-items-center">

<span class="user-text">
{{ Auth::user()->name }}
</span>

<form method="POST"
action="{{ route('logout') }}">

@csrf

<button class="btn btn-outline-light btn-sm">
Logout
</button>

</form>

</div>

</div>

</nav>

<div class="container mt-4">

@yield('content')

</div>

</body>

</html>