<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Merk;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Kategori::all();
        $merk = Merk::all();
        return view('pages/kategori/index')->with([
            'category' => $category,
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
                'id_merk' => 'required',
                'category' => 'required',
            ],
            [
                'id_merk.required' => 'Merk tidak boleh kosong',
                'category.required' => 'Kategory tidak boleh kosong',
            ],
        );

        $category = [
            'id_merk' => $request->input('id_merk'),
            'category' => $request->input('category'),
        ];

        Kategori::create($category);

        // return back('company.index')->with('message', 'Data Type Sudah ditambahkan');
        return redirect()
            ->route('kategori.index')
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
                'categorys' => 'required',
                'id_merks' => 'required',
            ],
            [
                'categorys.required' => 'Kategori tidak boleh kosong',
                'id_merks.required' => 'Merk tidak boleh kosong',
            ],
        );

        $data = [
            'id_merk' => $request->input('id_merks'),
            'category' => $request->input('categorys'),
        ];

        $category = Kategori::findOrFail($id);

        if ($category) {
            $category->update($data);
            return redirect()
                ->route('kategori.index')
                ->with('message', 'Data Kategori Sudah diupdate');
        } else {
            return redirect()
                ->route('kategori.index')
                ->with('error', 'Data Kategori tidak ditemukan');
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
        $category = Kategori::findOrFail($id);
        $category->delete();
        return back()->with('message_delete','Data Kategori Sudah dihapus');
    }
}
