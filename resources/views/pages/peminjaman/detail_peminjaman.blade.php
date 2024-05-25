<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl flex gap-5 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white w-2/3 overflow-hidden shadow-sm sm:rounded-lg flex flex-col">
                <div class="p-6 text-gray-900 flex-1">
                    <h1 class="font-bold text-[18px] my-2">PEMINJAM :</h1>
                    <div class="flex items-center gap-4 mb-4">
                        <i class="fa-solid fa-user" style="color: #64748b; line-height: 1;"></i>
                        <p class="text-wrap text-justify text-slate-500 font-bold">{{ $peminjaman->name }}</p>
                    </div>
                    <h1 class="font-bold text-[18px] my-2">KELAS :</h1>
                    <div class="flex items-center gap-4 mb-4">
                        <i class="fa-solid fa-book" style="color: #64748b; line-height: 1;"></i>
                        <p class="text-wrap text-justify text-slate-500 font-bold">{{ $peminjaman->classes }}</p>
                    </div>
                    <h1 class="font-bold text-[18px] my-2">NO HANDPHONE :</h1>
                    <div class="flex items-center gap-4 mb-4">
                        <i class="fa-solid fa-phone" style="color: #64748b; line-height: 1;"></i>
                        <p class="text-wrap text-justify text-slate-500 font-bold">
                            +{{ substr($peminjaman->no_hp, 0, 2) . ' ' . substr($peminjaman->no_hp, 2) }}</p>
                    </div>
                    <h1 class="font-bold text-[18px] my-2">KODE BARANG :</h1>
                    <div class="flex items-center gap-4 mb-4">
                        <i class="fa-solid fa-code" style="color: #64748b; line-height: 1;"></i>
                        <p class="text-wrap text-justify text-slate-500 font-bold">{{ $peminjaman->detail->id_item }}
                        </p>
                    </div>
                    <h1 class="font-bold text-[18px] my-2">NAMA BARANG :</h1>
                    <div class="flex items-center gap-4 mb-4">
                        <i class="fa-solid fa-boxes-stacked" style="color: #64748b; line-height: 1;"></i>
                        <p class="text-wrap text-justify text-slate-500 font-bold">
                            {{ $peminjaman->detail->barang->name }}</p>
                    </div>
                    <h1 class="font-bold text-[18px] my-2">HARGA BARANG :</h1>
                    <div class="flex items-center gap-4 mb-4">
                        <i class="fa-solid fa-tag" style="color: #64748b; line-height: 1;"></i>
                        <p class="text-wrap text-justify text-slate-500 font-bold">Rp
                            {{ number_format($peminjaman->detail->barang->price, 0, ',', '.') }}</p>
                    </div>
                    <h1 class="font-bold text-[18px] my-2">KEPERLUAN :</h1>
                    <div class="flex items-center gap-4 mb-4">
                        <i class="fa-solid fa-toolbox" style="color: #64748b; line-height: 1;"></i>
                        <p class="text-wrap text-justify text-slate-500 font-bold">{{ $peminjaman->needs }}</p>
                    </div>
                    <h1 class="font-bold text-[18px] my-2">INFORMASI BARANG :</h1>
                    <div class="flex items-start gap-4 mb-4">
                        <i class="fa-solid fa-circle-info mt-1" style="color: #64748b; line-height: 1;"></i>
                        <p class="text-wrap text-justify text-slate-500 font-bold">
                            {{ $peminjaman->detail->barang->information }}</p>
                    </div>
                </div>
            </div>
            <div class="w-1/3 bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-col">
                <div class="p-6 text-gray-900 flex-1">
                    <h1 class="font-bold text-[18px] my-2">SURAT PEMINJAMAN BARANG</h1>
                    <iframe src="{{ url('surat/' . $peminjaman->inventory_loan_letter) }}" frameborder="0" width="100%" height="600px"></iframe>
                </div>
                <div class="p-6 text-gray-900 flex-1">
                    <h1 class="font-bold text-[18px] my-2">FOTO BARANG</h1>
                    <img src="{{ url('picture/' . $peminjaman->detail->barang->picture) }}"
                        alt="{{ $peminjaman->detail->barang->name }}" class="w-full h-auto">
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
