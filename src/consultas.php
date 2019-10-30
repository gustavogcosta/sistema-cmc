<?php 

//conexao com o banco de dados
include '../src/conn.php';

//retorna o statement de uma query com id simples
function selectById($id, $tabela){ 
    if($tabela == "computadores"){
        $sql = "SELECT * FROM `computadores` WHERE `id` = :id";
    }elseif($tabela == "usuarios"){
        $sql = "SELECT * FROM `usuarios` WHERE `id` = :id";
    }elseif($tabela == "clientes"){
        $sql = "SELECT * FROM `clientes` WHERE `id` = :id";
    }
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id', $id);
    $result = $stmt->execute();
    if($result){
        return $stmt;
    }else{
        make_log($stmt->errorInfo()[2]);
    }    
}

//retorna um vetor de objetos usuarios
function getAllUsuarios(){ 
    global $conn;
    $result = $conn->query("SELECT * FROM `usuarios`");
    return ($result) ? $result->fetchAll(PDO::FETCH_OBJ) : make_log($conn->errorInfo()[2]);
    ;
}

//retorna um vetor de objetos computadores
function getAllComputadores(){ 
    global $conn;
    $result = $conn->query("SELECT * FROM `computadores`");
    return ($result) ? $result->fetchAll(PDO::FETCH_OBJ) : make_log($conn->errorInfo()[2]);
}

//retorna um vetor de objetos clientes
function getAllClientes(){ 
    global $conn;
    $result = $conn->query("SELECT * FROM `clientes`");
    return ($result) ? $result->fetchAll(PDO::FETCH_OBJ) : make_log($conn->errorInfo()[2]);
}

//retorna o computador, usando a selectById
function getComputador(){ 
    $id = $_REQUEST['id'];
    $stmt = selectById($id, "computadores");
    if($stmt){
        if($stmt->rowCount() > 0){
            return $stmt->fetch(PDO::FETCH_OBJ);
        }else{
            make_log("Nenhum computador encontrado");
        }
    }else{
        make_log($stmt->errorInfo()[2]);
    }      
}

//retorna o usuario, usando a selectById
function getUsuario(){ 
    $id = $_REQUEST['id'];
    $stmt = selectById($id, "usuarios");
    if($stmt){
        if($stmt->rowCount() > 0){
            return $stmt->fetch(PDO::FETCH_OBJ);
        }else{
            make_log("Nenhum usuario encontrado");
        }
    }else{
        make_log($stmt->errorInfo()[2]);
    }      
}

//retorna o cliente, usando a selectById
function getCliente(){ 
    $id = $_REQUEST['id'];
    $stmt = selectById($id, "clientes");
    if($stmt){
        if($stmt->rowCount() > 0){
            return $stmt->fetch(PDO::FETCH_OBJ);
        }else{
            make_log("Nenhum cliente encontrado");
        }
    }else{
        make_log($stmt->errorInfo()[2]);
    }      
}

function getClienteComputador($id){ 
    $stmt = selectById($id, "clientes");
    if($stmt){
        if($stmt->rowCount() > 0){
            return $stmt->fetch(PDO::FETCH_OBJ);
        }else{
            make_log("Nenhum cliente encontrado");
        }
    }else{
        make_log($stmt->errorInfo()[2]);
    }      
}

function validaUsuario(){
    session_start();
    if(!isset($_SESSION['id'])){
        Header("location: ./formLogin.php");
    }else{
        $id = $_SESSION['id'];
        $stmt = selectById($id, "usuarios");
        if($stmt){
            if($stmt->rowCount() > 0){
                $user = $stmt->fetch(PDO::FETCH_OBJ);
                if($user->nivel == "A"){
                    return true;
                }else{
                    return false;
                }
            }else{
                header("location: ./falhaLogin.php");
            }
        }else{
            make_log($stmt->errorInfo()[2]);
        }  
    };
}

//termina a sessão de login
function destroySessao(){
    session_start();
    unset($_SESSION['id']);
    session_destroy();
}

//define a opção do select na hora de atualizar
function defineSelectComputador($computador){ 
    switch ($computador->estado) {
        case 'Pendente manutencao':
            $string = "<script>document.getElementById('pendente-manutencao').";
            $string .= "setAttribute('selected', 'true');</script>";
            echo $string;
            break;
        case 'Pendente pecas':
            $string = "<script>document.getElementById('pendente-pecas').";
            $string .= "setAttribute('selected', 'true');</script>";
            echo $string;
            break;
        case 'Entregue':
            $string = "<script>document.getElementById('entregue').";
            $string .= "setAttribute('selected', 'true');</script>";
            echo $string;
            break;
        case 'Pendente entrega':
            $string = "<script>document.getElementById('pendente-entrega').";
            $string .= "setAttribute('selected', 'true');</script>";
            echo $string;
            break;
        case 'Pendente aprovacao':
            $string = "<script>document.getElementById('pendente-aprovacao').";
            $string .= "setAttribute('selected', 'true');</script>";
            echo $string;
            break;
        default:
            break;
    }
    switch ($computador->tipo) {
        case 'Notebook':
            $string = "<script>document.getElementById('Notebook').";
            $string .= "setAttribute('selected', 'true');</script>";
            echo $string;
            break;
        case 'Desktop':
            $string = "<script>document.getElementById('Desktop').";
            $string .= "setAttribute('selected', 'true');</script>";
            echo $string;
            break;
        default:
            break;
    }
    $string = "<script>document.getElementById('$computador->idCliente').";
    $string .= "setAttribute('selected', 'true')</script>";
    echo $string;
}

//define a opção do select na hora de atualizar
function defineSelectUsuario($usuario){
    switch ($usuario->nivel) {
        case 'A':
            $string = "<script>document.getElementById('nivel_a').";
            $string .= "setAttribute('selected', 'true');</script>";
            echo $string;
            break;
        case 'B':
            $string = "<script>document.getElementById('nivel_b').";
            $string .= "setAttribute('selected', 'true');</script>";
            echo $string;
            break;
        default:
            break;
    }
}

function getComputadoresEntrega(){
    $sql = "SELECT * FROM `computadores` WHERE `estado` = :estado";
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':estado', 'Pendente entrega');
    $result = $stmt->execute();
    if($result){
        if($stmt->rowCount() > 0){
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }else{
            return false;
        }
    }else{
        make_log($stmt->errorInfo()[2]);
    }    
}
