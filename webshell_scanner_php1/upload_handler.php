<?php
session_start();
$conn = new mysqli("localhost", "root", "", "database");
if ($_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit();
}

$message = '';
$messageType = '';
$filename = '';

if ($_FILES['file']['error'] == 0) {
    $filename = basename($_FILES['file']['name']);
    $filepath = "uploads/" . $filename;
    move_uploaded_file($_FILES['file']['tmp_name'], $filepath);

    $content = file_get_contents($filepath);
    if (preg_match('/eval|system|shell_exec|base64_decode|passthru/i', $content)) {
        unlink($filepath);
        $stmt = $conn->prepare("INSERT INTO log (filename, uploader, reason) VALUES (?, ?, ?)");
        $reason = "Phát hiện mã độc Web Shell";
        $stmt->bind_param("sss", $filename, $_SESSION['username'], $reason);
        $stmt->execute();
        $message = "Phát hiện mã độc! File đã bị chặn.";
        $messageType = 'danger';
    } else {
        $stmt = $conn->prepare("INSERT INTO safe_file (filename, uploader) VALUES (?, ?)");
        $stmt->bind_param("ss", $filename, $_SESSION['username']);
        $stmt->execute();
        $message = "Tải lên thành công!";
        $messageType = 'success';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả kiểm tra - WebShell Scanner</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>WebShell Scanner</h1>
            <h2>Kết quả kiểm tra file</h2>
        </div>

        <nav class="nav-menu">
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="upload.php">Tải file khác</a></li>
                <li><a href="safe_files.php">Xem file an toàn</a></li>
                <li><a href="logout.php" class="btn btn-danger">Đăng xuất</a></li>
            </ul>
        </nav>

        <div class="form-container">
            <h2>Thông tin file</h2>
            <?php if($filename): ?>
                <div class="form-group">
                    <label>Tên file:</label>
                    <p><?php echo htmlspecialchars($filename); ?></p>
                </div>
            <?php endif; ?>

            <?php if($message): ?>
                <div class="alert alert-<?php echo $messageType; ?>">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <div class="form-group" style="margin-top: 2rem;">
                <a href="upload.php" class="btn">Tải file khác</a>
                <a href="safe_files.php" class="btn" style="margin-left: 1rem;">Xem file an toàn</a>
            </div>
        </div>
    </div>
</body>
</html>