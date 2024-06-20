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
                        <div class="p-4 text-gray-900 w-full">
                            <div class="bg-slate-100 shadow-2xl border-slate-900 border-xl p-4 rounded-lg ">
                                <div class="flex items-center justify-between">
                                    <h2>Tambah Data <span class="font-bold">Koleksi </span></h2>
                                </div>
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
                                    {{-- TANGGAL --}}
                                    <div class="flex items-center gap-3 {{$masuk}}">
                                        <i class="fa-solid fa-calendar-days"></i>
                                        <span class="font-bold">Tanggal Masuk</span>
                                    </div>
                                    <p class="my-2 {{$masuk}}">{{ $koleksi->tgl_masuk }}</p>

                                    <div class="flex items-center gap-3 {{$keluar}}">
                                        <i class="fa-solid fa-calendar-days"></i>
                                        <span class="font-bold">Tanggal Keluar</span>
                                    </div>
                                    <p class="my-2 {{$keluar}}">{{ $koleksi->tgl_keluar }}</p>
                                    {{-- ==== --}}

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

                                    <button type="button"
                                        onclick="window.location.href='{{ route('koleksi.edit', $koleksi->id_koleksi) }}'"
                                        class="mt-4 bg-white border border-2 border-black hover:bg-black hover:text-white px-3 py-1 rounded-full shadow-md text-md text-black">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </button>
                                    <button type="button"
                                        onclick="window.location.href='{{ route('koleksi.index') }}'"
                                        class="mt-4 bg-amber-300 hover:bg-black px-3 py-1 rounded-full shadow-md text-md text-black border border-2 border-black border-black hover:bg-black hover:text-white">
                                        <i class="fa-solid fa-arrow-rotate-left"></i> Kembali
                                    </button>
                                </div>
                                <div class="p-12" style="width:100%">
                                    <img src="{{ url('uploads/' . $koleksi->foto) }}" alt="{{ $koleksi->judul_buku }}"
                                        class="w-full h-auto">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
