<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kode_jenis = Jenis::createCode();
        return view('perpustakaan/jenis/index', compact('kode_jenis'))->with([]);
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
        $request->validate(
            [
                'jenis' => 'required',
            ],
            [
                'jenis.required' => 'Merk tidak boleh kosong',
            ],
        );

        $jenis = [
            'kode_jenis' => $request->input('kode_jenis'),
            'jenis' => $request->input('jenis'),
        ];

        Jenis::create($jenis);

        return redirect()->back()->with('success', 'Data Jenis Koleksi berhasil ditambahkan.');
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
        $request->validate(
            [
                'jenis' => 'required',
            ],
            [
                'jenis.required' => 'Jenis tidak boleh kosong',
            ],
        );

        $data = [
            'kode_jenis' => $request->input('kode_jenis'),
            'jenis' => $request->input('jenis'),
        ];

        $jenis = Jenis::findOrFail($id);
        $jenis->update($data);

        return redirect()
            ->route('jenis.index')
            ->with('message', 'Data Jenis Koleksi Sudah diupdate');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jenis = Jenis::findOrFail($id);
        $jenis->delete();
        return back()->with('message_delete','Data Jenis Koleksi Sudah dihapus');
    }
}
