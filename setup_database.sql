CREATE DATABASE IF NOT EXISTS rental;
USE rental;

CREATE TABLE IF NOT EXISTS owner (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(64) NOT NULL
);

CREATE TABLE IF NOT EXISTS ruangan (
  id_ruangan INT AUTO_INCREMENT PRIMARY KEY,
  nama_ruangan VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS penyewa (
  id_penyewa INT AUTO_INCREMENT PRIMARY KEY,
  nama_penyewa VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS penyewaan (
  id_penyewaan INT AUTO_INCREMENT PRIMARY KEY,
  id_ruangan INT NOT NULL,
  id_penyewa INT NOT NULL,
  tanggal_mulai DATETIME NOT NULL,
  tanggal_selesai DATETIME NOT NULL,
  keterangan TEXT,
  FOREIGN KEY (id_ruangan) REFERENCES ruangan(id_ruangan) ON DELETE CASCADE,
  FOREIGN KEY (id_penyewa) REFERENCES penyewa(id_penyewa) ON DELETE CASCADE
);

INSERT INTO owner (username, password) VALUES ('admin', SHA2('admin123', 256));

-