<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Detail;
use App\Models\Divisi;
use App\Models\Kategori;
use App\Models\Lantai;
use App\Models\Merk;
use App\Models\Ruang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $inventory_item = Barang::all();
        // return view('pages/barang/index')->with([
        //     'inventory_item' => $inventory_item,
        // ]);

        $detail = Detail::all();
        return view('pages/barang/index')->with([
            'inventory_item_detail' => $detail,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kode_barang = Barang::createCode();
        $inventory_item = Barang::all();
        $floor = Lantai::all();
        $room = Ruang::all();
        $category = Kategori::all();
        $division = Divisi::all();
        $merk = Merk::all();
        return view('pages/barang/add', compact('kode_barang'))->with([
            'inventory_item' => $inventory_item,
            'floor' => $floor,
            'room' => $room,
            'category' => $category,
            'division' => $division,
            'merk' => $merk,
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
                'kodes' => 'required',
                'barang' => 'required',
                'id_floor' => 'required',
                'id_room' => 'required',
                'id_category' => 'required',
                'id_divisi' => 'required',
                'id_merk' => 'required',
                'informasi' => 'required',
                'harga' => 'required',
                'penyusutan' => 'required',
            ],
            [
                'kodes.required' => 'Kode tidak boleh kosong',
                'barang.required' => 'Barang tidak boleh kosong',
                'id_floor.required' => 'Lantai tidak boleh kosong',
                'id_room.required' => 'Ruang tidak boleh kosong',
                'id_category.required' => 'Kategori tidak boleh kosong',
                'id_divisi.required' => 'Divisi tidak boleh kosong',
                'id_merk.required' => 'Divisi tidak boleh kosong',
                'informasi.required' => 'Informasi tidak boleh kosong',
                'harga.required' => 'Harga tidak boleh kosong',
                'penyusutan.required' => 'Penyusutan tidak boleh kosong',
            ],
        );

        $barang = [
            'code' => $request->input('kodes'),
            'name' => $request->input('barang'),
            'id_floor' => $request->input('id_floor'),
            'id_room' => $request->input('id_room'),
            'id_category' => $request->input('id_category'),
            'id_division' => $request->input('id_divisi'),
            'id_merk' => $request->input('id_merk'),
            'information' => $request->input('informasi'),
            'price' => $request->input('harga'),
            'cost_of_depreciation' => $request->input('penyusutan'),
            'invoice' => $request->input('faktur'),
            'id_user' => $request->user()->id,
        ];

        Barang::create($barang);

        $jumlah = $request->input('jumlah');
        $kode = $request->input('kode');
        $merek = $request->input('id_merk');
        $ruang = $request->input('id_room');
        $divisi = $request->input('id_divisi');


        $index = 0;
        $no = 1;
        $n = 1;
        for ($x = 1; $x <= $jumlah; $x++) {
            $a = $x;
            $data[] = [
                'code' => $request->input('kode'),
                'id_item' => $kode . '/' . $a . '/Mrk-' . $merek . '/Rng-' . $ruang . '/Dv-' . $divisi,
                'status' => "BAIK",
                'availability' => "AVAILABLE",
            ];

            Detail::create($data[$index]); // Menggunakan $index sebagai kunci untuk mengakses data yang sesuai
            $index++;
        }


        // return back('company.index')->with('message', 'Data Type Sudah ditambahkan');
        return redirect()
            ->route('barang.index')
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
