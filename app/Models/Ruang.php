<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_floor',
        'room',
    ];

    protected $table = 'room';

    public function floor()
    {
        return $this->belongsTo(Lantai::class, 'id_floor', 'id');
    }

    public function barang()
    {
        return $this->hasMany(Barang::class, 'id_room');
    }
}
