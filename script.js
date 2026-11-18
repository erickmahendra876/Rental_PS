// Menghitung total biaya sewa secara otomatis
function hitungTotal() {
    let selectBilik = document.getElementById("bilik_id");
    let inputDurasi = document.getElementById("durasi");
    let tampilTotal = document.getElementById("tampil_total");

    if (selectBilik && inputDurasi && tampilTotal) {
        let opsi = selectBilik.options[selectBilik.selectedIndex];
        let harga = parseInt(opsi.getAttribute("data-harga"));
        let durasi = parseInt(inputDurasi.value);

        let total = harga * durasi;
        tampilTotal.innerHTML = "Rp " + total.toLocaleString("id-ID");
    }
}

// Pop-up informasi rekening / QRIS saat memilih metode non-tunai
function infoPembayaran(metode) {
    if (metode == "Transfer Bank") {
        alert("Silakan transfer ke Rekening BCA: 1234567890 a.n. PlayZone PS, lalu tunjukkan bukti ke kasir.");
    } else if (metode == "QRIS") {
        alert("Silakan scan kode QRIS di meja kasir atau bayar ke DANA/GoPay: 081234567890.");
    }
}

// Konfirmasi sebelum menghapus data
function konfirmasiHapus() {
    return confirm("Apakah Anda yakin ingin menghapus data ini?");
}

// Konfirmasi sebelum logout
function konfirmasiLogout() {
    return confirm("Apakah Anda yakin ingin keluar dari akun?");
}

// Jalankan perhitungan otomatis saat halaman booking dibuka
hitungTotal();