CREATE DATABASE IF NOT EXISTS abina_scripting_lab_2_q31;
USE abina_scripting_lab_2_q31;

DROP TABLE IF EXISTS students;
DROP TABLE IF EXISTS courses;

CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    duration VARCHAR(50),
    status VARCHAR(20),
    created_at DATETIME,
    updated_at DATETIME
);

CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    course_id INT,
    fee DECIMAL(10,2),
    rollno VARCHAR(20),
    phone VARCHAR(20),
    address VARCHAR(150),
    dob DATE,
    status VARCHAR(20),
    created_at DATETIME,
    updated_at DATETIME,
    FOREIGN KEY (course_id) REFERENCES courses(id)
);

INSERT INTO courses (title, duration, status, created_at, updated_at)
VALUES ('BCA', '4 Years', 'active', NOW(), NOW());