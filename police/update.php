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

// ��ȡ���ݵĲ���
if (isset($_GET['id']) && isset($_GET['action'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];

    // ����passֵ
    $pass = ($action === 'approve') ? 1 : -1;

    $sql = "UPDATE users SET pass = $pass WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "���״̬���³ɹ�";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    // ��ת�����ҳ��
    header('Location: index.php');
    exit;
} else {
    echo "��Ч������";
}

$conn->close();
?>
