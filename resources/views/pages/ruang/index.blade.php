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
                            <form method="POST" action="{{ route('ruang.store') }}">
                                @csrf
                                <div class="mb-5">
                                    <label for="lantai"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lantai
                                        <span class="text-red-500">*</span></label>
                                    <select class="js-example-placeholder-single js-states form-control w-full m-6"
                                        name="lantai" data-placeholder="Pilih Lantai">
                                        <option value="">Pilih...</option>
                                        @foreach ($floor as $m)
                                            <option value="{{ $m->id }}">{{ $m->floor }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-sm m-l text-red-500">{{ $errors->first('lantai') }}</span>
                                </div>
                                <div class="mb-5">
                                    <label for="ruang"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ruang
                                        <span class="text-red-500">*</span></label>
                                    <input type="text" id="ruang" name="ruang"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Masukan Ruangan...." />
                                    <span class="text-sm m-l text-red-500">{{ $errors->first('ruang') }}</span>
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
                            <table class="table table-bordered" id="room-datatable">
                                <thead>
                                    <tr>
                                        <th class="w-7">No.</th>
                                        <th>Lantai</th>
                                        <th>Ruang</th>
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
                                    <label for="lantai"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lantai
                                        <span class="text-red-500">*</span></label>
                                    <select class="js-example-placeholder-single js-states form-control w-[1000px] m-6" id="id_floor"
                                        name="id_floor" data-placeholder="Pilih Lantai">
                                        <option value="">Pilih...</option>
                                        @foreach ($floor as $m)
                                            <option value="{{ $m->id }}">{{ $m->floor }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-sm m-l text-red-500">{{ $errors->first('lantai') }}</span>
                                </div>
                                <div class="mb-5">
                                    <label for="ruang"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ruang
                                        <span class="text-red-500">*</span></label>
                                    <input type="text" id="room" name="ruang"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Masukan Ruangan...." />
                                    <span class="text-sm m-l text-red-500">{{ $errors->first('room') }}</span>
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
            $('#room-datatable').DataTable({
                ajax: {
                    url: 'api/room',
                    dataSrc: 'room'
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
                    data: 'floor',
                    render: (data, type, row) => {
                        return data.floor;
                    }
                }, {
                    data: 'room',
                    render: (data, type, row) => {
                        return data;
                    }
                }, {
                    data: {
                        id: 'id',
                        id_floor: 'id_floor',
                        room: 'room'
                    },
                    render: (data, type, row) => {
                        let editUrl =
                            `<button type="button" data-id="${data.id}"
                                                        data-modal-target="sourceModal" data-id_floor="${data.id_floor}" data-room="${data.room}"
                                                        onclick="editSourceModal(this)"
                                                        class="bg-amber-500 hover:bg-amber-600 px-3 py-1 rounded-md text-xs text-white">
                                                       <i class="fas fa-edit"></i>
                                                    </button>`;
                        let deleteUrl =
                            `<button onclick="return roomDelete('${data.id}','${data.room}')" class="bg-red-500 hover:bg-bg-red-300 px-3 py-1 rounded-md text-xs text-white"><i class="fas fa-trash"></i></button>`;
                        return `<div style="text-align:center">${editUrl} ${deleteUrl}</div>`;
                    }
                }, ],
            });
        });

        const editSourceModal = (button) => {
            const formModal = document.getElementById('formSourceModal');
            const modalTarget = button.dataset.modalTarget;
            const id = button.dataset.id;
            const room = button.dataset.room;
            const id_floor = button.dataset.id_floor;
            console.log(button.dataset);
            let url = "{{ route('ruang.update', ':id') }}".replace(':id', id);
            let status = document.getElementById(modalTarget);
            document.getElementById('title_source').innerText = `Update Ruang ${room}`;
            document.getElementById('room').value = room;
            document.querySelector('[name="id_floor"]').value = id_floor;
            let event = new Event('change');
            document.querySelector('[name="id_floor"]').dispatchEvent(event);

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

        const roomDelete = async (id, room) => {
            let tanya = confirm(`Apakah anda yakin untuk menghapus ruang ${room} ?`);
            if (tanya) {
                await axios.post(`/ruang/${id}`, {
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
