<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Divisi;
use Illuminate\Http\Request;

class DivisiAPIController extends Controller
{
    public function get_all()
    {
        $division = Divisi::all();
        return response()->json([
            'division'=>$division,
        ]);
    }
}
