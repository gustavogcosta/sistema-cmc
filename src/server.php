<?php 

//conexao com o banco de dados
include './conn.php';

//parametro indicando a ação a ser executada
$action = (isset($_GET['action'])) ? $_GET['action'] : null;

//switch de controle de ações
switch ($action) {
    case 'createComputador':
        createComputador();  
        break;
    case 'updateComputador':
        updateComputador();
        break;
    case 'deleteComputador':
        deleteComputador();
        break;
    case 'createUsuario':
        createUsuario();
        break;
    case 'updateUsuario':
        updateUsuario();
        break;
    case 'deleteUsuario':
        deleteUsuario();
        break;
    case 'createCliente':
        createCliente();
        break;
    case 'updateCliente':
        updateCliente();
        break;
    case 'deleteCliente':
        deleteCliente();
        break;
    case 'login':
        login();
        break;
    case 'searchUsuario':
        searchUsuario();
        break;
    case 'searchComputador':
        searchComputador();
        break;
    case 'searchCliente':
        searchCliente();
        break;
    case 'getUserLogon':
        getUserLogon();
        break;
    case 'getCliente':
        getClienteById();
        break;
    default:
        make_log("Parametro não informado no switch");
        break;
};

//insere um computador no banco de dados
function createComputador(){
    $tipo = $_REQUEST['tipo'];
    $modelo = $_REQUEST['modelo'];
    $descricao_defeito = $_REQUEST['descricao_defeito'];
    $descricao_solucao = $_REQUEST['descricao_solucao'];
    $cliente = $_REQUEST['cliente'];
    $estado = $_REQUEST['estado'];
    $sql = "INSERT INTO `computadores`(`tipo`, `modelo`, `descricao_defeito`,";
    $sql .= "`descricao_solucao`, `estado`, `idCliente`) ";
    $sql .= "VALUES (:tipo, :modelo, :descricao_defeito, :descricao_solucao, ";
    $sql .= ":estado, :cliente)";
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(":tipo", $tipo);
    $stmt->bindValue(":modelo", $modelo);
    $stmt->bindValue(":descricao_defeito", $descricao_defeito);
    $stmt->bindValue(":descricao_solucao", $descricao_solucao);
    $stmt->bindValue(":estado", $estado);
    $stmt->bindValue(":cliente", $cliente);
    $result = $stmt->execute();
    if ($result){
        if($stmt->rowCount() === 0){
            make_log("Nenhum usuario inserido");
        }else{
            Header("Location: ../pages/viewComputador.php");
        }
    }else{
        make_log($stmt->errorInfo()[2]);
    }   
}

//atualiza um computador no banco de dados
function updateComputador(){
    $id = $_REQUEST['id'];
    $tipo = $_REQUEST['tipo'];
    $modelo = $_REQUEST['modelo'];
    $descricao_defeito = $_REQUEST['descricao_defeito'];
    $descricao_solucao = $_REQUEST['descricao_solucao'];
    $estado = $_REQUEST['estado'];
    $cliente = $_REQUEST['cliente'];
    $sql = "UPDATE `computadores` SET `tipo` = :tipo, `modelo` ";
    $sql .="= :modelo, `descricao_defeito` = :descricao_defeito, ";
    $sql .= "`descricao_solucao` = :descricao_solucao, `estado` ";
    $sql .= "= :estado, `idCliente` = :cliente WHERE `id` = :id";
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(":tipo", $tipo);
    $stmt->bindValue(":modelo", $modelo);
    $stmt->bindValue(":descricao_defeito", $descricao_defeito);
    $stmt->bindValue(":descricao_solucao", $descricao_solucao);
    $stmt->bindValue(":estado", $estado);
    $stmt->bindValue(":cliente", $cliente);
    $stmt-> bindValue(":id" , $id);
    $result = $stmt->execute();
    if ($result){
        if($stmt->rowCount() === 0){
            make_log("Nenhum usuario atualizado");
        }else{
            Header("Location: ../pages/viewComputador.php");
        }
    }else{
        make_log($stmt->errorInfo()[2]);
    }
}

//deleta um computador no banco de dados
function deleteComputador(){
    $id = $_REQUEST['id'];
    $sql = "DELETE FROM `computadores` WHERE `id` = :id";
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(":id", $id);
    $result = $stmt->execute();
    if ($result){
        if($stmt->rowCount() === 0){
            make_log("Nenhum computador deletado");
        }else{
            Header("Location: ../pages/viewComputador.php");
        }
    }else{
        make_log($stmt->errorInfo()[2]);
    }        
}


//cria um usuario no banco de dados
function createUsuario(){
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    $nivel = $_REQUEST['nivel'];
    $sql = "INSERT INTO `usuarios`(`username`, `password`, `nivel`) ";
    $sql .= "VALUES (:username, :password, :nivel);";
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(":username", $username);
    $stmt->bindValue(":password", base64_encode($password));
    $stmt->bindValue(":nivel", $nivel);
    $result = $stmt->execute();
    if ($result){
        if($stmt->rowCount() === 0){
            make_log("Nenhum usuario cadastrado");
        }else{
            Header("Location: ../pages/viewUsuario.php");
        }
    }else{
        make_log($stmt->errorInfo()[2]);
    }
}

//atualiza um usuario no banco de dados
function updateUsuario(){
    $id = $_REQUEST['id'];
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    $nivel = $_REQUEST['nivel'];
    $sql = "UPDATE `usuarios` SET `username` = :username, ";
    $sql .="`password` = :password, `nivel` = :nivel WHERE `id` = :id";
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(":username", $username);
    $stmt->bindValue(":password", base64_encode($password));
    $stmt->bindValue(":nivel", $nivel);
    $stmt-> bindValue(":id" , $id);
    $result = $stmt->execute();
    if ($result){
        if($stmt->rowCount() > 0){
            Header("Location: ../pages/viewUsuario.php");
        }else{
            make_log("Nenhum usuario atualizado");
        }
    }else{
        make_log($stmt->errorInfo()[2]);
    }
}

//deleta um usuario no banco de dados
function deleteUsuario(){
    $id = $_REQUEST['id'];
    $sql = "DELETE FROM `usuarios` WHERE `id` = :id";
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(":id", $id);
    $result = $stmt->execute();
    if ($result){
        if($stmt->rowCount() === 0){
            make_log("Nenhum usuario deletado");
        }else{
            Header("Location: ../pages/viewUsuario.php");
        }
    }else{
        make_log($stmt->errorInfo()[2]);
    }        
}

//cria um usuario no banco de dados
function createCliente(){
    $nome = $_REQUEST['nome'];
    $contato = $_REQUEST['contato'];
    $sql = "INSERT INTO `clientes`(`nome`, `contato`) ";
    $sql .= "VALUES (:nome, :contato);";
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(":nome", $nome);
    $stmt->bindValue(":contato", $contato);
    $result = $stmt->execute();
    if ($result){
        if($stmt->rowCount() === 0){
            make_log("Nenhum cliente inserido");
        }else{
            Header("Location: ../pages/viewCliente.php");
        }
    }else{
        make_log($stmt->errorInfo()[2]);
    }
}

//atualiza um usuario no banco de dados
function updateCliente(){
    $id = $_REQUEST['id'];
    $nome = $_REQUEST['nome'];
    $contato = $_REQUEST['contato'];
    $sql = "UPDATE `clientes` SET `nome` = :nome, ";
    $sql .="`contato` = :contato WHERE `id` = :id";
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(":nome", $nome);
    $stmt->bindValue(":contato", $contato);
    $stmt-> bindValue(":id" , $id);
    $result = $stmt->execute();
    if ($result){
        if($stmt->rowCount() === 0){
            make_log("Nenhum cliente atualizado");
        }else{
            Header("Location: ../pages/viewCliente.php");
        }
    }else{
        make_log($stmt->errorInfo()[2]);
    }
}

//deleta um usuario no banco de dados
function deleteCliente(){
    $id = $_REQUEST['id'];
    $sql = "DELETE FROM `clientes` WHERE `id` = :id";
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(":id", $id);
    $result = $stmt->execute();
    if ($result){
        if($stmt->rowCount() === 0){
            make_log("Nenhum cliente deletado");
        }else{
            Header("Location: ../pages/viewCliente.php");
        }
    }else{
        make_log($stmt->errorInfo()[2]);
    }        
}

//verifica se o usuario está cadastrado no sistema
//caso esteja, envia pra pagina principal
//caso contario, envia para a pagina de falha de login
function login(){
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    global $conn;
    $sql = "SELECT * FROM `usuarios` WHERE `username` = :username";
    $sql .= " and `password` = :password";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':password', base64_encode($password));
    $result = $stmt->execute();
    if($result){
        if($stmt->rowCount() > 0){
            $usuario = $stmt->fetch(PDO::FETCH_OBJ);
            session_start();
            $_SESSION['id'] = $usuario->id;
            Header("location: ../pages");
        }else{
            Header("location: ../pages/falhaLogin.php");
        }
    }else{
        make_log($stmt->errorInfo()[2]);
    }
}

// Busca um determinado usuario e entrega um json com as respostas, função feita pra ser utilzada atraves
// de AJAX
function searchUsuario(){
    $req = file_get_contents('php://input');
    $req_parse = json_decode($req, true);
    $filtro = $req_parse['filtro'];
    $keyword = $req_parse['keyword'];
    global $conn;
    function defineSqlUsuario($filtro){
        if($filtro == "nivel"){
            return "SELECT * FROM `usuarios` WHERE `nivel` LIKE :keyword";
        }elseif($filtro == "username"){
            return "SELECT * FROM `usuarios` WHERE `username` LIKE :keyword";
        }
    }
    $sql = defineSqlUsuario($filtro);
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':keyword', "%".$keyword."%");
    $result = $stmt->execute();
    if($result){
        if($stmt->rowCount() > 0){
            echo json_encode($stmt->fetchAll(PDO::FETCH_OBJ));
        }else{
            echo json_encode(["message" => "Usuario não encontrado"]);
        }
    }else{
        make_log($stmt->errorInfo()[2]);
    }
}

// Busca um determinado computador e entrega um json com as respostas, função feita pra ser utilzada 
// atraves de AJAX
function searchComputador(){
    $req = file_get_contents('php://input');
    $req_parse = json_decode($req, true);
    $filtro = $req_parse['filtro'];
    $keyword = $req_parse['keyword'];
    global $conn;
    function defineSqlComputador($filtro, $keyword){
        switch ($filtro) {
            case 'tipo':
                return "SELECT * FROM `computadores` WHERE `tipo` LIKE :keyword";
            break;
            case 'modelo':
                return "SELECT * FROM `computadores` WHERE `modelo` LIKE :keyword";
            break;
            case 'descricao_solucao':
                return "SELECT * FROM `computadores` WHERE `descricao_solucao` LIKE :keyword";
            break;
            case 'descricao_defeito':
                return "SELECT * FROM `computadores` WHERE `descricao_defeito` LIKE :keyword";
            break;
            case 'cliente':
                $sql = "SELECT * FROM `clientes` WHERE `nome` LIKE :keyword";
                global $conn;
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':keyword', '%'.$keyword.'%');
                $result = $stmt->execute();
                if($result){
                    if($stmt->rowCount()){
                        $clientes = $stmt->fetchAll(PDO::FETCH_OBJ);
                        return $clientes;
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }
            break;
            break;
            case 'estado':
                return "SELECT * FROM `computadores` WHERE `estado` LIKE :keyword";
            break;
            default:
                return "SELECT * FROM `computadores`";
            break;
        }
    }
    $sqlOrClients = defineSqlComputador($filtro, $keyword);
    if(is_array($sqlOrClients)){
        $arrayComputadores = [];
        foreach ($sqlOrClients as $cliente) {
            $sql = "SELECT * FROM `computadores` WHERE `idCliente` = :idCliente";
            global $conn;
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':idCliente', $cliente->id);
            $result = $stmt->execute();
            if($result){
                if($stmt->rowCount() > 0){
                    foreach ($stmt->fetchAll(PDO::FETCH_OBJ) as $computador) {
                        array_push($arrayComputadores, $computador);
                    }
                }
            }
        }
        echo json_encode($arrayComputadores);

    }else{
        $stmt = $conn->prepare($sqlOrClients);
        $stmt->bindValue(':keyword', "%".$keyword."%");
        $result = $stmt->execute();
        if($result){
            if($stmt->rowCount() > 0){
                echo json_encode($stmt->fetchAll(PDO::FETCH_OBJ));
            }else{
                echo json_encode(["message" => "Computador não encontrado"]);
            }
        }else{
            make_log($stmt->errorInfo()[2]);
        }
    }
}

// Busca um determinado usuario e entrega um json com as respostas, função feita pra ser utilzada atraves
// de AJAX
function searchCliente(){
    $req = file_get_contents('php://input');
    $req_parse = json_decode($req, true);
    $filtro = $req_parse['filtro'];
    $keyword = $req_parse['keyword'];
    global $conn;
    function defineSqlCliente($filtro){
        if($filtro == "contato"){
            return "SELECT * FROM `clientes` WHERE `contato` LIKE :keyword";
        }elseif($filtro == "nome"){
            return "SELECT * FROM `clientes` WHERE `nome` LIKE :keyword";
        }
    }
    $sql = defineSqlCliente($filtro);
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':keyword', "%".$keyword."%");
    $result = $stmt->execute();
    if($result){
        if($stmt->rowCount() > 0){
            echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        }else{
            echo json_encode(["message" => "Cliente não encontrado"]);
        }
    }else{
        make_log($stmt->errorInfo()[2]);
    }
}

//verifica qual usuario esta logado e retorna o nome do mesmo
//caso contrario o sistema encaminha para a pagina de login
function getUserLogon(){
    session_start();
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM `usuarios` WHERE `id` = :id";
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id', $id);
    $result = $stmt->execute();
    if($result){
        if($stmt->rowCount() > 0){
            $user = $stmt->fetch(PDO::FETCH_OBJ);
            echo json_encode(["username", $user->username]);
        }else{
            echo json_encode(["username", "Not found"]);
        }
    }else{
        make_log($stmt->errorInfo()[2]);
    }   
}

function getClienteById(){
    $id = $_REQUEST['id'];
    $sql = "SELECT * FROM `clientes` WHERE `id` = :id";
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id', $id);
    $result = $stmt->execute();
    if($result){
        if($stmt->rowCount() > 0){
            $cliente = $stmt->fetch(PDO::FETCH_OBJ);
            echo json_encode(["cliente", $cliente->nome]);
        }else{
            echo json_encode(["cliente", "Not found"]);
        }
    }else{
        make_log($stmt->errorInfo()[2]);
    }
}