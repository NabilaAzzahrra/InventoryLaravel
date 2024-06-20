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
                                    <form method="POST" action="{{ route('kelompok_kkn.update', $koleksi->id_koleksi) }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        <div class="grid grid-cols-3 gap-5">
                                            <div class="mb-5 w-full">
                                                <label for="kode_koleksi"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode
                                                    Koleksi
                                                    <span class="text-red-500">*</span></label>
                                                <input type="text" id="kode_koleksi" name="kode_koleksi"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    placeholder="Masukan Kode...." value="{{ $koleksi->kode_koleksi }}"
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
                                                    placeholder="Masukan Judul Koleksi...."
                                                    value="{{ $koleksi->judul_buku }}" />
                                                <span
                                                    class="text-sm m-l text-red-500">{{ $errors->first('judul_buku') }}</span>
                                            </div>
                                            <div class="mb-5 w-full">
                                                <label for="pengarang"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                                    Kelompok
                                                    <span class="text-red-500">*</span></label>
                                                <input type="text" id="pengarang" name="pengarang"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    placeholder="Masukan Pengarang...."
                                                    value="{{ $koleksi->pengarang }}" />
                                                <span
                                                    class="text-sm m-l text-red-500">{{ $errors->first('pengarang') }}</span>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-3 gap-5">
                                            <div class="mb-5 w-full">
                                                <label for="lantai"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                    Jenis <span class="text-red-500">*</span>
                                                </label>
                                                <select
                                                    class="js-example-placeholder-single js-states form-control w-[385px] m-4"
                                                    id="kode_jenis" name="kode_jenis"
                                                    data-placeholder="Pilih Jenis Koleksi">
                                                    <option value="">Pilih...</option>
                                                    @foreach ($jenis as $m)
                                                        <option value="{{ $m->kode_jenis }}"
                                                            {{ old('kode_jenis', $koleksi->kode_jenis ?? '') == $m->kode_jenis ? 'selected' : '' }}>
                                                            {{ $m->jenis }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span
                                                    class="text-sm m-l text-red-500">{{ $errors->first('kode_jenis') }}</span>
                                            </div>

                                            <div class="mb-5 w-full">
                                                <label for="tahun_terbit"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tahun
                                                    Angkatan
                                                    <span class="text-red-500">*</span></label>
                                                <input type="number" id="tahun_terbit" name="tahun_terbit"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    placeholder="Masukan Tahun Terbit...."
                                                    value="{{ $koleksi->tahun_terbit }}" />
                                                <span
                                                    class="text-sm m-l text-red-500">{{ $errors->first('tahun_terbit') }}</span>
                                            </div>
                                            @php
                                                if ($koleksi->ketersediaan == 'AVAILABLE') {
                                                    $keluar = 'hidden';
                                                    $masuk = '';
                                                } else {
                                                    $keluar = '';
                                                    $masuk = 'hidden';
                                                }

                                            @endphp

                                            <div class="mb-5 w-full {{ $masuk }}">
                                                <label for="tgl_masuk"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal
                                                    Masuk
                                                    <span class="text-red-500">*</span></label>
                                                <input type="date" id="tgl_masuk" name="tgl_masuk"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    placeholder="Masukan Tanggal Masuk...."
                                                    value="{{ $koleksi->tgl_masuk }}" />
                                                <span
                                                    class="text-sm m-l text-red-500">{{ $errors->first('tgl_masuk') }}</span>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-3 gap-5">


                                            <div class="mb-5 w-full {{ $keluar }}">
                                                <label for="tgl_keluar"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal
                                                    Keluar
                                                    <span class="text-red-500">*</span></label>
                                                <input type="date" id="tgl_keluar" name="tgl_keluar"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    placeholder="Masukan Tanggal Keluar...."
                                                    value="{{ $koleksi->tgl_keluar }}" />
                                                <span
                                                    class="text-sm m-l text-red-500">{{ $errors->first('tgl_keluar') }}</span>
                                            </div>

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
                                                        <option value="{{ $m->kode_sumber }}"
                                                            {{ old('kode_sumber', $koleksi->kode_sumber ?? '') == $m->kode_sumber ? 'selected' : '' }}>
                                                            {{ $m->sumber }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span
                                                    class="text-sm m-l text-red-500">{{ $errors->first('kode_sumber') }}</span>
                                            </div>
                                            <div class="mb-5 w-full {{ $masuk }}">
                                                <label for="foto"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto
                                                    <span class="text-red-500">*</span></label>
                                                <input
                                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                                    aria-describedby="user_avatar_help" id="foto" name="foto"
                                                    type="file">
                                            </div>

                                            <div class="mb-5 w-full {{ $keluar }}">
                                                <label for="ketersediaan"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ketersediaan
                                                    <span class="text-red-500">*</span></label>
                                                <input
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    aria-describedby="user_avatar_help" id="ketersediaan"
                                                    name="ketersediaan" type="text"
                                                    value="{{ $koleksi->ketersediaan }}" readonly>
                                            </div>
                                            <div class="mb-2 w-full">
                                                <label for="foto"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto
                                                    <span class="text-red-500">*</span></label>
                                                <img src="{{ url('uploads/' . $koleksi->foto) }}"
                                                    alt="{{ $koleksi->judul_buku }}" class="w-full h-auto">
                                            </div>
                                        </div>

                                        <div
                                            class="bg-slate-100 shadow-2xl border-slate-900 border-xl p-4 rounded-lg text-center font-bold mb-8">
                                            DATA ANGGOTA KELOMPOK
                                        </div>

                                        <div class="relative overflow-x-auto">
                                            <table
                                                class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                <thead
                                                    class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                                                    <tr>
                                                        <th scope="col" class="px-6 py-3 rounded-s- w-3">
                                                            No
                                                        </th>
                                                        <th scope="col" class="px-6 py-3 rounded-s-lg">
                                                            Nama Mahasiswa
                                                        </th>
                                                        <th scope="col" class="px-6 py-3">
                                                            NIM
                                                        </th>
                                                        <th scope="col" class="px-6 py-3 rounded-e-lg">
                                                            Program Studi
                                                        </th>
                                                        <th scope="col" class="px-6 py-3 rounded-e-lg">
                                                            Kelas
                                                        </th>
                                                        <th scope="col" class="px-6 py-3 rounded-e-lg">
                                                            Action
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $no = 1;
                                                    @endphp
                                                    @foreach ($detail as $d)
                                                        <tr class="bg-white dark:bg-gray-800">
                                                            <th scope="row"
                                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                {{ $no++ }}
                                                            </th>
                                                            <td class="px-6 py-4">
                                                                {{ $d->nama }}
                                                            </td>
                                                            <td class="px-6 py-4">
                                                                {{ $d->nim }}
                                                            </td>
                                                            <td class="px-6 py-4">
                                                                {{ $d->jurusan }}
                                                            </td>
                                                            <td class="px-6 py-4">
                                                                {{ $d->kelas }}
                                                            </td>
                                                            <td class="px-6 py-4">
                                                                <button type="button"
                                                                    onclick="return detailDelete({{ $d->id }}, '{{ $d->nama }}')"
                                                                    class="bg-red-500 hover:bg-red-300 px-3 py-1 rounded-md text-xs text-white">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                                <button type="button" data-id="{{ $d->id }}"
                                                                    data-nama="{{ $d->nama }}"
                                                                    data-modal-target="sourceModal"
                                                                    data-nim="{{ $d->nim }}"
                                                                    data-jurusan="{{ $d->jurusan }}"
                                                                    data-kelas="{{ $d->kelas }}"
                                                                    onclick="editSourceModal(this)"
                                                                    class="bg-amber-500 hover:bg-amber-600 px-3 py-1 rounded-md text-xs text-white">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        <div
                                            class="bg-slate-100 shadow-2xl border-slate-900 border-xl p-4 rounded-lg text-center font-bold mt-8">
                                            TAMBAHAN DATA ANGGOTA KELOMPOK
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

                                        <button type="submit" id="formSourceButton"
                                            class="text-white mt-4 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="fixed inset-0 flex items-center justify-center z-50 hidden" id="sourceModal">
        <div class="fixed inset-0 bg-black opacity-50" onclick="sourceModalClose(this)"></div>
        <div class="fixed inset-0 flex items-center justify-center">
            <div class="w-full md:w-1/2 relative bg-white rounded-lg shadow mx-5">
                <div class="flex items-start justify-between p-4 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900" id="title_source">Tambah Sumber Database</h3>
                    <button type="button" onclick="sourceModalClose(this)" data-modal-target="sourceModal"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <form method="POST" action="#" id="formSourceModal">
                    @csrf
                    <div class="p-4 space-y-6">
                        <div class="mb-2">
                            <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                            <input type="text" id="nama" name="nama"
                                onkeyup="this.value = this.value.toUpperCase()"
                                class="px-3 py-2 border shadow rounded w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-pink-700 invalid:focus:ring-pink-700 invalid:focus:border-pink-700 peer"
                                placeholder="Masukan Nama Mahasiswa...">
                        </div>
                        <div class="mb-2">
                            <label for="nim" class="block mb-2 text-sm font-medium text-gray-900">NIM</label>
                            <input type="text" id="nim" name="nim"
                                onkeyup="this.value = this.value.toUpperCase()"
                                class="px-3 py-2 border shadow rounded w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-pink-700 invalid:focus:ring-pink-700 invalid:focus:border-pink-700 peer"
                                placeholder="Masukan NIM...">
                        </div>
                        <div class="mb-2">
                            <label for="jurusan" class="block mb-2 text-sm font-medium text-gray-900">Program
                                Studi</label>
                            <input type="text" id="jurusan" name="jurusan"
                                onkeyup="this.value = this.value.toUpperCase()"
                                class="px-3 py-2 border shadow rounded w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-pink-700 invalid:focus:ring-pink-700 invalid:focus:border-pink-700 peer"
                                placeholder="Masukan Program Studi...">
                        </div>
                        <div class="mb-2">
                            <label for="kelas" class="block mb-2 text-sm font-medium text-gray-900">Kelas</label>
                            <input type="text" id="kelas" name="kelas"
                                onkeyup="this.value = this.value.toUpperCase()"
                                class="px-3 py-2 border shadow rounded w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-pink-700 invalid:focus:ring-pink-700 invalid:focus:border-pink-700 peer"
                                placeholder="Masukan Kelas...">
                        </div>
                    </div>
                    <div class="flex items-center p-4 space-x-2 border-t border-gray-200 rounded-b">
                        <button type="submit" id="formSourceButton"
                            class="bg-green-400 m-2 w-40 h-10 rounded-xl hover:bg-green-500">Simpan</button>
                        <button type="button" data-modal-target="sourceModal" onclick="sourceModalClose(this)"
                            class="bg-red-500 m-2 w-40 h-10 rounded-xl text-white hover:shadow-lg hover:bg-red-600">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        let table;

        $(document).ready(function() {
            table = $('#candidat-datatable').DataTable({
                paging: false, // Disable pagination
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

        const editSourceModal = (button) => {
            const formModal = document.getElementById('formSourceModal');
            const modalTarget = button.dataset.modalTarget;
            const id = button.dataset.id;
            const nama = button.dataset.nama;
            const nim = button.dataset.nim;
            const jurusan = button.dataset.jurusan;
            const kelas = button.dataset.kelas;
            let url = "{{ route('detail_kkn.update', ':id') }}".replace(':id', id);
            let status = document.getElementById(modalTarget);

            document.getElementById('title_source').innerText = 'Update Data Anggota Kelompok';
            document.getElementById('nama').value = nama;
            document.getElementById('nim').value = nim;
            document.getElementById('jurusan').value = jurusan;
            document.getElementById('kelas').value = kelas;
            document.getElementById('formSourceButton').innerText = 'Simpan';
            document.getElementById('formSourceModal').setAttribute('action', url);

            // Clear existing hidden inputs to avoid duplicates
            const csrfInputs = formModal.querySelectorAll('input[type="hidden"]');
            csrfInputs.forEach(input => input.remove());

            // Add CSRF token
            let csrfToken = document.createElement('input');
            csrfToken.setAttribute('type', 'hidden');
            csrfToken.setAttribute('name', '_token');
            csrfToken.setAttribute('value', '{{ csrf_token() }}');
            formModal.appendChild(csrfToken);

            // Add method input
            let methodInput = document.createElement('input');
            methodInput.setAttribute('type', 'hidden');
            methodInput.setAttribute('name', '_method');
            methodInput.setAttribute('value', 'PATCH');
            formModal.appendChild(methodInput);

            status.classList.toggle('hidden');
        }

        const sourceModalClose = (button) => {
            const modalTarget = button.dataset.modalTarget;
            let status = document.getElementById(modalTarget);
            status.classList.toggle('hidden');
        }

        const detailDelete = async (id, nama) => {
            let tanya = confirm(`Apakah anda yakin untuk menghapus anggota dengan nama ${nama} ?`);
            if (tanya) {
                await axios.post(`/detail_kkn/${id}`, {
                        '_method': 'DELETE',
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    })
                    .then(function(response) {
                        // Handle success
                        location.reload();
                    })
                    .catch(function(error) {
                        // Handle error
                        alert('Error deleting record');
                        console.log(error);
                    });
            }
        }
    </script>
</x-app-layout>
