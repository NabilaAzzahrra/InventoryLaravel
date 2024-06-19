<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kode_jurusan = Jurusan::createCode();
        return view('perpustakaan/jurusan/index', compact('kode_jurusan'))->with([]);
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
                'jurusan' => 'required',
            ],
            [
                'jurusan.required' => 'Merk tidak boleh kosong',
            ],
        );

        $jurusan = [
            'kode_jurusan' => $request->input('kode_jurusan'),
            'jurusan' => $request->input('jurusan'),
        ];

        Jurusan::create($jurusan);

        return redirect()->back()->with('success', 'Data Jurusan berhasil ditambahkan.');
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
                'jurusan' => 'required',
            ],
            [
                'jurusan.required' => 'Sumber tidak boleh kosong',
            ],
        );

        $data = [
            'kode_jurusan' => $request->input('kode_jurusan'),
            'jurusan' => $request->input('jurusan'),
        ];

        $jurusan = Jurusan::findOrFail($id);
        $jurusan->update($data);

        return redirect()
            ->route('jurusan.index')
            ->with('message', 'Data Jurusan Sudah diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        $jurusan->delete();
        return back()->with('message_delete','Data Jurusan Sudah dihapus');
    }
}
