<?php

namespace App\Http\Controllers;

use App\Models\Lantai;
use Illuminate\Http\Request;

class LantaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $floor = Lantai::all();
        return view('pages/lantai/index')->with([
            'floor' => $floor,
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
                'lantai' => 'required',
            ],
            [
                'lantai.required' => 'Lantai tidak boleh kosong',
            ],
        );

        $floor = [
            'floor' => $request->input('lantai'),
        ];

        Lantai::create($floor);

        // return back('company.index')->with('message', 'Data Type Sudah ditambahkan');
        return redirect()
            ->route('lantai.index')
            ->with('message', 'Data Kelas Sudah ditambahkan');
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
                'lantai' => 'required',
            ],
            [
                'lantai.required' => 'Lantai tidak boleh kosong',
            ],
        );

        $data = [
            'floor' => $request->input('lantai'),
        ];

        $floor = Lantai::findOrFail($id);

        if ($floor) {
            $floor->update($data);
            return redirect()
                ->route('lantai.index')
                ->with('message', 'Data Lantai Sudah diupdate');
        } else {
            return redirect()
                ->route('lantai.index')
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
        $floor = Lantai::findOrFail($id);
        $floor->delete();
        return back()->with('message_delete','Data Lantai Sudah dihapus');
    }
}
