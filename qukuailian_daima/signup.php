<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "forum";

// ��������
$conn = new mysqli($servername, $username, $password, $dbname);

// �������
if(!$conn){
    die("Connection failed. Reason:".mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST["username"];
    $pass = password_hash($_POST["password"], PASSWORD_BCRYPT); // ʹ�������ϣ

    $sql = "INSERT INTO users (username, password) VALUES ('$user', '$pass')";

    if ($conn->query($sql) === TRUE) {
        echo "success";
        header("Location: login.html");
        exit();
    } else {
        echo "there is something wrong " . $conn->error;
    }

    $conn->close();
}
?>
