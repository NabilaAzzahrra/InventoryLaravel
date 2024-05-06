<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangAPIController extends Controller
{
    public function get_all()
    {
        $inventory_item = Barang::with(['kategori','kategori.merk', 'room'])->get();
        return response()->json([
            'inventory_item'=>$inventory_item,
        ]);
    }
}
