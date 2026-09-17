CREATE DATABASE IF NOT EXISTS abina_scripting_lab_2_q30;
USE abina_scripting_lab_2_q30;

DROP TABLE IF EXISTS records;
CREATE TABLE records (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    rank_no VARCHAR(50) NOT NULL,
    status VARCHAR(20) NOT NULL,
    image VARCHAR(255),
    created_by VARCHAR(50),
    updated_by VARCHAR(50),
    created_at DATETIME,
    updated_at DATETIME
);

INSERT INTO records (name, rank_no, status, image, created_by, updated_by, created_at, updated_at)
VALUES ('Ram Bahadur', '1st', 'active', 'ram.jpg', 'admin', 'admin', NOW(), NOW());