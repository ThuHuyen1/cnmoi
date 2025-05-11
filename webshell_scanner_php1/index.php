<?php
session_start();
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Trang chủ</title></head>
<body>
<h1>Chào mừng đến WebShell Scanner (PHP)</h1>
<a href="login.php">Đăng nhập</a>
</body>
</html>
