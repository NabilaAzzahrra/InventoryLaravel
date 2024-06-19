<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_jenis',
        'jenis'
    ];

    protected $table = 'jenis';

    public static function createCode()
    {
        $latestCode = self::orderBy('kode_jenis', 'desc')->value('kode_jenis');
        $latestCodeNumber = intval(substr($latestCode, 2));
        $nextCodeNumber = $latestCodeNumber ? $latestCodeNumber + 1 : 1;
        $formattedCodeNumber = sprintf("%05d", $nextCodeNumber);
        return 'JS' . $formattedCodeNumber;
    }

    public function koleksi()
    {
        return $this->hasMany(Koleksi::class, 'kode_jenis');
    }
}
