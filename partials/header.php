<?php
if (session_status() == PHP_SESSION_NONE) { /* session already started in pages */ }
// Determine base path
$base = dirname($_SERVER['SCRIPT_NAME']);
$inViews = strpos($base, '/views') !== false || strpos($base, '\\views') !== false;
$inActions = strpos($base, '/actions') !== false || strpos($base, '\\actions') !== false;
$inAuth = strpos($base, '/auth') !== false || strpos($base, '\\auth') !== false;
$prefix = ($inViews || $inActions || $inAuth) ? '../' : '';
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Rental BDL</title>
</head>
<body class="bg-gray-100 text-gray-800">
<nav class="bg-white shadow">
  <div class="container mx-auto px-4 py-3 flex items-center justify-between">
    <a href="<?= $prefix ?>views/index.php" class="font-bold text-lg">Rental BDL</a>
    <div class="space-x-3">
      <?php if (isset($_SESSION) && isset($_SESSION['login'])): ?>
        <a href="<?= $prefix ?>views/ruangan.php" class="text-sm text-gray-600 hover:text-gray-900">Ruangan</a>
        <a href="<?= $prefix ?>views/penyewa.php" class="text-sm text-gray-600 hover:text-gray-900">Penyewa</a>
        <a href="<?= $prefix ?>views/penyewaan.php" class="text-sm text-gray-600 hover:text-gray-900">Penyewaan</a>
        <a href="<?= $prefix ?>auth/logout.php" class="text-sm text-red-600 hover:text-red-800">Logout</a>
      <?php else: ?>
        <a href="<?= $prefix ?>auth/login.php" class="text-sm text-gray-600 hover:text-gray-900">Login</a>
      <?php endif; ?>
    </div>
  </div>
</nav>

<main class="container mx-auto px-4 py-6">
