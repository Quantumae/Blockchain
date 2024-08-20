<?php
session_start(); // �����Ự����

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

// ����Ƿ��¼
if (!isset($_SESSION['user_id'])) {
    http_response_code(401); // δ��Ȩ
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

$userId = $_SESSION['user_id'];

// ��ѯ�û�����
$sql = "SELECT points FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $userId);
$stmt->execute();
$stmt->bind_result($points);
$stmt->fetch();

header('Content-Type: application/json'); // ȷ������ JSON ����

if ($points === null) {
    http_response_code(404); // δ�ҵ�
    echo json_encode(['error' => 'User not found']);
} else {
    // ���ػ�������
    echo json_encode(['points' => $points]);
}

$stmt->close();
$conn->close();
?>
