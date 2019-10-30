<?php 
include '../templates/header.php';
include '../src/consultas.php';
validaUsuario();
$cliente = getCliente();
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
    <form action="../src/server.php?action=updateCliente" method="POST">
        <input type="hidden" name="id" value="<?= $cliente->id ?>">
        <div class="input-field col s6">
            <label for="nome">Nome:</label>
            <input id="nome" type="text" required name="nome" 
            class="validate"
            value="<?= $cliente->nome ?>"> 
        </div> 
        <div class="input-field col s6">
            <label for="contato">Contato:</label>
            <input id="contato" type="text" name="contato" class="validate"
            value="<?= $cliente->contato ?>"> 
        </div> 
        <div class="row center">
            <a href="./viewCliente.php" 
            class="btn blue-grey darken-3 btn-small">Voltar</a>
            <input type="submit" class="btn blue-grey darken-3 btn-small" 
            value="Atualizar">    
            <!-- Modal -->
            <a class="btn-small btn blue-grey darken-3 modal-trigger" 
            href="#modal">Deletar</a>
                <div id="modal" class="modal">
                <div class="modal-content">
                    <p>Tem certeza que deseja remover este cliente?</p>
                </div>
                <div class="modal-footer">
                <a 
                href="../src/server.php?action=deleteCliente&id=<?= $cliente->id ?>" 
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
include '../templates/footer.php';
?>

