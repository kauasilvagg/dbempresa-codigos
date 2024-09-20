<?php
// Iniciando a conexão com o banco de dados
$conn = new mysqli("localhost", "root", "13032005", "dbempresa");

// Verificar se houve erro na conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verificar se o ID do projeto foi passado
if (isset($_GET['id'])) {
    $idProjeto = intval($_GET['id']); // Sanitizar entrada

    // Consultar para verificar se o projeto existe
    $stmt = $conn->prepare("SELECT * FROM projeto WHERE idProjeto = ?");
    $stmt->bind_param("i", $idProjeto);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        // Preparar a exclusão
        $stmt = $conn->prepare("DELETE FROM projeto WHERE idProjeto = ?");
        $stmt->bind_param("i", $idProjeto);

        if ($stmt->execute()) {
            $mensagem = "Projeto excluído com sucesso!";
        } else {
            $mensagem = "Erro ao excluir projeto: " . $stmt->error;
        }
    } else {
        $mensagem = "Projeto não encontrado.";
    }

    $stmt->close();
} else {
    $mensagem = "ID do projeto não fornecido.";
}

// Fechar a conexão com o banco de dados
$conn->close();
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resultado da Exclusão do Projeto</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #343a40; /* Fundo escuro */
            color: #ffffff; /* Texto claro */
        }
        header, footer {
            background-color: #212529; /* Cabeçalho e rodapé ainda mais escuros */
            color: #ffffff;
        }
        .card {
            background-color: #495057; /* Cor da carta mais clara que o fundo */
            border: none;
        }
        .card-header {
            background-color: #6c757d;
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
        }
        a {
            color: #ffc107; /* Links em amarelo */
        }
        a:hover {
            color: #e0a800; /* Hover dos links */
        }
    </style>
</head>
<body>

<header>
    <div class="container" id="nav-container">
        <?php include('navbar.php'); ?>
    </div>
</header>

<main>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                Resultado da Exclusão
            </div>
            <div class="card-body text-center">
                <p><?= $mensagem ?></p>
            </div>
        </div>
    </div>
</main>

<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
