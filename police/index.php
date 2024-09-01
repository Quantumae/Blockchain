<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>审核页面</title>
</head>
<body>
    <h2>审核数据</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>Public Key</th>
                <th>Year</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
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
                // 输出数据
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["public_key"] . "</td>";
                    echo "<td>" . $row["year"] . "</td>";
                    echo '<td><a href="update.php?id=' . $row["id"] . '&action=approve">通过</a> | ';
                    echo '<a href="update.php?id=' . $row["id"] . '&action=reject">不通过</a></td>';
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>没有待审核的数据</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>
