<?php 
include '../templates/header.php';
include '../src/consultas.php';
$code = validaUsuario();
if(!$code){
    header("location: ./falhaAcesso.php");
}
$usuarios = getAllUsuarios();
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
                Usuarios cadastrados  <?= count(getAllUsuarios()) ?>
            </li>
        </ul>
        <a href="#!" class="brand-logo center">Controle de manutenção</a>
        <ul class="right">
            <li>
                <a href="./pesquisaUsuario.php">
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
        <th class="center">Username</th>
        <th class="center">Password</th>
        <th class="center">Nivel</th>
        <th class="center">
            <a class="btn btn-small blue-grey darken-3" href="cadUsuario.php">
                <i class="material-icons">add</i>
            </a>
        </th> 
    </tr>
</thead>
<tbody>

    <?php foreach ($usuarios as $usuario): ?>

    <tr>
        <td class="center"><?= $usuario->username ?></td>
        <td class="center"><?= $usuario->password ?></td>
        <td class="center"><?= $usuario->nivel ?></td>
        <td class="center">
            <a 
            href="./editUsuario.php?id=<?=$usuario->id ?>" 
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
    