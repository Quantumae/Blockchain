<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>积分兑换奖品</title>
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

        .products {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .product {
            width: 30%;
            margin: 15px 0;
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-align: center;
        }

            .product img {
                max-width: 100%;
                height: auto;
            }

            .product h3 {
                margin: 10px 0;
            }

            .product p {
                color: #555;
            }

            .product button {
                background-color: #4CAF50;
                color: white;
                border: none;
                padding: 10px 20px;
                cursor: pointer;
                border-radius: 5px;
            }

                .product button:hover {
                    background-color: #45a049;
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
        <a href="goods.php">奖品</a>
        <a href="my_points.php">我的积分</a>

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
            <h1>欢迎来到积分兑换奖品平台</h1>
            <p>用您的积分兑换精彩奖品!</p>
        </div>
        <div class="products">
            <div class="product">
                <img src="https://via.placeholder.com/150" alt="产品1">
                <h3>奖品1</h3>
                <p>100积分</p>
                <button>立即兑换</button>
            </div>
            <div class="product">
                <img src="https://via.placeholder.com/150" alt="产品2">
                <h3>奖品2</h3>
                <p>200积分</p>
                <button>立即兑换</button>
            </div>
            <div class="product">
                <img src="https://via.placeholder.com/150" alt="产品3">
                <h3>奖品3</h3>
                <p>300积分</p>
                <button>立即兑换</button>
            </div>
        </div>
    </div>
    <footer>
        <p>© 浙江大学srtp项目 版权所有.</p>
    </footer>
</body>
</html>
