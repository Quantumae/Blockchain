<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>论坛首页</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .header {
            background-color: #66ccff;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        .login {
            position: absolute;
            top: 10px;
            left: 10px;
        }

            .login a {
                color: #fff;
                text-decoration: none;
                font-weight: bold;
                background-color: #007bff;
                padding: 5px 10px;
                border-radius: 5px;
            }

        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
            max-width: 1200px; /* 设置最大宽度 */
        }

        .nav {
            background-color: #66ccff;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

            .nav a {
                color: #fff;
                margin: 0 15px;
                text-decoration: none;
            }

        .section {
            margin: 20px 0;
        }

            .section h2 {
                background-color: #ddd;
                padding: 10px;
                border-radius: 5px;
            }

        .board-list, .post-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .board-list {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

            .board-list li, .post-list li {
                background-color: #fff;
                padding: 15px;
                border-radius: 5px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

                .board-list li a, .post-list li a {
                    text-decoration: none;
                    color: #333;
                    font-weight: bold;
                }

                    .board-list li a:hover, .post-list li a:hover {
                        color: #007bff;
                    }

        .footer {
            background-color: #66ccff;
            color: #fff;
            text-align: center;
            padding: 10px;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>
<body>
    <div class="login">
        <?php
        if (isset($_SESSION['user_id'])) {
        // 用户已登录，显示用户名
        echo '<span>欢迎，' . htmlspecialchars($_SESSION['user_id']) . '</span>';
        echo ' | <a href="logout.php">登出</a>';
        } else {
        // 用户未登录，显示登录和注册链接
        echo '<a href="login.html">登录</a>';
        echo '<a href="signup.html">注册</a>';
        }
        ?>
    </div>
    <div class="header">
        <h1>白度贴巴</h1>
    </div>
    <div class="nav">
        <a href="home.php">首页</a>
        <a href="board.php">论坛版块</a>
        <a href="about_us.php">关于我们</a>
        <a href="call_us.php">联系我们</a>
    </div>
    <div class="container">
        <div class="section">
            <h2>论坛版块</h2>
            <ul class="board-list">
                <li><a href="tech.php">技术讨论区</a></li>
                <li><a href="life.php">生活闲聊区</a></li>
                <li><a href="entertainment.php">娱乐八卦区</a></li>
                <li><a href="resources.php">学习资源区</a></li>
            </ul>
        </div>
        <div class="section">
            <h2>最新帖子</h2>
            <ul class="post-list">
                <li><a href="postI.html">如何在Python中使用装饰器？</a></li>
                <li><a href="postII.html">区块链和元宇宙是什么？</a></li>
                <li><a href="postIII.html">如何快速学习一门新语言？</a></li>
                <li><a href="postIV.html">你最喜欢的旅行地是哪儿？</a></li>
            </ul>
        </div>
    </div>
    <div class="footer">
        <p>© 浙江大学srtp项目 版权所有.</p>
    </div>
</body>
</html>
