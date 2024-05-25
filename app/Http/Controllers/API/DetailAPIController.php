<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Detail;
use Illuminate\Http\Request;

class DetailAPIController extends Controller
{
    public function get_all()
    {
        $bmasukQuery = Detail::query();

        $dateStart = request('fromDate', 'all');
        $dateEnd = request('toDate', 'all');
        $barang = request('barang', 'all');

        if ($dateStart !== 'all' && $dateEnd !== 'all') {
            $bmasukQuery->whereBetween('created_at', [$dateStart, $dateEnd]);
        }

        if ($barang !== 'all') {
            if ($barang == '1') {
                $bmasukQuery->where('status', 'BAIK')
                    ->where('availability', 'AVAILABLE');
            } elseif ($barang == '0') {
                $bmasukQuery->where(function ($query) {
                    $query->where('status', '!=', 'BAIK')
                        ->orWhere('availability', '!=', 'AVAILABLE');
                });
            }
        }

        $bmasukItem = $bmasukQuery->with(['barang', 'barang.kategori', 'barang.kategori.merk', 'barang.room'])->get();

        return response()->json(['inventory_item_detail' => $bmasukItem]);
    }
}
