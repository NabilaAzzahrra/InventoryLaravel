<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use App\Models\Koleksi;
use App\Models\Sumber;
use Illuminate\Http\Request;

class PrintKoleksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $koleksi = Koleksi::all();
        return view('perpustakaan/print/index')->with([
            'koleksi' => $koleksi
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
        $user_ids = $request->input('user_id');
        if (empty($user_ids)) {
            return redirect()->back()->with('error', 'Pilih dulu');
        }

        $result = Koleksi::join('Jenis', 'jenis.kode_jenis', '=', 'koleksi.kode_jenis')
            ->join('sumber', 'sumber.kode_sumber', '=', 'koleksi.kode_sumber')
            ->whereIn('koleksi.id', $user_ids)
            ->select('koleksi.*', 'koleksi.id as id_koleksi', 'jenis.*', 'sumber.*')
            ->get();

        if ($result->isEmpty()) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        return view('perpustakaan/print/cetak')->with([
            'stu_data' => $result,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $koleksi = Koleksi::join('jenis', 'jenis.kode_jenis', '=', 'koleksi.kode_jenis')
            ->join('sumber', 'sumber.kode_sumber', '=', 'koleksi.kode_sumber')
            ->where('koleksi.kode_koleksi', $id)
            ->select('koleksi.*', 'koleksi.id as id_koleksi', 'jenis.*', 'sumber.*')
            ->first();
        $jenis = Jenis::all();
        $sumber = Sumber::all();
        return view('perpustakaan/print/detail_scan')->with([
            'koleksi' => $koleksi,
            'jenis' => $jenis,
            'sumber' => $sumber,
        ]);
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
