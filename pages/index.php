<?php 
require '../templates/header.php';
require '../src/consultas.php';
$code = validaUsuario();
?>
<nav>
    <div class="nav-wrapper blue-grey darken-3">
        <ul class="left">
            <li>
                <span style="margin-left: 4px;" id="user-logon"></span>
            </li>
        </ul>
        <a href="#!" class="brand-logo center">Controle de manutenção</a>
        <ul class="right">
            <li>
                <a href="./formLogin.php">
                    <i class="material-icons">exit_to_app</i>
                </a>
            </li>
        </ul>
    </div>
</nav>
<div class="container">

    <br>

    <div class="row">

        <div class="col s12">
            <div class="card">   
                <div class="card-stacked blue-grey lighten-5">
                    <div class="card-content">
                        <h5>Computadores</h5>
                    </div>
                    <div class="card-action">
                        <a href="./viewComputador.php"
                        class="btn btn-large blue-grey darken-3">Acessar</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col s12">
            <div class="card">   
                <div class="card-stacked blue-grey lighten-5">
                    <div class="card-content">
                        <h5>Clientes</h5>
                    </div>
                    <div class="card-action">
                        <a href="./viewCliente.php"
                        class="btn btn-large blue-grey darken-3">Acessar</a>
                    </div>
                </div>
            </div>
        </div>

        <?php if($code): ?>

        <div class="col s12">
            <div class="card">   
                <div class="card-stacked blue-grey lighten-5">
                    <div class="card-content">
                        <h5>Usuarios</h5>
                    </div>
                    <div class="card-action">
                    <a href="./viewUsuario.php"
                        class="btn btn-large blue-grey darken-3">Acessar</a>
                    </div>
                </div>
            </div>
        </div>

        <?php endif; ?>
        
    </div>
</div>      
<?php require '../templates/footer.php' ?>
<script>
    axios.get('../src/server.php?action=getUserLogon')
    .then(res => {
        let string = `Usuário logado : ${res.data[1]}`;
        document.getElementById('user-logon').innerHTML = string;
    })
    .catch(err => {
        console.log(err.data);
    })
</script>