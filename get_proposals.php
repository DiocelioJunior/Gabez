<?php
include 'config.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode([]);
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT p.*, u.username 
        FROM proposals p 
        JOIN users u ON p.user_id = u.id 
        WHERE p.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$proposals = [];
while ($row = $result->fetch_assoc()) {
    $proposals[] = $row;
}

echo json_encode($proposals);

$conn->close();
?>
