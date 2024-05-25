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
        $validated = $request->validate(
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
                'faktur' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'picture' => 'required|file|mimes:jpg,jpeg,png|max:2048',
                'jumlah' => 'required|integer|min:1'
            ],
            [
                'kodes.required' => 'Kode tidak boleh kosong',
                'barang.required' => 'Barang tidak boleh kosong',
                'id_floor.required' => 'Lantai tidak boleh kosong',
                'id_room.required' => 'Ruang tidak boleh kosong',
                'id_category.required' => 'Kategori tidak boleh kosong',
                'id_divisi.required' => 'Divisi tidak boleh kosong',
                'id_merk.required' => 'Merk tidak boleh kosong',
                'informasi.required' => 'Informasi tidak boleh kosong',
                'harga.required' => 'Harga tidak boleh kosong',
                'penyusutan.required' => 'Penyusutan tidak boleh kosong',
                'faktur.required' => 'Faktur tidak boleh kosong',
                'faktur.file' => 'Faktur harus berupa file',
                'faktur.mimes' => 'Faktur harus berupa file dengan tipe: jpg, jpeg, png, pdf',
                'faktur.max' => 'Faktur tidak boleh lebih besar dari 2MB',
                'picture.required' => 'Picture tidak boleh kosong',
                'picture.file' => 'Picture harus berupa file',
                'picture.mimes' => 'Picture harus berupa file dengan tipe: jpg, jpeg, png',
                'picture.max' => 'Picture tidak boleh lebih besar dari 2MB',
                'jumlah.required' => 'Jumlah tidak boleh kosong',
                'jumlah.integer' => 'Jumlah harus berupa angka',
                'jumlah.min' => 'Jumlah minimal 1',
            ]
        );

        try {
            $kodes = $request->input('kodes');
            $barangs = $request->input('barang');

            $fakturFile = $request->file('faktur');
            $pictureFile = $request->file('picture');

            $fakturFileName = $kodes . '.' . $fakturFile->extension();
            $pictureFileName = "{$kodes}-{$barangs}.{$pictureFile->extension()}";

            // Move the files to the appropriate directories
            $fakturFilePath = $fakturFile->move(public_path('uploads'), $fakturFileName);
            $pictureFilePath = $pictureFile->move(public_path('picture'), $pictureFileName);

            // Save only the filenames in the database
            $fakturFilePath = $fakturFileName;
            $pictureFilePath = $pictureFileName;
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Error uploading file: ' . $e->getMessage());
        }

        $barangData = [
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
            'invoice' => $fakturFilePath,
            'picture' => $pictureFilePath,
            'id_user' => $request->user()->id,
        ];

        try {
            $barang = Barang::create($barangData);
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Error saving Barang: ' . $e->getMessage());
        }

        $jumlah = $request->input('jumlah');
        $kode = $request->input('kode');
        $merek = $request->input('id_merk');
        $ruang = $request->input('id_room');
        $divisi = $request->input('id_divisi');

        $data = [];
        for ($x = 1; $x <= $jumlah; $x++) {
            $a = $x;
            $data[] = [
                'code' => $request->input('kode'),
                'id_item' => $kode . '/' . $a . '/Mrk-' . $merek . '/Rng-' . $ruang . '/Dv-' . $divisi,
                'status' => "BAIK",
                'availability' => "AVAILABLE",
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        try {
            Detail::insert($data);
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Error saving Detail: ' . $e->getMessage());
        }

        return redirect()
            ->route('barang.index')
            ->with('message', 'Data Barang sudah ditambahkan');
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
        $detail = Detail::join('inventory_item', 'inventory_item_detail.code', '=', 'inventory_item.code')
            ->join('floor', 'inventory_item.id_floor', '=', 'floor.id')
            ->join('room', 'inventory_item.id_room', '=', 'room.id')
            ->join('category', 'inventory_item.id_category', '=', 'category.id')
            ->join('division', 'inventory_item.id_division', '=', 'division.id')
            ->where('inventory_item_detail.id', $id)
            ->select('inventory_item_detail.*', 'inventory_item.*','inventory_item_detail.id as id_inventory_item', 'floor.*', 'room.*', 'category.*', 'division.*')
            ->first();
        return view('pages/barang/detail')->with([
            'inventory_item_detail' => $detail,
        ]);
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
        if ($request->input('sts') == "RUSAK" || $request->input('sts') == "PINJAM") {
            $data = [
                'status' => $request->input('sts'),
                'availability' => 'NOT AVAILABLE',
            ];
        } else {
            $data = [
                'status' => $request->input('sts'),
                'availability' => 'AVAILABLE',
            ];
        }



        $status = Detail::findOrFail($id);

        if ($status) {
            $status->update($data);
            return redirect()
                ->route('barang.index')
                ->with('message', 'Data Status Sudah diupdate');
        } else {
            return redirect()
                ->route('barang.index')
                ->with('error', 'Data Status tidak ditemukan');
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
        $detail = Detail::findOrFail($id);

        $codeCount = Detail::where('code', $detail->code)->count();

        if ($codeCount > 1) {
            $detail->delete();
        } else {
            $detail->delete();

            $barang = Barang::where('code', $detail->code)->first();
            if ($barang) {
                $barang->delete();
            }
        }

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
