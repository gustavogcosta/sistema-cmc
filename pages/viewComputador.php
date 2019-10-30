<?php 
include '../templates/header.php';
include '../src/consultas.php';
validaUsuario();
$computadores = getAllComputadores();
?>
<nav>
    <div class="nav-wrapper blue-grey darken-3">
        <ul class="left">
            <li>
                <a href="./index.php">
                    <i class="material-icons">arrow_back_ios</i>
                </a>
            </li>
            <li>
                Computadores cadastrados <?= count(getAllComputadores()) ?>
            </li>
        </ul>
        <a href="#!" class="brand-logo center">Controle de manutenção</a>
        <ul class="right">
            <li>
                <a href="./pesquisaComputador.php">
                    <i class="material-icons">search</i>
                </a>
            </li>
        </ul>
    </div>
</nav>
<br>
<table class="responsive-table container blue-grey lighten-5">
<thead>
    <tr>
        <th>Tipo</th>
        <th>Modelo</th>
        <th>Descrição Defeito</th>
        <th>Descrição Solução</th>
        <th>Cliente</th>
        <th>Estado</th> 
        <th>
            <a class="btn btn-small blue-grey darken-3" href="cadComputador.php">
                <i class="material-icons">add</i>
            </a>
        </th> 
    </tr>
</thead>
<tbody>

    <?php foreach ($computadores as $computador): ?>

    <tr>
        <td><?= $computador->tipo ?></td>
        <td><?= $computador->modelo ?></td>
        <td><?= $computador->descricao_defeito ?></td>
        <td><?= $computador->descricao_solucao ?></td>
        <td>
            <?php 
            $cliente = getClienteComputador($computador->idCliente);
            echo $cliente->nome;
            ?>
        </td>
        <td><?= $computador->estado ?></td>
        <td>
            <a 
            href="./editComputador.php?id=<?=$computador->id ?>" 
            class="btn blue-grey darken-3 btn-small">                        
                <i class="material-icons">edit</i>
            </a>
        </td>    
    </tr>

    <?php endforeach ?>

</tbody>
</table>
<?php include '../templates/footer.php' ?>

    