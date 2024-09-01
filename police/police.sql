/*
在终端中输入：
cd \xampp\mysql\bin
mysql -u root
再输入以下代码
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

--添加某一个数据类型：ALTER TABLE users ADD COLUMN
--                例：ALTER TABLE users ADD COLUMN year INT DEFAULT 0;