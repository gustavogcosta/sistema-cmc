<?php 
require '../templates/header.php';
require '../src/consultas.php';
destroySessao();
?>
<div class="container center">
    <h5>Usuario não cadastrado!</h5>
    <img src="../images/error.png" width="300px">
    <br>
    <br>
    <a href="./formLogin.php" class="btn blue-grey darken-3">Voltar</a>
</div>

<?php require '../templates/footer.php' ?>