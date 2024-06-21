<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DETAIL BARANG</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    {{-- POPPINS --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-300 mx-auto">
    <div class="py-7 flex items-center justify-center">
        <div class="max-w-8xl flex flex-col md:flex-row gap-5 mx-auto sm:px-6 lg:px-52">
            <div class="bg-white md:w-2/3 overflow-hidden shadow-sm sm:rounded-lg flex flex-col">
                <div class="p-6 text-gray-900 flex-1">
                    <div class="flex">
                        <h1 class="font-extrabold underline underline-offset-8 mb-5">DETAIL DATA BARANG</h1>
                    </div>
                    <p class="mb-2"><span class="font-bold">Kode Barang</span> :
                    </p>
                    <p class="text-slate-500">{{ $inventory_item_detail->id_item }}</p>
                    <p class="mb-2"><span class="font-bold">Nama Barang</span> :
                    </p>
                    <p class="text-slate-500">{{ $inventory_item_detail->name }}</p>
                    <p class="mb-2"><span class="font-bold">Lantai</span> : </p>
                    <p class="text-slate-500">{{ $inventory_item_detail->floor }}</p>
                    <p class="mb-2"><span class="font-bold">Ruang</span> : </p>
                    <p class="text-slate-500">{{ $inventory_item_detail->room }}</p>
                    <p class="mb-2"><span class="font-bold">Kategori</span> :
                    </p>
                    <p class="text-slate-500">{{ $inventory_item_detail->category }}</p>
                    <p class="mb-2"><span class="font-bold">Divisi</span> : </p>
                    <p class="text-slate-500">{{ $inventory_item_detail->division }}</p>
                    <p class="mb-2"><span class="font-bold">Detail Informasi</span> : </p>
                    <p class="text-slate-500"><span class="text-wrap">{{ $inventory_item_detail->information }}</span>
                    </p>
                    @php
                        $bg = '';
                        if ($inventory_item_detail->status == 'BAIK') {
                            $bg = 'bg-green-400';
                        } elseif ($inventory_item_detail->status == 'RUSAK') {
                            $bg = 'bg-red-500 text-white';
                        } else {
                            $bg = 'bg-amber-400';
                        }

                        $icon = '';
                        if ($inventory_item_detail->availability === 'AVAILABLE') {
                            $icon = '<i class="fa-solid fa-circle-check text-green-400 text-md"></i>';
                        } else {
                            $icon = '<i class="fa-solid fa-circle-xmark text-red-500 text-md"></i>';
                        }
                    @endphp
                    <p class="mb-2"><span class="font-bold">Status</span> :
                    </p>
                    <p class="mb-2"><span
                            class="{{ $bg }} py-1 px-6 rounded-xl text-sm font-bold">{{ $inventory_item_detail->status }}</span>
                    </p>
                    <p class="mb-2"><span class="font-bold">Ketersediaan</span> :
                    </p>
                    <p class="text-slate-500">{{ $inventory_item_detail->availability }} {!! $icon !!}</p>
                    <p class="mb-2"><span class="font-bold">Harga</span> : </p>
                    <p class="text-slate-500">{{ $inventory_item_detail->price }}</p>
                    <p class="mb-2"><span class="font-bold">Penyusutan</span> :
                    </p>
                    <p class="mb-5 text-slate-500">{{ $inventory_item_detail->cost_of_depreciation }}</p>
                    <div id="loan-container" data-availability="{{ $inventory_item_detail->availability }}"
                        data-status="{{ $inventory_item_detail->status }}">
                        <a href="#" id="loan-button"
                            onclick="return editSourceModal(`{{ $inventory_item_detail->id_inventory_item }}`)"
                            data-availability="{{ $inventory_item_detail->availability }}"
                            data-status="{{ $inventory_item_detail->status }}">
                            <div class="bg-sky-400 w-56 text-center p-1 rounded-xl mt-5">Ajukan Peminjaman Barang</div>
                    </div>
                    </a>

                    <div class="flex gap-5">
                        <?php
                        $id = $inventory_item_detail->id_inventory_item;
                        ?>
                    </div>
                </div>
            </div>
            <div class="md:w-1/3 bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-col">
                <div class="p-6 text-gray-900 flex-1">
                    <p class="mb-5"><span class="font-bold">FAKTUR</span></p>
                    <img src="{{ url('uploads/' . $inventory_item_detail->invoice) }}"
                        alt="{{ $inventory_item_detail->name }}" class="w-full h-auto">
                </div>
                <div class="p-6 text-gray-900 flex-1">
                    <p class="mb-5"><span class="font-bold">FOTO</span></p>
                    <img src="{{ url('picture/' . $inventory_item_detail->picture) }}"
                        alt="{{ $inventory_item_detail->name }}" class="w-full h-auto">
                </div>
            </div>
        </div>
    </div>

    <div class="fixed inset-0 flex items-center justify-center z-50 hidden" id="sourceModal">
        <div class="fixed inset-0 bg-black opacity-50"></div>
        <div class="fixed inset-0 flex items-center justify-center">
            <div class="w-full md:w-1/2 relative bg-white rounded-lg shadow mx-5">
                <div class="flex items-start justify-between p-4 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900" id="title_source">Tambah Sumber Database</h3>
                    <button type="button" onclick="sourceModalClose()"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <form method="POST" id="formSourceModal" enctype="multipart/form-data">
                    @csrf
                    <div id="peminjamanForm" class="flex flex-col hidden p-4 space-y-6">
                        <input type="hidden" name="idItem" id="idItem">
                        <input type="hidden" name="judulPinjam" id="judulPinjam" value="PEMINJAMAN">
                        <input type="hidden" name="pesan" id="pesan" value="BELUM DIKEMBALIKAN">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama
                                Lengkap</label>
                            <input type="text" id="name" name="name"
                                class="px-3 py-2 border shadow rounded w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-pink-700 invalid:focus:ring-pink-700 invalid:focus:border-pink-700 peer hover:shadow-lg"
                                placeholder="Masukan Nama disini..." required>
                        </div>
                        <div class="flex gap-4">
                            <div class="w-full">
                                <label for="classes"
                                    class="block mb-2 text-sm font-medium text-gray-900">Kelas</label>
                                <input type="text" id="classes" name="classes"
                                    class="px-3 py-2 border shadow rounded w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-pink-700 invalid:focus:ring-pink-700 invalid:focus:border-pink-700 peer hover:shadow-lg"
                                    placeholder="Masukan Kelas disini..." required>
                            </div>
                            <div class="w-full">
                                <label for="no_hp" class="block mb-2 text-sm font-medium text-gray-900">Nomor
                                    Handphone</label>
                                <input type="text" id="no_hp" name="no_hp"
                                    class="px-3 py-2 border shadow rounded w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-pink-700 invalid:focus:ring-pink-700 invalid:focus:border-pink-700 peer hover:shadow-lg"
                                    placeholder="Masukan Nomor Handphone disini..." required>
                            </div>
                        </div>
                        <div>
                            <label for="keperluan" class="block mb-2 text-sm font-medium text-gray-900">Keperluan
                                Untuk</label>
                            <textarea id="keperluan" name="keperluan"
                                class="px-3 py-2 border shadow rounded w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-pink-700 invalid:focus:ring-pink-700 invalid:focus:border-pink-700 peer hover:shadow-lg"
                                placeholder="Masukan keterangan keperluan disini..." required></textarea>
                        </div>
                        <div class="w-full">
                            <label for="file" class="block mb-2 text-sm font-medium text-gray-900">Surat
                                Peminjaman</label>
                            <input type="file" id="file" name="file"
                                class="px-3 py-2 border shadow rounded w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500 invalid:text-pink-700 invalid:focus:ring-pink-700 invalid:focus:border-pink-700 peer hover:shadow-lg"
                                required>
                        </div>
                    </div>
                    <div class="flex items-center p-4 space-x-2 border-t border-gray-200 rounded-b">
                        <button type="submit" id="formSourceButtonPinjam"
                            class="bg-green-400 m-2 w-40 h-10 rounded-xl hidden hover:bg-green-500"
                            onclick="handleSave()">Simpan</button>
                        <button type="button" onclick="sourceModalClose()"
                            class="bg-red-500 m-2 w-40 h-10 rounded-xl text-white hover:shadow-lg hover:bg-red-600">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="fixed inset-0 flex items-center justify-center z-50 hidden" id="sourceModalKembali">
        <div class="fixed inset-0 bg-black opacity-50"></div>
        <div class="fixed inset-0 flex items-center justify-center">
            <div class="w-full md:w-1/2 relative bg-white rounded-lg shadow mx-5">
                <div class="flex items-start justify-between p-4 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900" id="title_source_kembali">Tambah Sumber Database
                    </h3>
                    <button type="button" onclick="sourceModalKembaliClose()"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <form method="POST" id="formSourceModalKembali" enctype="multipart/form-data"
                    action="{{ route('scanqr.update', ['id' => '__ID__']) }}">
                    @csrf
                    <div id="pengembalianForm" class="hidden">
                        <input type="text" name="idItemKembali"
                            id="idItemKembali">
                        <input type="hidden" name="judulKembali" id="judulKembali" value="PENGEMBALIAN">
                        <input type="hidden" name="ItemStatus" id="ItemStatus" value="BORROWED">
                        <input type="hidden" name="pesanKembali" id="pesanKembali" value="SUDAH DIKEMBALIKAN">
                        <input type="hidden" name="nameKembali" id="nameKembali"
                            value="{{ $inventory_landing->name ?? '' }}">
                        <input type="hidden" name="classesKembali" id="classesKembali"
                            value="{{ $inventory_landing->classes ?? '' }}">
                        <input type="hidden" name="no_hpKembali" id="no_hpKembali"
                            value="{{ $inventory_landing->no_hp ?? '' }}">
                        <input type="hidden" name="keperluanKembali" id="keperluanKembali"
                            value="{{ $inventory_landing->needs ?? 'kosong neng' }}">
                        <p class="font-bold p-4">Apakah anda yakin untuk melakukan pengembalian barang?</p>
                    </div>
                    <div class="flex items-center p-4 space-x-2 border-t border-gray-200 rounded-b">
                        <button type="submit" id="formSourceButtonKembali" onclick="handleSaveReturn()"
                            class="bg-amber-400 m-2 w-40 h-10 rounded-xl hidden hover:bg-amber-500">Ajukan</button>
                        <button type="button" onclick="sourceModalKembaliClose()"
                            class="bg-red-500 m-2 w-40 h-10 rounded-xl text-white hover:shadow-lg hover:bg-red-600">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        const editSourceModal = (id) => {
            const formModal = document.getElementById('formSourceModal');
            const sourceModal = document.getElementById('sourceModal');
            const peminjaman = document.getElementById('peminjamanForm');
            const pengembalian = document.getElementById('pengembalianForm');
            const savePinjam = document.getElementById('formSourceButtonPinjam');
            const saveKembali = document.getElementById('formSourceButtonKembali');

            // Set judul dan id item
            document.getElementById('title_source').innerText = 'Ajukan Peminjaman Barang';
            document.getElementById('idItem').value = id;
            document.getElementById('formSourceButtonPinjam').innerText = 'Simpan';

            // Tampilkan modal
            sourceModal.classList.remove('hidden');
            peminjaman.classList.remove('hidden');
            pengembalian.classList.add('hidden');
            savePinjam.classList.remove('hidden');
            saveKembali.classList.add('hidden');

            // Set URL aksi form
            let url = "{{ route('scanqr.store') }}";
            formModal.setAttribute('action', url);

            // Tambahkan token CSRF jika belum ada
            let existingCsrf = formModal.querySelector('input[name="_token"]');
            if (existingCsrf) {
                formModal.removeChild(existingCsrf);
            }

            let csrfToken = document.createElement('input');
            csrfToken.setAttribute('type', 'hidden');
            csrfToken.setAttribute('name', '_token');
            csrfToken.setAttribute('value', '{{ csrf_token() }}');
            formModal.appendChild(csrfToken);

            return false;
        }

        const pengembalianSourceModal = (id, ItemStatus) => {
            const formModal = document.getElementById('formSourceModalKembali');
            const sourceModal = document.getElementById('sourceModalKembali');
            const pengembalian = document.getElementById('pengembalianForm');
            const peminjaman = document.getElementById('peminjamanForm');
            const savePinjam = document.getElementById('formSourceButtonPinjam');
            const saveKembali = document.getElementById('formSourceButtonKembali');

            document.getElementById('title_source_kembali').innerText = 'Ajukan Pengembalian Barang';
            document.getElementById('idItemKembali').value = id;
            document.getElementById('formSourceButtonKembali').innerText = 'Ajukan';

            sourceModal.classList.remove('hidden');
            pengembalian.classList.remove('hidden');
            peminjaman.classList.add('hidden');
            savePinjam.classList.add('hidden');
            saveKembali.classList.remove('hidden');

            const actionUrl = formModal.getAttribute('action').replace('__ID__', id);
            formModal.setAttribute('action', actionUrl);

            return false;
        }

        const handleSave = () => {
            const nameElement = document.getElementById('name');
            const kelasElement = document.getElementById('classes');
            const keperluanElement = document.getElementById('keperluan');
            const judulElement = document.getElementById('judulPinjam');
            const pesanElement = document.getElementById('pesan');
            const noHpElement = document.getElementById('no_hp');
            if (!noHpElement) {
                console.error('Element with ID "no_hp" not found');
                return false;
            }

            const noHpValue = noHpElement.value;
            const newNoHpValue = noHpValue ? `${noHpValue}@c.us` : '';

            if (!newNoHpValue) {
                console.error('No HP tidak ditemukan atau kosong');
                return false;
            }

            const idElement = document.getElementById('idItem');
            if (!idElement) {
                console.error('Element with ID "idItem" not found');
                return false;
            }

            const id = idElement.value;
            const name = nameElement.value;
            const kelas = kelasElement.value;
            const keperluan = keperluanElement.value;
            const judul = judulElement.value;
            const pesan = pesanElement.value;

            const data = {
                name: name,
                kelas: kelas,
                keperluan: keperluan,
                id: id,
                phone: newNoHpValue,
                judul: judul,
                pesan: pesan,
            }

            console.log(data);

            sendMessage(data);

            return false;
        }

        const handleSaveReturn = () => {
            const nameElement = document.getElementById('nameKembali');
            const kelasElement = document.getElementById('classesKembali');
            const keperluanElement = document.getElementById('keperluanKembali');
            const judulElement = document.getElementById('judulKembali');
            const pesanElement = document.getElementById('pesanKembali');
            const noHpElement = document.getElementById('no_hpKembali');
            if (!noHpElement) {
                console.error('Element with ID "no_hp" not found');
                return false;
            }

            const noHpValue = noHpElement.value;
            const newNoHpValue = noHpValue ? `${noHpValue}@c.us` : '';

            if (!newNoHpValue) {
                console.error('No HP tidak ditemukan atau kosong');
                return false;
            }

            const idElement = document.getElementById('idItemKembali');
            if (!idElement) {
                console.error('Element with ID "idItem" not found');
                return false;
            }

            const id = idElement.value;
            const name = nameElement.value;
            const kelas = kelasElement.value;
            const keperluan = keperluanElement.value;
            const judul = judulElement.value;
            const pesan = pesanElement.value;

            const data = {
                name: name,
                kelas: kelas,
                keperluan: keperluan,
                id: id,
                phone: newNoHpValue,
                judul: judul,
                pesan: pesan
            }

            console.log(data);

            sendMessage(data);

            return false;
        }

        const sourceModalClose = () => {
            const sourceModal = document.getElementById('sourceModal');
            sourceModal.classList.add('hidden');
        }

        const sourceModalKembaliClose = () => {
            const sourceModal = document.getElementById('sourceModalKembali');
            sourceModal.classList.add('hidden');
        }

        const sendMessage = async (data) => {
            await axios.post(`http://localhost:3000/send`, {
                    id: data.id,
                    name: data.name,
                    kelas: data.kelas,
                    keperluan: data.keperluan,
                    phone: data.phone,
                    judul: data.judul,
                    pesan: data.pesan,
                })
                .then((response) => {
                    console.log(response.data);
                })
                .catch((error) => {
                    console.log(error);
                });
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var loanContainer = document.getElementById('loan-container');
            if (!loanContainer) return;

            var availability = loanContainer.getAttribute('data-availability');
            var status = loanContainer.getAttribute('data-status');

            if (status === 'PINJAM' && availability === 'NOT AVAILABLE') {
                loanContainer.innerHTML =
                    '<a href="#" id="loan-button" onclick="return pengembalianSourceModal(`{{ $inventory_item_detail->id_inventory_item }}`)" data-availability="{{ $inventory_item_detail->availability }}" data-status="{{ $inventory_item_detail->status }}"><div class="bg-amber-400 w-56 text-center p-1 rounded-xl mt-5">Ajukan Pengembalian Barang</div></a>';
            } else if (status === 'RUSAK') {
                loanContainer.innerHTML =
                    '<div class="bg-slate-400 w-56 text-center p-1 rounded-xl mt-5">Barang Tidak Tersedia</div>';
                loanContainer.style.pointerEvents = 'none';
                loanContainer.removeAttribute('onclick');
            } else if (status === 'MAINTENANCE') {
                loanContainer.innerHTML =
                    '<div class="bg-slate-400 w-56 text-center p-1 rounded-xl mt-5">Barang Tidak Tersedia</div>';
                loanContainer.style.pointerEvents = 'none';
                loanContainer.removeAttribute('onclick');
            } else if (availability === 'NOT AVAILABLE') {
                loanContainer.innerHTML =
                    '<div class="bg-gray-400 w-56 text-center p-1 rounded-xl mt-5">Barang Tidak Tersedia</div>';
                loanContainer.style.pointerEvents = 'none';
                loanContainer.removeAttribute('onclick');
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const input = document.getElementById('no_hp');
            const submitBtn = document.getElementById('formSourceButton');
            const form = document.getElementById('formSourceModal');

            input.addEventListener('input', function(e) {
                const value = e.target.value;

                if (!value.startsWith('62')) {
                    e.target.value = '62';
                }

                if (value === '62' || value === '628') {
                    e.target.value = value;
                } else if (value.length === 3 && value[2] !== '8') {
                    e.target.value = '628';
                }

                if (value.length > 14) {
                    e.target.value = value.slice(0, 14);
                }

                submitBtn.disabled = value.length < 12;
            });

            input.value = '62';

            form.addEventListener('submit', function(e) {
                if (input.value.length < 12) {
                    e.preventDefault();
                    alert('Nomor Handphone harus terdiri dari minimal 13 karakter.');
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const nameInput = document.getElementById('name');
            const classesInput = document.getElementById('classes');
            const nohpInput = document.getElementById('no_hp');
            const keperluanInput = document.getElementById('keperluan');

            nameInput.addEventListener('input', function(e) {
                e.target.value = e.target.value.toUpperCase();
            });
            classesInput.addEventListener('input', function(e) {
                e.target.value = e.target.value.toUpperCase();
            });
            nohpInput.addEventListener('input', function(e) {
                e.target.value = e.target.value.toUpperCase();
            });
            keperluanInput.addEventListener('input', function(e) {
                e.target.value = e.target.value.toUpperCase();
            });
        });
    </script>

</body>

</html>
