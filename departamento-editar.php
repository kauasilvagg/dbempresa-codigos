<?php
// Conectar ao banco de dados
$conn = new mysqli("localhost", "root", "13032005", "dbempresa");

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $idDepartamento = intval($_GET['id']); // Sanitizar o valor
    // Aqui você deve consultar o banco para obter os dados do departamento
} else {
    die("ID do departamento não fornecido.");
}
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Editar Departamento</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Seu código para o formulário de edição vai aqui -->
</body>
</html>
