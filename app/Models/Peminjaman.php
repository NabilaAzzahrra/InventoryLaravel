<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_item',
        'name',
        'classes',
        'no_hp',
        'needs',
        'inventory_loan_letter',
    ];

    protected $table = 'inventory_lending';

    public function detail()
    {
        return $this->belongsTo(Detail::class, 'id_item', 'id');
    }
}
