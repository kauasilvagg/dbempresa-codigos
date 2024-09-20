<?php
// Conectar ao banco de dados
$conn = new mysqli("localhost", "root", "13032005", "dbempresa");

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verifica se o parâmetro 'id' foi passado via URL
if (isset($_GET['id'])) {
    $idDepartamento = intval($_GET['id']); // Sanitizar o valor

    // Preparar a query de exclusão
    $sql = "DELETE FROM departamento WHERE idDepartamento = ?";
    
    // Preparar a execução da query
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idDepartamento); // 'i' representa um valor inteiro

    // Executar e verificar se a exclusão foi bem-sucedida
    if ($stmt->execute()) {
        $mensagem = "Departamento excluído com sucesso.";
    } else {
        $mensagem = "Erro ao excluir departamento: " . $stmt->error;
    }

    $stmt->close();
} else {
    $mensagem = "ID do departamento não fornecido.";
}

// Fechar a conexão com o banco de dados
$conn->close();
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resultado da Exclusão</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #343a40; /* Fundo escuro */
            color: #ffffff; /* Texto claro */
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
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Resultado da Exclusão
            </div>
            <div class="card-body text-center">
                <p><?php echo $mensagem; ?></p>
                <a href="departamento-listar.php" class="btn btn-primary">Voltar para a Lista de Departamentos</a>
            </div>
        </div>
    </div>
</body>
</html>
