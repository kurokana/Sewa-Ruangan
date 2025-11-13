<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: ../auth/login.php"); exit; }
include '../config/db.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM ruangan WHERE id_ruangan=$id");
header("Location: ../views/ruangan.php");
exit;
?>