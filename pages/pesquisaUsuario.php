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
<br>
<div class="container row">
    <form id="form" name="form">
        <div class="input-field col s3">
            <select id="select" name="filtro">
                <option id="username" value="username">Username</option>
                <option id="nivel" value="nivel">Nivel</option>
            </select>
            <label>Filtrar por:</label>
        </div>
        <div class="input-field col s9">
            <label for="keyword">Buscar:</label>
            <input id="keyword" type="text" name="keyword" class="validate"> 
        </div> 
    </form>
</div>
<div class="container row">
    <div id="listResult" class="collection"></div>
</div>
<script>
    document.getElementById('keyword').onkeyup = () => {
        let select = document.getElementById('select');
        let filtro = select.options[select.selectedIndex].value;
        let keyword = document.getElementById('keyword').value;
        let data = {
            "filtro" : filtro,
            "keyword" : keyword
        }
        axios.post("../src/server.php?action=searchUsuario", data)
        .then(res => {
            montaResultado(res.data)
        }) 
        .catch(err => console.log(err))
    }
    function montaResultado(usuarios){
        document.getElementById('listResult').innerHTML = '';
        if(Array.isArray(usuarios)){
            usuarios.map(usuario => {
                let listResult = document.getElementById('listResult');
                let li = document.createElement('li');
                li.setAttribute('class', 'collection-item')
                let content = `Username: ${usuario.username} `;
                content += `/ Nivel de acesso: ${usuario.nivel}`;
                let txt = document.createTextNode(content);
                li.appendChild(txt);
                listResult.appendChild(li);
            })
        }else{
            let listResult = document.getElementById('listResult');
            let li = document.createElement('li');
            li.setAttribute('class', 'collection-item')
            let content = `Usuario não encontrado!`;
            let txt = document.createTextNode(content);
            li.appendChild(txt);
            listResult.appendChild(li);
        }
    }
    
</script>
<?php include '../templates/footer.php' ?>

