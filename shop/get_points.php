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

// 检查是否登录
if (!isset($_SESSION['user_id'])) {
    http_response_code(401); // 未授权
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

$userId = $_SESSION['user_id'];

// 查询用户积分
$sql = "SELECT points FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $userId);
$stmt->execute();
$stmt->bind_result($points);
$stmt->fetch();

header('Content-Type: application/json'); // 确保返回 JSON 数据

if ($points === null) {
    http_response_code(404); // 未找到
    echo json_encode(['error' => 'User not found']);
} else {
    // 返回积分数据
    echo json_encode(['points' => $points]);
}

$stmt->close();
$conn->close();
?>
