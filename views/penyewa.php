<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: ../auth/login.php"); exit; }
include '../config/db.php';
include '../partials/header.php';
$result = mysqli_query($conn, "SELECT * FROM penyewa");
?>
<div class="bg-white shadow rounded p-6">
  <h2 class="text-xl font-semibold mb-4">List Penyewa</h2>
  <a href="../actions/add_penyewa.php" class="inline-block px-3 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Tambah Penyewa</a>
  <div class="overflow-x-auto mt-4">
    <table class="min-w-full bg-white">
      <thead>
        <tr class="bg-gray-100 text-left">
          <th class="px-4 py-2">ID</th>
          <th class="px-4 py-2">Nama Penyewa</th>
          <th class="px-4 py-2">Aksi</th>
        </tr>
      </thead>
      <tbody>
      <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr class="border-t">
          <td class="px-4 py-2"><?= $row['id_penyewa'] ?></td>
          <td class="px-4 py-2"><?= $row['nama_penyewa'] ?></td>
          <td class="px-4 py-2">
            <a href="../actions/edit_penyewa.php?id=<?= $row['id_penyewa'] ?>" class="text-blue-600 hover:underline">Edit</a>
            <span class="px-2">|</span>
            <a href="../actions/delete_penyewa.php?id=<?= $row['id_penyewa'] ?>" onclick="return confirm('Hapus?')" class="text-red-600 hover:underline">Hapus</a>
          </td>
        </tr>
      <?php endwhile; ?>
      </tbody>
    </table>
  </div>
  <div class="mt-4">
    <a href="index.php" class="text-sm text-gray-600 hover:underline">Kembali</a>
  </div>
</div>

<?php include '../partials/footer.php'; ?>