<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>帖子详情</title>
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
            padding: 20px;
            text-align: center;
        }

        .post-title {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .post-content {
            line-height: 1.6;
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
            max-width: 800px;
            padding: 20px;
        }

        .container2 {
            width: 80%;
            margin: auto;
            max-width: 1200px;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .comment {
            background-color: #fff;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .comment-form {
            background-color: #fff;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

            .comment-form textarea {
                width: 100%;
                padding: 10px;
                border-radius: 4px;
                border: 1px solid #ddd;
                margin-bottom: 10px;
                box-sizing: border-box;
            }

            .comment-form button {
                padding: 10px 20px;
                border: none;
                border-radius: 4px;
                background-color: #007bff;
                color: #fff;
                cursor: pointer;
            }

                .comment-form button:hover {
                    background-color: #0056b3;
                }
    </style>
</head>
<body>
    <div class="header">
        <h1>白度贴巴</h1>
    </div>
    <div class="nav">
        <a href="home.php">首页</a>
        <a href="board.php">论坛版块</a>
        <a href="about_us.php">关于我们</a>
        <a href="call_us.php">联系我们</a>
    </div>

    <div class="container2">
        <div class="post-title">
            <h1>如何在Python中使用装饰器？</h1>
        </div>
        <div class="post-content">
            <p>装饰器是Python中一种非常强大的工具，可以用来修改函数或方法的行为。通过使用装饰器，我们可以在不修改函数本身的情况下，添加额外的功能或逻辑。</p>
            <p>在Python中，装饰器实际上是一个函数，它接受一个函数作为参数，并返回一个新的函数。这个新的函数通常会包含原始函数的功能，并且可以添加额外的功能。</p>
            <h2>示例代码：</h2>
            <pre><code>def decorator(func):
    def wrapper(*args, **kwargs):
        print("Before the function is called.")
        result = func(*args, **kwargs)
        print("After the function is called.")
        return result
    return wrapper

@decorator
def say_hello(name):
    print(f"Hello, {name}!")

say_hello("World")</code></pre>
            <p>在上面的示例中，`decorator` 是一个装饰器，它在调用 `say_hello` 函数之前和之后打印一些消息。使用 `@decorator` 语法，我们可以将装饰器应用于 `say_hello` 函数。</p>
        </div>
    </div>

    <div class="container">
        <div class="comment-form">
            <h2>添加评论</h2>
            <form id="comment-form">
                <textarea id="comment-content" rows="4" placeholder="请输入评论..."></textarea>
                <button type="submit">提交评论</button>
            </form>
        </div>
        <div id="comments-container">
            <!-- 评论将被动态加载到这里 -->
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const commentsContainer = document.getElementById('comments-container');
            const commentForm = document.getElementById('comment-form');
            const commentContent = document.getElementById('comment-content');

            // 加载评论
            function loadComments() {
                fetch('get_comments.php')
                    .then(response => response.json())
                    .then(data => {
                        commentsContainer.innerHTML = ''; // 清空评论容器
                        data.forEach(comment => {
                            const commentDiv = document.createElement('div');
                            commentDiv.className = 'comment';
                            commentDiv.innerHTML = `<p>${comment.content}</p>`;
                            commentsContainer.appendChild(commentDiv);
                        });
                    });
            }

            // 提交评论
            commentForm.addEventListener('submit', function (event) {
                event.preventDefault();
                fetch('add_comment.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({
                        content: commentContent.value
                    })
                }).then(() => {
                    commentContent.value = ''; // 清空文本框
                    loadComments(); // 重新加载评论
                });
            });

            loadComments(); // 页面加载时加载评论
        });</script>
</body>
</html>
