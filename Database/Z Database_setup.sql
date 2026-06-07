-- database_setup.sql

CREATE DATABASE IF NOT EXISTS hello_world;
USE hello_world;

CREATE TABLE IF NOT EXISTS messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO messages (message) VALUES 
('Hello from the database!'),
('Welcome to our three-tier architecture demo'),
('This is a simple example showing frontend, backend, and database');