<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Cadastro de Projeto</title>
    <style>
        body {
            background-color: #343a40; /* Fundo escuro */
            color: #ffffff; /* Texto claro */
        }
        .form-container {
            background-color: #495057; /* Cor do fundo do formulário */
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            margin-top: 50px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .btn-primary {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container col-12 col-md-8">
        <div class="form-container">
            <h2>Cadastro de Projeto</h2>
            <form action="processa_projeto.php" method="POST">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do Projeto" required>
                    <label for="nome" class="form-label">Nome do Projeto</label>
                    <small class="form-text text-muted">Insira o nome do projeto que deseja cadastrar.</small>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="local" name="local" placeholder="Local do Projeto" required>
                    <label for="local" class="form-label">Local do Projeto</label>
                    <small class="form-text text-muted">Insira a localização onde o projeto será realizado.</small>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="fkNumDepartamento" name="fkNumDepartamento" placeholder="Digite o número do Departamento" required>
                    <label for="fkNumDepartamento" class="form-label">Número do Departamento</label>
                    <small class="form-text text-muted">Digite o número do departamento relacionado ao projeto.</small>
                </div>
                <input type="submit" class="btn btn-primary" value="Cadastrar Projeto">
            </form>
            <div class="text-center mt-3">
                <a href="home.php" class="btn btn-secondary">Voltar para a Home</a>
            </div>
        </div>
    </div>
</body>
</html>
