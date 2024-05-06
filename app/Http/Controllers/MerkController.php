<?php

namespace App\Http\Controllers;

use App\Models\Merk;
use Illuminate\Http\Request;

class MerkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $merk = Merk::all();
        return view('pages/merk/index')->with([
            'merk' => $merk,
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
        $request->validate(
            [
                'merk' => 'required',
            ],
            [
                'merk.required' => 'Merk tidak boleh kosong',
            ],
        );

        $merk = [
            'merk' => $request->input('merk'),
        ];

        Merk::create($merk);

        // return back('company.index')->with('message', 'Data Type Sudah ditambahkan');
        return redirect()
            ->route('merk.index')
            ->with('message', 'Data Merk Sudah ditambahkan');
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
                'merk' => 'required',
            ],
            [
                'merk.required' => 'Merk tidak boleh kosong',
            ],
        );

        $data = [
            'merk' => $request->input('merk'),
        ];

        $merk = Merk::findOrFail($id);

        if ($merk) {
            $merk->update($data);
            return redirect()
                ->route('merk.index')
                ->with('message', 'Data Lantai Sudah diupdate');
        } else {
            return redirect()
                ->route('merk.index')
                ->with('error', 'Data Lantai tidak ditemukan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $merk = Merk::findOrFail($id);
        $merk->delete();
        return back()->with('message_delete','Data Merk Sudah dihapus');
    }
}
