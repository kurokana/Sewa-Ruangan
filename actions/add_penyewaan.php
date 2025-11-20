<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: ../auth/login.php"); exit; }
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_ruangan = $_POST['id_ruangan'];
    $id_penyewa = $_POST['id_penyewa'];
    $tanggal_mulai = $_POST['tanggal_mulai'];
    $tanggal_selesai = $_POST['tanggal_selesai'];
    $keterangan = $_POST['keterangan'];
    
    mysqli_query($conn, "INSERT INTO penyewaan (id_ruangan, id_penyewa, tanggal_mulai, tanggal_selesai, keterangan) 
                         VALUES ('$id_ruangan', '$id_penyewa', '$tanggal_mulai', '$tanggal_selesai', '$keterangan')");
    header("Location: ../views/penyewaan.php");
    exit;
}

$ruangan = mysqli_query($conn, "SELECT * FROM ruangan ORDER BY nama_ruangan");
$penyewa = mysqli_query($conn, "SELECT * FROM penyewa ORDER BY nama_penyewa");

include '../partials/header.php';
?>
<div class="max-w-2xl bg-white shadow rounded p-6">
  <h2 class="text-xl font-semibold mb-4">Tambah Penyewaan</h2>
  <form method="POST" class="space-y-3">
    <div>
      <label class="block text-sm font-medium">Ruangan</label>
      <select name="id_ruangan" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" required>
        <option value="">-- Pilih Ruangan --</option>
        <?php while ($r = mysqli_fetch_assoc($ruangan)): ?>
          <option value="<?= $r['id_ruangan'] ?>"><?= $r['nama_ruangan'] ?></option>
        <?php endwhile; ?>
      </select>
    </div>
    <div>
      <label class="block text-sm font-medium">Penyewa</label>
      <select name="id_penyewa" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" required>
        <option value="">-- Pilih Penyewa --</option>
        <?php while ($p = mysqli_fetch_assoc($penyewa)): ?>
          <option value="<?= $p['id_penyewa'] ?>"><?= $p['nama_penyewa'] ?></option>
        <?php endwhile; ?>
      </select>
    </div>
    <div>
      <label class="block text-sm font-medium">Tanggal Mulai</label>
      <input type="datetime-local" name="tanggal_mulai" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" required>
    </div>
    <div>
      <label class="block text-sm font-medium">Tanggal Selesai</label>
      <input type="datetime-local" name="tanggal_selesai" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" required>
    </div>
    <div>
      <label class="block text-sm font-medium">Keterangan</label>
      <textarea name="keterangan" rows="3" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2"></textarea>
    </div>
    <div class="flex gap-2">
      <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Simpan</button>
      <a href="../views/penyewaan.php" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Batal</a>
    </div>
  </form>
</div>
<?php include '../partials/footer.php'; ?>
