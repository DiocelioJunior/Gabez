<?php
include 'config.php';
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];
$tableName = "user_" . $userId . "_data";

// Criar tabela se não existir
$sql = "CREATE TABLE IF NOT EXISTS $tableName (
    id INT AUTO_INCREMENT PRIMARY KEY,
    clientName VARCHAR(100),
    solutionName VARCHAR(100),
    description TEXT,
    imageUrl VARCHAR(255),
    aboutClientName VARCHAR(100),
    aboutSolutionName VARCHAR(100),
    aboutDescription TEXT,
    aboutImageUrl VARCHAR(255),
    testimonialClientName VARCHAR(100),
    testimonialSolutionName VARCHAR(100),
    testimonialDescription TEXT,
    testimonialImageUrl VARCHAR(255),
    testimonialVideoUrl VARCHAR(255),
    offerClientName VARCHAR(100),
    offerSolutionName VARCHAR(100),
    offerDescription TEXT,
    offerImageUrl VARCHAR(255)
)";

$conn->query($sql);

// Receber os dados do formulário
$data = json_decode(file_get_contents('php://input'), true);

// Inserir dados na tabela
$sql = "INSERT INTO $tableName (clientName, solutionName, description, imageUrl, aboutClientName, 
        aboutSolutionName, aboutDescription, aboutImageUrl, testimonialClientName, 
        testimonialSolutionName, testimonialDescription, testimonialImageUrl, 
        testimonialVideoUrl, offerClientName, offerSolutionName, 
        offerDescription, offerImageUrl) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssssssssssss", 
    $data['clientName'],
    $data['solutionName'],
    $data['description'],
    $data['imageUrl'],
    $data['aboutClientName'],
    $data['aboutSolutionName'],
    $data['aboutDescription'],
    $data['aboutImageUrl'],
    $data['testimonialClientName'],
    $data['testimonialSolutionName'],
    $data['testimonialDescription'],
    $data['testimonialImageUrl'],
    $data['testimonialVideoUrl'],
    $data['offerClientName'],
    $data['offerSolutionName'],
    $data['offerDescription'],
    $data['offerImageUrl']
);

if ($stmt->execute()) {
    echo "Data saved successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$conn->close();
?>
