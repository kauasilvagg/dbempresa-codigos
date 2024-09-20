<?php
  require('conexao.php');

  $sql = "SELECT * FROM funcionario WHERE Cpf = '".$_REQUEST["id"]."'";
  //print($sql);
  $res = $conn->query($sql);
  $row = $res->fetch_object();

?>

<h2>
    Atualize o seu cadastro
</h2>
<form action="acoes.php" method="POST">
    <div class="form-floating mb-3">
        <input type="hidden" name="id" value="<?=$row->Cpf?>">
        <input type="text" class="form-control" id="cpf" name="cpf" 
            placeholder="Disabled input" aria-label="Cpf" disabled
            value = "<?=$row->Cpf?>">
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="nome" name="nome" 
            placeholder="Digite seu nome" value = "<?=$row->Nome?>">
        <label for="nome" class="form-label">
            Digite seu nome
        </label>
    </div>
    <div class="form-floating mb-3">
        <input type="date" class="form-control" id="datanascimento" name="datanascimento"
            placeholder="Data de nascimento (dd/mm/yyyy)" value = "<?=$row->DataNascimento?>">
        <label for="datanascimento" class="form-label">Data de nascimento (dd/mm/yyyy)</label>
    </div>
    <div class="form-floating mb-3">                        
        <input type="text" class="form-control" id="endereco" name="endereco" 
            placeholder="Digite seu endereço" value = "<?=$row->Endereco?>">
        <label for="endereco" class="form-label">Digite seu endereço</label>
    </div>
    <!-- Selects -->
    <div class="mb-4">
        <select class="form-select" id="sexo" name="sexo">
            <option selected>Selecione sexo</option>
            <option value="M" <?php if($row->Sexo == "M"){echo("selected");}; ?>>Masculino</option>
            <option value="F" <?php if($row->Sexo == "F"){echo("selected");}; ?>>Feminino</option>
        </select>
    </div>
    <div class="form-group">
        <label for="salario">Salário</label>
        <input type="number" class="form-control" id="salario" name="salario" 
            placeholder="Digite seu salário" value = "<?=$row->Salario?>">
    </div>

    <div class="form-floating mb-3">                        
        <input type="email" class="form-control" id="email" name="email" 
            placeholder="Digite seu email" value = "<?=$row->Email?>">
        <label for="email" class="form-label">Digite seu email</label>
    </div>
    <div class="form-floating mb-3">                        
        <input type="password" class="form-control" id="password" name="password" placeholder="Digite sua senha">
        <label for="password" class="form-label">Digite sua senha</label>
    </div>
    <div class="form-floating mb-3">                        
        <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirme sua senha">
        <label for="confirmpassword" class="form-label">Confirme sua senha</label>
    </div>
    <input type="submit" class="btn btn-primary" name="edit_funcionario" value="Salvar">
</form>

<div class="col-md-6">
    <div class="row align-items-center">
        <div class="col-12" id="link-container">
            <a href="?page=funcionario-listar">Voltar para o Listar Funcionário</a>
        </div>
    </div>
</div>