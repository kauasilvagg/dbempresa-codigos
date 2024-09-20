<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <title>Cadastrar Departamento</title>
    <style>
        body {
            background-color: #343a40; /* Fundo escuro */
            color: #ffffff; /* Texto claro */
        }
        #form-container {
            background-color: #495057; /* Fundo do formulário */
            border-radius: 8px;
            padding: 20px;
            margin: 20px auto;
            max-width: 600px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>
<body>
    <div class="container" id="form-container">
        <h2>Cadastrar Novo Departamento</h2>
        <form action="departamento-salvar-action.php" method="POST">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome do Departamento</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="mb-3">
                <label for="cpf" class="form-label">CPF do Gerente</label>
                <input type="text" class="form-control" id="cpf" name="cpf" required>
            </div>
            <div class="mb-3">
                <label for="data_inicio" class="form-label">Data de Início do Gerente</label>
                <input type="date" class="form-control" id="data_inicio" name="data_inicio" required>
            </div>
            <div class="mb-3">
                <label for="local" class="form-label">Local</label>
                <select class="form-select" id="local" name="local" required>
                    <option value="">Selecione um local</option>
                    <!-- Adicione opções de locais aqui -->
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
