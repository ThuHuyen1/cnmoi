<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
$role = $_SESSION['role'];
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title></head>
<body>
<h2>Xin chào <?php echo $_SESSION['username']; ?> (<?php echo $role; ?>)</h2>
<ul>
<?php if ($role == 'user'): ?>
    <li><a href="upload.php">Tải file</a></li>
    <li><a href="safe_files.php">Xem file an toàn</a></li>
<?php else: ?>
    <li><a href="log_files.php">Xem file nguy hiểm</a></li>
<?php endif; ?>
    <li><a href="logout.php">Đăng xuất</a></li>
</ul>
</body>
</html>
