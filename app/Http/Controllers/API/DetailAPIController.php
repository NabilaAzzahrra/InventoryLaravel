<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Detail;
use Illuminate\Http\Request;

class DetailAPIController extends Controller
{
    public function get_all()
    {
        $inventory_item_detail = Detail::with(['barang', 'barang.room', 'barang.kategori', 'barang.kategori.merk'])->get();
        return response()->json([
            'inventory_item_detail'=>$inventory_item_detail,
        ]);
    }
}
