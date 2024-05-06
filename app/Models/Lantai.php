<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lantai extends Model
{
    use HasFactory;

    protected $fillable = [
        'floor',
    ];

    protected $table = 'floor';

    public function room()
    {
        return $this->hasMany(Ruang::class, 'id_floor');
    }
}
