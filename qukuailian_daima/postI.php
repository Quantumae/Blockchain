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

// 处理评论提交
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 获取评论内容
    $comment = $_POST["comment"];

    // 转义特殊字符以防止SQL注入
    $comment = $conn->real_escape_string($comment);

    // 插入评论到数据库（假设评论表为 `comments`）
    $sql = "INSERT INTO comments (post_id, content) VALUES (1, '$comment')"; // `post_id` 应根据具体实现修改

    if ($conn->query($sql) === TRUE) {
        echo "评论已提交成功!";
    } else {
        echo "错误: " . $sql . "<br>" . $conn->error;
    }

    // 关闭连接
    $conn->close();

    // 重定向回到帖子页面
    header("Location: postI.html");
    exit();
} else {
    echo "无效的请求方法";
}
?>
