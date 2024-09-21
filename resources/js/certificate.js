document.addEventListener('DOMContentLoaded', function() {
    const rows = document.querySelectorAll('table tbody tr');

    rows.forEach(row => {
        row.addEventListener('click', function() {
            // Add any action you want on row click
            // For example, alert the certificate ID
            alert(`ID Sertifikat: ${this.cells[0].innerText}`);
        });
    });
});
