<?php 

$servidor = "localhost";
$database = "restaurante";
$usuario = "root";
$senha = "";

try
{
    $conexao = new PDO("mysql:host=$servidor;dbname=$database",$usuario,$senha);
    //echo "conectado com sucesso !";
}catch(Exception $error){
    echo $error->getMessage();
}