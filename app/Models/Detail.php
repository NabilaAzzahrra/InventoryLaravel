<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'id_item',
        'status',
        'availability',
        'qr',
    ];

    protected $table = 'inventory_item_detail';

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'code', 'code');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_category', 'id');
    }

    public function merk()
    {
        return $this->belongsTo(Merk::class, 'id_merk', 'id');
    }

    public function room()
    {
        return $this->belongsTo(Ruang::class, 'id_room', 'id');
    }
}
