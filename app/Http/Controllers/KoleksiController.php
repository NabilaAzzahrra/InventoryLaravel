<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use App\Models\Koleksi;
use App\Models\Sumber;
use Illuminate\Http\Request;

class KoleksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $koleksi = Koleksi::where('ketersediaan', 'AVAILABLE')->get();
        return view('perpustakaan/koleksi/index')->with([
            'koleksi' => $koleksi
        ]);
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
        return view('perpustakaan/koleksi/create', compact('kode_koleksi'))->with([
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
                'pengarang' => 'required|string|max:255',
                'kode_jenis' => 'required|string|max:255',
                'penerbit' => 'required|string|max:255',
                'tahun_terbit' => 'required|integer|min:1000|max:' . date('Y'),
                'tgl_masuk' => 'required|date',
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'kode_sumber' => 'required|string|max:255',
            ],
            [
                'kode_koleksi.required' => 'Kode Koleksi tidak boleh kosong',
                'judul_buku.required' => 'Judul Buku tidak boleh kosong',
                'pengarang.required' => 'Pengarang tidak boleh kosong',
                'kode_jenis.required' => 'Kode Jenis tidak boleh kosong',
                'penerbit.required' => 'Penerbit tidak boleh kosong',
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
            'penerbit' => $request->input('penerbit'),
            'tahun_terbit' => $request->input('tahun_terbit'),
            'tgl_masuk' => $request->input('tgl_masuk'),
            'foto' => $fotoFilePath,
            'ketersediaan' => 'AVAILABLE',
            'kode_sumber' => $request->input('kode_sumber'),
        ];

        try {
            Koleksi::create($koleksi);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error saving Koleksi: ' . $e->getMessage());
        }

        return redirect()->route('koleksi.index')->with('message', 'Data Koleksi sudah ditambahkan');
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
        $jenis = Jenis::all();
        $sumber = Sumber::all();
        return view('perpustakaan/koleksi/show')->with([
            'koleksi' => $koleksi,
            'jenis' => $jenis,
            'sumber' => $sumber,
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
        return view('perpustakaan/koleksi/edit')->with([
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
        $request->validate([
            'kode_koleksi' => 'required|string|max:255',
            'judul_buku' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'kode_jenis' => 'required|string',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer',
            'tgl_masuk' => 'required|date',
            'kode_sumber' => 'required|string',
            // Validasi untuk foto tidak wajib, tapi jika ada input maka harus berupa file image
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $koleksi = Koleksi::find($id);

        if (!$koleksi) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        $koleksi->kode_koleksi = $request->input('kode_koleksi');
        $koleksi->judul_buku = $request->input('judul_buku');
        $koleksi->pengarang = $request->input('pengarang');
        $koleksi->kode_jenis = $request->input('kode_jenis');
        $koleksi->penerbit = $request->input('penerbit');
        $koleksi->tahun_terbit = $request->input('tahun_terbit');
        $koleksi->tgl_masuk = $request->input('tgl_masuk');
        $koleksi->kode_sumber = $request->input('kode_sumber');

        $ko = $request->input('kode_koleksi');
        // Jika ada file foto yang diunggah
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($koleksi->foto && file_exists(public_path('uploads/' . $koleksi->foto))) {
                unlink(public_path('uploads/' . $koleksi->foto));
            }

            $file = $request->file('foto');
            $filename = $ko . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);

            $koleksi->foto = $filename;
        }

        $koleksi->save();

        if ($request->input('ketersediaan') == 'AVAILABLE') {
            return redirect()->route('koleksi.index')->with('message', 'Data Koleksi sudah diperbarui');
        } else {
            return redirect()->route('input_koleksi_keluar.index')->with('message', 'Data Koleksi sudah diperbarui');
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
        $koleksi = Koleksi::findOrFail($id);
        $koleksi->delete();
        return back()->with('message_delete', 'Data Koleksi Sudah dihapus');
    }

    public function keluar(Request $request)
    {
        $request->validate([
            'user_id' => 'required|array',
            'tgl_keluar' => 'required|date',
        ]);

        $user_ids = $request->input('user_id');
        if (empty($user_ids)) {
            return redirect()->back()->with('error', 'Pilih dulu');
        }

        $tglKeluar = $request->input('tgl_keluar');
        $ketersediaan = 'NOT AVAILABLE';

        try {
            Koleksi::whereIn('id', $user_ids)->update(['tgl_keluar' => $tglKeluar, 'ketersediaan' => $ketersediaan]);

            return redirect()->route('koleksi.index')->with('message', 'Data Koleksi berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating Koleksi: ' . $e->getMessage());
        }
    }
}
