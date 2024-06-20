<?php

namespace App\Http\Controllers;

use App\Models\DetailKel;
use App\Models\Jenis;
use App\Models\Koleksi;
use App\Models\Sumber;
use Illuminate\Http\Request;

class KelompokKKNController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('perpustakaan/kkn/index')->with([]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kode_koleksi = Koleksi::createCode();
        $jenis = Jenis::all();
        $sumber = Sumber::all();
        return view('perpustakaan/kkn/create', compact('kode_koleksi'))->with([
            'jenis' => $jenis,
            'sumber' => $sumber,
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
                'kode_koleksi' => 'required|string|max:255',
                'judul_buku' => 'required|string|max:255',
                'kode_jenis' => 'required|string|max:255',
                'tahun_terbit' => 'required|integer|min:1000|max:' . date('Y'),
                'tgl_masuk' => 'required|date',
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'kode_sumber' => 'required|string|max:255',
            ],
            [
                'kode_koleksi.required' => 'Kode Koleksi tidak boleh kosong',
                'judul_buku.required' => 'Judul Buku tidak boleh kosong',
                'kode_jenis.required' => 'Kode Jenis tidak boleh kosong',
                'tahun_terbit.required' => 'Tahun Terbit tidak boleh kosong',
                'tgl_masuk.required' => 'Tanggal Masuk tidak boleh kosong',
                'foto.required' => 'Foto tidak boleh kosong',
                'kode_sumber.required' => 'Kode Sumber tidak boleh kosong',
            ]
        );

        try {
            $kodek = $request->input('kode_koleksi');

            if ($request->hasFile('foto')) {
                $fotoFile = $request->file('foto');
                $fotoFileName = $kodek . '.' . $fotoFile->extension();
                $fotoFilePath = $fotoFile->move(public_path('uploads'), $fotoFileName);
                $fotoFilePath = $fotoFileName;
            } else {
                return redirect()->back()->with('error', 'Foto tidak ditemukan');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error uploading file: ' . $e->getMessage());
        }

        $koleksi = [
            'kode_koleksi' => $request->input('kode_koleksi'),
            'judul_buku' => $request->input('judul_buku'),
            'pengarang' => $request->input('pengarang'),
            'kode_jenis' => $request->input('kode_jenis'),
            'pengarang' => $request->input('nama_kelompok'),
            'tahun_terbit' => $request->input('tahun_terbit'),
            'tgl_masuk' => $request->input('tgl_masuk'),
            'foto' => $fotoFilePath,
            'ketersediaan' => 'AVAILABLE',
            'kode_sumber' => $request->input('kode_sumber'),
        ];

        Koleksi::create($koleksi);

        $code = $request->input('kode_koleksi');
        $students = $request->input('student', []);
        $nims = $request->input('nim', []);
        $jurusans = $request->input('major', []);
        $classess = $request->input('classes', []);

        foreach ($students as $index => $student) {
            $dataa = [
                'kode_koleksi' => $code,
                'nim' => $nims[$index],
                'nama' => $student,
                'jurusan' => $jurusans[$index],
                'kelas' => $classess[$index],
                'created_at' => now(),
                'updated_at' => now(),
            ];
            DetailKel::create($dataa);
        }

        return redirect()
            ->route('kelompok_kkn.index')
            ->with('message', 'Data KKN Sudah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $koleksi = Koleksi::join('jenis', 'jenis.kode_jenis', '=', 'koleksi.kode_jenis')
            ->join('sumber', 'sumber.kode_sumber', '=', 'koleksi.kode_sumber')
            ->where('koleksi.id', $id)
            ->select('koleksi.*', 'koleksi.id as id_koleksi', 'jenis.*', 'sumber.*')
            ->first();
        $detail = Koleksi::join('detail_kelompok', 'detail_kelompok.kode_koleksi', '=', 'koleksi.kode_koleksi')
            ->where('koleksi.id', $id)
            ->select('koleksi.*', 'koleksi.id as id_koleksi', 'detail_kelompok.*')
            ->get();
        $jenis = Jenis::all();
        $sumber = Sumber::all();
        return view('perpustakaan/kkn/show')->with([
            'koleksi' => $koleksi,
            'jenis' => $jenis,
            'sumber' => $sumber,
            'detail' => $detail,
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
        $koleksi = Koleksi::join('jenis', 'jenis.kode_jenis', '=', 'koleksi.kode_jenis')
            ->join('sumber', 'sumber.kode_sumber', '=', 'koleksi.kode_sumber')
            ->where('koleksi.id', $id)
            ->select('koleksi.*', 'koleksi.id as id_koleksi', 'jenis.*', 'sumber.*')
            ->first();
        $jenis = Jenis::all();
        $sumber = Sumber::all();
        return view('perpustakaan/kkn/edit')->with([
            'koleksi' => $koleksi,
            'jenis' => $jenis,
            'sumber' => $sumber,
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
