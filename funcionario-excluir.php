<?php
// Conectar ao banco de dados
$conn = new mysqli("localhost", "root", "13032005", "dbempresa");

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verifica se o ID do funcionário foi passado
if (isset($_GET['id'])) {
    $idFuncionario = intval($_GET['id']); // Sanitizar o valor

    // Preparar a query de exclusão
    $stmt = $conn->prepare("DELETE FROM funcionarios WHERE idFuncionario = ?");
    $stmt->bind_param("i", $idFuncionario);

    // Executar e verificar se a exclusão foi bem-sucedida
    if ($stmt->execute()) {
        $mensagem = "Funcionário excluído com sucesso.";
    } else {
        $mensagem = "Erro ao excluir funcionário: " . $stmt->error;
    }

    $stmt->close();
} else {
    $mensagem = "ID do funcionário não fornecido.";
}

// Fechar a conexão com o banco de dados
$conn->close();

// Redirecionar de volta para a página de listagem de funcionários
header("Location: funcionario-listar.php?mensagem=" . urlencode($mensagem));
exit();
?>
