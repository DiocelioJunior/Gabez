<?php
// Configurações do banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_database";

// Conectar ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Obter o UUID da URL
$uuid = $_GET['uuid'];

// Preparar a declaração SQL
$stmt = $conn->prepare("SELECT * FROM propostas WHERE uuid = ?");
$stmt->bind_param("s", $uuid);

// Executar a declaração
$stmt->execute();
$result = $stmt->get_result();

// Verificar se a proposta foi encontrada
if ($result->num_rows > 0) {
    $proposal = $result->fetch_assoc();
} else {
    die("Proposta não encontrada.");
}

// Fechar a declaração
$stmt->close();

// Fechar a conexão
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/proposta.css">
    <title>Proposta - <?php echo htmlspecialchars($proposal['clientName']); ?></title>
</head>
<body>
    <div class="container mt-5">
        <div class="mb-4">
            <h1>Olá, <?php echo htmlspecialchars($proposal['clientName']); ?>. Esta é</h1>
            <h2>Proposta Comercial</h2>
        </div>
        
        <div class="mt-4">
            <h2>Detalhes da Proposta</h2>
            <p><strong>Nome da Solução:</strong> <?php echo htmlspecialchars($proposal['solutionName']); ?></p>
            <p><strong>Descrição:</strong> <?php echo htmlspecialchars($proposal['description']); ?></p>
            <p><strong>URL da Imagem:</strong> <img src="<?php echo htmlspecialchars($proposal['imageUrl']); ?>" alt="Imagem da Proposta" class="img-fluid"></p>
        </div>

        <div class="mt-4">
            <h2>Sobre Mim</h2>
            <p><strong>Título:</strong> <?php echo htmlspecialchars($proposal['aboutClientName']); ?></p>
            <p><strong>Sub-Título:</strong> <?php echo htmlspecialchars($proposal['aboutSolutionName']); ?></p>
            <p><strong>Parágrafo:</strong> <?php echo htmlspecialchars($proposal['aboutDescription']); ?></p>
            <p><strong>URL da Imagem:</strong> <img src="<?php echo htmlspecialchars($proposal['aboutImageUrl']); ?>" alt="Imagem sobre mim" class="img-fluid"></p>
        </div>

        <div class="mt-4">
            <h2>Depoimentos</h2>
            <p><strong>Título:</strong> <?php echo htmlspecialchars($proposal['testimonialClientName']); ?></p>
            <p><strong>Sub-Título:</strong> <?php echo htmlspecialchars($proposal['testimonialSolutionName']); ?></p>
            <p><strong>Parágrafo:</strong> <?php echo htmlspecialchars($proposal['testimonialDescription']); ?></p>
            <p><strong>URL da Imagem:</strong> <img src="<?php echo htmlspecialchars($proposal['testimonialImageUrl']); ?>" alt="Imagem do depoimento" class="img-fluid"></p>
            <p><strong>URL do Vídeo:</strong> <a href="<?php echo htmlspecialchars($proposal['testimonialVideoUrl']); ?>" class="btn btn-primary">Ver Vídeo</a></p>
        </div>

        <div class="mt-4">
            <h2>Ofertas</h2>
            <p><strong>Título:</strong> <?php echo htmlspecialchars($proposal['offerClientName']); ?></p>
            <p><strong>Sub-Título:</strong> <?php echo htmlspecialchars($proposal['offerSolutionName']); ?></p>
            <p><strong>Parágrafo:</strong> <?php echo htmlspecialchars($proposal['offerDescription']); ?></p>
            <p><strong>URL da Imagem:</strong> <img src="<?php echo htmlspecialchars($proposal['offerImageUrl']); ?>" alt="Imagem da oferta" class="img-fluid"></p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
