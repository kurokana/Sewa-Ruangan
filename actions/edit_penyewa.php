<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: ../auth/login.php"); exit; }
include '../config/db.php';
$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM penyewa WHERE id_penyewa=$id");
$row = mysqli_fetch_assoc($data);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama_penyewa'];
    mysqli_query($conn, "UPDATE penyewa SET nama_penyewa='$nama' WHERE id_penyewa=$id");
    header("Location: ../views/penyewa.php");
    exit;
}
include '../partials/header.php';
?>
<div class="max-w-lg bg-white shadow rounded p-6">
  <h2 class="text-xl font-semibold mb-4">Edit Penyewa</h2>
  <form method="POST" class="space-y-3">
    <div>
      <label class="block text-sm font-medium">Nama Penyewa</label>
      <input type="text" name="nama_penyewa" value="<?= $row['nama_penyewa'] ?>" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" required>
    </div>
    <div class="flex gap-2">
      <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Simpan</button>
      <a href="../views/penyewa.php" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Batal</a>
    </div>
  </form>
</div>
<?php include '../partials/footer.php'; ?>