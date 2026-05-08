<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class barang extends Model
{
    use HasFactory;
    protected $table = "barang";
    protected $fillable = [
        'Kode_barang',
        'Nama_barang',
        'Kategori',
        'Jumlah_barang',
        'Kondisi_barang'   
         ];
        
    }

    