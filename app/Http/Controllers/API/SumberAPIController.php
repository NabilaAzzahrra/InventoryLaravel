<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Sumber;
use Illuminate\Http\Request;

class SumberAPIController extends Controller
{
    public function get_all()
    {
        $sumber = Sumber::all();
        return response()->json([
            'sumber'=>$sumber,
        ]);
    }
}
