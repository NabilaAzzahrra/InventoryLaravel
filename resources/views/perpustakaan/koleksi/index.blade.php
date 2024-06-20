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
                        <form id="print-form" action="{{ route('koleksi.keluar') }}" method="POST" class="formupdate"
                            target="_blank">
                            @csrf
                            <div class="p-4 text-gray-900 w-full">
                                <div class="bg-slate-100 shadow-2xl border-slate-900 border-xl p-4 rounded-lg ">
                                    <div class="flex items-center justify-between">
                                        <h2>Data <span class="font-bold">Koleksi </span></h2>
                                        <div class="flex gap-1">
                                            <a href="{{ route('koleksi.create') }}">
                                                <div
                                                    class="bg-sky-400 py-2 px-4 rounded-lg text-white hover:bg-sky-500">
                                                    <i class="fa-solid fa-plus"></i>
                                                </div>
                                            </a>
                                            <div id="data-container"></div>
                                            <button type="submit"
                                                class="bg-sky-400 py-2 px-4 rounded-lg text-white hover:bg-sky-500">
                                                <i class="fa-solid fa-edit"></i> Koleksi Keluar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-center">
                                    <div class="w-full mt-5" style="width:100%">
                                        <table class="table table-bordered" id="koleksi-datatable">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Kode Koleksi</th>
                                                    <th>Judul Koleksi </th>
                                                    <th>Pengarang</th>
                                                    <th>Jenis</th>
                                                    <th>Penerbit</th>
                                                    <th>Tahun Terbit</th>
                                                    <th>Tanggal Masuk</th>
                                                    <th>Sumber</th>
                                                    <th>Check</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal HTML -->
        <div id="tanggalModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen">
                <div
                    class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900 bg-slate-200 rounded-xl p-2"
                                    id="modal-title">
                                    Pilih Tanggal
                                </h3>
                                <div class="mb-5 w-full mt-6">
                                    <label for="foto"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal
                                        Keluar
                                        <span class="text-red-500">*</span></label>
                                    <input
                                        class="block w-[430px] text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                        aria-describedby="user_avatar_help" id="tgl_keluar" name="tgl_keluar"
                                        type="date">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 gap-2 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button id="update-button" type="button"
                            class="bg-sky-400 py-2 px-4 rounded-lg text-white hover:bg-sky-500">
                            Update
                        </button>
                        <button id="cancel-button" type="button"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
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
            $('#koleksi-datatable').DataTable({
                ajax: {
                    url: 'api/koleksi',
                    dataSrc: 'koleksi'
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
                        data: 'kode_koleksi',
                        render: (data, type, row) => {
                            return data;
                        }
                    }, {
                        data: 'judul_buku',
                        render: (data, type, row) => {
                            return `<p class="text-wrap">${data}</p>`;
                        }
                    }, {
                        data: 'pengarang',
                        render: (data, type, row) => {
                            return data;
                        }
                    }, {
                        data: 'jenis',
                        render: (data, type, row) => {
                            return `<p class="text-wrap">${data.jenis}</p>`;
                        }
                    }, {
                        data: 'penerbit',
                        render: (data, type, row) => {
                            return data;
                        }
                    }, {
                        data: 'tahun_terbit',
                        render: (data, type, row) => {
                            return data;
                        }
                    }, {
                        data: 'tgl_masuk',
                        render: (data, type, row) => {
                            if (type === 'display' || type === 'filter') {
                                // Format data tgl_masuk ke format d/m/Y
                                const date = new Date(data);
                                const day = String(date.getDate()).padStart(2, '0');
                                const month = String(date.getMonth() + 1).padStart(2, '0');
                                const year = date.getFullYear();
                                return `${day}/${month}/${year}`;
                            } else {
                                // Jika tipe lainnya, kembalikan data aslinya
                                return data;
                            }
                        }
                    }, {
                        data: 'sumber',
                        render: (data, type, row) => {
                            return data.sumber;
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
                    }, {
                        data: {
                            no: 'no',
                            judul_buku: 'judul_buku'
                        },
                        render: (data) => {
                            var mo = "{{ route('koleksi.show', ':id') }}".replace(
                                ':id',
                                data.id
                            );
                            let moreUrl = `
                                <button type="button" onclick="window.location.href='${mo}'" class="bg-amber-300 hover:bg-amber-400 px-3 py-1 rounded-md text-xs text-white">
                                    <i class="fa-solid fa-circle-info text-white"></i>
                                </button>`;
                            let deleteUrl =
                                `<button type="button" onclick="return koleksiDelete('${data.id}','${data.judul_buku}')" class="bg-red-500 hover:bg-bg-red-300 px-3 py-1 rounded-md text-xs text-white"><i class="fas fa-trash"></i></button>`;
                            return `
                        <div class='flex gap-2'>
                            <div style="text-align:center">${deleteUrl}</div>
                            <div style="text-align:center">${moreUrl}</div>
                        </div>`;
                        }
                    },
                ],
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('print-form');
            const updateButton = document.getElementById('update-button');
            const cancelButton = document.getElementById('cancel-button');
            const modal = document.getElementById('tanggalModal');
            const tglKeluarInput = document.getElementById('tgl_keluar');

            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Mencegah form submit langsung
                modal.classList.remove('hidden'); // Menampilkan modal
            });

            updateButton.addEventListener('click', function() {
                const selectedIds = Array.from(document.querySelectorAll('input[name="user_id[]"]:checked'))
                    .map(cb => cb.value);
                const tglKeluar = tglKeluarInput.value;

                if (selectedIds.length === 0 || !tglKeluar) {
                    alert('Pilih minimal satu item dan tanggal keluar.');
                    return;
                }

                const dataContainer = document.getElementById('data-container');
                dataContainer.innerHTML = '';

                selectedIds.forEach(id => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'user_id[]';
                    input.value = id;
                    dataContainer.appendChild(input);
                });

                const tglKeluarHiddenInput = document.createElement('input');
                tglKeluarHiddenInput.type = 'hidden';
                tglKeluarHiddenInput.name = 'tgl_keluar';
                tglKeluarHiddenInput.value = tglKeluar;
                dataContainer.appendChild(tglKeluarHiddenInput);

                form.submit();
            });

            cancelButton.addEventListener('click', function() {
                modal.classList.add('hidden');
            });
        });

        const koleksiDelete = async (id, judul_buku) => {
            let tanya = confirm(`Apakah anda yakin untuk menghapus ${judul_buku} ?`);
            if (tanya) {
                await axios.post(`/koleksi/${id}`, {
                        '_method': 'DELETE',
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    })
                    .then(function(response) {
                        location.reload();
                    })
                    .catch(function(error) {
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
    </script>
</x-app-layout>
