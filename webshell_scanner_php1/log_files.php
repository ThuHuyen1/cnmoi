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
    <title>File nguy hiểm - WebShell Scanner</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>WebShell Scanner</h1>
            <h2>Danh sách file chứa mã độc</h2>
        </div>

        <nav class="nav-menu">
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="logout.php" class="btn btn-danger">Đăng xuất</a></li>
            </ul>
        </nav>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Tên file</th>
                        <th>Người tải lên</th>
                        <th>Lý do</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['filename']); ?></td>
                        <td><?php echo htmlspecialchars($row['uploader']); ?></td>
                        <td><?php echo htmlspecialchars($row['reason']); ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
