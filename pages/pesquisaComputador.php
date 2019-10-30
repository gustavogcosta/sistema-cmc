<?php 
require '../templates/header.php';
require '../src/consultas.php';
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
<br>
<div class="container row">
    <form id="form" name="form">
        <div class="input-field col s3">
            <select id="select" name="filtro">
                <option id="tipo" value="tipo">Tipo</option>
                <option id="modelo" value="modelo">Modelo</option>
                <option id="descricao-defeito" value="descricao_defeito">Descricao Defeito</option>
                <option id="descricao-solucao" value="descricao_solucao">Descrição Solução</option>
                <option id="cliente" value="cliente">Cliente</option>
                <option id="estado" value="estado">Estado</option>
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
    document.getElementById('keyword').onkeypress = (e) => {
        if(e.which == 13){
            let select = document.getElementById('select');
            let filtro = select.options[select.selectedIndex].value;
            let keyword = document.getElementById('keyword').value;
            let data = {
                "filtro" : filtro,
                "keyword" : keyword
            }
            axios.post("../src/server.php?action=searchComputador", data)
            .then(res => {
                montaResultado(res.data);
            }) 
            .catch(err => console.log(err))
        }
    }
    function montaResultado(computadores){
        document.getElementById('listResult').innerHTML = '';
        if(Array.isArray(computadores)){
            computadores.map(computador => {
                let idCliente = computador.idCliente;
                var nomecliente;
                axios.get(`../src/server.php?action=getCliente&id=${idCliente}`)
                .then( res => {
                    let listResult = document.getElementById('listResult');
                    let li = document.createElement('li');
                    li.setAttribute('class', 'collection-item')
                    let content = `Tipo: ${computador.tipo} `;
                    content += `/ Modelo: ${computador.modelo}`;
                    content += `/ Descrição defeito: ${computador.descricao_defeito}`;
                    content += `/ Descrição solução: ${computador.descricao_solucao}`;
                    content += `/ Cliente: ${res.data[1]}`;
                    content += `/ Estado: ${computador.estado}`;
                    let txt = document.createTextNode(content);
                    li.appendChild(txt);
                    listResult.appendChild(li);
                })
                .catch( err => {
                    console.log(err);
                })
                
            })
        }else{
            let listResult = document.getElementById('listResult');
            let li = document.createElement('li');
            li.setAttribute('class', 'collection-item')
            let content = `Computador não encontrado!`;
            let txt = document.createTextNode(content);
            li.appendChild(txt);
            listResult.appendChild(li);
        }
    }
    
</script>
<?php include '../templates/footer.php' ?>

