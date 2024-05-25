<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Barang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl flex gap-5 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white w-2/3 overflow-hidden shadow-sm sm:rounded-lg flex flex-col">
                <div class="p-6 text-gray-900 flex-1">
                    <div class="flex">
                        <h1 class="font-extrabold underline underline-offset-8 mb-10">DETAIL DATA BARANG</h1>
                    </div>
                    <p class="mb-2"><span class="font-bold">Kode Barang</span> : {{ $inventory_item_detail->id_item }}
                    </p>
                    <p class="mb-2"><span class="font-bold">Nama Barang</span> : {{ $inventory_item_detail->name }}
                    </p>
                    <p class="mb-2"><span class="font-bold">Lantai</span> : {{ $inventory_item_detail->floor }}</p>
                    <p class="mb-2"><span class="font-bold">Ruang</span> : {{ $inventory_item_detail->room }}</p>
                    <p class="mb-2"><span class="font-bold">Kategori</span> : {{ $inventory_item_detail->category }}
                    </p>
                    <p class="mb-2"><span class="font-bold">Divisi</span> : {{ $inventory_item_detail->division }}</p>
                    <p class="mb-2"><span class="font-bold">Detail Informasi</span> : <span
                            class="text-wrap">{{ $inventory_item_detail->information }}</span></p>
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
                    <p class="mb-2"><span class="font-bold">Status</span> : <span
                            class="{{ $bg }} py-1 px-6 rounded-xl ">{{ $inventory_item_detail->status }}</span>
                    </p>
                    <p class="mb-2"><span class="font-bold">Ketersediaan</span> :
                        {{ $inventory_item_detail->availability }} {!! $icon !!}</p>
                    <p class="mb-2"><span class="font-bold">Harga</span> : {{ $inventory_item_detail->price }}</p>
                    <p class="mb-2"><span class="font-bold">Penyusutan</span> :
                        {{ $inventory_item_detail->cost_of_depreciation }}</p>
                    <div class="flex gap-5">
                        <div class="border-solid border-2 border-sky-400 p-4 rounded-lg w-2/4 text-sm mb-0">
                            <div>
                                <div class="flex items-center justify-center bg-sky-400 p-1 font-bold text-white">Daftar
                                    Nomor Inventaris Politeknik LP3I Kampus Tasikmalaya</div>
                                <div class=" my-3 gap-4">
                                    <div class="flex flex-col items-center justify-center">
                                        <div>Kode Barang : <span
                                                class="font-extrabold">{{ $inventory_item_detail->id_item }}</span>
                                        </div>
                                        <div class="w-full flex">
                                            <img src="{{ url('images/LP3I.png') }}" class="w-[70px] h-auto">
                                            <div class="flex flex-col pl-24">
                                                <div id="qr-pinjam"></div>
                                                <div> QR-Inventaris</div>
                                                <canvas id="canvas" style="display:none;"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $id = $inventory_item_detail->id_inventory_item;
                        ?>
                        <a href="{{ route('print.show', $id) }}" target="_blank">
                            <div class="mt-44">
                                <span class="bg-amber-300 h-10 p-2 rounded-md"><i
                                        class="fas fa-print pr-2"></i>Cetak</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="w-1/3 bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-col">
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
</x-app-layout>
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

{{-- <script>
    const idItem = "<?php echo $inventory_item_detail->id_inventory_item; ?>";
    const urlI = `https://nabil.com/detail/${idItem}`;
    const canvas = document.createElement('canvas');
    QRCode.toCanvas(canvas, urlI, {
        errorCorrectionLevel: 'H'
    }, function(error) {
        if (error) console.error(error);
    });

    const dataUrl = canvas.toDataURL()

    const img = document.createElement('img');
    img.src = dataUrl;
    img.style.width = '90px';

    document.getElementById('qr-code').appendChild(img);
</script> --}}

<script>
    const idPinjam = "<?php echo $inventory_item_detail->id_inventory_item; ?>";
    const url = `http://127.0.0.1:8001/scanQr/${idPinjam}/show`;

    const canvasPinjam = document.getElementById('canvas');

    QRCode.toCanvas(canvasPinjam, url, {
        errorCorrectionLevel: 'H'
    }, function(error) {
        if (error) {
            console.error(error);
            return;
        }

        const dataUrl = canvasPinjam.toDataURL();

        const img = document.createElement('img');
        img.src = dataUrl;
        img.style.width = '90px';

        document.getElementById('qr-pinjam').appendChild(img);
    });
</script>
