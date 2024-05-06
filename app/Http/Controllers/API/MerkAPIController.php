<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Merk;
use Illuminate\Http\Request;

class MerkAPIController extends Controller
{
    public function get_all()
    {
        $merk = Merk::all();
        return response()->json([
            'merk'=>$merk,
        ]);
    }
}
