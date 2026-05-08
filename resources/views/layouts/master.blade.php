<!DOCTYPE html>
<html>
<head>
    <title>Inventaris Aset</title>

<style>

body{
    font-family: 'Segoe UI', Arial, sans-serif;
    margin:0;
    background:#f5f6fa;
}


.navbar{
    background:#2c3e50;
    color:white;
    padding:15px 40px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.nav-left a{
    color:white;
    margin-right:20px;
    text-decoration:none;
    font-weight:500;
}

.nav-left a:hover{
    opacity:0.8;
}

.nav-right{
    display:flex;
    align-items:center;
    gap:10px;
}

.logout-btn{
    background:#e74c3c;
    border:none;
    color:white;
    padding:6px 10px;
    cursor:pointer;
    border-radius:4px;
}

.logout-btn:hover{
    background:#c0392b;
}


.container{
    width:85%;
    margin:auto;
    margin-top:30px;
}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
    box-shadow:0 2px 6px rgba(0,0,0,0.1);
    margin-bottom: 31px;
}

th,td{
    padding:10px;
    border-bottom:1px solid #eee;
    text-align:center;
}

th{
    background:#34495e;
    color:white;
}



.btn{
    padding:6px 12px;
    border:none;
    text-decoration:none;
    color:white;
    border-radius:4px;
    cursor:pointer;
}

.btn-add{ background:#27ae60; }
.btn-edit{ background:#2980b9; }
.btn-delete{ background:#e74c3c; }
.btn-cancel{ background:#7f8c8d; }

.btn:hover{
    opacity:0.9;
}

form input, form select{
    width:100%;
    padding:8px;
    margin-bottom:12px;
    border:1px solid #ccc;
    border-radius:4px;
}

.success{
    color:green;
    margin-bottom:10px;
}

.error{
    color:red;
}

</style>

</head>

<body>

<div class="navbar">

    <div class="nav-left">
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('asets.index') }}">Data Aset</a>
    </div>

    <div class="nav-right">
        <span>{{ Auth::user()->name }}</span>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="logout-btn">Logout</button>
        </form>
    </div>

</div>

<div class="container">
@yield('content')
</div>

</body>
</html>