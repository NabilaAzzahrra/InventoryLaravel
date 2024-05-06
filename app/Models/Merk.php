<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merk extends Model
{
    use HasFactory;

    protected $fillable = [
        'merk',
    ];

    protected $table = 'merk';

    public function category()
    {
        return $this->hasMany(Kategori::class, 'id_merk');
    }
}
