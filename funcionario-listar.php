<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

require('conexao.php');
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Listar Funcionários</title>
   
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
        h1 {
            font-size: 3rem; /* Título maior */
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
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
        .table {
            background-color: #ffffff; /* Fundo branco para a tabela */
            color: #212529; /* Texto escuro para contraste */
        }
        .table th {
            background-color: #6c757d; /* Cor das colunas do cabeçalho */
            color: #ffffff; /* Texto branco no cabeçalho */
        }
        .table td {
            background-color: #f8f9fa; /* Fundo claro nas células da tabela */
            color: #212529; /* Texto escuro nas células */
        }
        a {
            color: #ffc107; /* Links em amarelo */
        }
        a:hover {
            color: #e0a800; /* Hover dos links */
        }
        .footer-text {
            text-align: center;
            padding: 20px 0;
            font-size: 1rem;
        }
    </style>
</head>
<body>

                    <div class="card">
                        <div class="card-header">
                            <h4>
                                <a class="btn btn-primary" href="?page=funcionario-create">Novo Funcionário</a>
                                <div class="ms-auto"> <!-- Adiciona margem à esquerda para separar o botão de logout do menu -->
                                 <a href="logout.php" class="btn btn-danger">Sair</a>
                        </div>
                            </h4>
                        </div>
                        
                        <div class="card-body">
                            <table class="table table-striped mt-3">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Data Nascimento</th>
                                        <th>Sexo</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM funcionario ORDER BY Nome";
                                    $res = $conn->query($sql);
                                    $qtd = $res->num_rows;

                                    if ($qtd > 0) {
                                        while ($row = $res->fetch_object()) {
                                            ?>
                                            <tr>
                                                <td><?= htmlspecialchars($row->Nome) ?></td>
                                                <td><?= date('d/m/Y', strtotime($row->DataNascimento)) ?></td>
                                                <td><?= htmlspecialchars($row->Sexo) ?></td>
                                                <td>
                                                    <a href="?page=dependente-listar&id=<?= htmlspecialchars($row->Cpf) ?>" class="btn btn-secondary btn-sm">
                                                        <span class="bi-eye-fill"></span>&nbsp;Dependente
                                                    </a>
                                                    <a href="?page=funcionario-edit&id=<?= htmlspecialchars($row->Cpf) ?>" class="btn btn-success btn-sm">
                                                        <span class="bi-pencil-fill"></span>&nbsp;Editar
                                                    </a>
                                                    <form action="acoes.php" method="POST" class="d-inline">
                                                        <button onclick="return confirm('Tem certeza que deseja excluir?')" 
                                                            type="submit" name="funcionario-excluir" 
                                                            value="<?= htmlspecialchars($row->Cpf) ?>" class="btn btn-danger btn-sm">
                                                            <span class="bi-trash3-fill"></span>&nbsp;Excluir
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='4' class='text-center'>Nenhum funcionário cadastrado.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
</main>

<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>