<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['room_name'];
    $desc = $_POST['description'];
    mysqli_query($conn, "INSERT INTO rooms (room_name, description) VALUES ('$name', '$desc')");
    header("Location: rooms.php");
    exit;
}
?>
<form method="POST">
    Nama Ruangan: <input type="text" name="room_name"><br>
    Deskripsi: <textarea name="description"></textarea><br>
    <input type="submit" value="Simpan">
</form>