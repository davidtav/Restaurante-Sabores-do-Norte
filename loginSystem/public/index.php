<?php
//inicio da sessão
session_start();

//carregamento de rotas permitidas
$rotas_permitidas = require_once __DIR__ . '/../inc/rotas.php';

//definição da rota
$rota = $_GET["rota"] ?? 'home';

//verificação se o usuario está logado
if (!isset($_SESSION['usuario']) && $rota!=='login_submit') {
    $rota = 'login';
}

//se o usuario já está logado e tenta entrar no login
if (isset($_SESSION['usuario']) && $rota === 'login') {
    $rota = 'home';
}

//se a rota não existe
if (!in_array($rota, $rotas_permitidas)) {
    $rota = '404';
}

//preparação da pagina
$script = null;
switch ($rota) {
    case '404':
        $script = '404.php';
        break;
    case 'login':
        $script = 'login.php';
        break;
    case 'login_submit':
        $script = 'login_submit.php';
        break;
    case 'logout':
        $script = 'logout.php';
        break;
        
    //painel e paginas a serem exibidas 
    case 'home':
        $script = 'home.php';
        break;

}
//carregamento de scripts permanentes
require_once __DIR__ . "/../inc/config.php";
require_once __DIR__ . "/../inc/database.php";

//teste de conexão(esse teste pode ser apagado após a verificação com sucesso da conexão)
// $db = new database();
// $usuarios = $db->query('SELECT * FROM tbl_usuarios');
// echo'<pre>';
// print_r($usuarios);
// echo'</pre>';
// die();


//apresentação da pagina
require_once __DIR__ . "/../inc/header.php";
require_once __DIR__ . "/../scripts/$script";
require_once __DIR__ . "/../inc/footer.php";
?>
<!-- fav icon -->
<link rel="icon" type="image/png" sizes="16x16" href="../../imagens/fav-icon/favicon-16x16.png">