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
    <title>Dashboard - WebShell Scanner</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>WebShell Scanner</h1>
            <h2>Xin chào <?php echo $_SESSION['username']; ?> (<?php echo $role; ?>)</h2>
        </div>

        <nav class="nav-menu">
            <ul>
                <?php if ($role == 'user'): ?>
                    <li><a href="upload.php">Tải file</a></li>
                    <li><a href="safe_files.php">Xem file an toàn</a></li>
                <?php else: ?>
                    <li><a href="log_files.php">Xem file nguy hiểm</a></li>
                <?php endif; ?>
                <li><a href="logout.php" class="btn btn-danger">Đăng xuất</a></li>
            </ul>
        </nav>

        <div class="form-container">
            <h2>Chức năng</h2>
            <div class="table-container">
                <table>
                    <tr>
                        <th>Chức năng</th>
                        <th>Mô tả</th>
                    </tr>
                    <?php if ($role == 'user'): ?>
                        <tr>
                            <td><a href="upload.php">Tải file</a></td>
                            <td>Tải lên file để kiểm tra mã độc</td>
                        </tr>
                        <tr>
                            <td><a href="safe_files.php">Xem file an toàn</a></td>
                            <td>Danh sách các file đã được kiểm tra an toàn</td>
                        </tr>
                    <?php else: ?>
                        <tr>
                            <td><a href="log_files.php">Xem file nguy hiểm</a></td>
                            <td>Danh sách các file bị phát hiện chứa mã độc</td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
