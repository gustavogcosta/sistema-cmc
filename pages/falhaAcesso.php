<?php 
require '../templates/header.php';
require '../src/consultas.php';
?>
<div class="container center">
    <h4>Parece que você não tem permissão para acessar essa página!</h4>
    <h5>Contate o administrador!</h5>
    <img src="../images/error.png" width="200px">
    <br>
    <br>
    <a href="./index.php" class="btn blue-grey darken-3">Voltar</a>
</div>

<?php require '../templates/footer.php' ?>