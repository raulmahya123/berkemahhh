<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate</title>
    <link href="{{ asset('css/show.css') }}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
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
    <button id="download">Download Certificate</button>

    <script>
        document.getElementById('download').addEventListener('click', function () {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF({ orientation: 'p', unit: 'mm', format: 'a4' });

            html2canvas(document.querySelector('.certificate-container')).then(canvas => {
                const imgData = canvas.toDataURL('image/png');
                const imgWidth = 190;
                const pageHeight = 295;
                const imgHeight = canvas.height * imgWidth / canvas.width;
                let heightLeft = imgHeight;

                let position = 0;

                doc.addImage(imgData, 'PNG', 10, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;

                while (heightLeft >= 0) {
                    position = heightLeft - imgHeight;
                    doc.addPage();
                    doc.addImage(imgData, 'PNG', 10, position, imgWidth, imgHeight);
                    heightLeft -= pageHeight;
                }

                doc.save('sertifikat.pdf');
            });
        });
    </script>
</body>
</html>
