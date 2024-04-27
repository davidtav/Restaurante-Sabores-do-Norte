<?php 
//verifica se aconteceu uma requisição POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('location:index.php?rota=login');
    exit;
}
//buscando os dados do POST
$usuario = $_POST['usuario'] ?? null;
$senha = $_POST['senha'] ?? null;

//verificando se os dados estão preenchidos
if (empty($usuario)||empty($senha)) {
    header('location:index.php?rota=login');
    exit;
}

//a classe da base de dados ja está carregada no index.php
$db = new database();
$params =[
    ':usuario' => $usuario
];

$sql = "SELECT * FROM tbl_usuarios WHERE usuario = :usuario";
$result = $db->query($sql,$params);

//verificando se aconteceu algum erro
if ($result['status']==='error') {
    header('Location:index.php?rota=404');
    exit;
}

//verificando se o usuário existe
if (count($result['data'])==0) {
    //erro na sessão
    $_SESSION['error']='usuario ou senha invalidos';

    header('Location:index.php?rota=login');
    exit;
}

//verificando se a senha corresponde 
if (!password_verify($senha,$result['data'][0]->senha)) {
    //erro na sessão
    $_SESSION['error']='usuario ou senha invalidos';

    header('Location:index.php?rota=login');
    exit;
}

//define a sessão do usuario
$_SESSION['usuario'] = $result['data'][0];

//redirecionando para a pagina inicial (no projeto final deve redirecionar para o meu painel)
header('Location:index.php?rota=home');
exit;