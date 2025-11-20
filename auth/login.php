<?php
session_start();
include '../config/db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password']; 
    $result = mysqli_query($conn, "SELECT * FROM owner WHERE username='$username' AND password='" . hash('sha256', $password) . "'");
    if (mysqli_num_rows($result) == 1) {
        $_SESSION['login'] = true;
        header("Location: ../views/index.php");
        exit;
    } else {
                $error = "Login gagal!";
    }
}
?>
<?php include '../partials/header.php'; ?>
<div class="max-w-md mx-auto mt-8 bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Login</h2>
    <?php if (!empty(
        isset($error) ? $error : null
    )): ?>
        <div class="text-sm text-red-600 mb-3"><?= isset($error) ? $error : '' ?></div>
    <?php endif; ?>
    <form method="POST" class="space-y-3">
        <div>
            <label class="block text-sm font-medium">Username</label>
            <input type="text" name="username" class="mt-1 block w-full border-gray-300 rounded px-3 py-2" required>
        </div>
        <div>
            <label class="block text-sm font-medium">Password</label>
            <input type="password" name="password" class="mt-1 block w-full border-gray-300 rounded px-3 py-2" required>
        </div>
        <div>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Login</button>
        </div>
    </form>
</div>
<?php include '../partials/footer.php'; ?>