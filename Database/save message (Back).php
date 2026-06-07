<?php
header('Content-Type: application/json');

require_once 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'error' => 'Method not allowed'
    ]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);
$message = trim($data['message'] ?? '');

if (empty($message)) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'error' => 'Message cannot be empty'
    ]);
    exit;
}

try {
    $conn = getDatabaseConnection();

    $query = "INSERT INTO messages (message) VALUES (:message)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':message', $message);
    $stmt->execute();

    http_response_code(201);

    echo json_encode([
        'success' => true,
        'message' => 'Message saved successfully'
    ]);

} catch (PDOException $e) {

    http_response_code(500);

    echo json_encode([
        'success' => false,
        'error' => 'Internal server error'
    ]);
}
?>