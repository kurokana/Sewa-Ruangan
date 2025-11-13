<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: ../auth/login.php"); exit; }
include '../config/db.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM penyewaan WHERE id_penyewaan=$id");
header("Location: ../views/penyewaan.php");
exit;
?>
