<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'id_floor',
        'id_room',
        'id_category',
        'id_division',
        'information',
        'invoice',
        'picture',
        'price',
        'cost_of_depreciation',
        'id_user',
    ];

    protected $table = 'inventory_item';

    public static function createCode()
    {
        $latestCode = self::orderBy('code', 'desc')->value('code');
        $latestCodeNumber = intval(substr($latestCode, 2)); 
        $nextCodeNumber = $latestCodeNumber ? $latestCodeNumber + 1 : 1; 
        $formattedCodeNumber = sprintf("%05d", $nextCodeNumber); 
        return 'BR' . $formattedCodeNumber;
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

    public function detail()
    {
        return $this->hasMany(Detail::class, 'code');
    }
}
