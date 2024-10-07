<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate</title>
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/certificate/certificate.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
</head>

<body>
    {{-- button back --}}
    {{-- <a href="{{ route('front.index') }}" class="btn btn-primary mt-3" style="background-color:  #3525B3;">Kembali ke
        Beranda</a>
    <button class="btn btn-primary mt-3" onclick="downloadPDF()">Cetak PDF</button> --}}

    {{-- <a href="{{ route('front.index') }}"
        class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">Back to List</a> --}}
    <div class="certificate-background">
        <img src="{{ asset('assets/background/Desain Sertifikat.svg') }}" class="certificate-image">
        <div class="certificate-container">
            <div class="certificate-data">
                <p class="course-title">PROGRAM KURSUS: {{ strtoupper($course->name) }}</p>
                <p class="course-givento">Sertifikat ini diberikan kepada</p>
                <p class="user-name">{{ strtoupper($user->name) }}</p>
                <p class="course-desc">Sebagai apresiasi atas penyelesaian program dengan hasil memuaskan.</p>
                <p class="course-finished">Pada tanggal
                    {{ $issuedDate }}</p>
                <p class="course-privider">Program Belajar Koding Bersama Mahya</p>
            </div>
            <div class="certificate-links">
                <p class="certificate-no">NO: {{ $certificate->certificate_code }}</p>
                <p class="certificate-link">{{ url('/certificates/' . $certificate->certificate_code) }}</p>
            </div>
        </div>
    </div>



    <script>
        document.ready(downloadPDF());

        function downloadPDF() {
            var element = document.querySelector('.certificate-background');
            try {
                // Hitung dimensi elemen
                var width = element.offsetWidth;
                var height = element.offsetHeight;

                // Konversi ukuran dari px ke milimeter untuk PDF (1 px = 0.264583 mm)
                var pdfWidth = width * 0.264583;
                var pdfHeight = height * 0.264583;

                var opt = {
                    margin: [0, 0, 0, 0], // Menghilangkan margin
                    filename: 'certificate.pdf',
                    image: {
                        type: 'jpeg',
                        quality: 0.98
                    },
                    html2canvas: {
                        scale: 2, // Meningkatkan kualitas
                        logging: true,
                        useCORS: true
                    },
                    jsPDF: {
                        unit: 'mm', // Ubah unit ke milimeter
                        format: [pdfWidth, pdfHeight], // Atur ukuran PDF agar sesuai dengan elemen HTML
                        orientation: 'landscape' // Orientasi landscape sesuai sertifikat
                    }
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
