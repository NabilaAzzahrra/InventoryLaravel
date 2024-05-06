<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriAPIController extends Controller
{
    public function get_all()
    {
        $category = Kategori::with(['merk'])->get();
        return response()->json([
            'category'=>$category,
        ]);
    }
}
