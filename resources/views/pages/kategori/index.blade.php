<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('LANTAI') }}
        </h2>
    </x-slot>
    <div class="py-2">
        <div class="px-2 max-w-7sm gap-8 justify-center mx-auto sm:px-6 lg:px-8 md:flex lg:flex">

            <div class="bg-white my-2 overflow-hidden shadow-lg w-full rounded-lg lg:rounded-lg md:rounded-lg">
                <div class="p-4 text-gray-900 w-full">
                    <div class="bg-slate-100 shadow-2xl border-slate-900 border-xl p-4 rounded-lg ">
                        <h2>TAMBAH DATA RUANG</span></h2>
                    </div>
                    <div class="flex justify-center">
                        <div class="p-12" style="width:100%">
                            <form method="POST" action="{{ route('kategori.store') }}">
                                @csrf
                                <div class="mb-5">
                                    <label for="id_merk"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Merk
                                        <span class="text-red-500">*</span></label>
                                    <select class="js-example-placeholder-single js-states form-control w-full m-6"
                                        name="id_merk" data-placeholder="Pilih Merk">
                                        <option value="">Pilih...</option>
                                        @foreach ($merk as $m)
                                            <option value="{{ $m->id }}">{{ $m->merk }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-sm m-l text-red-500">{{ $errors->first('id_merk') }}</span>
                                </div>
                                <div class="mb-5">
                                    <label for="category"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori
                                        <span class="text-red-500">*</span></label>
                                    <input type="text" id="category" name="category"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Masukan Kategori...." />
                                    <span class="text-sm m-l text-red-500">{{ $errors->first('category') }}</span>
                                </div>
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

            <div class="bg-white my-2 overflow-hidden shadow-lg w-full rounded-lg lg:rounded-lg md:rounded-lg">
                <div class="p-4 text-gray-900 w-full">
                    <div class="bg-slate-100 shadow-2xl border-slate-900 border-xl p-4 rounded-lg ">
                        <h2>DATA RUANG</h2>
                    </div>
                    <div class="flex justify-center">
                        <div class="p-12" style="width:100%">
                            <table class="table table-bordered" id="category-datatable">
                                <thead>
                                    <tr>
                                        <th class="w-7">No.</th>
                                        <th>Merk</th>
                                        <th>Kategori</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
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
                        <form method="POST" id="formSourceModal">
                            @csrf
                            <div class="flex flex-col  p-4 space-y-6">
                                <div class="">
                                    <label for="id_merks"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Merk
                                        <span class="text-red-500">*</span></label>
                                    <select class="js-example-placeholder-single js-states form-control w-[1000px] m-6" id="id_merks"
                                        name="id_merks" data-placeholder="Pilih Merk">
                                        <option value="">Pilih...</option>
                                        @foreach ($merk as $m)
                                            <option value="{{ $m->id }}">{{ $m->merk }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-sm m-l text-red-500">{{ $errors->first('id_merks') }}</span>
                                </div>
                                <div class="mb-5">
                                    <label for="category"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori
                                        <span class="text-red-500">*</span></label>
                                    <input type="text" id="categorys" name="categorys"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Masukan Kategori...." />
                                    <span class="text-sm m-l text-red-500">{{ $errors->first('categorys') }}</span>
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
            $('#category-datatable').DataTable({
                ajax: {
                    url: 'api/category',
                    dataSrc: 'category'
                },
                initComplete: function() {
                    // Menengahkan teks di semua sel pada header (baris pertama)
                    $('#room-datatable thead th').css('text-align', 'center');
                },
                columns: [{
                    data: 'no',
                    render: (data, type, row, meta) => {
                        return `<div style="text-align:center">${meta.row + 1}.</div>`;;
                    }
                }, {
                    data: 'merk',
                    render: (data, type, row) => {
                        return data.merk;
                    }
                }, {
                    data: 'category',
                    render: (data, type, row) => {
                        return data;
                    }
                }, {
                    data: {
                        no: 'no',
                        name: 'name'
                    },
                    render: (data) => {
                        let editUrl =
                            `<button type="button" data-id="${data.id}"
                                                        data-modal-target="sourceModal" data-id_merk="${data.id_merk}" data-category="${data.category}"
                                                        onclick="editSourceModal(this)"
                                                        class="bg-amber-500 hover:bg-amber-600 px-3 py-1 rounded-md text-xs text-white">
                                                       <i class="fas fa-edit"></i>
                                                    </button>`;
                        let deleteUrl =
                            `<button onclick="return categoryDelete('${data.id}','${data.category}')" class="bg-red-500 hover:bg-bg-red-300 px-3 py-1 rounded-md text-xs text-white"><i class="fas fa-trash"></i></button>`;
                        return `<div style="text-align:center">${editUrl} ${deleteUrl}</div>`;
                    }
                }, ],
            });
        });

        const editSourceModal = (button) => {
            const formModal = document.getElementById('formSourceModal');
            const modalTarget = button.dataset.modalTarget;
            const id = button.dataset.id;
            const categorys = button.dataset.category;
            const id_merks = button.dataset.id_merk;

            let url = "{{ route('kategori.update', ':id') }}".replace(':id', id);
            console.log(url);
            let status = document.getElementById(modalTarget);
            document.getElementById('title_source').innerText = `Update Ruang ${categorys}`;
            document.getElementById('categorys').value = categorys;
            document.querySelector('[name="id_merks"]').value = id_merks;
            let event = new Event('change');
            document.querySelector('[name="id_merks"]').dispatchEvent(event);

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

        const categoryDelete = async (id, category) => {
            let tanya = confirm(`Apakah anda yakin untuk menghapus kategori ${category} ?`);
            if (tanya) {
                await axios.post(`/kategori/${id}`, {
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
