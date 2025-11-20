<?php
$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "rental");
if (!$conn) die("Koneksi gagal: " . mysqli_connect_error());
?>