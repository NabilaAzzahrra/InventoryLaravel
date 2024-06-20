<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DETAIL BARANG</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <!-- POPPINS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-300 h-screen flex items-center justify-center">
    <div class="flex items-center justify-center h-full">
            <div class="bg-white md:w-2/3 overflow-hidden shadow-sm sm:rounded-lg flex flex-col">
                <div class="p-6 text-gray-900 flex-1">
                    <div class="flex">
                        <h1 class="font-extrabold underline underline-offset-8 mb-5">DETAIL DATA KOLEKSI PERPUSTAKAAN POLITEKNIK LP3I KAMPUS TASIKMALAYA</h1>
                    </div>
                    <div class="flex justify-center">
                        <div class="p-12" style="width:100%">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-code"></i>
                                <span class="font-bold">Kode Koleksi</span>
                            </div>
                            <p class="my-2">{{ $koleksi->kode_koleksi }}</p>
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-book"></i>
                                <span class="font-bold">Judul Koleksi</span>
                            </div>
                            <p class="my-2">{{ $koleksi->judul_buku }}</p>
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-user"></i>
                                <span class="font-bold">Pengarang</span>
                            </div>
                            <p class="my-2">{{ $koleksi->pengarang }}</p>
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-tag"></i>
                                <span class="font-bold">Jenis</span>
                            </div>
                            <p class="my-2">{{ $koleksi->jenis }}</p>
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-at"></i>
                                <span class="font-bold">Penerbit</span>
                            </div>
                            <p class="my-2">{{ $koleksi->penerbit }}</p>
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-calendar-days"></i>
                                <span class="font-bold">Tahun Terbit</span>
                            </div>
                            <p class="my-2">{{ $koleksi->tahun_terbit }}</p>

                            @php
                                if ($koleksi->ketersediaan == 'AVAILABLE') {
                                    $keluar = 'hidden';
                                    $masuk = '';
                                } else {
                                    $keluar = '';
                                    $masuk = 'hidden';
                                }
                            @endphp
                            <!-- TANGGAL -->
                            <div class="flex items-center gap-3 {{ $masuk }}">
                                <i class="fa-solid fa-calendar-days"></i>
                                <span class="font-bold">Tanggal Masuk</span>
                            </div>
                            <p class="my-2 {{ $masuk }}">{{ $koleksi->tgl_masuk }}</p>

                            <div class="flex items-center gap-3 {{ $keluar }}">
                                <i class="fa-solid fa-calendar-days"></i>
                                <span class="font-bold">Tanggal Keluar</span>
                            </div>
                            <p class="my-2 {{ $keluar }}">{{ $koleksi->tgl_keluar }}</p>
                            <!-- ==== -->

                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-file"></i>
                                <span class="font-bold">Sumber</span>
                            </div>
                            <p class="my-2">{{ $koleksi->sumber }}</p>
                            <div class="flex items-center gap-3">
                                <i class="fa-brands fa-dropbox"></i>
                                <span class="font-bold">Ketersediaan</span>
                            </div>
                            <p class="my-2">{{ $koleksi->ketersediaan }}</p>
                        </div>
                        <div class="p-12" style="width:100%">
                            <img src="{{ url('uploads/' . $koleksi->foto) }}" alt="{{ $koleksi->judul_buku }}" class="w-full h-auto">
                        </div>
                    </div>
                </div>
            </div>
    </div>
</body>

</html>
