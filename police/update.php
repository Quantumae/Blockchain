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

// 获取传递的参数
if (isset($_GET['public_key']) && isset($_GET['action'])) {
    $public_key = $_GET['public_key'];
    $action = $_GET['action'];

    // 更新pass值
    $pass = ($action === 'approve') ? 1 : -1;

    // 使用prepared statement防止SQL注入
    $sql = "UPDATE users SET pass = ? WHERE public_key = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $pass, $public_key);

    if ($stmt->execute()) {
        echo "审核状态更新成功";
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    // 关闭statement
    $stmt->close();

    // 跳转回审核页面
    header('Location: index.php');
    exit;
} else {
    echo "无效的请求";
}

$conn->close();
?>
