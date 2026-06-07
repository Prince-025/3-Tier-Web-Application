<?php
header('Content-Type: application/json');

require_once 'db_connection.php';

try {
    $conn = getDatabaseConnection();

    $query = "SELECT * FROM messages ORDER BY created_at DESC LIMIT 10";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

    http_response_code(200);

    echo json_encode([
        'success' => true,
        'messages' => $messages
    ]);

} catch (PDOException $e) {

    http_response_code(500);

    echo json_encode([
        'success' => false,
        'error' => 'Internal server error'
    ]);
}
?>