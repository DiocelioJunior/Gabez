<?php
// Iniciar a sessão
session_start();

// Verificar se o usuário está logado e obter o ID do usuário
if (!isset($_SESSION['user_id'])) {
    die("Usuário não está logado.");
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username']; // Obter o nome de usuário da sessão

// Configurações do banco de dados
$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "user_database";

// Conectar ao banco de dados
$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Receber dados JSON
$data = json_decode(file_get_contents('php://input'), true);

// Verificar se os dados foram recebidos corretamente
if (is_array($data)) {
    // Preparar a declaração SQL
    $stmt = $conn->prepare("INSERT INTO proposals (user_id, clientName, solutionName, description, imageUrl, 
    aboutClientName, aboutSolutionName, aboutDescription, aboutImageUrl, 
    testimonialClientName, testimonialSolutionName, testimonialDescription, testimonialImageUrl, testimonialVideoUrl, 
    offerClientName, offerSolutionName, offerDescription, offerImageUrl) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Ligar os parâmetros
    $stmt->bind_param("isssssssssssssssss", 
        $user_id,
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

    // Executar a declaração
    if ($stmt->execute()) {
        $proposal_id = $stmt->insert_id; // ID da proposta inserida
        $proposal_link = "http://localhost/Gabez/view_proposal.php/" . $_SESSION['username'] . "/$proposal_id"; // Gera o link
        echo json_encode([
            'message' => 'Dados salvos com sucesso!',
            'proposal_link' => $proposal_link
        ]);
        
        // Mostrar o link em um alert (apenas para fins de demonstração)
        echo "<script>alert('Link da proposta: $proposal_link');</script>";
    } else {
        echo "Erro ao salvar dados: " . $stmt->error;
    }

    // Fechar a declaração
    $stmt->close();
} else {
    echo json_encode([
        "message" => "Dados inválidos."
    ]);
}

// Fechar a conexão
$conn->close();
?>
