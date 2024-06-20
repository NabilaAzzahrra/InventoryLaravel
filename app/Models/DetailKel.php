<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailKel extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode_koleksi',
        'id_item',
        'nim',
        'nama',
        'jurusan',
        'kelas'
    ];

    protected $table = 'detail_kelompok';
}
