<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Cadastrar Projeto</title>
    <style>
        body {
            background-color: #343a40; /* Fundo escuro */
            color: #ffffff; /* Texto claro */
        }
        .container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container col-11 col-md-6">
        <h2>Cadastrar Projeto</h2>
        <form action="processa_projeto.php" method="POST">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do Projeto" required>
                <label for="nome">Nome do Projeto</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="local" name="local" placeholder="Local do Projeto" required>
                <label for="local">Local do Projeto</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="fkNumDepartamento" name="fkNumDepartamento" placeholder="Número do Departamento" required>
                <label for="fkNumDepartamento">Número do Departamento</label>
            </div>
            <input type="submit" class="btn btn-primary" name="projeto-create" value="Cadastrar Projeto">
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
