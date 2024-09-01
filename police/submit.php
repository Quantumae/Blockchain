<?php
// 连接数据库
$servername = "localhost";
$username = "root"; // 默认用户名是root
$password = ""; // 默认没有密码
$dbname = "police"; // 数据库名为police

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

// 获取表单数据
$name = $_POST['name'];
$public_key = $_POST['public_key'];
$year = $_POST['year'];
$id = $_POST['id'];

// 防止SQL注入
$name = $conn->real_escape_string($name);
$public_key = $conn->real_escape_string($public_key);
$year = (int)$year;
$id = (int)$id;

// 插入数据
$sql = "INSERT INTO users (name, public_key, year, pass) VALUES ('$name', '$public_key', $year,$id, 0)";

if ($conn->query($sql) === TRUE) {
    echo "申请成功！";
} else {
    echo "错误: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
