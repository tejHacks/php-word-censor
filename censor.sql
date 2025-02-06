
-- Use the newly created database
USE censor_db;

-- Create the table for banned words
CREATE TABLE banned_words (
    id INT AUTO_INCREMENT PRIMARY KEY,
    word VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
