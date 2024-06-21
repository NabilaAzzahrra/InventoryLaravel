<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Koleksi;
use Illuminate\Http\Request;

class KoleksiAPIController extends Controller
{
    public function get_print()
    {
        $koleksiQuery = Koleksi::query();

        $dateStart = request('fromDate', 'all');
        $dateEnd = request('toDate', 'all');

        if ($dateStart !== 'all' && $dateEnd !== 'all') {
            $koleksiQuery->whereBetween('tgl_masuk', [$dateStart, $dateEnd]);
        }

        $koleksi = $koleksiQuery->with(['jenis','sumber'])->where('kode_jenis','JS00004')->get();

        return response()->json([
            'koleksi'=>$koleksi,
        ]);

    }

    public function get_all()
    {
        $koleksiQuery = Koleksi::query();

        $dateStart = request('fromDate', 'all');
        $dateEnd = request('toDate', 'all');

        $jenis = request('jenis', 'all');
        $sumber = request('sumber', 'all');
        $tahun = request('tahun', 'all');

        if ($dateStart !== 'all' && $dateEnd !== 'all') {
            $koleksiQuery->whereBetween('tgl_masuk', [$dateStart, $dateEnd]);
        }

        if ($jenis !== 'all') {
            $koleksiQuery->where('kode_jenis', $jenis);
        }

        if ($sumber !== 'all') {
            $koleksiQuery->where('kode_sumber', $sumber);
        }

        if ($tahun !== 'all') {
            $koleksiQuery->where('tahun_terbit', $tahun);
        }

        $koleksi = $koleksiQuery->with(['jenis','sumber'])->where('ketersediaan','AVAILABLE')->get();

        return response()->json([
            'koleksi'=>$koleksi,
        ]);

    }

    public function get_keluar()
    {
        $koleksiQuery = Koleksi::query();

        $dateStart = request('fromDate', 'all');
        $dateEnd = request('toDate', 'all');

        if ($dateStart !== 'all' && $dateEnd !== 'all') {
            $koleksiQuery->whereBetween('tgl_keluar', [$dateStart, $dateEnd]);
        }

        $koleksi = $koleksiQuery->with(['jenis','sumber'])->where('ketersediaan','NOT AVAILABLE')->get();

        return response()->json([
            'koleksi'=>$koleksi,
        ]);
    }

    public function get_kkn()
    {
        $koleksi = Koleksi::with(['jenis','sumber'])->where('kode_jenis', 'JS00002')->get();

        return response()->json([
            'koleksi'=>$koleksi,
        ]);
    }
}
