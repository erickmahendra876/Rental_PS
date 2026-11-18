DROP DATABASE IF EXISTS rental_ps;
CREATE DATABASE rental_ps;
USE rental_ps;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    role VARCHAR(20) NOT NULL
);

CREATE TABLE bilik (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_bilik VARCHAR(50) NOT NULL,
    tipe_konsol VARCHAR(50) NOT NULL,
    fasilitas VARCHAR(255) NOT NULL,
    harga_per_jam INT NOT NULL,
    status VARCHAR(20) NOT NULL
);

CREATE TABLE booking (
    id INT AUTO_INCREMENT PRIMARY KEY,
    bilik_id INT NOT NULL,
    nama_penyewa VARCHAR(100) NOT NULL,
    tanggal DATE NOT NULL,
    jam_mulai VARCHAR(10) NOT NULL,
    durasi INT NOT NULL,
    jam_selesai VARCHAR(10) NOT NULL,
    total_harga INT NOT NULL,
    metode_pembayaran VARCHAR(50) NOT NULL,
    status_pembayaran VARCHAR(30) NOT NULL,
    status_booking VARCHAR(30) NOT NULL
);

INSERT INTO users (nama, username, password, role) VALUES
('Admin Kasir', 'admin', '123', 'admin'),
('Budi Santoso', 'budi', '123', 'pelanggan');

INSERT INTO bilik (nama_bilik, tipe_konsol, fasilitas, harga_per_jam, status) VALUES
('Bilik Reguler 01', 'PlayStation 4 Slim', 'TV LED 43 Inch, 2 Stik, Kipas Angin, Sofa', 10000, 'Tersedia'),
('Bilik Reguler 02', 'PlayStation 4 Pro', 'TV 4K 50 Inch, 2 Stik, AC, Bean Bag', 15000, 'Tersedia'),
('Bilik VIP 01', 'PlayStation 5 Disc', 'Smart TV 55 Inch, 2 Stik DualSense, AC, Ruang Privat', 25000, 'Tersedia'),
('Bilik VIP 02', 'PlayStation 5 Pro', 'Smart TV 65 Inch, 4 Stik DualSense, AC, Sofa Bed', 35000, 'Perbaikan');