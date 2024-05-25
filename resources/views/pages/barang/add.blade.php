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
                        <h2>TAMBAH DATA BARANG</h2>
                    </div>
                    <div class="flex justify-center">
                        <div class="p-12" style="width:100%">
                            <form method="POST" action="{{ route('barang.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="grid grid-cols-4 gap-5">
                                    <div class="mb-5 w-full"hidden>
                                        <label for="kode"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode
                                            Barang
                                            <span class="text-red-500">*</span></label>
                                        <input type="text" id="kode" name="kode"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Masukan Kode...." value="{{ $kode_barang }}" />
                                        <span class="text-sm m-l text-red-500">{{ $errors->first('kode') }}</span>
                                    </div>
                                    <div class="mb-5 w-full">
                                        <label for="kodes"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode
                                            Barang
                                            <span class="text-red-500">*</span></label>
                                        <input type="text" id="kodes" name="kodes"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Masukan Kode...." value="{{ $kode_barang }}" />
                                        <span class="text-sm m-l text-red-500">{{ $errors->first('kodes') }}</span>
                                    </div>
                                    <div class="mb-5 w-full">
                                        <label for="barang"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Barang
                                            <span class="text-red-500">*</span></label>
                                        <input type="text" id="barang" name="barang"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Masukan Barang...." />
                                        <span class="text-sm m-l text-red-500">{{ $errors->first('barang') }}</span>
                                    </div>
                                    <div class="mb-5 w-full">
                                        <label for="lantai"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lantai
                                            <span class="text-red-500">*</span></label>
                                        <select
                                            class="js-example-placeholder-single js-states form-control w-[400px] m-4"
                                            id="id_floor" name="id_floor" data-placeholder="Pilih Lantai">
                                            <option value="">Pilih...</option>
                                            @foreach ($floor as $m)
                                                <option value="{{ $m->id }}">{{ $m->floor }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-sm m-l text-red-500">{{ $errors->first('id_floor') }}</span>
                                    </div>
                                    <div class="mb-5 w-full">
                                        <label for="merk"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Merk
                                            <span class="text-red-500">*</span></label>
                                        <select
                                            class="js-example-placeholder-single js-states form-control w-[400px] m-4"
                                            id="id_merk" name="id_merk" data-placeholder="Pilih Merk">
                                            <option value="">Pilih...</option>
                                            @foreach ($merk as $m)
                                                <option value="{{ $m->id }}">{{ $m->merk }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-sm m-l text-red-500">{{ $errors->first('id_merk') }}</span>
                                    </div>
                                </div>
                                <div class="grid grid-cols-3 gap-5">
                                    <div class="mb-5 w-full">
                                        <label for="ruang"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ruang
                                            <span class="text-red-500">*</span></label>
                                        <select
                                            class="js-example-placeholder-single js-states form-control w-[550px] m-4"
                                            id="id_room" name="id_room" data-placeholder="Pilih Ruang">
                                            <option value="">Pilih...</option>
                                            @foreach ($room as $m)
                                                <option value="{{ $m->id }}">{{ $m->room }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-sm m-l text-red-500">{{ $errors->first('id_room') }}</span>
                                    </div>
                                    <div class="mb-5 w-full">
                                        <label for="kategori"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori
                                            <span class="text-red-500">*</span></label>
                                        <select
                                            class="js-example-placeholder-single js-states form-control w-[550px] m-4"
                                            id="id_category" name="id_category" data-placeholder="Pilih Kategori">
                                            <option value="">Pilih...</option>
                                            @foreach ($category as $m)
                                                <option value="{{ $m->id }}">{{ $m->category }}</option>
                                            @endforeach
                                        </select>
                                        <span
                                            class="text-sm m-l text-red-500">{{ $errors->first('id_category') }}</span>
                                    </div>
                                    <div class="mb-5 w-full">
                                        <label for="kategori"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Divisi
                                            <span class="text-red-500">*</span></label>
                                        <select
                                            class="js-example-placeholder-single js-states form-control w-[550px] m-4"
                                            id="id_divisi" name="id_divisi" data-placeholder="Pilih Divisi">
                                            <option value="">Pilih...</option>
                                            @foreach ($division as $m)
                                                <option value="{{ $m->id }}">{{ $m->division }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-sm m-l text-red-500">{{ $errors->first('id_divisi') }}</span>
                                    </div>
                                </div>
                                <div class="grid grid-cols-1">
                                    <div class="mb-5 w-full">
                                        <label for="informasi"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Informasi
                                            <span class="text-red-500">*</span></label>
                                        <textarea type="text" id="informasi" name="informasi"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Masukan Informasi Barang...."></textarea>
                                        <span class="text-sm m-l text-red-500">{{ $errors->first('informasi') }}</span>
                                    </div>
                                </div>
                                <div class="grid grid-cols-5 gap-5">
                                    <div class="mb-5 w-full">
                                        <label for="faktur" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            Faktur <span class="text-red-500">*</span>
                                        </label>
                                        <input
                                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                            aria-describedby="user_avatar_help" id="faktur" name="faktur" type="file">
                                    </div>
                                    <div class="mb-5 w-full">
                                        <label for="picture" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            Foto <span class="text-red-500">*</span>
                                        </label>
                                        <input
                                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                            aria-describedby="user_avatar_help" id="picture" name="picture" type="file">
                                    </div>
                                    <div class="mb-5 w-full">
                                        <label for="harga"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga
                                            <span class="text-red-500">*</span></label>
                                        <input type="number" id="harga" name="harga"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Masukan Harga...."/>
                                        <span class="text-sm m-l text-red-500">{{ $errors->first('harga') }}</span>
                                    </div>
                                    <div class="mb-5 w-full">
                                        <label for="penyusutan"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Biaya Penyusutan
                                            <span class="text-red-500">*</span></label>
                                        <input type="number" id="penyusutan" name="penyusutan"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Masukan Penyusutan...."/>
                                        <span class="text-sm m-l text-red-500">{{ $errors->first('penyusutan') }}</span>
                                    </div>
                                    <div class="mb-5 w-full">
                                        <label for="jumlah"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Total Barang
                                            <span class="text-red-500">*</span></label>
                                        <input type="number" id="jumlah" name="jumlah"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Masukan Total Barang...."/>
                                        <span class="text-sm m-l text-red-500">{{ $errors->first('jumlah') }}</span>
                                    </div>
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
        </div>
    </div>
</x-app-layout>
