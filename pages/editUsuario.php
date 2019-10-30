<?php 
include '../templates/header.php';
include '../src/consultas.php';
$code = validaUsuario();
if(!$code){
    header("location: ./falhaAcesso.php");
}
$usuario = getUsuario();
?>
<nav>
    <div class="nav-wrapper blue-grey darken-3">
        <ul class="left">
            <li>
                <a href="./viewUsuario.php">
                    <i class="material-icons">arrow_back_ios</i>
                </a>
            </li>
        </ul>
        <a href="#!" class="brand-logo center">Controle de manutenção</a>
        <ul class="right">
            <li>
                <a href="../logout.php">
                    <!-- <i class="material-icons">exit_to_app</i> -->
                </a>
            </li>
        </ul>
    </div>
</nav>
<div class="container row">
    <form action="../src/server.php?action=updateUsuario" method="POST">
        <input type="hidden" name="id" value="<?= $usuario->id ?>">
        <div class="input-field col s6">
            <label for="username">Username:</label>
            <input id="username" type="text" required name="username" 
            class="validate"
            value="<?= $usuario->username ?>"> 
        </div> 
        <div class="input-field col s6">
            <label for="password">Password:</label>
            <input id="password" type="text" name="password" class="validate"
            value="<?= $usuario->password ?>"> 
        </div> 
        <div class="input-field col s12">
            <select name="nivel">
                <option id="nivel_a" value="A">A</option>
                <option id="nivel_b" value="B">B</option>
            </select>
            <label>Nivel:</label>
        </div>
        <div class="row center">
            <a href="./viewUsuario.php" 
            class="btn blue-grey darken-3 btn-small">Voltar</a>
            <input type="submit" class="btn blue-grey darken-3 btn-small" 
            value="Atualizar">    
            <!-- Modal -->
            <a class="btn-small btn blue-grey darken-3 modal-trigger" 
            href="#modal">Deletar</a>
                <div id="modal" class="modal">
                <div class="modal-content">
                    <p>Tem certeza que deseja remover este usuario?</p>
                </div>
                <div class="modal-footer">
                <a 
                href="../src/server.php?action=deleteUsuario&id=<?= $usuario->id ?>" 
                class="modal-close waves-effect waves-green btn-flat">Sim</a>
                <a 
                href="#!" 
                class="modal-close waves-effect waves-green btn-flat">Não</a>
                </div>
            </div>
        </div>
    </form>
</div>
<?php 
defineSelectUsuario($usuario);
include '../templates/footer.php';
?>

