<?php
// 连接数据库
$servername = "localhost";
$username = "root"; // 默认用户名是root
$password = ""; // 默认没有密码
$dbname = "police"; // 数据库名为police

$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接是否成功
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

// 获取表单数据
$name = $conn->real_escape_string($_POST['name']);
$public_key = $conn->real_escape_string($_POST['public_key']);
$year = (int)$_POST['year'];

// 插入数据
$sql = "INSERT INTO users (name, public_key, year, pass) VALUES ('$name', '$public_key', $year, 0)";

if ($conn->query($sql) === TRUE) {
    echo "申请成功！";
} else {
    echo "错误: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
