<?php

namespace App\Http\Controllers;

use App\Models\Lantai;
use App\Models\Ruang;
use Illuminate\Http\Request;

class RuangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $room = Ruang::all();
        $floor = Lantai::all();
        return view('pages/ruang/index')->with([
            'room' => $room,
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
                'ruang' => 'required',
            ],
            [
                'lantai.required' => 'Lantai tidak boleh kosong',
                'ruang.required' => 'Ruang tidak boleh kosong',
            ],
        );

        $room = [
            'id_floor' => $request->input('lantai'),
            'room' => $request->input('ruang'),
        ];

        Ruang::create($room);

        // return back('company.index')->with('message', 'Data Type Sudah ditambahkan');
        return redirect()
            ->route('ruang.index')
            ->with('message', 'Data Ruang Sudah ditambahkan');
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
                'ruang' => 'required',
                'id_floor' => 'required',
            ],
            [
                'ruang.required' => 'Lantai tidak boleh kosong',
                'id_floor.required' => 'Lantai tidak boleh kosong',
            ],
        );

        $data = [
            'id_floor' => $request->input('id_floor'),
            'room' => $request->input('ruang'),
        ];

        $room = Ruang::findOrFail($id);

        if ($room) {
            $room->update($data);
            return redirect()
                ->route('ruang.index')
                ->with('message', 'Data Ruang Sudah diupdate');
        } else {
            return redirect()
                ->route('ruang.index')
                ->with('error', 'Data Ruang tidak ditemukan');
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
        $room = Ruang::findOrFail($id);
        $room->delete();
        return back()->with('message_delete','Data Ruang Sudah dihapus');
    }
}
