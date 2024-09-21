<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate</title>
    <link href="{{ asset('css/show.css') }}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
</head>
<body>
    <div class="certificate-container">
        <div class="header">
            <img src="{{ asset('assets/logo/logo.png') }}" alt="logo" class="logo">
            <h1>Sertifikat Prestasi</h1>
            <p>Sertifikat ini diberikan kepada</p>
            <h2 class="recipient-name">{{ strtoupper($user->name) }}</h2>
            <p class="recognition">Sebagai pengakuan atas penyelesaian program dengan hasil yang memuaskan.</p>
        </div>

        <div class="content">
            <p class="description">Program Magang Belajar Koding Bersama Mahya</p>
            <p class="dates">Dilaksanakan mulai {{ \Carbon\Carbon::parse($certificate->start_date)->format('d F Y') }} - {{ \Carbon\Carbon::parse($certificate->end_date)->format('d F Y') }}</p>

            <p class="certificate-code">NO: {{ $certificate->certificate_code }}</p>

            <p class="certificate-url">
                <strong>Link Sertifikat:</strong>
                <a href="{{ url('/certificates/'.$certificate->certificate_code) }}" target="_blank">
                    {{ url('/certificates/'.$certificate->certificate_code) }}
                </a>
            </p>
        </div>

        <div class="footer">
            <div class="signature">
                <img src="{{ asset('assets/icon/watermark-removebg-preview.png') }}" alt="signature">
                <p><strong>RAUL MAHYA KOMARAN</strong></p>
                <p>CEO</p>
            </div>
        </div>
    </div>

    <button id="download">Download Certificate</button>
    <button onclick="window.location='{{ route('front.index') }}'">Back to Home</button>

    <script>
        document.getElementById('download').addEventListener('click', function () {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF({ orientation: 'landscape', unit: 'mm', format: 'a4' }); // Landscape mode

            html2canvas(document.querySelector('.certificate-container'), { scale: 2 }).then(canvas => {
                const imgData = canvas.toDataURL('image/png');
                const imgWidth = 297; // A4 landscape width in mm
                const pageHeight = 210; // A4 landscape height in mm

                // Adjust the height according to the aspect ratio of the canvas
                const imgHeight = (canvas.height * imgWidth) / canvas.width;

                let heightLeft = imgHeight;
                let position = 0;

                // Add the first image to the PDF
                doc.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;

                // Add new pages if the content exceeds one page
                while (heightLeft > 0) {
                    position = heightLeft - imgHeight; // Adjust the position for new content
                    doc.addPage();
                    doc.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                    heightLeft -= pageHeight;
                }

                // Save the final PDF
                doc.save('sertifikat.pdf');
            });
        });
        </script>

</body>
</html>
