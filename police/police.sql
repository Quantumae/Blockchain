/*
���ն������룺
cd \xampp\mysql\bin
mysql -u root
���������´���
*/
CREATE DATABASE police;
USE police;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE,
    public_key VARCHAR(50) NOT NULL UNIQUE,
    year INT DEFAULT 0,
    pass INT DEFAULT 0
);

--���ĳһ���������ͣ�ALTER TABLE users ADD COLUMN
--                ����ALTER TABLE users ADD COLUMN year INT DEFAULT 0;