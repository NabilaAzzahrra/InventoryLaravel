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
                        <div class="flex justify-between">
                            <div class="p-2">
                                <h2>DATA BARANG</h2>
                            </div>
                            <a href="{{ route('barang.create') }}">
                                <div class="bg-sky-400 py-2 px-4 rounded-lg text-white hover:bg-sky-500">
                                    <i class="fa-solid fa-plus"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <div class="p-12" style="width:100%">
                            <table class="table table-bordered" id="detail-datatable">
                                <thead>
                                    <tr>
                                        <th class="w-7">No.</th>
                                        <th>Kode Item</th>
                                        <th>Item</th>
                                        <th>Kategori</th>
                                        <th>Merk</th>
                                        <th>Ruang</th>
                                        <th>Harga</th>
                                        <th>Penyusutan</th>
                                        <th>QR</th>
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

                                <div>
                                    <label for="text"
                                        class="block mb-2 text-sm font-medium text-gray-900">Divisi</label>
                                    <input type="text" id="divisions" name="divisi"
                                        class="px-3 py-2 border shadow rounded w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-pink-700 invalid:focus:ring-pink-700 invalid:focus:border-pink-700 peer hover:shadow-lg"
                                        placeholder="Masukan divisi disini...">
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
            $('#detail-datatable').DataTable({
                ajax: {
                    url: 'api/inventory_item_detail',
                    dataSrc: 'inventory_item_detail'
                },
                initComplete: function() {
                    // Menengahkan teks di semua sel pada header (baris pertama)
                    $('#division-datatable thead th').css('text-align', 'center');
                },
                columns: [{
                    data: 'no',
                    render: (data, type, row, meta) => {
                        return `<div style="text-align:center">${meta.row + 1}.</div>`;;
                    }
                }, {
                    data: 'code',
                    render: (data, type, row) => {
                        return data;
                    }
                }, {
                    data: 'barang',
                    render: (data, type, row) => {
                        return data.name;
                    }
                }, {
                    data: 'barang',
                    render: (data, type, row) => {
                        return data.kategori.category;
                    }
                }, {
                    data: 'barang',
                    render: (data, type, row) => {
                        return data.kategori.merk.merk;
                    }
                }, {
                    data: 'barang',
                    render: (data, type, row) => {
                        return data.room.room;
                    }
                }, {
                    data: 'barang',
                    render: (data, type, row) => {
                        return data.price;
                    }
                }, {
                    data: 'barang',
                    render: (data, type, row) => {
                        return data.cost_of_depreciation;
                    }
                }, {
                    data: 'id_item',
                    render: (data, type, row) => {
                        return `
                            <div class="text-red-500">${data}</div>
                        `;
                    }
                }, {
                    data: {
                        no: 'no',
                        name: 'name'
                    },
                    render: (data) => {
                        let editUrl =
                            `<button type="button" data-id="${data.id}"
                                                        data-modal-target="sourceModal" data-division="${data.division}"
                                                        onclick="editSourceModal(this)"
                                                        class="bg-amber-500 hover:bg-amber-600 px-3 py-1 rounded-md text-xs text-white">
                                                       <i class="fas fa-edit"></i>
                                                    </button>`;
                        let deleteUrl =
                            `<button onclick="return divisionDelete('${data.id}','${data.division}')" class="bg-red-500 hover:bg-bg-red-300 px-3 py-1 rounded-md text-xs text-white"><i class="fas fa-trash"></i></button>`;
                        return `<div style="text-align:center">${editUrl} ${deleteUrl}</div>`;
                    }
                }, ],
            });
        });

        const editSourceModal = (button) => {
            const formModal = document.getElementById('formSourceModal');
            const modalTarget = button.dataset.modalTarget;
            const id = button.dataset.id;
            const division = button.dataset.division;
            let url = "{{ route('divisi.update', ':id') }}".replace(':id', id);
            console.log(url);
            let status = document.getElementById(modalTarget);
            document.getElementById('title_source').innerText = `Update Divisi ${division}`;
            document.getElementById('divisions').value = division;
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

        const divisionDelete = async (id, division) => {
            let tanya = confirm(`Apakah anda yakin untuk menghapus divisi ${division} ?`);
            if (tanya) {
                await axios.post(`/divisi/${id}`, {
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