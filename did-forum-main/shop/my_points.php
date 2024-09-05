<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>我的积分</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #4CAF50;
            color: white;
            padding: 10px 0;
            text-align: center;
        }

        nav {
            margin: 10px 0;
            text-align: center;
        }

            nav a {
                margin: 0 15px;
                text-decoration: none;
                color: #333;
            }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .hero {
            text-align: center;
            padding: 50px 0;
        }

            .hero h1 {
                margin: 0;
                font-size: 2.5em;
                color: #333;
            }

            .hero p {
                color: #777;
                font-size: 1.2em;
            }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>
<body>
    <header>
        <h1>积分兑换奖品</h1>
    </header>
    <nav>
        <a href="home.php">首页</a>
        <a href="goods.html">奖品</a>
        <a href="get_points.html">我的积分</a>


        <?php
        session_start();
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


    </nav>
    <div class="container">
        <div class="hero">
            <h1>我的积分</h1>
            <p>查看您当前的积分余额</p>
        </div>
        <div class="hero">
            <p>您的当前积分是：<span id="points">加载中...</span></p>
        </div>
    </div>
    <footer>
        <p>© 浙江大学srtp项目 版权所有.</p>
    </footer>

    <script>
        async function fetchPoints() {
            try {
                const response = await fetch('get_points.php');
                if (response.ok) {
                    const data = await response.json();
                    if (data.points !== undefined) {
                        document.getElementById('points').textContent = data.points;
                    } else {
                        document.getElementById('points').textContent = '无法获取积分';
                    }
                } else {
                    document.getElementById('points').textContent = '无法获取积分';
                    console.error('Server responded with an error:', await response.text());
                }
            } catch (error) {
                document.getElementById('points').textContent = '加载失败';
                console.error('Error fetching points:', error);
            }
        }

        // Fetch points on page load
        fetchPoints();
    </script>
</body>
</html>
