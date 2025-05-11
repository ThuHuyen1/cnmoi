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
<title>Upload File</title></head>
<body>
<h2>Tải lên file</h2>
<form method="POST" enctype="multipart/form-data" action="upload_handler.php">
    <input type="file" name="file">
    <input type="submit" value="Tải lên">
</form>
</body>
</html>
