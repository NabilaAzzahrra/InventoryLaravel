<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Koleksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_koleksi',
        'judul_buku',
        'pengarang',
        'kode_jenis',
        'penerbit',
        'tahun_terbit',
        'tgl_masuk',
        'foto',
        'kode_sumber',
        'ketersediaan',
        'tgl_keluar',
    ];

    protected $table = 'koleksi';

    public static function createCode()
    {
        $latestCode = self::orderBy('kode_koleksi', 'desc')->value('kode_koleksi');
        $latestCodeNumber = intval(substr($latestCode, 2));
        $nextCodeNumber = $latestCodeNumber ? $latestCodeNumber + 1 : 1;
        $formattedCodeNumber = sprintf("%05d", $nextCodeNumber);
        return 'KL' . $formattedCodeNumber;
    }

    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'kode_jenis', 'kode_jenis');
    }

    public function sumber()
    {
        return $this->belongsTo(Sumber::class, 'kode_sumber', 'kode_sumber');
    }
}
