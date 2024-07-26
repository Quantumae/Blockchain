<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "forum";

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接
if(!$conn){
    die("Connection failed. Reason:".mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST["username"];
    $pass = password_hash($_POST["password"], PASSWORD_BCRYPT); // 使用密码哈希

    $sql = "INSERT INTO users (username, password) VALUES ('$user', '$pass')";

    if ($conn->query($sql) === TRUE) {
        echo "success";
        header("Location: login.html");
        exit(); // 确保脚本停止执行
    } else {
        echo "there is something wrong " . $conn->error;
    }

    $conn->close();
}
?>
