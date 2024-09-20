
<?php
// Conexão com o banco de dados
$conn = new mysqli("localhost", "root", "13032005", "dbempresa");

// Verificar se houve erro na conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $cpf = $_POST['cpf'];
    $nome = $_POST['nome'];
    $datanascimento = $_POST['datanascimento'];
    $endereco = $_POST['endereco'];
    $sexo = $_POST['sexo'];
    $salario = $_POST['salario'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Inserir no banco de dados
    $stmt = $conn->prepare("INSERT INTO funcionario (cpf, nome, datanascimento, endereco, sexo, salario, email, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssisss", $cpf, $nome, $datanascimento, $endereco, $sexo, $salario, $email, $password);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success' role='alert'>Funcionário cadastrado com sucesso!</div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>Erro ao cadastrar funcionário: " . $stmt->error . "</div>";
    }

    $stmt->close();
}

$conn->close();
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-label {
            font-size: 0.875rem; /* Diminuir a fonte dos rótulos */
        }
        .form-control {
            font-size: 0.875rem; /* Diminuir a fonte dos campos */
        }
        .btn-custom {
            margin-top: 20px;
        }
        ::placeholder {
    font-size: 0.875rem; /* Tamanho do texto do placeholder */
}
    </style>
    <title>Cadastro de Funcionário</title>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Realize o seu cadastro</h2>
        <form action="acoes.php" method="POST">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Digite seu CPF" required>
                <label for="cpf">Digite seu CPF</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite seu nome" required>
                <label for="nome">Digite seu nome</label>
            </div>
            <div class="form-floating mb-3">
                <input type="date" class="form-control" id="datanascimento" name="datanascimento" placeholder="Data de nascimento" required>
                <label for="datanascimento">Data de nascimento</label>
            </div>
            <div class="form-floating mb-3">                        
                <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Digite seu endereço" required>
                <label for="endereco">Digite seu endereço</label>
            </div>
            <div class="mb-4">
                <select class="form-select" id="sexo" name="sexo" required>
                    <option selected>Selecione sexo</option>
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="salario">Salário</label>
                <input type="number" class="form-control" id="salario" name="salario" placeholder="Digite seu salário" required>
            </div>
            <div class="form-floating mb-3">                        
                <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu email" required>
                <label for="email">Digite seu email</label>
            </div>
            <div class="form-floating mb-3">                        
                <input type="password" class="form-control" id="password" name="password" placeholder="Digite sua senha" required>
                <label for="password">Digite sua senha</label>
            </div>
            <input type="submit" name="create_funcionario" class="btn btn-primary" value="Salvar">
        </form>
        
        <div class="col-12" id="link-container">
            <a href="?page=funcionario-listar" class="btn btn-secondary btn-custom">Voltar para Listar Funcionário</a>
        </div>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
