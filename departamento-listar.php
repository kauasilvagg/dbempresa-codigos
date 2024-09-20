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
        h1 {
            font-size: 3rem; /* Título maior */
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
        }
        .table {
            background-color: #495057; /* Cor da tabela */
            color: #ffffff; /* Texto claro */
        }
        .table th {
            background-color: #6c757d; /* Cor das colunas do cabeçalho */
            color: #ffffff; /* Texto branco no cabeçalho */
        }
        .table td {
            background-color: #343a40; /* Fundo escuro nas células da tabela */
            color: #ffffff; /* Texto claro nas células */
        }
    </style>
</head>
<body>

<main class="container mt-5">
    <h1>Lista de Departamentos</h1>
    <a class="btn btn-primary mb-3" href="departamento-salvar.php">Novo Departamento</a>
    <table class="table table-striped">
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
        // Consulta SQL ajustada
        $sql = "SELECT d.NumDepartamento, d.fkCpf, d.NomeDepartamento, d.DataInicioGerente, l.Nome AS LocalNome
                FROM departamento d
                JOIN local_departamento l ON d.fkidLocalDepartamento = l.idLocalDepartamento";

        $res = $conn->query($sql); // Executa a consulta SQL

        if ($res->num_rows > 0) {
            while ($row = $res->fetch_object()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row->NomeDepartamento) . "</td>";
                echo "<td>" . htmlspecialchars($row->fkCpf) . "</td>";
                echo "<td>" . ($row->DataInicioGerente ? date('d/m/Y', strtotime($row->DataInicioGerente)) : 'Não definido') . "</td>";
                echo "<td>" . htmlspecialchars($row->LocalNome) . "</td>";
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
</main>

<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
