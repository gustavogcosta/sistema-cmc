<?php 
require '../templates/header.php';
require '../src/consultas.php';
$code = validaUsuario();
if(!$code){
    header("location: ./falhaAcesso.php");
}
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
    <form action="../src/server.php?action=createUsuario" method="POST">
        <div class="input-field col s6">
            <label for="username">Username:</label>
            <input id="username" type="text" required name="username" class="validate"> 
        </div> 
        <div class="input-field col s6">
            <label for="password">Password:</label>
            <input id="password" type="text" name="password" class="validate"> 
        </div> 
        <div class="input-field col s12">
            <select name="nivel">
                <option id="NaN" selected disabled value="NaN">Escolha uma opção</option>
                <option id="nivel_a" value="A">A</option>
                <option id="nivel_b" value="B">B</option>
            </select>
            <label>Nivel:</label>
        </div>
        <div class="row center">
            <a href="./viewUsuario.php" class="btn blue-grey darken-3 btn-small">Voltar</a>
            <input type="submit" class="btn blue-grey darken-3 btn-small" value="Adicionar">    
        </div>
    </form>
</div>
<?php include '../templates/footer.php' ?>

