<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use Illuminate\Http\Request;

class DivisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $division = Divisi::all();
        return view('pages/divisi/index')->with([
            'division' => $division,
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
                'divisi' => 'required',
            ],
            [
                'divisi.required' => 'Divisi tidak boleh kosong',
            ],
        );

        $division = [
            'division' => $request->input('divisi'),
        ];

        Divisi::create($division);

        // return back('company.index')->with('message', 'Data Type Sudah ditambahkan');
        return redirect()
            ->route('divisi.index')
            ->with('message', 'Data Divisi Sudah ditambahkan');
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
                'divisi' => 'required',
            ],
            [
                'divisi.required' => 'Divisi tidak boleh kosong',
            ],
        );

        $data = [
            'division' => $request->input('divisi'),
        ];

        $division = Divisi::findOrFail($id);

        if ($division) {
            $division->update($data);
            return redirect()
                ->route('divisi.index')
                ->with('message', 'Data divisi Sudah diupdate');
        } else {
            return redirect()
                ->route('divisi.index')
                ->with('error', 'Data divisi tidak ditemukan');
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
        $division = Divisi::findOrFail($id);
        $division->delete();
        return back()->with('message_delete','Data divisi Sudah dihapus');
    }
}
