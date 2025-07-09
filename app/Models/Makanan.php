<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Makanan extends Model
{
    protected $table = 'makanan';
    protected $fillable = [
        'nama', 'harga', 'kategori', 'deskripsi', 'foto', 'stok'
    ];
}
