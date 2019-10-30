<?php 
require '../templates/header.php';
require '../src/consultas.php';
validaUsuario();
$computador = getComputador(); 
$clientes = getAllClientes();
?>
<nav>
    <div class="nav-wrapper blue-grey darken-3">
        <ul class="left">
            <li>
                <a href="./viewComputador.php">
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
    <form action="../src/server.php?action=updateComputador" method="POST">
        <input type="hidden" name="id" value="<?= $computador->id ?>">
        <div class="input-field col s6">
            <select name="tipo">
                <option id="Notebook" value="Notebook">Notebook</option>
                <option id="Desktop" value="Desktop">Desktop</option>
            </select>
            <label>Tipo:</label>
        </div> 
        <div class="input-field col s6">
            <label for="modelo">Modelo:</label>
            <input 
            id="modelo" 
            name="modelo" 
            value="<?= $computador->modelo ?>" 
            required="true"
            type="text" 
            class="validate">
        </div>
        <div class="input-field col s12">
            <label for="descricao-defeito">Descrição defeito:</label>
            <input 
            id="descricao-defeito" 
            value="<?= $computador->descricao_defeito ?>"
            required 
            type="text" 
            name="descricao_defeito" 
            class="validate">
        </div>
        <div class="input-field col s12">
            <label for="descricao-solucao">Descrição solução:</label>
            <input 
            id="descricao-solucao" 
            value="<?= $computador->descricao_solucao ?>"
            type="text" 
            name="descricao_solucao" 
            class="materialize-textarea">
        </div>
        <div class="input-field col s12">
            <select name="cliente">
                <?php foreach($clientes as $cliente): ?>
                    <option id="<?= $cliente->id ?>" value="<?= $cliente->id ?>"><?= $cliente->nome ?></option>
                <?php endforeach; ?>
            </select>
            <label>Cliente:</label>
        </div>
        <div class="input-field col s12">
            <select name="estado">
                <option 
                id="pendente-manutencao" 
                value="Pendente manutencao">Pendente manuntenção</option>
                <option 
                id="pendente-entrega" 
                value="Pendente entrega">Pendente entrega</option>
                <option 
                id="pendente-pecas" 
                value="Pendente pecas">Pendente peças</option>
                <option 
                id="pendente-aprovacao" 
                value="Pendente aprovacao">Pendente aprovação</option>
                <option 
                id="entregue" 
                value="Entregue">Entregue</option>
            </select>
            <label>Estado:</label>
        </div> 
        <div class="row center">
            <a href="./viewComputador.php" class="btn blue-grey darken-3 btn-small">Voltar</a>
            <input type="submit" class="btn blue-grey darken-3 btn-small" value="Atualizar">    
            <!-- Modal -->
            <a class="btn-small btn blue-grey darken-3 modal-trigger" href="#modal">Deletar</a>
                <div id="modal" class="modal">
                <div class="modal-content">
                    <p>Tem certeza que deseja remover este notebook/desktop?</p>
                </div>
                <div class="modal-footer">
                <a 
                href="../src/server.php?action=deleteComputador&id=<?= $computador->id ?>" 
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
defineSelectComputador($computador); 
require '../templates/footer.php';
?>
