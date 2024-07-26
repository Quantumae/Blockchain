<?php
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
else{
    echo"connected";
}

// 处理表单数据
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $conn->real_escape_string($_POST["username"]);
    $pass = $_POST["password"];

    $sql = "SELECT password FROM users WHERE username='$user'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($pass, $row['password'])) {
            header("Location: home.html");
            exit();
        } else {
            echo "密码错误";
        }
    } else {
        echo "用户名不存在";
    }
} else {
    echo "无效的请求方法";
}

$conn->close();
?>
