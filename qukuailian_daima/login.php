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

// ����������
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $conn->real_escape_string($_POST["public_key"]);
    $pass = $_POST["password"];

    $sql = "SELECT password FROM users WHERE username='$user'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($pass, $row['password'])) {
            header("Location: home.html");
            exit();
        } else {
            echo "wrong password";
        }
    } else {
        echo "no user";
    }
} else {
    echo "problem";
}

$conn->close();
?>
