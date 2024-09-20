<?php
require('conexao.php');

$id = $_REQUEST["id"];
$sql = "SELECT * FROM local_departamento WHERE idLocalDepartamento = '$id'";
$res = $conn->query($sql);
$row = $res->fetch_object();

if (!$row) {
    die("Local não encontrado.");
}
?>

<h2>Atualize o cadastro do Local</h2>
<form action="acoes.php" method="POST">
    <div class="form-floating mb-3">
        <input type="hidden" name="id" value="<?=$row->idLocalDepartamento?>">
        <input type="text" class="form-control" id="local" name="local" 
            placeholder="Nome do Local" value="<?=$row->nome?>">
        <label for="local" class="form-label">Nome do Local</label>
    </div>
    
    <div class="form-floating mb-3">                        
        <input type="text" class="form-control" id="endereco" name="endereco" 
            placeholder="Digite o endereço" value="<?=$row->endereco?>">
        <label for="endereco" class="form-label">Digite o Endereço</label>
    </div>

    <div class="form-floating mb-3">                        
        <input type="text" class="form-control" id="telefone" name="telefone" 
            placeholder="Digite o telefone" value="<?=$row->telefone?>">
        <label for="telefone" class="form-label">Digite o Telefone</label>
    </div>
    
    <div class="form-floating mb-3">                        
        <input type="email" class="form-control" id="email" name="email" 
            placeholder="Digite o email" value="<?=$row->email?>">
        <label for="email" class="form-label">Digite o Email</label>
    </div>

    <input type="submit" class="btn btn-primary" name="edit_local" value="Salvar">
</form>

<div class="col-md-6">
    <div class="row align-items-center">
        <div class="col-12" id="link-container">
            <a href="?page=local-listar">Voltar para o Listar Locais</a>
        </div>
    </div>
</div>
