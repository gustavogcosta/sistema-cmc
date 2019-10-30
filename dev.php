<?php 
    $sql = file_get_contents('./bd_tecnico.sql');
    $conn = new PDO("mysql:host=localhost", "root", "");
    $result = $conn->query($sql);
    if($result){
        echo 'Sistema pronto para ser utilizado';
    }else{
        echo 'Erro na criação da base de dados';
    }
?>