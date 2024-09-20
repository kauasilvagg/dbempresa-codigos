<?php
  require('conexao.php');

  $cpf = $_REQUEST["id"];
?>

<div class="card-header">
    <h4>
        Lista de Funcionários
        <a class="btn btn-primary" href="?page=funcionario-create">Novo Dependente</a>
    </h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Sexo</th>
                <th>Data de Nascimento</th>
                <th>Parentesco</th>
                <th>Ação</th>
            </tr>
        </thead>
        <?php
        $sql = "SELECT iddependente, Nome, Sexo, Datanasc, Parentesco 
        FROM dependente 
        WHERE fkCpf = '" . $cpf . "'";

    
            print($sql);
            $res = $conn->query($sql);
            $qtd = $res->num_rows;

            if($qtd > 0){
                while($row = $res->fetch_object()){
        ?>
                    <tr>
                        <td><?=$row->Nome?></td>
                        <td><?=$row->Sexo?></td>
                        <td><?=date('d/m/Y', strtotime($row->Datanasc))?></td>
                        <td><?=$row->Parentesco?></td>
                        <td>
                            <a href="?page=dependente-editar&id=<?=$row->iddependente?>" class="btn btn-success btn-sm">
                            <span class="bi-pencil-fill"></span>
                            &nbsp; Editar
                            </a>

                            <form action="acoes.php" method="POST" class="d-inline">
                                <button onclick="return confirm('Tem certeza que deseja excluir?')" 
                                    type="submit" name="delete_dependente" 
                                    value="<?=$row->iddependente?>" class="btn btn-danger btn-sm">
                                <span class="bi-trash3-fill"></span>&nbsp;Excluir
                                </button>
                            </form>
                        </td>
                    </tr>
             <?php
                }
            }
        ?>
    </table>

    <a class="btn btn-primary" href="?page=funcionario-create">Novo Dependente</a>

</div>