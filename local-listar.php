<?php
require('conexao.php');
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista de Departamentos</title>
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
                            <h4>
                                <a class="btn btn-primary" href="departamento-salvar.php">Novo Departamento</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped mt-3">
                                <thead>
                                    <tr>
                                        <th>Nome do Departamento</th>
                                        <th>CPF do Gerente</th>
                                        <th>Data de Início do Gerente</th>
                                        <th>Local</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                // Consulta SQL ajustada para incluir o JOIN com a tabela `local_departamento`
                                $sql = "SELECT d.NumDepartamento, d.fkCpf, d.NomeDepartamento, d.DataInicioGerente, l.Nome AS LocalNome
                                        FROM departamento d
                                        JOIN local_departamento l ON d.fkidLocalDepartamento = l.idLocalDepartamento";

                                $res = $conn->query($sql); // Executa a consulta SQL
                                $qtd = $res->num_rows; // Obtém a quantidade de resultados

                                if ($qtd > 0) {
                                    while ($row = $res->fetch_object()) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($row->NomeDepartamento) . "</td>";
                                        echo "<td>" . htmlspecialchars($row->fkCpf) . "</td>";
                                        echo "<td>" . ($row->DataInicioGerente ? date('d/m/Y', strtotime($row->DataInicioGerente)) : 'Não definido') . "</td>";
                                        echo "<td>" . htmlspecialchars($row->LocalNome) . "</td>"; // Exibe o nome do local
                                        echo "<td>
                                                <a href='departamento-editar.php?id=" . htmlspecialchars($row->NumDepartamento) . "' class='btn btn-sm btn-info'>Editar</a>
                                                <a href='departamento-excluir.php?id=" . htmlspecialchars($row->NumDepartamento) . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Tem certeza que deseja excluir?\")'>Excluir</a>
                                              </td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='5' class='text-center'>Nenhum departamento cadastrado.</td></tr>";
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
