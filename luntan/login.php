<?php
session_start(); // 启动会话管理

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "forum";

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

// 处理表单数据
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST["public_key"]);
    $password = $_POST["password"];

    // 查找用户
    $sql = "SELECT id, password FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // 登录成功，设置会话变量
            $_SESSION['user_id'] = $row['id'];
            header("Location: home.php"); // 重定向到主页
            exit();
        } else {
            echo "密码错误";
        }
    } else {
        echo "公钥不存在";
    }
} else {
    echo "无效的请求方法";
}

$conn->close();
?>
