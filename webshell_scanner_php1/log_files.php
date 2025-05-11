<?php
session_start();
$conn = new mysqli("localhost", "root", "", "database");
if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
$result = $conn->query("SELECT * FROM log");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>File nguy hiểm</title></head>
<body>
<h2>Danh sách file chứa mã độc</h2>
<table border="1">
    <tr><th>Filename</th><th>Uploader</th><th>Lý do</th></tr>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['filename']; ?></td>
        <td><?php echo $row['uploader']; ?></td>
        <td><?php echo $row['reason']; ?></td>
    </tr>
    <?php endwhile; ?>
</table>
<a href="dashboard.php">Quay lại Dashboard</a>
</body>
</html>
