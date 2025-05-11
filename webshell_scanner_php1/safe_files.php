<?php
session_start();
$conn = new mysqli("localhost", "root", "", "database");
if ($_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit();
}
$username = $_SESSION['username'];
$result = $conn->query("SELECT filename FROM safe_file WHERE uploader = '$username'");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>File an toàn</title></head>
<body>
<h2>Danh sách file an toàn</h2>
<ul>
<?php while($row = $result->fetch_assoc()): ?>
    <li><?php echo $row['filename']; ?></li>
<?php endwhile; ?>
</ul>
<a href="dashboard.php">Quay lại Dashboard</a>
</body>
</html>
