<?php
session_start(); // �����Ự����

// �������лỰ����
session_unset();

// ���ٻỰ
session_destroy();

// �ض��򵽵�¼ҳ�����ҳ
header("Location: home.php"); // ���� header("Location: login.html");
exit();
?>
