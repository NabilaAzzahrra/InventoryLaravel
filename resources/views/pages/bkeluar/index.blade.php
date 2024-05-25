<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="px-2 max-w-7sm gap-8 justify-center mx-auto sm:px-6 lg:px-8 md:flex lg:flex">

            <div class="bg-white my-2 overflow-hidden shadow-lg w-full rounded-lg lg:rounded-lg md:rounded-lg">

                <div class="p-4 text-gray-900 w-full">
                    <div class="bg-slate-100 shadow-2xl border-slate-900 border-xl p-4 rounded-lg ">
                        <div class="flex justify-between">
                            <div class="p-2">
                                <h2>DATA BARANG KELUAR</h2>
                            </div>
                            <div>
                                <button onclick="filter(this)" data-modal-target="sourceModal"
                                    class="bg-sky-400 py-2 px-4 rounded-lg text-white hover:bg-sky-500"><i
                                        class="fa-solid fa-filter"></i></button>
                                <button onclick="exportExcel()"
                                    class="bg-amber-400 py-2 px-4 rounded-lg text-white hover:bg-amber-500"><i
                                        class="fa-solid fa-file-excel"></i>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <div class="p-12" style="width:100%">
                            <table class="table table-bordered" id="bkeluar-datatable">
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
                                        <th>Status</th>
                                        <th>Availability</th>
                                        <th>Waktu</th>
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
                                Filter Tanggal Barang Keluar
                            </h3>
                            <button type="button" onclick="sourceModalClose(this)" data-modal-target="sourceModal"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center"
                                data-modal-hide="defaultModal">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                        <div class="flex flex-col p-4 space-y-6">
                            <div>
                                <label for="from_date" class="block mb-2 text-sm font-medium text-gray-900">Dari
                                    Tanggal</label>
                                <input type="date" id="from_date" name="from_date"
                                    class="px-3 py-2 border shadow rounded w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-pink-700 invalid:focus:ring-pink-700 invalid:focus:border-pink-700 peer hover:shadow-lg"
                                    placeholder="Masukan tanggal awal disini...">
                            </div>
                            <div>
                                <label for="to_date" class="block mb-2 text-sm font-medium text-gray-900">Sampai
                                    Tanggal</label>
                                <input type="date" id="to_date" name="to_date"
                                    class="px-3 py-2 border shadow rounded w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-pink-700 invalid:focus:ring-pink-700 invalid:focus:border-pink-700 peer hover:shadow-lg"
                                    placeholder="Masukan tanggal akhir disini...">
                            </div>
                        </div>
                        <div class="flex items-center p-4 space-x-2 border-t border-gray-200 rounded-b">
                            <button id="formSourceButton" onclick="changeFilterDataRegisterProgram()"
                                class="bg-green-400 m-2 w-40 h-10 rounded-xl hover:bg-green-500">Simpan</button>
                            <button type="button" data-modal-target="sourceModal"
                                class="bg-red-500 m-2 w-40 h-10 rounded-xl text-white hover:shadow-lg hover:bg-red-600">Batal</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/exceljs.min.js') }}"></script>
        <script>
            var dataNabil;
            let dataTableDataRegisterProgramInstance;
            let dataTableDataRegisterProgramInitialized = false;
            let urlItemDetail =
                `/api/inventory_item_detail`;
        </script>
        <script>
            const changeFilterDataRegisterProgram = () => {
                let queryParams = [];

                let fromDate = document.getElementById('from_date').value;
                let toDate = document.getElementById('to_date').value;

                if (fromDate !== 'all' && toDate !== 'all') {
                    queryParams.push(`fromDate=${fromDate}`);
                    queryParams.push(`toDate=${toDate}`);
                    queryParams.push(`barang=0`);
                }

                let queryString = queryParams.join('&');

                urlItemDetail = `/api/inventory_item_detail?${queryString}`;

                if (dataTableDataRegisterProgramInstance) {
                    dataTableDataRegisterProgramInstance.clear();
                    dataTableDataRegisterProgramInstance.destroy();
                    getDataTableRegisterProgram()
                        .then((response) => {
                            dataTableDataRegisterProgramInstance = $('#bkeluar-datatable').DataTable(
                                response
                                .config);
                            dataTableDataRegisterProgramInitialized = response.initialized;
                            document.getElementById('sourceModal').classList.add('hidden');
                        })
                        .catch((error) => {
                            console.log(error);
                        });
                }
            }

            const getDataTableRegisterProgram = async () => {
                return new Promise(async (resolve, reject) => {
                    try {
                        const response = await axios.get(urlItemDetail);
                        let registers = response.data.inventory_item_detail;
                        console.log(registers);
                        dataNabil = registers;

                        let columnConfigs = [{
                                data: 'no',
                                render: (data, type, row, meta) => {
                                    return `<div style="text-align:center">${meta.row + 1}.</div>`;
                                },
                            },
                            {
                                data: 'id_item',
                                render: (data, type, row, meta) => {
                                    return data;
                                }
                            }, {
                                data: 'barang',
                                render: (data, type, row, meta) => {
                                    return data.name;
                                }
                            },
                            {
                                data: 'barang',
                                render: (data, type, row, meta) => {
                                    return data.kategori.category;
                                }
                            },
                            {
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
                            },{
                                data: 'status',
                                render: (data, type, row) => {
                                    return data;
                                }
                            },{
                                data: 'availability',
                                render: (data, type, row) => {
                                    return data;
                                }
                            }, {
                                data: 'barang',
                                render: (data, type, row) => {
                                    const date = new Date(data.created_at);

                                    const day = date.getDate().toString().padStart(2,
                                        '0');
                                    const month = (date.getMonth() + 1).toString().padStart(2,
                                        '0');
                                    const year = date.getFullYear();

                                    return `${day}/${month}/${year}`;
                                }
                            },
                        ];

                        const dataTableConfig = {
                            data: registers,
                            columnDefs: [{
                                width: 50,
                                target: 0
                            }],
                            createdRow: (row, data, index) => {
                                if (index % 2 === 0) {
                                    $(row).css('background-color', '#f9fafb');
                                }
                            },
                            columns: columnConfigs,
                        }

                        let results = {
                            config: dataTableConfig,
                            initialized: true
                        }

                        resolve(results);
                    } catch (error) {
                        reject(error)
                    }
                });
            }
        </script>
        <script>
            const promiseDataRegisterProgram = () => {

                Promise.all([
                        getDataTableRegisterProgram(),
                    ])
                    .then((response) => {
                        let responseDTRS = response[0];
                        dataTableDataRegisterProgramInstance = $('#bkeluar-datatable').DataTable(
                            responseDTRS
                            .config);
                        dataTableDataRegisterProgramInitialized = responseDTRS.initialized;

                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
            promiseDataRegisterProgram();
        </script>
    @endpush

    <script>
        const filter = (button) => {
            const formModal = document.getElementById('formSourceModal');
            const modalTarget = button.dataset.modalTarget;

            document.getElementById('title_source').innerText = `Filter Tanggal Barang Masuk`;

            let modal = document.getElementById(modalTarget);
            modal.classList.remove('hidden');
        }

        const sourceModalClose = (button) => {
            const modalTarget = button.dataset.modalTarget;
            let status = document.getElementById(modalTarget);
            status.classList.toggle('hidden');
        }
    </script>
    <script>
        const exportExcel = async () => {
            console.log(dataNabil)
            try {
                const workbook = new ExcelJS.Workbook();
                const worksheet = workbook.addWorksheet('Data');
                let header = ['No', 'Kode', 'Barang', 'Kategori', 'Merk', 'Ruang', 'Harga', 'Penyusutan', 'status', 'availability', 'Waktu'];
                let dataExcel = [
                    header,
                ];
                dataNabil.forEach((data, index) => {
                    let studentBucket = [];
                    const date = new Date(data.barang.created_at);
                    const day = date.getDate().toString().padStart(2,
                    '0'); 
                    const month = (date.getMonth() + 1).toString().padStart(2,
                    '0'); 
                    const year = date.getFullYear();
                    const formattedDate = `${day}/${month}/${year}`;
                    studentBucket.push(
                        `${index + 1}`,
                        `${data.id_item}`,
                        `${data.barang.name}`,
                        `${data.barang.kategori.category}`,
                        `${data.barang.kategori.merk.merk}`,
                        `${data.barang.room.room}`,
                        `${data.barang.price}`,
                        `${data.barang.cost_of_depreciation}`,
                        `${data.status}`,
                        `${data.availability}`,
                        formattedDate
                    );
                    dataExcel.push(studentBucket);
                });

                worksheet.addRows(dataExcel);

                const blob = await workbook.xlsx.writeBuffer();
                const blobData = new Blob([blob], {
                    type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                });

                const link = document.createElement('a');
                link.href = window.URL.createObjectURL(blobData);
                link.download = `nabilaaa.xlsx`;

                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);

            } catch (error) {
                console.error('Error:', error);
            }
        };
    </script>
</x-app-layout>
