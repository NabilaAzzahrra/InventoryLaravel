<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('JURUSAN ') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">
                <div class="p-6 text-gray-900 flex gap-4 grid-cols-1">
                    <div class="bg-white my-2 overflow-hidden shadow-lg w-full rounded-lg lg:rounded-lg md:rounded-lg">
                        <div class="p-4 text-gray-900 w-full">
                            <div class="bg-slate-100 shadow-2xl border-slate-900 border-xl p-4 rounded-lg ">
                                <h2>Tambah Data <span class="font-bold">jurusan </span></h2>
                            </div>
                            <div class="flex justify-center">
                                <div class="p-12" style="width:100%">
                                    <form action="{{ route('jurusan.store') }}" method="post">
                                        @csrf
                                        <div class="mb-2">
                                            <label for="">
                                                <span
                                                    class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-0.5 dark:text-white">Kode
                                                    jurusan</span>
                                                <input type="text" name="kode_jurusan"
                                                    onkeyup="this.value = this.value.toUpperCase()"
                                                    class="px-3 py-2 border shadow rounded w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-pink-700 invalid:focus:ring-pink-700 invalid:focus:border-pink-700 peer"
                                                    id="" placeholder="Masukan Kode jurusan..."
                                                    value="{{ $kode_jurusan }}" readonly>
                                                <span
                                                    class="text-sm m-l text-red-500">{{ $errors->first('kode_jurusan') }}</span>
                                            </label>
                                        </div>
                                        <div class="mb-2">
                                            <label for="">
                                                <span
                                                    class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-0.5 dark:text-white">jurusan
                                                    </span>
                                                <input type="text" name="jurusan"
                                                    onkeyup="this.value = this.value.toUpperCase()"
                                                    class="px-3 py-2 border shadow rounded w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-pink-700 invalid:focus:ring-pink-700 invalid:focus:border-pink-700 peer"
                                                    id="" placeholder="Masukan jurusan ...">
                                                <span
                                                    class="text-sm m-l text-red-500">{{ $errors->first('jurusan') }}</span>
                                            </label>
                                        </div>
                                        <div class="pt-2">
                                            <button type="submit"
                                                class="bg-sky-400 h-10 w-28 mt-2 p-2 rounded-xl text-lime-50 hover:bg-sky-600 hover:shadow-sky-700 hover:shadow-md">
                                                <div class="">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="inline text-white"
                                                        height="16" width="14"
                                                        viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                                                        <path
                                                            d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V173.3c0-17-6.7-33.3-18.7-45.3L352 50.7C340 38.7 323.7 32 306.7 32H64zm0 96c0-17.7 14.3-32 32-32H288c17.7 0 32 14.3 32 32v64c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V128zM224 288a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" />
                                                    </svg> Simpan
                                                </div>
                                            </button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white my-2 overflow-hidden shadow-lg w-full m-auto rounded-lg lg:rounded-lg md:rounded-lg">
                        <div class="p-4 text-gray-900 w-full">
                            <div class="bg-slate-100 shadow-2xl border-slate-900 border-xl p-4 rounded-lg ">
                                <h2>Data <span class="font-bold">jurusan </span></h2>
                            </div>
                            <div class="flex justify-center">
                                <div class="p-12" style="width:100%">
                                    <table class="table table-bordered" id="jurusan-datatable">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Kode jurusan</th>
                                                <th>jurusan </th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="fixed inset-0 flex items-center justify-center z-50 hidden" id="sourceModal">
                <div class="fixed inset-0 bg-black opacity-50"></div>
                <div class="fixed inset-0 flex items-center justify-center">
                    <div class="w-full md:w-1/2 relative bg-white rounded-lg shadow mx-5">
                        <div class="flex items-start justify-between p-4 border-b rounded-t">
                            <h3 class="text-xl font-semibold text-gray-900" id="title_source">
                                Tambah jurusan Database
                            </h3>
                            <button type="button" onclick="sourceModalClose(this)" data-modal-target="sourceModal"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center"
                                data-modal-hide="defaultModal">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                        <form method="POST" action="#" id="formSourceModal">
                            @csrf
                            <div class="p-4 space-y-6">
                                <div class="mb-2">
                                    <label for="text"
                                        class="block mb-2 text-sm font-medium text-gray-900">Kode jurusan </label>
                                    <input type="text" id="kode_jurusan" name="kode_jurusan" onkeyup="this.value = this.value.toUpperCase()"
                                        class="px-3 py-2 border shadow rounded w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-pink-700 invalid:focus:ring-pink-700 invalid:focus:border-pink-700 peer"
                                        placeholder="Masukan Kode ..." readonly>
                                </div>
                                <div class="mb-2">
                                    <label for="text"
                                        class="block mb-2 text-sm font-medium text-gray-900">jurusan </label>
                                    <input type="text" id="jurusan" name="jurusan" onkeyup="this.value = this.value.toUpperCase()"
                                        class="px-3 py-2 border shadow rounded w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-pink-700 invalid:focus:ring-pink-700 invalid:focus:border-pink-700 peer"
                                        placeholder="Masukan jurusan ...">
                                </div>
                            </div>
                            <div class="flex items-center p-4 space-x-2 border-t border-gray-200 rounded-b">
                                <button type="submit" id="formSourceButton"
                                    class="bg-green-400 m-2 w-40 h-10 rounded-xl hover:bg-green-500">Simpan</button>
                                <button type="button" data-modal-target="sourceModal" onclick="changeSourceModal(this)"
                                    class="bg-red-500 m-2 w-40 h-10 rounded-xl text-white hover:shadow-lg hover:bg-red-600">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            console.log('RUN!');
            $('#jurusan-datatable').DataTable({
                ajax: {
                    url: 'api/jurusan',
                    dataSrc: 'jurusan'
                },
                columns: [{
                    data: 'no',
                    render: (data, text, row, meta) => {
                        return meta.row + 1;
                    }
                }, {
                    data: 'kode_jurusan',
                }, {
                    data: 'jurusan',
                    render: (data, text, row, meta) => {
                        return `<div class="text-wrap">${data}</div>`;
                    }
                }, {
                    data: {
                        no: 'no',
                        name: 'name'
                    },
                    render: (data) => {
                        let editUrl =
                            `<button type="button" data-id="${data.id}" data-kode_jurusan="${data.kode_jurusan}"
                                                        data-modal-target="sourceModal" data-jurusan="${data.jurusan}"
                                                        onclick="editSourceModal(this)"
                                                        class="bg-amber-500 hover:bg-amber-600 px-3 py-1 rounded-md text-xs text-white">
                                                       <i class="fas fa-edit"></i>
                                                    </button>`;
                        let deleteUrl =
                            `<button onclick="return jurusanDelete('${data.id}','${data.jurusan}')" class="bg-red-500 hover:bg-bg-red-300 px-3 py-1 rounded-md text-xs text-white"><i class="fas fa-trash"></i></button>`;
                        return `${editUrl} ${deleteUrl}`;
                    }
                }, ],
            });
        });

        const editSourceModal = (button) => {
            const formModal = document.getElementById('formSourceModal');
            const modalTarget = button.dataset.modalTarget;
            const id = button.dataset.id;
            const kode_jurusan = button.dataset.kode_jurusan;
            const jurusan = button.dataset.jurusan;
            let url = "{{ route('jurusan.update', ':id') }}".replace(':id', id);
            let status = document.getElementById(modalTarget);
            document.getElementById('title_source').innerText = `Update jurusan  ${jurusan}`;
            document.getElementById('kode_jurusan').value = kode_jurusan;
            document.getElementById('jurusan').value = jurusan;
            document.getElementById('formSourceButton').innerText = 'Simpan';
            document.getElementById('formSourceModal').setAttribute('action', url);
            let csrfToken = document.createElement('input');
            csrfToken.setAttribute('type', 'hidden');
            csrfToken.setAttribute('value', '{{ csrf_token() }}');
            formModal.appendChild(csrfToken);

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

        const jurusanDelete = async (id, jurusan) => {
            let tanya = confirm(`Apakah anda yakin untuk menghapus jurusan ${jurusan} ?`);
            if (tanya) {
                await axios.post(`/jurusan/${id}`, {
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
