<?php
// Incluir arquivo de configuração
include 'config.php';

// Pegar dados do formulário
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$date_of_birth = $_POST['date_of_birth'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Inserir dados na tabela
$sql = "INSERT INTO users (name, email, phone, date_of_birth, password) VALUES ('$name', '$email', '$phone', '$date_of_birth', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
