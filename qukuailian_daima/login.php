<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "forum";

// ��������
$conn = new mysqli($servername, $username, $password, $dbname);

// �������
if ($conn->connect_error) {
    die("����ʧ��: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST["username"];
    $pass = $_POST["password"];

    $sql = "SELECT password FROM users WHERE username='$user'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($pass, $row['password'])) {
            echo "��¼�ɹ�";
        } else {
            echo "�������";
        }
    } else {
        echo "�û���������";
    }

    $conn->close();
}
?>
