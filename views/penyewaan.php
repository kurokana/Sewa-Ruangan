<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: ../auth/login.php"); exit; }
include '../config/db.php';
include '../partials/header.php';

// Query dengan JOIN untuk menampilkan nama ruangan dan penyewa
$result = mysqli_query($conn, "
  SELECT p.*, r.nama_ruangan, py.nama_penyewa 
  FROM penyewaan p
  JOIN ruangan r ON p.id_ruangan = r.id_ruangan
  JOIN penyewa py ON p.id_penyewa = py.id_penyewa
  ORDER BY p.tanggal_mulai DESC
");
?>
<div class="bg-white shadow rounded p-6">
  <h2 class="text-xl font-semibold mb-4">Kelola Penyewaan</h2>
  <a href="../actions/add_penyewaan.php" class="inline-block px-3 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Tambah Penyewaan</a>
  <div class="overflow-x-auto mt-4">
    <table class="min-w-full bg-white">
      <thead>
        <tr class="bg-gray-100 text-left text-sm">
          <th class="px-4 py-2">ID</th>
          <th class="px-4 py-2">Ruangan</th>
          <th class="px-4 py-2">Penyewa</th>
          <th class="px-4 py-2">Tanggal Mulai</th>
          <th class="px-4 py-2">Tanggal Selesai</th>
          <th class="px-4 py-2">Keterangan</th>
          <th class="px-4 py-2">Aksi</th>
        </tr>
      </thead>
      <tbody>
      <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr class="border-t text-sm">
          <td class="px-4 py-2"><?= $row['id_penyewaan'] ?></td>
          <td class="px-4 py-2"><?= $row['nama_ruangan'] ?></td>
          <td class="px-4 py-2"><?= $row['nama_penyewa'] ?></td>
          <td class="px-4 py-2"><?= date('d/m/Y H:i', strtotime($row['tanggal_mulai'])) ?></td>
          <td class="px-4 py-2"><?= date('d/m/Y H:i', strtotime($row['tanggal_selesai'])) ?></td>
          <td class="px-4 py-2"><?= $row['keterangan'] ? substr($row['keterangan'], 0, 50) . '...' : '-' ?></td>
          <td class="px-4 py-2">
            <a href="../actions/edit_penyewaan.php?id=<?= $row['id_penyewaan'] ?>" class="text-blue-600 hover:underline">Edit</a>
            <span class="px-2">|</span>
            <a href="../actions/delete_penyewaan.php?id=<?= $row['id_penyewaan'] ?>" onclick="return confirm('Hapus penyewaan ini?')" class="text-red-600 hover:underline">Hapus</a>
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
