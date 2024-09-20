<?php
  require('conexao.php');
?>

<h2>
    Realize o seu cadastro
</h2>
<form action="acoes.php" method="POST">
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="cpf" name="cpf" 
            placeholder="Digite seu CPF">
        <label for="cpf" class="form-label">
            Digite seu CPF
        </label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite seu nome">
        <label for="nome" class="form-label">
            Digite seu nome
        </label>
    </div>
    <div class="form-floating mb-3">
        <input type="date" class="form-control" id="datanascimento" name="datanascimento"
            placeholder="Data de nascimento (dd/mm/yyyy)">
        <label for="datanascimento" class="form-label">Data de nascimento (dd/mm/yyyy)</label>
    </div>
    <div class="form-floating mb-3">                        
        <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Digite seu endereço">
        <label for="endereco" class="form-label">Digite seu endereço</label>
    </div>
    <!-- Selects -->
    <div class="mb-4">
        <select class="form-select" id="sexo" name="sexo">
            <option selected>Selecione sexo</option>
            <option value="M">Masculino</option>
            <option value="F">Feminino</option>
        </select>
    </div>
    <div class="form-group">
        <label for="salario">Salário</label>
        <input type="number" class="form-control" id="salario" name="salario" 
            placeholder="Digite seu salário">
    </div>

    <div class="form-floating mb-3">                        
        <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu email">
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
    <input type="submit" name="create_funcionario" class="btn btn-primary" value="Salvar">
    <div class="col-12" id="link-container">
</form>

<div class="col-md-6">
    <div class="row align-items-center">
        <div class="col-12" id="link-container">
            <a href="?page=funcionario-listar">Voltar para o Listar Funcionário</a>
        </div>
    </div>
</div>