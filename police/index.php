<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>���ҳ��</title>
</head>
<body>
    <h2>�������</h2>
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
            // �������ݿ�
            $servername = "localhost";
            $username = "root"; // Ĭ���û�����root
            $password = ""; // Ĭ��û������
            $dbname = "police"; // ���ݿ���Ϊpolice

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("����ʧ��: " . $conn->connect_error);
            }

            // ��ѯpassֵΪ0������
            $sql = "SELECT name, public_key, year FROM your_table WHERE pass = 0";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // �������
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["public_key"] . "</td>";
                    echo "<td>" . $row["year"] . "</td>";
                    echo '<td><a href="update.php?id=' . $row["id"] . '&action=approve">ͨ��</a> | ';
                    echo '<a href="update.php?id=' . $row["id"] . '&action=reject">��ͨ��</a></td>';
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>û�д���˵�����</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>
