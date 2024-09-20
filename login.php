<?php
session_start(); // Iniciar sessão para controle de login

// Conexão com o banco de dados
$conn = new mysqli("localhost", "root", "13032005", "dbempresa");

// Verificar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Função para sanitizar entradas
function sanitizar($data) {
    return htmlspecialchars(trim($data));
}

// Verificar se o formulário de login foi enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = sanitizar($_POST['usuario']);
    $senha = sanitizar($_POST['senha']);

    // Consultar o usuário na tabela usuarios
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE usuario = ?");
    $stmt->bind_param("s", $usuario); // Usando o nome do usuário para fazer a busca
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows === 1) {
        $usuarioData = $res->fetch_assoc();

        // Verificar se a senha está correta
        if ($senha == $usuarioData['senha']) { // Aqui estou comparando diretamente a senha, considere usar `password_hash` e `password_verify`
            // Login bem-sucedido
            $_SESSION['usuario'] = $usuarioData['usuario']; // Armazenar o nome de usuário na sessão
            header("Location: home.php"); // Redirecionar para a página inicial após o login
            exit;
        } else {
            $erro = "Senha incorreta.";
        }
    } else {
        $erro = "Usuário não encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login de Usuário</title>
    <style>
        body {
            background: linear-gradient(45deg, #0d47a1, #1976d2, #42a5f5, #64b5f6);
            background-size: 400% 400%;
            animation: gradientBG 10s ease infinite;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-family: 'Roboto', sans-serif;
        }
        
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .form-container {
            max-width: 400px;
            width: 100%;
            padding: 30px;
            background-color: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        .form-container:hover {
            transform: translateY(-10px);
            opacity: 0.95;
        }

        .btn-primary {
            background-color: #ff6f61;
            border: none;
            box-shadow: 0 4px 15px rgba(255, 111, 97, 0.4);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #ff8a70;
            box-shadow: 0 6px 20px rgba(255, 111, 97, 0.6);
        }

        .form-label {
            color: #ffffffb3;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.2);
            color: #fff;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.3);
            box-shadow: none;
            color: #fff;
        }

        .alert-danger {
            background-color: rgba(255, 77, 77, 0.8);
            border: none;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2 class="text-center">Login de Usuário</h2>
        <?php if (isset($erro)): ?>
            <div class="alert alert-danger"><?php echo $erro; ?></div>
        <?php endif; ?>
        <form method="post">
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuário</label>
                <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Digite seu nome de usuário" required>
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite sua senha" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Entrar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
