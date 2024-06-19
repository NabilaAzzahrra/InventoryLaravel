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
}
