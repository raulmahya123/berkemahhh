document.querySelector(".download-btn").addEventListener("click", (event) => {
    event.preventDefault();
    downloadPDF();
});

function downloadPDF() {
    var element = document.querySelector(".certificate-background");
    try {
        // Hitung dimensi elemen
        var width = element.offsetWidth;
        var height = element.offsetHeight;

        // Konversi ukuran dari px ke milimeter untuk PDF (1 px = 0.264583 mm)
        var pdfWidth = width * 0.264583;
        var pdfHeight = height * 0.264583;

        var opt = {
            margin: [0, 0, 0, 0], // Menghilangkan margin
            filename: "certificate.pdf",
            image: {
                type: "jpeg",
                quality: 0.98,
            },
            html2canvas: {
                scale: 2, // Meningkatkan kualitas
                logging: true,
                useCORS: true,
            },
            jsPDF: {
                unit: "mm", // Ubah unit ke milimeter
                format: [pdfWidth, pdfHeight], // Atur ukuran PDF agar sesuai dengan elemen HTML
                orientation: "landscape", // Orientasi landscape sesuai sertifikat
            },
        };

        html2pdf()
            .from(element)
            .set(opt)
            .save()
            .then(function () {
                console.log("PDF successfully created and downloaded.");
            })
            .catch(function (error) {
                console.error(
                    "An error occurred during PDF generation: ",
                    error
                );
            });
    } catch (error) {
        console.error("Unexpected error occurred: ", error);
    }
}
