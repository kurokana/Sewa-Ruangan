<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: ../auth/login.php"); exit; }
include '../config/db.php';

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM penyewaan WHERE id_penyewaan=$id");
$row = mysqli_fetch_assoc($data);

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_ruangan = $_POST['id_ruangan'];
    $id_penyewa = $_POST['id_penyewa'];
    $tanggal_mulai = $_POST['tanggal_mulai'];
    $tanggal_selesai = $_POST['tanggal_selesai'];
    $keterangan = $_POST['keterangan'];
    
    // Cek apakah ruangan sedang disewa oleh penyewaan lain (bukan penyewaan ini)
    $cek = mysqli_query($conn, "SELECT * FROM penyewaan 
                                WHERE id_ruangan='$id_ruangan' 
                                AND id_penyewaan != $id
                                AND tanggal_selesai >= NOW()");
    
    if (mysqli_num_rows($cek) > 0) {
        $error = "Ruangan ini sedang disewa oleh penyewaan lain!";
    } else {
        mysqli_query($conn, "UPDATE penyewaan SET 
                             id_ruangan='$id_ruangan', 
                             id_penyewa='$id_penyewa', 
                             tanggal_mulai='$tanggal_mulai', 
                             tanggal_selesai='$tanggal_selesai', 
                             keterangan='$keterangan' 
                             WHERE id_penyewaan=$id");
        header("Location: ../views/penyewaan.php");
        exit;
    }
}

// Query ruangan yang tersedia ATAU ruangan yang sedang dipakai oleh penyewaan ini
$ruangan = mysqli_query($conn, "
    SELECT r.* 
    FROM ruangan r
    WHERE NOT EXISTS (
        SELECT 1 FROM penyewaan p 
        WHERE p.id_ruangan = r.id_ruangan 
        AND p.tanggal_selesai >= NOW()
        AND p.id_penyewaan != $id
    )
    ORDER BY r.nama_ruangan
");

$penyewa = mysqli_query($conn, "SELECT * FROM penyewa ORDER BY nama_penyewa");

include '../partials/header.php';
?>
<div class="max-w-2xl bg-white shadow rounded p-6">
  <h2 class="text-xl font-semibold mb-4">Edit Penyewaan</h2>
  
  <?php if ($error): ?>
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
      <?= $error ?>
    </div>
  <?php endif; ?>
  
  <form method="POST" class="space-y-3">
    <div>
      <label class="block text-sm font-medium">Ruangan</label>
      <select name="id_ruangan" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" required>
        <option value="">-- Pilih Ruangan --</option>
        <?php while ($r = mysqli_fetch_assoc($ruangan)): ?>
          <option value="<?= $r['id_ruangan'] ?>" <?= $r['id_ruangan'] == $row['id_ruangan'] ? 'selected' : '' ?>>
            <?= $r['nama_ruangan'] ?>
          </option>
        <?php endwhile; ?>
      </select>
      <p class="text-xs text-gray-500 mt-1">*Hanya menampilkan ruangan yang tersedia</p>
    </div>
    <div>
      <label class="block text-sm font-medium">Penyewa</label>
      <select name="id_penyewa" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" required>
        <option value="">-- Pilih Penyewa --</option>
        <?php while ($p = mysqli_fetch_assoc($penyewa)): ?>
          <option value="<?= $p['id_penyewa'] ?>" <?= $p['id_penyewa'] == $row['id_penyewa'] ? 'selected' : '' ?>>
            <?= $p['nama_penyewa'] ?>
          </option>
        <?php endwhile; ?>
      </select>
    </div>
    <div>
      <label class="block text-sm font-medium">Tanggal Mulai</label>
      <input type="datetime-local" name="tanggal_mulai" value="<?= date('Y-m-d\TH:i', strtotime($row['tanggal_mulai'])) ?>" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" required>
    </div>
    <div>
      <label class="block text-sm font-medium">Tanggal Selesai</label>
      <input type="datetime-local" name="tanggal_selesai" value="<?= date('Y-m-d\TH:i', strtotime($row['tanggal_selesai'])) ?>" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" required>
    </div>
    <div>
      <label class="block text-sm font-medium">Keterangan</label>
      <textarea name="keterangan" rows="3" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2"><?= $row['keterangan'] ?></textarea>
    </div>
    <div class="flex gap-2">
      <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Simpan</button>
      <a href="../views/penyewaan.php" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Batal</a>
    </div>
  </form>
</div>
<?php include '../partials/footer.php'; ?>
