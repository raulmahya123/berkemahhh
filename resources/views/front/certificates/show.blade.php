<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate</title>
    <link href="{{ asset('css/show.css') }}" rel="stylesheet">
</head>
<body>
    <div class="certificate-container">
        <div class="header">
            <h2>BELAJAR KODING BERSAMA MAHYA</h2>
            <h1>SERTIFIKAT DARI PRESTASI</h1>
            <p>Sertifikat ini diberikan kepada</p>
            <h2 class="recipient-name">{{ strtoupper($user->name) }}</h2>
            <p class="from">From Belajar Koding Bersama Mahya</p>
        </div>
        <div class="content">
            <p>Sebagai bentuk pengakuan atas usaha dan prestasinya dalam menyelesaikan program magang selama tiga bulan.</p>
            <p class="dates">Dilaksanakan mulai {{ \Carbon\Carbon::parse($certificate->start_date)->format('d F Y') }} - {{ \Carbon\Carbon::parse($certificate->end_date)->format('d F Y') }}</p>
            <p class="certificate-code">NO: {{ $certificate->certificate_code }}</p>
        </div>
        <div class="signature">
            <p><strong>RAUL MAHYA KOMARAN</strong></p>
            <p>CEO</p>
        </div>
    </div>
</body>
</html>
