<?php 
include '../templates/header.php';
include '../src/consultas.php';
validaUsuario();
$clientes = getAllClientes();
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
                Clientes cadastrados  <?= count(getAllClientes()) ?>
            </li>
        </ul>
        <a href="#!" class="brand-logo center">Controle de manutenção</a>
        <ul class="right">
            <li>
                <a href="./pesquisaCliente.php">
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
        <th class="center">Nome</th>
        <th class="center">Contato</th>
        <th class="center">
            <a class="btn btn-small blue-grey darken-3" href="cadCliente.php">
                <i class="material-icons">add</i>
            </a>
        </th> 
    </tr>
</thead>
<tbody>

    <?php foreach ($clientes as $cliente): ?>

    <tr>
        <td class="center"><?= $cliente->nome ?></td>
        <td class="center"><?= $cliente->contato ?></td>
        <td class="center">
            <a 
            href="./editCliente.php?id=<?=$cliente->id ?>" 
            class="btn blue-grey darken-3 btn-small">                        
                <i class="material-icons">edit</i>
            </a>
        </td>    
    </tr>

    <?php endforeach ?>

</tbody>
</table>
<?php 
include '../templates/footer.php'; 
?>
    