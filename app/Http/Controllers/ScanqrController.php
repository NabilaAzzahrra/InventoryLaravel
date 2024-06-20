<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class ScanqrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $floor = Lantai::all();
        return view('pages/scan/success')->with([
            // 'floor' => $floor,
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
                'idItem' => 'required',
                'name' => 'required',
                'classes' => 'required',
                'no_hp' => 'required',
                'keperluan' => 'required',
                'file' => 'required|file'
            ],
            [
                'idItem.required' => 'Barang tidak boleh kosong',
                'name.required' => 'Nama tidak boleh kosong',
                'classes.required' => 'Kelas tidak boleh kosong',
                'no_hp.required' => 'No Hp tidak boleh kosong',
                'keperluan.required' => 'Keperluan tidak boleh kosong',
                'file.required' => 'File surat peminjaman tidak boleh kosong'
            ],
        );

        $kode = $request->input('name');
        $idItem = $request->input('idItem');

        $letterFile = $request->file('file');
        $letterFileName = "{$kode}-{$idItem}.{$letterFile->extension()}";
        $letterFilePath = $letterFile->move(public_path('surat'), $letterFileName);
        $letterFilePath = $letterFileName;

        $peminjaman = [
            'id_item' => $request->input('idItem'),
            'name' => $request->input('name'),
            'classes' => $request->input('classes'),
            'no_hp' => $request->input('no_hp'),
            'needs' => $request->input('keperluan'),
            'inventory_loan_letter' => $letterFilePath,
            'item_status' => 'BORROWED',
        ];

        Peminjaman::create($peminjaman);

        $id = $request->input('idItem');

        $data = [
            'status' => 'PINJAM',
            'availability' => 'NOT AVAILABLE',
        ];

        $detailPinjam = Detail::findOrFail($id);
        $detailPinjam->update($data);

        return back()->with('message_delete', 'Data Lantai Sudah dihapus');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail = Detail::join('inventory_item', 'inventory_item_detail.code', '=', 'inventory_item.code')
            ->join('floor', 'inventory_item.id_floor', '=', 'floor.id')
            ->join('room', 'inventory_item.id_room', '=', 'room.id')
            ->join('category', 'inventory_item.id_category', '=', 'category.id')
            ->join('division', 'inventory_item.id_division', '=', 'division.id')
            ->where('inventory_item_detail.id', $id)
            ->select('inventory_item_detail.*', 'inventory_item.*', 'inventory_item_detail.id as id_inventory_item', 'floor.*', 'room.*', 'category.*', 'division.*')
            ->first();
        $inventory_landing = Peminjaman::where('inventory_lending.id_item', $id)
            ->where('item_status', 'BORROWED')
            ->first();
        return view('pages/scan/detail_scan')->with([
            'inventory_item_detail' => $detail,
            'inventory_landing' => $inventory_landing,
        ]);
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
        $status = $request->input('ItemStatus');

        $data = [
            'status' => "BAIK",
            'availability' => "AVAILABLE",
        ];

        $datas = [
            'item_status' => "RETURNED",
        ];

        $detail = Detail::findOrFail($id);

        $pinjam = Peminjaman::where('id_item', $id)
            ->where('item_status', $status)
            ->firstOrFail();

        $detail->update($data);
        $pinjam->update($datas);

        return back()->with('message_delete', 'Data Lantai Sudah dihapus');
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
