<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Jenis;
use Illuminate\Http\Request;

class JenisAPIController extends Controller
{
    public function get_all()
    {
        $jenis = Jenis::all();
        return response()->json([
            'jenis'=>$jenis,
        ]);
    }
}
