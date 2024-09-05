<?php
session_start(); // 启动会话管理

// 销毁所有会话数据
session_unset();

// 销毁会话
session_destroy();

// 重定向到登录页面或首页
header("Location: home.php"); // 或者 header("Location: login.html");
exit();
?>
