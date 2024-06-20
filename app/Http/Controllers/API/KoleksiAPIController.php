<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Koleksi;
use Illuminate\Http\Request;

class KoleksiAPIController extends Controller
{
    public function get_all()
    {
        $koleksi = Koleksi::with(['jenis','sumber'])->where('ketersediaan','AVAILABLE')->get();
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
            $koleksiQuery->whereBetween('created_at', [$dateStart, $dateEnd]);
        }

        $koleksi = $koleksiQuery->with(['jenis','sumber'])->where('ketersediaan','NOT AVAILABLE')->get();

        return response()->json([
            'koleksi'=>$koleksi,
        ]);
    }
}
