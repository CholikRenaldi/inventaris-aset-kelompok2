<!DOCTYPE html>
<html>
<head>

<title>Laporan Aset</title>

<style>

body{
    font-family:Arial;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
}

th, td{
    border:1px solid black;
    padding:8px;
    text-align:center;
}

th{
    background:#dddddd;
}

h2{
    text-align:center;
}

</style>

</head>

<body>

<h2>
Laporan Data Inventaris Aset
</h2>

<table>

<tr>

<th>No</th>
<th>Kode</th>
<th>Nama</th>
<th>Kategori</th>
<th>Jumlah</th>
<th>Kondisi</th>

</tr>

@foreach($data as $item)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $item->kode_barang }}</td>

<td>{{ $item->nama_barang }}</td>

<td>
{{ $item->kategori->nama_kategori ?? '-' }}
</td>

<td>{{ $item->jumlah }}</td>

<td>{{ $item->kondisi }}</td>

</tr>

@endforeach

</table>

</body>
</html>