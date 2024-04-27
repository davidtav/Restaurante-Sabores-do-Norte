<?php
//condicional  para que o usuario só tenha acesso após passar pela pagina de login
//session_start();
$url_base = "http://localhost/pi-backend/restaurante/public/admin/";
if (!isset($_SESSION["usuario"])) {
    header("Location:" . $url_base . "login.php");
}
?>
<?php require_once __DIR__.'/../admin/templates/header.php'?>
<br>
<!doctype html>
<html lang="pt-br">


<head>

    <title>Administrador</title>
    <!-- fav icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../imagens/fav-icon/favicon-16x16.png">
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>
<!-- ---------------------------------------------------------- -->
<br>
<br>
<br>
<div class="row align-items-md-stretch">
    <div class="col-md-12">
        <div class="h-100 p-5 border rounded-3">
            <h2>Bem vindo ao painel administrativo</h2>
            <p>
                Nesse espaço voce poderá gerir seu site
            </p>
            <!-- <a name="" id="" class="btn btn-primary" href="section/banners/listar.php" role="button">Inicar Agora</a> -->
        </div>
    </div>
</div>

<?php include("templates/footer.php"); ?>