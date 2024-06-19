<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('JENIS KOLEKSI') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">
                <div class="p-6 text-gray-900 flex gap-4 grid-cols-1">
                    <div class="bg-white my-2 overflow-hidden shadow-lg w-full rounded-lg lg:rounded-lg md:rounded-lg">
                        <div class="p-4 text-gray-900 w-full">
                            <div class="bg-slate-100 shadow-2xl border-slate-900 border-xl p-4 rounded-lg ">
                                <h2>Tambah Data <span class="font-bold">Jenis Koleksi</span></h2>
                            </div>
                            <div class="flex justify-center">
                                <div class="p-12" style="width:100%">
                                    <form action="{{ route('jenis.store') }}" method="post">
                                        @csrf
                                        <div class="mb-2">
                                            <label for="">
                                                <span
                                                    class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-0.5 dark:text-white">Kode
                                                    Jenis</span>
                                                <input type="text" name="kode_jenis"
                                                    onkeyup="this.value = this.value.toUpperCase()"
                                                    class="px-3 py-2 border shadow rounded w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-pink-700 invalid:focus:ring-pink-700 invalid:focus:border-pink-700 peer"
                                                    id="" placeholder="Masukan Kode Jenis..."
                                                    value="{{ $kode_jenis }}" readonly>
                                                <span
                                                    class="text-sm m-l text-red-500">{{ $errors->first('kode_jenis') }}</span>
                                            </label>
                                        </div>
                                        <div class="mb-2">
                                            <label for="">
                                                <span
                                                    class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-0.5 dark:text-white">Jenis
                                                    Koleksi</span>
                                                <input type="text" name="jenis"
                                                    onkeyup="this.value = this.value.toUpperCase()"
                                                    class="px-3 py-2 border shadow rounded w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-pink-700 invalid:focus:ring-pink-700 invalid:focus:border-pink-700 peer"
                                                    id="" placeholder="Masukan Jenis Koleksi...">
                                                <span
                                                    class="text-sm m-l text-red-500">{{ $errors->first('jenis') }}</span>
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

                    <div class="bg-white my-2 overflow-hidden shadow-lg w-full rounded-lg lg:rounded-lg md:rounded-lg">
                        <div class="p-4 text-gray-900 w-full">
                            <div class="bg-slate-100 shadow-2xl border-slate-900 border-xl p-4 rounded-lg ">
                                <h2>Data <span class="font-bold">Jenis Koleksi</span></h2>
                            </div>
                            <div class="flex justify-center">
                                <div class="p-12" style="width:100%">
                                    <table class="table table-bordered" id="jenis-datatable">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Kode Jenis</th>
                                                <th>Jenis Koleksi</th>
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
                                Tambah Sumber Database
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
                                        class="block mb-2 text-sm font-medium text-gray-900">Kode Jenis Koleksi</label>
                                    <input type="text" id="kode_jenis" name="kode_jenis" onkeyup="this.value = this.value.toUpperCase()"
                                        class="px-3 py-2 border shadow rounded w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-pink-700 invalid:focus:ring-pink-700 invalid:focus:border-pink-700 peer"
                                        placeholder="Masukan Kode Koleksi..." readonly>
                                </div>
                                <div class="mb-2">
                                    <label for="text"
                                        class="block mb-2 text-sm font-medium text-gray-900">Jenis Koleksi</label>
                                    <input type="text" id="jenis" name="jenis" onkeyup="this.value = this.value.toUpperCase()"
                                        class="px-3 py-2 border shadow rounded w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-pink-700 invalid:focus:ring-pink-700 invalid:focus:border-pink-700 peer"
                                        placeholder="Masukan Jenis Koleksi...">
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
            $('#jenis-datatable').DataTable({
                ajax: {
                    url: 'api/jenis',
                    dataSrc: 'jenis'
                },
                columns: [{
                    data: 'no',
                    render: (data, text, row, meta) => {
                        return meta.row + 1;
                    }
                }, {
                    data: 'kode_jenis',
                }, {
                    data: 'jenis',
                }, {
                    data: {
                        no: 'no',
                        name: 'name'
                    },
                    render: (data) => {
                        let editUrl =
                            `<button type="button" data-id="${data.id}" data-kode_jenis="${data.kode_jenis}"
                                                        data-modal-target="sourceModal" data-jenis="${data.jenis}"
                                                        onclick="editSourceModal(this)"
                                                        class="bg-amber-500 hover:bg-amber-600 px-3 py-1 rounded-md text-xs text-white">
                                                       <i class="fas fa-edit"></i>
                                                    </button>`;
                        let deleteUrl =
                            `<button onclick="return jenisDelete('${data.id}','${data.jenis}')" class="bg-red-500 hover:bg-bg-red-300 px-3 py-1 rounded-md text-xs text-white"><i class="fas fa-trash"></i></button>`;
                        return `${editUrl} ${deleteUrl}`;
                    }
                }, ],
            });
        });

        const editSourceModal = (button) => {
            const formModal = document.getElementById('formSourceModal');
            const modalTarget = button.dataset.modalTarget;
            const id = button.dataset.id;
            const kode_jenis = button.dataset.kode_jenis;
            const jenis = button.dataset.jenis;
            let url = "{{ route('jenis.update', ':id') }}".replace(':id', id);
            let status = document.getElementById(modalTarget);
            document.getElementById('title_source').innerText = `Update Jenis Koleksi ${jenis}`;
            document.getElementById('kode_jenis').value = kode_jenis;
            document.getElementById('jenis').value = jenis;
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

        const jenisDelete = async (id, jenis) => {
            let tanya = confirm(`Apakah anda yakin untuk menghapus jurusan ${jenis} ?`);
            if (tanya) {
                await axios.post(`/jenis/${id}`, {
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
