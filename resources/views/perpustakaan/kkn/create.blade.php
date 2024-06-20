<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('KOLEKSI ') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">
                <div class="p-6 text-gray-900 flex gap-4 grid-cols-1">
                    <div
                        class="bg-white my-2 overflow-hidden shadow-lg w-full m-auto rounded-lg lg:rounded-lg md:rounded-lg">
                        <div class="p-4 text-gray-900 w-full">
                            <div class="bg-slate-100 shadow-2xl border-slate-900 border-xl p-4 rounded-lg ">
                                <div class="flex items-center justify-between">
                                    <h2>Tambah Data <span class="font-bold">Koleksi </span></h2>
                                </div>
                            </div>
                            <div class="flex justify-center">
                                <div class="p-12" style="width:100%">
                                    <form method="POST" action="{{ route('kelompok_kkn.store') }}"
                                        enctype="multipart/form-data">

                                        @csrf
                                        <div class="grid grid-cols-3 gap-5">
                                            <div class="mb-5 w-full">
                                                <label for="kode_koleksi"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode
                                                    Koleksi
                                                    <span class="text-red-500">*</span></label>
                                                <input type="text" id="kode_koleksi" name="kode_koleksi"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    placeholder="Masukan Kode...." value="{{ $kode_koleksi }}"
                                                    readonly />
                                                <span
                                                    class="text-sm m-l text-red-500">{{ $errors->first('kode_koleksi') }}</span>
                                            </div>
                                            <div class="mb-5 w-full">
                                                <label for="judul_buku"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul
                                                    Koleksi
                                                    <span class="text-red-500">*</span></label>
                                                <input type="text" id="judul_buku" name="judul_buku"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    placeholder="Masukan Judul Koleksi...." />
                                                <span
                                                    class="text-sm m-l text-red-500">{{ $errors->first('judul_buku') }}</span>
                                            </div>
                                            <div class="mb-5 w-full">
                                                <label for="lantai"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis
                                                    <span class="text-red-500">*</span></label>
                                                <select
                                                    class="js-example-placeholder-single js-states form-control w-[385px] m-4"
                                                    id="kode_jenis" name="kode_jenis"
                                                    data-placeholder="Pilih Jenis Koleksi">
                                                    <option value="">Pilih...</option>
                                                    @foreach ($jenis as $m)
                                                        <option value="{{ $m->kode_jenis }}">{{ $m->jenis }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span
                                                    class="text-sm m-l text-red-500">{{ $errors->first('kode_jenis') }}</span>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-3 gap-5">
                                            <div class="mb-5 w-full">
                                                <label for="tahun_terbit"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tahun
                                                    Angkatan
                                                    <span class="text-red-500">*</span></label>
                                                <input type="number" id="tahun_terbit" name="tahun_terbit"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    placeholder="Masukan Tahun Terbit...." />
                                                <span
                                                    class="text-sm m-l text-red-500">{{ $errors->first('tahun_terbit') }}</span>
                                            </div>
                                            <div class="mb-5 w-full">
                                                <label for="tgl_masuk"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal
                                                    Masuk
                                                    <span class="text-red-500">*</span></label>
                                                <input type="date" id="tgl_masuk" name="tgl_masuk"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    placeholder="Masukan Tanggal Masuk...." />
                                                <span
                                                    class="text-sm m-l text-red-500">{{ $errors->first('tgl_masuk') }}</span>
                                            </div>
                                            <div class="mb-5 w-full">
                                                <label for="foto"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto
                                                    <span class="text-red-500">*</span></label>
                                                <input
                                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                                    aria-describedby="user_avatar_help" id="foto" name="foto"
                                                    type="file">
                                                <span
                                                    class="text-sm m-l text-red-500">{{ $errors->first('foto') }}</span>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-3 gap-5">
                                            <div class="mb-5 w-full">
                                                <label for="lantai"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sumber
                                                    <span class="text-red-500">*</span></label>
                                                <select
                                                    class="js-example-placeholder-single js-states form-control w-[385px] m-4"
                                                    id="kode_sumber" name="kode_sumber"
                                                    data-placeholder="Pilih Sumber Koleksi">
                                                    <option value="">Pilih...</option>
                                                    @foreach ($sumber as $m)
                                                        <option value="{{ $m->kode_sumber }}">{{ $m->sumber }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span
                                                    class="text-sm m-l text-red-500">{{ $errors->first('kode_sumber') }}</span>
                                            </div>
                                            <div class="mb-5 w-full">
                                                <label for="pengarang"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Kelompok
                                                    <span class="text-red-500">*</span></label>
                                                <input type="text" id="pengarang" name="pengarang"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    placeholder="Masukan Nama Kelompok...." />
                                                <span
                                                    class="text-sm m-l text-red-500">{{ $errors->first('pengarang') }}</span>
                                            </div>
                                        </div>

                                        <div
                                            class="bg-slate-100 shadow-2xl border-slate-900 border-xl p-4 rounded-lg text-center font-bold mt-3">
                                            DATA ANGGOTA KELOMPOK
                                        </div>

                                        <button id="addRowBtn"
                                            class="mb-3 bg-sky-500 p-2 rounded-xl m-4 text-white"><i
                                                class="fa-solid fa-user-plus" style="color: #fafafa;"></i></button>

                                        <table class="table table-bordered" id="candidat-datatable">
                                            <thead>
                                                <tr>
                                                    <th class="w-2">No.</th>
                                                    <th>Mahasiswa</th>
                                                    <th>NIM</th>
                                                    <th>Program Sutudi</th>
                                                    <th>Kelas</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>

                                        <div class="mb-5">
                                            <label for="lantai"
                                                class="block mb-2 text-sm font-medium text-red-500 text-gray-900 dark:text-white">
                                                {{ __('*) Wajib diisi...') }}</label>
                                        </div>
                                        <button type="submit" id="formSourceButton"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let table;

        $(document).ready(function() {
            table = $('#candidat-datatable').DataTable({
                paging: false,  // Disable pagination
            });

            $('#addRowBtn').click(function(event) {
                event.preventDefault();
                if (table.rows().count() < 15) {
                    addRow();
                } else {
                    alert('Maximum 15 rows allowed.');
                }
            });
        });

        let rowCount = 0;

        function addRow() {
            rowCount++;
            table.row.add([
                rowCount,
                `<input type="text" name="student[]" id="student${rowCount}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">`,
                `<input type="text" name="nim[]" id="nim${rowCount}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">`,
                `<input type="text" name="major[]" id="major${rowCount}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">`,
                `<input type="text" name="classes[]" id="classes${rowCount}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">`,
                `<button type="button" class="mb-3 bg-red-500 p-2 rounded-xl m-4 text-white" onclick="removeRow(${rowCount})"><i class="fa-solid fa-user-minus" style="color: #fafcff;"></i></button>`
            ]).draw(false);
        }

        function removeRow(rowId) {
            let rowIndex = table.row(`#row${rowId}`).index();
            table.row(rowIndex).remove().draw(false);
            updateRowNumbers();
        }

        function updateRowNumbers() {
            table.rows().every(function(rowIdx, tableLoop, rowLoop) {
                let cell = this.cell(rowIdx, 0).node();
                $(cell).html(rowIdx + 1);
            });
        }
    </script>
</x-app-layout>
