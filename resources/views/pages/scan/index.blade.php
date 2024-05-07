<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <video id="scanner" style="width: 100%; height:100%;"></video>

    <script src="{{ asset('assets/js/dom-to-image.min.js') }}"></script>
    <script src="{{ asset('assets/js/qrcode.js') }}"></script>
    <script src="{{ asset('assets/js/qr-scanner.umd.min.js') }}"></script>
    <script>
        let videoElem = document.getElementById('scanner');
        const qrScanner = new QrScanner(
            videoElem,
            result => console.log('decoded qr code:', result),
            {
                maxScansPerSecond: 2,
                highlightScanRegion: true,
            }
        );
        qrScanner.start();
    </script>
</body>
</html>
