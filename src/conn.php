<?php

// ini_set('display_errors', 0 );
// error_reporting(0);

try{
    $conn = new PDO ("mysql:host=localhost;dbname=bd_tecnico;charset=utf8", "root", "");
}catch(Exception $e){
    make_log($e->getmessage());
}

function make_log($error){
    date_default_timezone_set('America/Sao_Paulo');
    $date = date("d/m/Y H:i", time());
    error_log("Erro gerado em $date / $error \n", 3, 'C:\xampp\htdocs\sistema_cmc\src\log.txt');
}

