<?php 
require '../templates/header.php';
require '../src/consultas.php';
destroySessao();
$computadores = getComputadoresEntrega();
?>
<div class="container row">
    <div class="center"><h5>Faça login para continuar!</h5></div>
    <form action="../src/server.php?action=login" method="POST">
        <div class="input-field col s6">
            <label for="username">Username:</label>
            <input id="username" type="text" required name="username" class="validate"> 
        </div> 
        <div class="input-field col s6">
            <label for="password">Password:</label>
            <input id="password" type="password" name="password" class="validate"> 
        </div> 
        <div class="row center">
            <a href="../index.php" class="btn blue-grey darken-3 btn-small">Voltar</a>
            <input type="submit" class="btn blue-grey darken-3 btn-small" value="Logar">    
        </div>
    </form>
</div>
    <div class="center"><h5>Computadores disponiveis para coleta</h5></div>
    <br>
    <table class="centered container">
    <thead>
        <tr>
            <th>Tipo</th>
            <th>Modelo</th>
            <th>Descrição Defeito</th>
            <th>Cliente</th>
        </tr>
    </thead>
    <tbody>

        <?php if(!$computadores): ?>
            <tr>
                <td colspan="4">Sem computadores pendente entrega!</td>
            </tr>
        <?php else: ?>
            <?php foreach ($computadores as $computador): ?>
            <tr>
                <td><?= $computador->tipo ?></td>
                <td><?= $computador->modelo ?></td>
                <td><?= $computador->descricao_defeito ?></td>
                <td>
                    <?php 
                    $cliente = getClienteComputador($computador->idCliente);
                    echo $cliente->nome;
                    ?>
                </td> 
            </tr>
            <?php endforeach ?>
        <?php endif ?>

    </tbody>
    </table>
<?php include '../templates/footer.php' ?>

