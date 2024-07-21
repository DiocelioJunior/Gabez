<?php
include 'config.php';

// Extrair dados da URL
$url_path = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
$username = $url_path[2]; // username
$proposal_id = $url_path[3]; // proposal_id

// Debugging
echo "Username: $username<br>";
echo "Proposal ID: $proposal_id<br>";

// Preparar a consulta
$stmt = $conn->prepare("SELECT * FROM proposals WHERE id = ? AND user_id = (SELECT id FROM users WHERE username = ?)");
$stmt->bind_param("is", $proposal_id, $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $proposal = $result->fetch_assoc();
} else {
    die("Proposta não encontrada. URL: $username/$proposal_id");
}

// Fechar a conexão
$stmt->close();
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
        <div class="intro mb-4">
            <h1>Olá, <span><?php echo htmlspecialchars($proposal['clientName']); ?></span>. Esta é</h1>
            <h2>Proposta<br> Comercial</h2>
        </div>
        
        <div class="proposal mt-4">
            <h2>Detalhes da Proposta</h2>
            <p><strong>Nome da Solução:</strong> <?php echo htmlspecialchars($proposal['solutionName']); ?></p>
            <p><strong>Descrição:</strong> <?php echo htmlspecialchars($proposal['description']); ?></p>
        </div>

        <div class="about mt-4">
            <h2>Sobre Mim</h2>
            <div class="about-container">
                <div>
                    <p><?php echo htmlspecialchars($proposal['aboutClientName']); ?></p>
                    <p><?php echo htmlspecialchars($proposal['aboutSolutionName']); ?></p>
                    <p><?php echo htmlspecialchars($proposal['aboutDescription']); ?></p>
                </div>
                <div>
                    <p><img src="<?php echo htmlspecialchars($proposal['aboutImageUrl']); ?>" alt="Imagem sobre mim" class="img-fluid"></p>
                </div>
            </div>
        </div>

        <div class="testimonials mt-4">
            <h2>Depoimentos</h2>
            <p><?php echo htmlspecialchars($proposal['testimonialClientName']); ?></p>
            <p><?php echo htmlspecialchars($proposal['testimonialSolutionName']); ?></p>
            <p><?php echo htmlspecialchars($proposal['testimonialDescription']); ?></p>
            <p><a href="<?php echo htmlspecialchars($proposal['testimonialVideoUrl']); ?>" class="btn btn-primary">Ver Vídeo</a></p>
        </div>

        <div class="off mt-4">
            <h2>Ofertas</h2>
            <p><?php echo htmlspecialchars($proposal['offerClientName']); ?></p>
            <p><?php echo htmlspecialchars($proposal['offerSolutionName']); ?></p>
            <p><?php echo htmlspecialchars($proposal['offerDescription']); ?></p>
            <p><img src="<?php echo htmlspecialchars($proposal['offerImageUrl']); ?>" alt="Imagem da oferta" class="img-fluid"></p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
