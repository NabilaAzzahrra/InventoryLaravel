<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PRINT NOMOR INVENTORY</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @page {
            size: A4;
            margin: 0;
        }

        .a4 {
            width: 210mm;
            height: 297mm;
            padding: 20mm;
            margin: auto;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .a4-content {
            display: flex;
            flex-wrap: wrap;
        }

        .a4-item {
            width: 50%;
            box-sizing: border-box;
            padding: 5px;
        }

        @media print {
            .a4 {
                box-shadow: none;
                margin: 0;
                page-break-after: always;
            }
        }
    </style>
</head>

<body class="bg-gray-100">
    @php
    $items_per_page = 2; // Jumlah item per kertas
    $item_count = count($stu_data); // Total jumlah item
    $page_count = ceil($item_count / $items_per_page); // Total jumlah halaman
    @endphp

    @for ($page = 0; $page < $page_count; $page++)
    <div class="a4">
        <div class="a4-content">
            @for ($i = $page * $items_per_page; $i < min(($page + 1) * $items_per_page, $item_count); $i++)
            <div class="a4-item">
                <div class="border-solid border-2 border-sky-400 p-4 rounded-lg text-sm ">
                    <div>
                        <div class="flex items-center justify-center bg-sky-400 p-1 font-bold text-white text-[13px] text-center">
                            Daftar Nomor Inventaris Politeknik LP3I Kampus Tasikmalaya</div>
                        <div class="my-1 gap-4">
                            <div class="flex flex-col items-center justify-center">
                                <div class="text-[12px]">Kode Barang : <span
                                        class="font-extrabold">{{ $stu_data[$i]->id_item }}</span></div>
                                <div class="w-full flex">
                                    <img src="{{ url('images/LP3I.png') }}" class="w-[70px] h-auto">
                                    <div class="flex flex-col pl-12">
                                        <div id="qr-pinjam-{{ $i }}"></div>
                                        <div> QR-Inventaris</div>
                                        <canvas id="canvas-{{ $i }}" style="display:none;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endfor
        </div>
    </div>
    @endfor

    <script src="{{ asset('assets/js/dom-to-image.min.js') }}"></script>
    <script src="{{ asset('assets/js/qr-scanner.min.js') }}"></script>
    <script src="{{ asset('assets/js/qrcode.js') }}"></script>
    <script>
        const stuData = @json($stu_data);

        stuData.forEach((data, index) => {
            const idPinjam = data.id_inventory_item;
            const url = `http://127.0.0.1:8001/scanQr/${idPinjam}/show`;

            const canvasPinjam = document.getElementById(`canvas-${index}`);

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

                document.getElementById(`qr-pinjam-${index}`).appendChild(img);
            });
        });
    </script>
    <script>
        window.print();
    </script>
</body>

</html>
