<?php
// Função para sanitizar entradas
function sanitizar($data) {
    return htmlspecialchars(trim($data));
}

// Conexão com o banco de dados
$conn = new mysqli("localhost", "root", "13032005", "dbempresa");

// Verificar se houve erro na conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verificar se o ID do projeto foi passado
if (isset($_GET['id'])) {
    $idProjeto = sanitizar($_GET['id']);

    // Obter os dados do projeto
    $stmt = $conn->prepare("SELECT * FROM projeto WHERE idProjeto = ?");
    $stmt->bind_param("i", $idProjeto);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows === 1) {
        $projeto = $res->fetch_assoc();
    } else {
        die("Projeto não encontrado.");
    }
} else {
    die("ID do projeto não fornecido.");
}

// Atualizar os dados do projeto
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = sanitizar($_POST['nome']);
    $local = sanitizar($_POST['local']);
    $fkNumDepartamento = sanitizar($_POST['fkNumDepartamento']);

    // Atualizar no banco de dados
    $stmt = $conn->prepare("UPDATE projeto SET Nome = ?, Local = ?, fkNumDepartamento = ? WHERE idProjeto = ?");
    $stmt->bind_param("ssii", $nome, $local, $fkNumDepartamento, $idProjeto);

    if ($stmt->execute()) {
        // Mensagem de sucesso
        echo "<div class='container-fluid d-flex align-items-center justify-content-center' style='height: 100vh; background-color: #343a40;'>"; // Container com altura total e fundo escuro
        echo "<div class='card-body'>";
        echo "<h2 class='text-success'>Projeto atualizado com sucesso!</h2>"; // Mensagem de sucesso
        echo "<a href='home.php' class='btn btn-primary btn-lg mt-3' style='background-color: #007bff; border-color: #007bff;'>Voltar para a Página Inicial</a>"; // Botão azul
        exit;
    } else {
        echo "<p>Erro ao atualizar projeto: " . $conn->error . "</p>";

    }
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <title>Editar Projeto</title>
    <style>
        body {
            background-color: #343a40; /* Fundo escuro */
            color: #ffffff; /* Texto claro */
        }
        .form-container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background: #495057; /* Cor da carta mais clara que o fundo */
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        .form-label {
            color: #ffffff; /* Texto claro para os rótulos do formulário */
        }
        .btn-primary {
            background-color: #6c757d; /* Botão primário em cinza */
            border-color: #6c757d; /* Borda do botão */
        }
        .btn-primary:hover {
            background-color: #5a6268; /* Hover do botão primário */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Editar Projeto</h1>
        <div class="form-container">
            <form method="post">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="<?php echo htmlspecialchars($projeto['Nome']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="local" class="form-label">Local</label>
                    <input type="text" class="form-control" id="local" name="local" value="<?php echo htmlspecialchars($projeto['Local']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="fkNumDepartamento" class="form-label">Número do Departamento</label>
                    <input type="number" class="form-control" id="fkNumDepartamento" name="fkNumDepartamento" value="<?php echo htmlspecialchars($projeto['fkNumDepartamento']); ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>
</body>
</html>

<?php
// Fechar a conexão com o banco de dados
$conn->close();
?>
