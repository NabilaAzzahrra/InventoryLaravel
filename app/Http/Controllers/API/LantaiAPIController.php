<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Lantai;
use Illuminate\Http\Request;

class LantaiAPIController extends Controller
{
    public function get_all()
    {
        $floor = Lantai::all();
        return response()->json([
            'floor'=>$floor,
        ]);
    }
}
