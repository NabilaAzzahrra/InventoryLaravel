<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('LANTAI') }}
        </h2>
    </x-slot>
    <div class="py-2">
        <div class="px-2 max-w-7sm gap-8 justify-center mx-auto sm:px-6 lg:px-8 md:flex lg:flex">

            <div class="bg-white my-2 overflow-hidden shadow-lg w-full rounded-lg lg:rounded-lg md:rounded-lg">
                <form id="print-form" action="{{ route('print.store') }}" method="POST" class="formupdate" target="_blank">
                    @csrf
                    <div class="p-4 text-gray-900 w-full">
                        <div class="bg-slate-100 shadow-2xl border-slate-900 border-xl p-4 rounded-lg ">
                            <div class="flex justify-between">
                                <div class="p-2">
                                    <h2>DATA BARANG</h2>
                                </div>

                                <button type="submit"
                                    class="bg-sky-400 py-2 px-4 rounded-lg text-white hover:bg-sky-500">
                                    <i class="fa-solid fa-print"></i>
                                </button>

                            </div>
                        </div>
                        <div class="flex justify-center">
                            <div class="p-12" style="width:100%">
                                <table class="table table-bordered" id="detail-datatable">
                                    <thead>
                                        <tr>
                                            <th class="w-7">No.</th>
                                            <th>Item</th>
                                            <th>Kode</th>
                                            <th>Kategori</th>
                                            <th>Merk</th>
                                            <th>Ruang</th>
                                            <th>Harga</th>
                                            <th>Penyusutan</th>
                                            <th>Status</th>
                                            <th>Availability</th>
                                            {{-- <th>QR</th> --}}
                                            <th><input id="checked-checkbox" onchange="checkAll(this)" name="check"
                                                    type="checkbox"
                                                    class="w-4 h-4 text-blue-600 bg-white border-black border-2 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            </th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                </form>
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
                                    class="block mb-2 text-sm font-medium text-gray-900">Status</label>
                                <select class="js-example-placeholder-single js-states form-control w-[900px] m-6"
                                    id="sts" name="sts" data-placeholder="Pilih Status">
                                    <option value="">Pilih...</option>
                                    <option value="BAIK">BAIK</option>
                                    <option value="RUSAK">RUSAK</option>
                                    <option value="PINJAM">PINJAM</option>
                                </select>
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
    <script src="{{ asset('assets/js/dom-to-image.min.js') }}"></script>
    <script src="{{ asset('assets/js/qr-scanner.min.js') }}"></script>
    <script src="{{ asset('assets/js/qrcode.js') }}"></script>
    <script>
        let code;
        const showQRCode = () => {
            const canvas = document.getElementById('canvas');
            QRCode.toCanvas('heuheuheu', {
                errorCorrectionLevel: 'H'
            }, function(err, canvas) {
                if (err) throw err;
                code = canvas;
            })
        }
        console.log(code);
    </script>
    <script>
        $(document).ready(function() {
            $('#detail-datatable').DataTable({
                ajax: {
                    url: 'api/inventory_item_detail',
                    dataSrc: 'inventory_item_detail'
                },
                initComplete: function() {
                    $('#division-datatable thead th').css('text-align', 'center');
                },
                paging: false,
                columns: [{
                        data: 'no',
                        render: (data, type, row, meta) => {
                            return `<div style="text-align:center">${meta.row + 1}.</div>`;
                        }
                    }, {
                        data: 'barang',
                        render: (data, type, row) => {
                            return data.name;
                        }
                    }, {
                        data: 'id_item',
                        render: (data, type, row) => {
                            return data;
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
                        data: 'status',
                        render: (data, type, row) => {
                            let warnaHijau = `bg-green-400`;
                            let warnaMerah = `bg-red-500`;
                            let warnaKuning = `bg-amber-400`;
                            let badge;

                            if (data == 'BAIK') {
                                badge =
                                    `<small class='${warnaHijau} py-1 px-4 rounded-xl'>${data}</small>`;
                            } else if (data == 'RUSAK') {
                                badge =
                                    `<small class='${warnaMerah} py-1 px-4 rounded-xl text-white'>${data}</small>`;
                            } else {
                                badge =
                                    `<small class='${warnaKuning} py-1 px-4 rounded-xl'>${data}</small>`;
                            }

                            return badge;
                        }
                    }, {
                        data: 'availability',
                        render: (data, type, row) => {
                            return data;
                        }
                    },
                    {
                        data: 'id',
                        render: (data, type, row) => {
                            let selectUrl =
                                `
                                <div class="flex items-center justify-center">
                                    <input id="checked-checkbox" name="user_id[]" type="checkbox" value="${data}" class="w-4 h-4 text-blue-600 bg-white border-black border-2 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </div>
                                `;

                            return `
                        <div class='flex gap-2'>
                            <div style="text-align:center">${selectUrl}</div>
                        </div>`;
                        }
                    },
                ],
            });
        });

        const editSourceModal = (button) => {
            const formModal = document.getElementById('formSourceModal');
            const modalTarget = button.dataset.modalTarget;
            const id = button.dataset.id;
            const sts = button.dataset.sts;
            const name = button.dataset.name;
            let url = "{{ route('barang.update', ':id') }}".replace(':id', id);
            console.log(url);
            let status = document.getElementById(modalTarget);
            document.getElementById('title_source').innerText = `Update Status Barang ${name}`;
            document.getElementById('sts').value = sts;
            document.querySelector('[name="sts"]').value = sts;
            let event = new Event('change');
            document.querySelector('[name="sts"]').dispatchEvent(event);
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

        const barangDelete = async (id, name) => {
            let tanya = confirm(`Apakah anda yakin untuk menghapus ${name} ?`);
            if (tanya) {
                await axios.post(`/barang/${id}`, {
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
    <script>
        function checkAll(ele) {
            var checkboxes = document.getElementsByTagName('input');
            if (ele.checked) {
                for (var i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i].type == 'checkbox' && !(checkboxes[i].disabled)) {
                        checkboxes[i].checked = true;
                    }
                }
            } else {
                for (var i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i].type == 'checkbox') {
                        checkboxes[i].checked = false;
                    }
                }
            }
        }

        // $('#print-form').on('submit', function(e) {
        //     e.preventDefault();
        //     let form = $(this);
        //     let checked = $('#detail-datatable input[type="checkbox"]:checked');

        //     if (checked.length > 0) {
        //         form.append(checked.clone()).submit();
        //     } else {
        //         alert('Pilih dulu');
        //     }
        // });
    </script>

</x-app-layout>
