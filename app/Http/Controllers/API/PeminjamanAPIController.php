<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanAPIController extends Controller
{
    public function get_all()
    {
        $peminjaman = Peminjaman::with(['detail', 'detail.barang'])->get();
        return response()->json([
            'peminjaman'=>$peminjaman,
        ]);
    }
}
