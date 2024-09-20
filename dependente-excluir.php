<?php
// Habilitar exibição de erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Conectar ao banco de dados
$conn = new mysqli("localhost", "root", "13032005", "dbempresa");

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verifica se o parâmetro 'id' foi passado via URL
if (isset($_GET['id'])) {
    $idDependente = intval($_GET['id']); // Sanitizar o valor

    // Iniciar uma transação
    $conn->begin_transaction();
    try {
        // Verificar se o dependente existe
        $sqlVerifica = "SELECT * FROM dependente WHERE idDependente = ?";
        $stmtVerifica = $conn->prepare($sqlVerifica);
        $stmtVerifica->bind_param("i", $idDependente);
        $stmtVerifica->execute();
        $resVerifica = $stmtVerifica->get_result();

        if ($resVerifica->num_rows === 1) {
            // Preparar a query de exclusão
            $sqlDelete = "DELETE FROM dependente WHERE idDependente = ?";
            $stmtDelete = $conn->prepare($sqlDelete);
            $stmtDelete->bind_param("i", $idDependente);
            $stmtDelete->execute();
            $stmtDelete->close();

            // Commit da transação
            $conn->commit();
            $mensagem = "Dependente excluído com sucesso.";
        } else {
            throw new Exception("Dependente não encontrado.");
        }
        $stmtVerifica->close();
    } catch (Exception $e) {
        // Rollback em caso de erro
        $conn->rollback();
        $mensagem = "Erro ao excluir: " . $e->getMessage();
    }
} else {
    $mensagem = "ID do dependente não fornecido.";
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
            background-color: #495057; /* Cor da carta */
            border: none;
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
                <a href="dependente-listar.php" class="btn btn-primary">Voltar para a Lista de Dependentes</a>
            </div>
        </div>
    </div>
</body>
</html>
