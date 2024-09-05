<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>生活闲聊区</title>
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

        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
            max-width: 1200px;
        }

        .section {
            margin: 20px 0;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

            .section h2 {
                margin-top: 0;
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

        .contact-info {
            line-height: 1.6;
        }
    </style>
</head>
<body>
    
    <div class="header">
        <h1>关于我们</h1>
    </div>
    <div class="nav">
        <a href="home.php">首页</a>
        <a href="board.php">论坛版块</a>
        <a href="about_us.php">关于我们</a>
        <a href="call_us.php">联系我们</a>
    </div>
    <div class="container">
        <div class="section">
            <h2>生活闲聊区</h2>
            <div class="contact-info">
                <p>哼，才...才不是没有做呢，只是...只是没有做好而已>_<</p>
            </div>
        </div>
    </div>
    <div class="footer">
        <p>© 浙江大学srtp项目 版权所有.</p>
    </div>
</body>
</html>
