<?php
// Incluir arquivo de configuração
include 'config.php';

// Verificar se os dados do formulário foram enviados
if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['date_of_birth']) && isset($_POST['password'])) {
    // Pegar dados do formulário
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $date_of_birth = $_POST['date_of_birth'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Preparar e vincular
    $stmt = $conn->prepare("INSERT INTO users (username, email, phone, date_of_birth, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $email, $phone, $date_of_birth, $password);

    // Executar a declaração
    if ($stmt->execute() === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Fechar a declaração e a conexão
    $stmt->close();
} else {
    echo "Please fill in all fields.";
}

$conn->close();
?>
