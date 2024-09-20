<?php
// Conexão com o banco de dados
$conn = new mysqli("localhost", "root", "13032005", "dbempresa");

// Verificar se houve erro na conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Adicionar um registro
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['add'])) {
    $fkIdProjeto = intval($_POST['fkIdProjeto']);
    $fkIdColaborador = intval($_POST['fkIdColaborador']);

    $stmt = $conn->prepare("INSERT INTO trabalha_em (fkIdProjeto, fkIdColaborador) VALUES (?, ?)");
    $stmt->bind_param("ii", $fkIdProjeto, $fkIdColaborador);

    if ($stmt->execute()) {
        echo "<p>Registro adicionado com sucesso!</p>";
    } else {
        echo "<p>Erro ao adicionar registro: " . $conn->error . "</p>";
    }

    $stmt->close();
}

// Excluir um registro
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);

    $stmt = $conn->prepare("DELETE FROM trabalha_em WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<p>Registro excluído com sucesso!</p>";
    } else {
        echo "<p>Erro ao excluir registro: " . $conn->error . "</p>";
    }

    $stmt->close();
}

// Listar registros
$sql = "SELECT t.id, t.fkIdProjeto, t.fkIdColaborador, p.Nome AS projetoNome, c.Nome AS colaboradorNome
        FROM trabalha_em t
        JOIN projeto p ON t.fkIdProjeto = p.idProjeto
        JOIN colaborador c ON t.fkIdColaborador = c.idColaborador";
$res = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Gerenciar Trabalha Em</title>
</head>
<body>
    <div class="container">
        <h1>Gerenciar Trabalha Em</h1>

        <form method="post" class="mb-4">
            <div class="mb-3">
                <label for="fkIdProjeto" class="form-label">ID do Projeto</label>
                <input type="number" class="form-control" id="fkIdProjeto" name="fkIdProjeto" required>
            </div>
            <div class="mb-3">
                <label for="fkIdColaborador" class="form-label">ID do Colaborador</label>
                <input type="number" class="form-control" id="fkIdColaborador" name="fkIdColaborador" required>
            </div>
            <button type="submit" name="add" class="btn btn-primary">Adicionar</button>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID Projeto</th>
                    <th>ID Colaborador</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($res && $res->num_rows > 0): ?>
                    <?php while ($row = $res->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['fkIdProjeto']); ?></td>
                            <td><?php echo htmlspecialchars($row['fkIdColaborador']); ?></td>
                            <td>
                                <a class="btn btn-sm btn-danger" href="?delete=<?php echo htmlspecialchars($row['id']); ?>">Excluir</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="4" class="text-center">Nenhum registro encontrado.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
// Fechar a conexão com o banco de dados
$conn->close();
?>
