<?php
// Incluir arquivo de configuração
include 'config.php';

// Iniciar sessão
session_start();

// Verificar se os dados do formulário foram enviados
if (isset($_POST['email']) && isset($_POST['password'])) {
    // Pegar dados do formulário
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Preparar e executar consulta
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar se o usuário existe
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Armazenar informações do usuário na sessão
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['username'] = $row['username'];
            // Redirecionar para a página home.html
            header("Location: home.html");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with this email.";
    }

    // Fechar a declaração e a conexão
    $stmt->close();
} else {
    echo "Please enter both email and password.";
}

$conn->close();
?>
