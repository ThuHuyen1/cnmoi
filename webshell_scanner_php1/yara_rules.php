<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Xử lý thêm rule mới
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] == 'add') {
        $rule_name = $_POST['rule_name'];
        $rule_content = $_POST['rule_content'];
        $rule_file = "yara_rules/" . $rule_name . ".yar";
        file_put_contents($rule_file, $rule_content);
    } elseif ($_POST['action'] == 'delete' && isset($_POST['rule_file'])) {
        $rule_file = "yara_rules/" . $_POST['rule_file'];
        if (file_exists($rule_file)) {
            unlink($rule_file);
        }
    }
}

// Lấy danh sách các file YARA rules
$rules = glob("yara_rules/*.yar");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý YARA Rules - WebShell Scanner</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>WebShell Scanner</h1>
            <h2>Quản lý YARA Rules</h2>
        </div>

        <nav class="nav-menu">
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="log_files.php">Xem file nguy hiểm</a></li>
                <li><a href="logout.php" class="btn btn-danger">Đăng xuất</a></li>
            </ul>
        </nav>

        <div class="form-container">
            <h2>Thêm Rule mới</h2>
            <form method="POST" class="form-group">
                <input type="hidden" name="action" value="add">
                <div class="form-group">
                    <label for="rule_name">Tên Rule:</label>
                    <input type="text" id="rule_name" name="rule_name" class="form-control" required 
                           placeholder="Ví dụ: webshell_detection">
                </div>
                <div class="form-group">
                    <label for="rule_content">Nội dung Rule:</label>
                    <textarea id="rule_content" name="rule_content" class="form-control" rows="10" required 
                              placeholder="rule Detect_Web_Shell {
    strings:
        $a1 = &quot;system(&quot; nocase
        $a2 = &quot;$_GET&quot; nocase
        $a3 = &quot;$_POST&quot; nocase
    condition:
        any of them
}"></textarea>
                </div>
                <button type="submit" class="btn">Thêm Rule</button>
            </form>
        </div>

        <div class="form-container" style="margin-top: 2rem;">
            <h2>Danh sách Rules hiện có</h2>
            <?php if (empty($rules)): ?>
                <div class="alert alert-info" style="background-color: #e3f2fd; color: #0d47a1; border: 1px solid #bbdefb;">
                    Chưa có rule nào được thêm vào.
                </div>
            <?php else: ?>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Tên Rule</th>
                                <th>Nội dung</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rules as $rule): ?>
                                <?php 
                                $rule_name = basename($rule, '.yar');
                                $rule_content = htmlspecialchars(file_get_contents($rule));
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($rule_name); ?></td>
                                    <td>
                                        <pre style="max-height: 100px; overflow-y: auto; background: #f8f9fa; padding: 10px; border-radius: 4px;"><?php echo $rule_content; ?></pre>
                                    </td>
                                    <td>
                                        <form method="POST" style="display: inline;">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="rule_file" value="<?php echo basename($rule); ?>">
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa rule này?')">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html> 