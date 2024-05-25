<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psy\Readline\Hoa\Console;

class PrintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detail = Detail::all();
        return view('pages/print/index')->with([
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
        $user_ids = $request->input('user_id');
        if (empty($user_ids)) {
            return redirect()->back()->with('error', 'Pilih dulu');
        }

        $result = Detail::join('inventory_item', 'inventory_item_detail.code', '=', 'inventory_item.code')
            ->join('floor', 'inventory_item.id_floor', '=', 'floor.id')
            ->join('room', 'inventory_item.id_room', '=', 'room.id')
            ->join('category', 'inventory_item.id_category', '=', 'category.id')
            ->join('division', 'inventory_item.id_division', '=', 'division.id')
            ->whereIn('inventory_item_detail.id', $user_ids)
            ->select('inventory_item.*','inventory_item_detail.id as id_inventory_item', 'inventory_item_detail.id_item as id_item', 'floor.*', 'room.*', 'category.*', 'division.*')
            ->get();

        if ($result->isEmpty()) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        return view('pages/print/cetak')->with([
            'stu_data' => $result,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = Detail::join('inventory_item', 'inventory_item_detail.code', '=', 'inventory_item.code')
            ->join('floor', 'inventory_item.id_floor', '=', 'floor.id')
            ->join('room', 'inventory_item.id_room', '=', 'room.id')
            ->join('category', 'inventory_item.id_category', '=', 'category.id')
            ->join('division', 'inventory_item.id_division', '=', 'division.id')
            ->where('inventory_item_detail.id', $id)
            ->select('inventory_item.*','inventory_item_detail.id as id_inventory_item', 'inventory_item_detail.id_item as id_item', 'floor.*', 'room.*', 'category.*', 'division.*')
            ->get();

        if ($result->isEmpty()) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        return view('pages/print/cetak_detail')->with([
            'stu_data' => $result,
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
