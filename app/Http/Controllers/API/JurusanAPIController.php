<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanAPIController extends Controller
{
    public function get_all()
    {
        $jurusan = Jurusan::all();
        return response()->json([
            'jurusan'=>$jurusan,
        ]);
    }
}
