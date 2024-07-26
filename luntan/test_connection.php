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
echo "成功连接到数据库";
$conn->close();
?>
