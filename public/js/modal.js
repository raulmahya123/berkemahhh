// Mendapatkan elemen modal
var modal = document.getElementById("myModal");

// Mendapatkan tombol yang membuka modal
var btn = document.getElementById("openModalBtn");

// Mendapatkan elemen <span> yang menutup modal
var span = document.getElementsByClassName("close")[0];

// Saat tombol diklik, buka modal
btn.onclick = function() {
    modal.style.display = "block";
}

// Saat tombol close (x) diklik, tutup modal
span.onclick = function() {
    modal.style.display = "none";
}

// Saat pengguna mengklik di luar modal, tutup modal
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
