<?php 
require '../templates/header.php';
require '../src/consultas.php';
validaUsuario();
?>
<nav>
    <div class="nav-wrapper blue-grey darken-3">
        <ul class="left">
            <li>
                <a href="./viewCliente.php">
                    <i class="material-icons">arrow_back_ios</i>
                </a>
            </li>
        </ul>
        <a href="#!" class="brand-logo center">Controle de manutenção</a>
    </div>
</nav>
<div class="container row">
    <form action="../src/server.php?action=createCliente" method="POST">
        <div class="input-field col s6">
            <label for="nome">Nome:</label>
            <input id="nome" type="text" required name="nome" class="validate"> 
        </div> 
        <div class="input-field col s6">
            <label for="contato">Contato:</label>
            <input id="contato" type="text" name="contato" class="validate"> 
        </div> 
        <div class="row center">
            <a href="./viewCliente.php" class="btn blue-grey darken-3 btn-small">Voltar</a>
            <input type="submit" class="btn blue-grey darken-3 btn-small" value="Adicionar">    
        </div>
    </form>
</div>
<?php include '../templates/footer.php' ?>

