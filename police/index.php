<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>审核页面</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            width: 100%;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            color: #333;
        }
        td {
            color: #666;
        }
        td.action {
            text-align: center;
        }
        td.action a {
            padding: 5px 10px;
            margin-right: 5px;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        td.action a:hover {
            background-color: #007BFF;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>审核数据</h2>
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

        // 查询pass值为0的数据
        $sql = "SELECT name, public_key, year FROM users WHERE pass = 0";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<table>';
            echo '<thead><tr>';
            echo '<th>Name</th>';
            echo '<th>Public Key</th>';
            echo '<th>Year</th>';
            echo '<th>Action</th>';
            echo '</tr></thead>';
            echo '<tbody>';
            while($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row["name"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["public_key"]) . '</td>';
                echo '<td>' . $row["year"] . '</td>';
                echo '<td class="action">';
                echo '<a href="update.php?public_key=' . urlencode($row["public_key"]) . '&action=approve">通过</a>';
                echo '<a href="update.php?public_key=' . urlencode($row["public_key"]) . '&action=reject">不通过</a>';
                echo '</td>';
                echo '</tr>';
            }
            echo '</tbody></table>';
        } else {
            echo "<p>没有待审核的数据</p>";
        }
        $conn->close();
        ?>
    </div>
</body>
</html>
