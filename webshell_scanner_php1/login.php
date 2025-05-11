<?php
session_start();
$conn = new mysqli("localhost", "root", "", "database");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $stmt = $conn->prepare("SELECT role FROM user WHERE username='$username' AND password='$password'");
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows == 1) {
        $stmt->bind_result($role);
        $stmt->fetch();
        $_SESSION["username"] = $username;
        $_SESSION["role"] = $role;
        header("Location: dashboard.php");
    } else {
        $error = "Sai tài khoản hoặc mật khẩu!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Đăng nhập</title></head>
<body>
<h2>Đăng nhập</h2>
<form method="POST">
    Username: <input type="text" name="username"><br>
    Password: <input type="password" name="password"><br>
    <input type="submit" value="Login">
</form>
<?php if(isset($error)) echo "<p>$error</p>"; ?>
</body>
</html>
