<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista de Projetos</title>
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
<main>
    <div class="card">
        <div class="card-header">
            Projetos Cadastrados
        </div>
        <div class="card-body">
            <h4>
                <a class="btn btn-primary" href="projeto-salvar.php">Novo Projeto</a>
            </h4>

            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Local</th>
                        <th>Número do Departamento</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Iniciando a conexão com o banco de dados
                    $conn = new mysqli("localhost", "root", "13032005", "dbempresa");

                    // Verificar se houve erro na conexão
                    if ($conn->connect_error) {
                        echo "<tr><td colspan='4' class='text-center'>Erro ao conectar ao banco de dados.</td></tr>";
                    } else {
                        // Consulta SQL para selecionar todos os projetos
                        $sql = "SELECT * FROM projeto";
                        $res = $conn->query($sql);

                        if ($res && $res->num_rows > 0) {
                            // Loop para exibir cada projeto
                            while ($row = $res->fetch_object()) {
                                echo "<tr>";
                                echo "<td>" . (!empty($row->Nome) ? htmlspecialchars($row->Nome) : 'Nome não informado') . "</td>";
                                echo "<td>" . (!empty($row->Local) ? htmlspecialchars($row->Local) : 'Local não informado') . "</td>";
                                echo "<td>" . htmlspecialchars($row->fkNumDepartamento) . "</td>";
                                echo "<td>";
                                echo "<a class='btn btn-sm btn-info' href='projeto-editar.php?id={$row->idProjeto}' aria-label='Editar projeto'>Editar</a> ";
                                echo "<a class='btn btn-sm btn-danger' href='projeto-excluir.php?id={$row->idProjeto}' aria-label='Excluir projeto'>Excluir</a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4' class='text-center'>Nenhum projeto cadastrado.</td></tr>";
                        }
                    }

                    // Fechar a conexão com o banco de dados
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
