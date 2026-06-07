<?php
// api/db_connection.php

function getDatabaseConnection() {

    // 🌍 Read values from Docker environment variables
    $host = getenv('DB_HOST');
    $db_name = getenv('DB_NAME');
    $username = getenv('DB_USER');
    $password = getenv('DB_PASS');

    // ⚠️ Safety check (fail fast if config is missing)
    if (!$host || !$db_name || !$username || !$password) {
        throw new Exception("Missing database environment variables");
    }

    // 🔗 MySQL DSN (connection string)
    $dsn = "mysql:host=$host;dbname=$db_name;charset=utf8mb4";

    // ⚙️ PDO options (best practice)
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,        // show errors as exceptions
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,   // return associative arrays
        PDO::ATTR_EMULATE_PREPARES => false,                // real prepared statements
    ];

    try {
        // 🔌 Create and return database connection
        return new PDO($dsn, $username, $password, $options);

    } catch (PDOException $e) {
        // ❌ Connection failed
        die("Database connection failed");
    }
}
?>