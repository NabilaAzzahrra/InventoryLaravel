<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use App\Models\Koleksi;
use App\Models\Sumber;
use Illuminate\Http\Request;

class KoleksiKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $koleksi = Koleksi::where('ketersediaan', 'AVAILABLE')->get();
        return view('perpustakaan/koleksi/koleksi_keluar')->with([
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
        $kode_koleksi = Koleksi::createCode();
        $jenis = Jenis::all();
        $sumber = Sumber::all();
        return view('perpustakaan/koleksi/koleksi_keluar_create', compact('kode_koleksi'))->with([
            'jenis' => $jenis,
            'sumber' => $sumber,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'kode_koleksi' => 'required|string|max:255',
                'judul_buku' => 'required|string|max:255',
                'pengarang' => 'required|string|max:255',
                'kode_jenis' => 'required|string|max:255',
                'penerbit' => 'required|string|max:255',
                'tahun_terbit' => 'required|integer|min:1000|max:' . date('Y'),
                'tgl_keluar' => 'required|date',
                'kode_sumber' => 'required|string|max:255',
            ],
            [
                'kode_koleksi.required' => 'Kode Koleksi tidak boleh kosong',
                'judul_buku.required' => 'Judul Buku tidak boleh kosong',
                'pengarang.required' => 'Pengarang tidak boleh kosong',
                'kode_jenis.required' => 'Kode Jenis tidak boleh kosong',
                'penerbit.required' => 'Penerbit tidak boleh kosong',
                'tahun_terbit.required' => 'Tahun Terbit tidak boleh kosong',
                'tgl_keluar.required' => 'Tanggal Keluar tidak boleh kosong',
                'kode_sumber.required' => 'Kode Sumber tidak boleh kosong',
            ]
        );

        $koleksi = [
            'kode_koleksi' => $request->input('kode_koleksi'),
            'judul_buku' => $request->input('judul_buku'),
            'pengarang' => $request->input('pengarang'),
            'kode_jenis' => $request->input('kode_jenis'),
            'penerbit' => $request->input('penerbit'),
            'tahun_terbit' => $request->input('tahun_terbit'),
            'tgl_keluar' => $request->input('tgl_keluar'),
            'ketersediaan' => 'NOT AVAILABLE',
            'kode_sumber' => $request->input('kode_sumber'),
        ];

        Koleksi::create($koleksi);

        return redirect()->route('input_koleksi_keluar.index')->with('message', 'Data Koleksi sudah ditambahkan');
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
