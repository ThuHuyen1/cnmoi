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
    <title>File an toàn - WebShell Scanner</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>WebShell Scanner</h1>
            <h2>Danh sách file an toàn</h2>
        </div>

        <nav class="nav-menu">
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="upload.php">Tải file</a></li>
                <li><a href="logout.php" class="btn btn-danger">Đăng xuất</a></li>
            </ul>
        </nav>

        <div class="form-container">
            <h2>File đã kiểm tra an toàn</h2>
            <?php if($result->num_rows > 0): ?>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Tên file</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['filename']); ?></td>
                                <td>
                                    <span class="alert alert-success" style="padding: 0.25rem 0.5rem; display: inline-block;">
                                        An toàn
                                    </span>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-info" style="background-color: #e3f2fd; color: #0d47a1; border: 1px solid #bbdefb;">
                    Bạn chưa có file nào được kiểm tra an toàn.
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
