<?php
session_start();
require 'conexao.php';

// FUNCIONÁRIO
if (isset($_POST['funcionario-create'])) {
    $cpf = $_POST['cpf'];
    $nome = $_POST['nome'];
    $datanascimento = $_POST['datanascimento'];
    $endereco = $_POST['endereco'];
    $sexo = $_POST['sexo'];
    $salario = $_POST['salario'];
    $email = $_POST['email'];
    $senha = md5($_POST['senha']);
    
    $sql = "INSERT INTO funcionario 
                (Cpf, Nome, DataNascimento, Endereco, Sexo, Salario, Email, Senha) 
            VALUES ('{$cpf}', '{$nome}', '{$datanascimento}', 
                '{$endereco}', '{$sexo}', '{$salario}', '{$email}', '{$senha}')";
    
    $res = $conn->query($sql);
    if ($res==true) {
        header('Location: home.php?page=funcionario-listar');
    } else {
        print "<script>alert('Não foi possível cadastrar');</script>";
        print "<script>location.href='?page=funcionario-create';</script>";
    }
    exit;
}

// EDITAR FUNCIONÁRIO
if (isset($_POST['funcionario-edit'])) {
    $cpf = $_POST['id'];
    $nome = $_POST['nome'];
    $datanascimento = $_POST['datanascimento'];
    $endereco = $_POST['endereco'];
    $sexo = $_POST['sexo'];
    $salario = $_POST['salario'];
    $email = $_POST['email'];
    $senha = md5($_POST['senha']);
    
    $sql = "UPDATE funcionario SET 
                Nome = '{$nome}', 
                DataNascimento = '{$datanascimento}',
                Endereco = '{$endereco}', 
                Sexo = '{$sexo}', 
                Salario = '{$salario}', 
                Email = '{$email}', 
                Senha = '{$senha}' 
            WHERE Cpf = '{$cpf}';";
    
    $res = $conn->query($sql);
    if ($res==true) {
        header('Location: funcionario-listar.php?page=funcionario-listar');
    } else {
        print "<script>alert('Não foi possível editar');</script>";
        print "<script>location.href='?page=funcionario-create';</script>";
    }
    exit;
}

// DELETAR FUNCIONÁRIO
//if (isset($_POST['funcionario-excluir'])) {
 //   $cpf = $_POST['funcionario-excluir'];

  ////  $sql = "DELETE FROM funcionario WHERE Cpf = '{$cpf}'";
    
   //// $res = $conn->query($sql);
   // if ($res==true) {
  //      header('Location: funcionario-excluir?page=funcionario-excluir');
   // } else {
  /////      print "<script>alert('Não foi possível excluir');</script>";
  //      print "<script>location.href='?page=funcionario-excluir';</script>";
 //   }
 ///   exit;
//}
// DELETAR FUNCIONÁRIO
if (isset($_POST['funcionario-excluir'])) {
    $cpf = $_POST['funcionario-excluir'];

    // Preparar a consulta para evitar injeção de SQL
    $stmt = $conn->prepare("DELETE FROM funcionario WHERE Cpf = ?");
    $stmt->bind_param("s", $cpf); // "s" indica que o parâmetro é uma string (CPF)

    if ($stmt->execute()) {
        // Se a exclusão for bem-sucedida, redireciona para a página de exclusão
        header('Location: funcionario-listar.php?mensagem=FuncionarioExcluido');
    } else {
        // Em caso de erro, exibe uma mensagem e recarrega a página
        print "<script>alert('Não foi possível excluir o funcionário.');</script>";
        print "<script>location.href='funcionario-excluir.php';</script>";
    }

    // Fechar a declaração preparada
    $stmt->close();
    exit;
}


// PROJETO
if (isset($_POST['create_projeto'])) {
    $nome = $_POST['nome'];
    $local = $_POST['local'];
    $fkNumDepartamento = $_POST['fkNumDepartamento'];

    $sql = "INSERT INTO projeto 
                (Nome, Local, fkNumDepartamento) 
            VALUES ('{$nome}', '{$local}', '{$fkNumDepartamento}')";
    
    $res = $conn->query($sql);
    if ($res == true) {
        header('Location: home.php?page=projeto-listar');
    } else {
        print "<script>alert('Não foi possível cadastrar o projeto');</script>";
        print "<script>location.href='?page=projeto-create';</script>";
    }
    exit;
}
?>
