<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    public function asets()
{
    return $this->hasMany(Aset::class);
}
}
