<?php
session_start();
if (!isset($_SESSION['login'])) {
        header("Location: ../auth/login.php");
        exit;
}
include '../partials/header.php';
?>
<div class="bg-white shadow rounded p-6">
    <h2 class="text-2xl font-bold mb-4">Dashboard Owner/Admin</h2>
    <div class="flex gap-3">
        <a href="ruangan.php" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Kelola Ruangan</a>
        <a href="penyewa.php" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Kelola Penyewa</a>
        <a href="penyewaan.php" class="px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600">Kelola Penyewaan</a>
        <a href="../auth/logout.php" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Logout</a>
    </div>
</div>

<?php include '../partials/footer.php'; ?>