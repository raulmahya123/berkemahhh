<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate</title>
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quattrocento:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
    <style>
body {
    font-family: 'Quattrocento', serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
}

.print-button {
    padding: 10px 20px;
    background-color: #0077cc;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    position: absolute;
    top: 10px;
}

.certificate-container {
    position: relative;
    background-color: white;
    width: 1000px; /* Increased width */
    box-sizing: border-box;
    margin: 50px;
    z-index: -2;
}

.certificate-body {
    position: relative;
    background-color: white;
    padding: 50px;
    margin: 10px;
    box-sizing: border-box;
}

/* Top-left border box */
.top-left-border {
    position: absolute;
    top: -10px;
    left: -10px;
    background-color: #0077cc;
    width: 500px; /* Adjust width */
    height: 500px; /* Adjust height */
    clip-path: polygon(0% 0%, 100% 0%, 0% 100%);
    z-index: -1;
}

/* Bottom-right border box */
.bottom-right-border {
    position: absolute;
    bottom: -10px;
    right: -10px;
    background-color: #0077cc;
    width: 500px; /* Adjust width */
    height: 500px; /* Adjust height */
    clip-path: polygon(100% 0%, 100% 100%, 0% 100%);
    z-index: -1;
}

.header {
    text-align: left;
}

.header h1 {
    margin-top: 100px;
    font-size: 36px;
    color: #0077cc;
}

.header h3 {
    font-weight: normal;
    margin-top: 10px;
}

.content {
    margin-top: 40px;
    text-align: left;
    margin-bottom: 20px;
}

.content p {
    font-size: 18px;
    margin: 10px 0;
}

.ribbon {
    position: absolute;
    right: 150px;
    z-index: 2;
}

.signature-section {
    margin-top: 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.signature {
    text-align: left;
}

.signature img {
    display: block;
    margin-bottom: 10px;
}

.signature p {
    margin: 5px 0;
}

.certificate-info {
    text-align: right;
}

.certificate-info p {
    font-size: 14px;
    margin: 5px 0;
}

.logo {
    position: absolute;
    top: 20px;
    left: 40px;
}


    </style>

</head>




    <body class="text-black font-poppins pt-10 pb-[50px]">
    {{-- button back --}}
    <a href="{{ route('front.index') }}" class="btn btn-primary mt-3" style="background-color:  #3525B3;">Kembali ke Beranda</a>
<button class="btn btn-primary mt-3" onclick="downloadPDF()">Cetak PDF</button>

    <a href="{{ route('front.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">Back to List</a>
    <div class="certificate-container">
        <img src="{{ asset('assets/logo/ribbon-removebg-preview.png') }}" alt="Certificate Ribbon" class="ribbon" width="200">

        <div class="certificate-body">
        <!-- Border decorations -->
        <div class="top-left-border"></div>
        <div class="bottom-right-border"></div>

        <!-- Certificate content -->
        <img src="{{ asset('assets/logo/logo.png') }}" alt="logo" class="logo" width="100">

        <div class="header">
            <h1>SERTIFIKAT PRESTASI</h1>
            <p style="font-weight: bold; font-size: 30px;">PROGRAM KURSUS: {{ $certificate->course->name ?? 'Tidak ada kursus' }}</p>
            <h3>Sertifikat ini diberikan kepada</h3>
            <h2 style="font-size: 36px; font-weight: bold;">{{ strtoupper($user->name) }}</h2>
        </div>
        <div class="content">
            <p>"Sebagai apresiasi atas penyelesaian program dengan hasil memuaskan."</p>
            <p>Program Belajar Koding Bersama Mahya</p>
            <p>Diselesaikan mulai {{ \Carbon\Carbon::parse($certificate->start_date)->format('d F Y') }}</p>
        </div>

        <!-- Signature and Certificate Info Section -->
        <img src="{{ asset('assets/icon/watermark-removebg-preview.png') }}" alt="Signature" width="190">

        <div class="signature-section">
            <div class="signature">
                <p style="font-size: 20px; font-weight: bold;">RAUL MAHYA KOMARAN</p>
                <p><b>CEO</b></p>
            </div>
            <div class="certificate-info">
                <p>NO: {{ $certificate->certificate_code }}</p>
                <p>Link Sertifikat: {{ url('/certificates/' . $certificate->certificate_code) }}</p>
            </div>
        </div>
    </div>

</div>

<script>
    function downloadPDF() {
        var element = document.querySelector('.certificate-container');
        try {
        var opt = {
            margin: 0,
            filename: 'certificate.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2, logging: true, useCORS: true },
            jsPDF: { unit: 'in', format: 'a4', orientation: 'landscape' }
        };

        html2pdf().from(element).set(opt).save().then(function() {
            console.log("PDF successfully created and downloaded.");
        }).catch(function(error) {
            console.error("An error occurred during PDF generation: ", error);
        });
    } catch (error) {
        console.error("Unexpected error occurred: ", error);
    }
    }
</script>
</body>

</html>
