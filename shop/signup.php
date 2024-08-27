<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shop";

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接
if(!$conn){
    die("Connection failed. Reason:".mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST["public_key"];
    $pass = password_hash($_POST["password"], PASSWORD_BCRYPT); // 使用密码哈希

    $sql = "INSERT INTO users (username, password) VALUES ('$user', '$pass')";

    if ($conn->query($sql) === TRUE) {
        echo "注册成功";
        header("Location: login.html");
        exit();
    } else {
        echo "注册失败: " . $conn->error;
    }

    $conn->close();
}
?>
