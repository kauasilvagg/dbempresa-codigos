<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gerenciamento Empresa</title>
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
        .footer-text {
            text-align: center;
            padding: 20px 0;
            font-size: 1rem;
        }
        a {
            color: #ffc107; /* Links em amarelo */
        }
        a:hover {
            color: #e0a800; /* Hover dos links */
        }
    </style>
</head>
<body>

<!-- Cabeçalho -->
<header>
    <div class="container" id="nav-container">
        <?php include('navbar.php'); ?>
    </div>
</header>

<!-- Título -->
<main>
    <div class="container-fluid">
        <h1>Projetos da Empresa</h1> <!-- Título maior -->
        <div class="container mt-4">
            <div class="row">
                <div class="col mt-12">
                    <div class="card">
                        <div class="card-header">
                            <?php
                            // Verifica se o parâmetro 'page' está definido
                            if (isset($_REQUEST["page"])) {
                                switch ($_REQUEST["page"]) {
                                    case "projeto-listar":
                                        include('projeto-listar.php');
                                        break;
                                    case "funcionario-listar":
                                        include('funcionario-listar.php');
                                        break;
                                    case "funcionario-create":
                                        include('funcionario-create.php');
                                        break;
                                    case "funcionario-edit":
                                        include('funcionario-edit.php');
                                        break;
                                    case "dependente-listar":
                                        include('dependente-listar.php');
                                        break;
                                    case "departamento-listar":
                                        include('departamento-listar.php');
                                        break;
                                    case "local-listar":
                                        include('local-listar.php');
                                        break;
                                    case "projeto-create": // Adicione o caso para o projeto-create
                                        include('projeto-create.php');
                                        break;
                                    default:
                                        echo "<h2>Bem-vindos!!!</h2>"; // Um subtítulo menor
                                }
                            } else {
                                echo "<h2>Bem-vindos!!!</h2>"; // Um subtítulo menor
                            }
                            ?>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Rodapé -->
<footer>
    <div id="copy-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
