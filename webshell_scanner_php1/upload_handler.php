<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
session_start();
$conn = new mysqli("localhost", "root", "", "database");
if ($_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit();
}
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
        echo "Phát hiện mã độc! File đã bị chặn.";
    } else {
        $stmt = $conn->prepare("INSERT INTO safe_file (filename, uploader) VALUES (?, ?)");
        $stmt->bind_param("ss", $filename, $_SESSION['username']);
        $stmt->execute();
        echo "Tải lên thành công!";
    }
}
?>
<br><a href="dashboard.php">Quay lại Dashboard</a>

</body>
</html>