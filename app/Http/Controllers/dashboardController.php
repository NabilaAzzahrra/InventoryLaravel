<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Kategori;
use App\Models\Koleksi;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detail = Detail::count();
        $category = Kategori::count();
        $detail_pinjam = Detail::where('status', 'PINJAM')->count();
        $detail_baik = Detail::where('status', 'BAIK')->count();
        $detail_maintenance = Detail::where('status', 'MAINTENANCE')->count();
        $detail_rusak = Detail::where('status', 'RUSAK')->count();
        $umum = Koleksi::where('kode_jenis', 'JS00004')->count();
        $ta = Koleksi::where('kode_jenis', 'JS00001')->count();
        $kkn = Koleksi::where('kode_jenis', 'JS00002')->count();
        $kki = Koleksi::where('kode_jenis', 'JS00003')->count();
        $hibah = Koleksi::where('kode_sumber', 'SM00001')->count();
        $beli = Koleksi::where('kode_sumber', 'SM00002')->count();
        return view('dashboard')->with([
            'inventory_item_detail' => $detail,
            'detail_pinjam' => $detail_pinjam,
            'detail_baik' => $detail_baik,
            'detail_maintenance' => $detail_maintenance,
            'detail_rusak' => $detail_rusak,
            'category' => $category,
            'umum' => $umum,
            'ta' => $ta,
            'kkn' => $kkn,
            'kki' => $kki,
            'hibah' => $hibah,
            'beli' => $beli,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
