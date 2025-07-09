<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $table = 'penjualan';
    protected $fillable = [
        'tanggal', 'id_makanan', 'id_minuman', 'id_user', 'jumlah', 'total_harga', 'foto', 'nama_pemesan', 'alamat', 'no_hp', 'status'
    ];
    public $timestamps = false;

    public function makanan()
    {
        return $this->belongsTo(Makanan::class, 'id_makanan');
    }

    public function minuman()
    {
        return $this->belongsTo(\App\Models\Minuman::class, 'id_minuman');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'id_user', 'id_user');
    }
}
