<?php
// Incluir arquivo de configuração
include 'config.php';

// Iniciar sessão
session_start();

// Pegar dados do formulário
$email = $_POST['email'];
$password = $_POST['password'];

// Verificar se o usuário existe
$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        // Armazenar informações do usuário na sessão
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['name'];
        // Redirecionar para a página home.html
        header("Location: home.html");
        exit();
    } else {
        echo "Invalid password.";
    }
} else {
    echo "No user found with this email.";
}

$conn->close();
?>
