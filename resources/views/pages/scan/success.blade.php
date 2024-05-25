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

<body class="bg-white flex mx-auto h-screen items-center justify-center flex-col md:flex-row">
    <div>
        <dotlottie-player src="{{ url('json/verification.json') }}" background="transparent" speed="1" style="width: 70px; height: 70px;" loop autoplay></dotlottie-player>
    </div>    
    <div class="font-bold text-sm text-wrap mx-4 flex items-center justify-center text-center  md:text-xl">PEMINJAMAN BARANG SUDAH BERHASIL DI AJUKAN, JANGAN LUPA UNTUK SELALU KONFIRMASI DALAM PENGEMBALIAN</div>
</body>
<script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
</html>
