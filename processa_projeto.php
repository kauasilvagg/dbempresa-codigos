<?php
session_start();
require 'conexao.php'; // Certifique-se de que esse arquivo está no mesmo diretório e contém a conexão correta

if (isset($_POST['create_projeto'])) {
    // Coletar dados do formulário
    $nome = $_POST['nome'];
    $local = $_POST['local'];
    $fkNumDepartamento = $_POST['fkNumDepartamento'];

    // Verifique se o número do departamento é um número válido
    if (is_numeric($fkNumDepartamento)) {
        // Inserir dados no banco
        $sql = "INSERT INTO projeto (Nome, Local, fkNumDepartamento) VALUES ('$nome', '$local', $fkNumDepartamento)";

        if ($conn->query($sql) === TRUE) {
            // Redirecionar após sucesso
            header('Location: home.php?page=projeto-listar');
            exit;
        } else {
            echo "Erro: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "<script>alert('Número do departamento deve ser um número válido.');</script>";
        echo "<script>location.href='home.php?page=projeto-create';</script>";
    }
}

$conn->close();
?>
