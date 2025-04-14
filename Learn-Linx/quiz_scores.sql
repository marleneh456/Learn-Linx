CREATE TABLE quiz_scores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(100),
    course_name VARCHAR(100),
    score INT,
    total INT,
    taken_on DATETIME DEFAULT CURRENT_TIMESTAMP
);
