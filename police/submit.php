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

// ��ȡ������
$name = $_POST['name'];
$public_key = $_POST['public_key'];
$year = $_POST['year'];

// ��ֹSQLע��
$name = $conn->real_escape_string($name);
$public_key = $conn->real_escape_string($public_key);
$year = (int)$year;

// ��������
$sql = "INSERT INTO your_table (name, public_key, year, pass) VALUES ('$name', '$public_key', $year, 0)";

if ($conn->query($sql) === TRUE) {
    echo "����ɹ���";
} else {
    echo "����: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
