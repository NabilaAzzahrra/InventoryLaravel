<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">
                <div class="p-6 text-gray-900 grid grid-cols-3 gap-4">

                    <div class="bg-white px-8 py-4 w-full rounded-3xl shadow-xl">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="mt-3">
                                    <h1 class="font-extrabold">JUMLAH BARANG KESELURUHAN</h1>
                                </div>
                                <p class="text-sm">Hingga Tanggal <span
                                        class="font-bold">{{ now()->format('d/m/Y') }}</span></p>
                            </div>
                            <div class="mr-10">
                                <div class="mt-3 font-extrabold text-5xl">
                                    {{ $inventory_item_detail }}
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="my-5">
                                <a href="{{ route('barang.index') }}"
                                    class="text-sm p-2 bg-amber-400 hover:bg-amber-500 hover:text-white rounded-xl font-bold px-8">Selengkapnya</a>
                            </div>
                            <div class="relative flex items-end -mb-4 -mr-8">
                                <div class="flex flex-col items-center">
                                    <div class="h-14 w-14 -mr-28 -mb-8 bg-purple-400 rounded-tl-full"></div>
                                    <div class="h-7 w-7 mr-[-140px] -mb-5 bg-sky-700 rounded-tl-full"></div>

                                    <div class="h-14 w-14 bg-red-500 rounded-full"></div>
                                    <div class="h-5 w-14 bg-emerald-500"></div>
                                </div>
                                <div class="h-14 w-14 rounded-br-2xl bg-amber-300"></div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white px-8 py-4 w-full rounded-3xl shadow-xl">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="mt-3">
                                    <h1 class="font-extrabold">JUMLAH BARANG DIPINJAM</h1>
                                </div>
                                <p class="text-sm">Hingga Tanggal <span
                                        class="font-bold">{{ now()->format('d/m/Y') }}</span></p>
                            </div>
                            <div class="mr-10">
                                <div class="mt-3 font-extrabold text-5xl">
                                    {{ $detail_pinjam }}
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="my-5">
                                <a href="#"
                                    class="text-sm p-2 bg-amber-400 hover:bg-amber-500 hover:text-white rounded-xl font-bold px-8">Selengkapnya</a>
                            </div>
                            <div class="relative flex items-end -mb-4 -mr-8">
                                <div class="flex flex-col items-center">
                                    <div class="h-14 w-14 -mr-28 -mb-8 bg-purple-400 rounded-tl-full"></div>
                                    <div class="h-7 w-7 mr-[-140px] -mb-5 bg-sky-700 rounded-tl-full"></div>

                                    <div class="h-14 w-14 bg-red-500 rounded-full"></div>
                                    <div class="h-5 w-14 bg-emerald-500"></div>
                                </div>
                                <div class="h-14 w-14 rounded-br-2xl bg-amber-300"></div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white px-8 py-4 w-full rounded-3xl shadow-xl">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="mt-3">
                                    <h1 class="font-extrabold">JUMLAH BARANG TERSEDIA</h1>
                                </div>
                                <p class="text-sm">Hingga Tanggal <span
                                        class="font-bold">{{ now()->format('d/m/Y') }}</span></p>
                            </div>
                            <div class="mr-10">
                                <div class="mt-3 font-extrabold text-5xl">
                                    {{ $detail_baik }}
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="my-5">
                                <a href="#"
                                    class="text-sm p-2 bg-amber-400 hover:bg-amber-500 hover:text-white rounded-xl font-bold px-8">Selengkapnya</a>
                            </div>
                            <div class="relative flex items-end -mb-4 -mr-8">
                                <div class="flex flex-col items-center">
                                    <div class="h-14 w-14 -mr-28 -mb-8 bg-purple-400 rounded-tl-full"></div>
                                    <div class="h-7 w-7 mr-[-140px] -mb-5 bg-sky-700 rounded-tl-full"></div>

                                    <div class="h-14 w-14 bg-red-500 rounded-full"></div>
                                    <div class="h-5 w-14 bg-emerald-500"></div>
                                </div>
                                <div class="h-14 w-14 rounded-br-2xl bg-amber-300"></div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white px-8 py-4 w-full rounded-3xl shadow-xl">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="mt-3">
                                    <h1 class="font-extrabold">JUMLAH BARANG MAINTENANCE</h1>
                                </div>
                                <p class="text-sm">Hingga Tanggal <span
                                        class="font-bold">{{ now()->format('d/m/Y') }}</span></p>
                            </div>
                            <div class="mr-10">
                                <div class="mt-3 font-extrabold text-5xl">
                                    {{ $detail_maintenance }}
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="my-5">
                                <a href="#"
                                    class="text-sm p-2 bg-amber-400 hover:bg-amber-500 hover:text-white rounded-xl font-bold px-8">Selengkapnya</a>
                            </div>
                            <div class="relative flex items-end -mb-4 -mr-8">
                                <div class="flex flex-col items-center">
                                    <div class="h-14 w-14 -mr-28 -mb-8 bg-purple-400 rounded-tl-full"></div>
                                    <div class="h-7 w-7 mr-[-140px] -mb-5 bg-sky-700 rounded-tl-full"></div>

                                    <div class="h-14 w-14 bg-red-500 rounded-full"></div>
                                    <div class="h-5 w-14 bg-emerald-500"></div>
                                </div>
                                <div class="h-14 w-14 rounded-br-2xl bg-amber-300"></div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white px-8 py-4 w-full rounded-3xl shadow-xl">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="mt-3">
                                    <h1 class="font-extrabold">JUMLAH BARANG RUSAK</h1>
                                </div>
                                <p class="text-sm">Hingga Tanggal <span
                                        class="font-bold">{{ now()->format('d/m/Y') }}</span></p>
                            </div>
                            <div class="mr-10">
                                <div class="mt-3 font-extrabold text-5xl">
                                    {{ $detail_rusak }}
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="my-5">
                                <a href="#"
                                    class="text-sm p-2 bg-amber-400 hover:bg-amber-500 hover:text-white rounded-xl font-bold px-8">Selengkapnya</a>
                            </div>
                            <div class="relative flex items-end -mb-4 -mr-8">
                                <div class="flex flex-col items-center">
                                    <div class="h-14 w-14 -mr-28 -mb-8 bg-purple-400 rounded-tl-full"></div>
                                    <div class="h-7 w-7 mr-[-140px] -mb-5 bg-sky-700 rounded-tl-full"></div>

                                    <div class="h-14 w-14 bg-red-500 rounded-full"></div>
                                    <div class="h-5 w-14 bg-emerald-500"></div>
                                </div>
                                <div class="h-14 w-14 rounded-br-2xl bg-amber-300"></div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white px-8 py-4 w-full rounded-3xl shadow-xl">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="mt-3">
                                    <h1 class="font-extrabold">JUMLAH KATEGORI BARANG</h1>
                                </div>
                                <p class="text-sm">Hingga Tanggal <span
                                        class="font-bold">{{ now()->format('d/m/Y') }}</span></p>
                            </div>
                            <div class="mr-10">
                                <div class="mt-3 font-extrabold text-5xl">
                                    {{ $category }}
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="my-5">
                                <a href="#"
                                    class="text-sm p-2 bg-amber-400 hover:bg-amber-500 hover:text-white rounded-xl font-bold px-8">Selengkapnya</a>
                            </div>
                            <div class="relative flex items-end -mb-4 -mr-8">
                                <div class="flex flex-col items-center">
                                    <div class="h-14 w-14 -mr-28 -mb-8 bg-purple-400 rounded-tl-full"></div>
                                    <div class="h-7 w-7 mr-[-140px] -mb-5 bg-sky-700 rounded-tl-full"></div>

                                    <div class="h-14 w-14 bg-red-500 rounded-full"></div>
                                    <div class="h-5 w-14 bg-emerald-500"></div>
                                </div>
                                <div class="h-14 w-14 rounded-br-2xl bg-amber-300"></div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
