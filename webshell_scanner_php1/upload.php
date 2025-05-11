<?php
session_start();
if ($_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tải lên file - WebShell Scanner</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>WebShell Scanner</h1>
            <h2>Tải lên file</h2>
        </div>

        <nav class="nav-menu">
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="safe_files.php">Xem file an toàn</a></li>
                <li><a href="logout.php" class="btn btn-danger">Đăng xuất</a></li>
            </ul>
        </nav>

        <div class="form-container">
            <h2>Tải lên file để kiểm tra</h2>
            <div class="alert alert-info" style="background-color: #e3f2fd; color: #0d47a1; border: 1px solid #bbdefb; margin-bottom: 1.5rem;">
                Hệ thống sẽ tự động kiểm tra file của bạn để phát hiện mã độc Web Shell.
            </div>
            
            <form method="POST" enctype="multipart/form-data" action="upload_handler.php">
                <div class="form-group">
                    <label for="file">Chọn file để tải lên:</label>
                    <input type="file" id="file" name="file" class="form-control" required>
                </div>
                <button type="submit" class="btn">Tải lên và kiểm tra</button>
            </form>
        </div>
    </div>
</body>
</html>
