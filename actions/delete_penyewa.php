<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: ../auth/login.php"); exit; }
include '../config/db.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM penyewa WHERE id_penyewa=$id");
header("Location: ../views/penyewa.php");
exit;
?>