<?php

namespace App\Http\Controllers;

use App\Models\Sumber;
use Illuminate\Http\Request;

class SumberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kode_sumber = Sumber::createCode();
        return view('perpustakaan/sumber/index', compact('kode_sumber'))->with([]);
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
                'sumber' => 'required',
            ],
            [
                'sumber.required' => 'Merk tidak boleh kosong',
            ],
        );

        $sumber = [
            'kode_sumber' => $request->input('kode_sumber'),
            'sumber' => $request->input('sumber'),
        ];

        Sumber::create($sumber);

        return redirect()->back()->with('success', 'Data Sumber Koleksi berhasil ditambahkan.');
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
                'sumber' => 'required',
            ],
            [
                'sumber.required' => 'Sumber tidak boleh kosong',
            ],
        );

        $data = [
            'kode_sumber' => $request->input('kode_sumber'),
            'sumber' => $request->input('sumber'),
        ];

        $sumber = Sumber::findOrFail($id);
        $sumber->update($data);

        return redirect()
            ->route('sumber.index')
            ->with('message', 'Data Sumber Koleksi Sudah diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sumber = Sumber::findOrFail($id);
        $sumber->delete();
        return back()->with('message_delete','Data Sumber Koleksi Sudah dihapus');
    }
}
