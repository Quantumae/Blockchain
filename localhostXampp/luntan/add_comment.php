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

// 获取评论内容
$content = $_POST['content'];

// 插入评论
$sql = "INSERT INTO comments (content) VALUES (?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $content);
$stmt->execute();

$stmt->close();
$conn->close();
?>
