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
    $pass = password_hash($_POST["password"], PASSWORD_BCRYPT); // ʹ�������ϣ

    $sql = "INSERT INTO users (username, password) VALUES ('$user', '$pass')";

    if ($conn->query($sql) === TRUE) {
        echo "ע��ɹ�";
    } else {
        echo "ע��ʧ��: " . $conn->error;
    }

    $conn->close();
}
?>
