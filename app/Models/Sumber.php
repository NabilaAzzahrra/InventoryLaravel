<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sumber extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_sumber',
        'sumber'
    ];

    protected $table = 'sumber';

    public static function createCode()
    {
        $latestCode = self::orderBy('kode_sumber', 'desc')->value('kode_sumber');
        $latestCodeNumber = intval(substr($latestCode, 2));
        $nextCodeNumber = $latestCodeNumber ? $latestCodeNumber + 1 : 1;
        $formattedCodeNumber = sprintf("%05d", $nextCodeNumber);
        return 'SM' . $formattedCodeNumber;
    }

    public function koleksi()
    {
        return $this->hasMany(Koleksi::class, 'kode_sumber');
    }
}
