<?php 
require '../templates/header.php';
require '../src/consultas.php';
$clientes = getAllClientes();
validaUsuario();
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
    <form action="../src/server.php?action=createComputador" method="POST">
        <div class="input-field col s6">
            <select name="tipo">
                <option id="NaN" selected disabled value="NaN">Escolha uma opção</option>
                <option id="Notebook" value="Notebook">Notebook</option>
                <option id="Notebook" value="Desktop">Desktop</option>
            </select>
            <label>Tipo:</label>
        </div> 
        <div class="input-field col s6">
            <label for="modelo">Modelo:</label>
            <input 
            id="modelo" 
            name="modelo" 
            required 
            type="text" 
            class="validate">
        </div>
        <div class="input-field col s12">
            <label for="descricao-defeito">Descrição defeito:</label>
            <input 
            id="descricao-defeito" 
            required 
            type="text" 
            name="descricao_defeito" 
            class="validate">
            </div>
        <div class="input-field col s12">
            <label for="descricao-solucao">Descrição solução:</label>
            <input 
            id="descricao-solucao" 
            type="text"
            name="descricao_solucao" 
            class="validate">
        </div>

        <div class="input-field col s12">
            <select name="cliente">
                <option id="NaN" selected disabled value="NaN">Escolha uma opção</option>
                <?php foreach($clientes as $cliente): ?>
                    <option value="<?= $cliente->id ?>"><?= $cliente->nome ?></option>
                <?php endforeach; ?>
            </select>
            <label>Cliente:</label>
        </div>
        <div class="input-field col s12">
            <select name="estado">
                <option id="NaN" 
                selected 
                disabled 
                value="NaN">Escolha uma opção</option>
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
            <input type="submit" class="btn blue-grey darken-3 btn-small" value="Adicionar">    
        </div>
    </form>
</div>
<?php include '../templates/footer.php' ?>
