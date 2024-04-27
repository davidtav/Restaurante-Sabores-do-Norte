<?php
//session_start();
$url_base = "http://localhost/pi-backend/restaurante/public/admin/";
//condicional  para que o usuario só tenha acesso após passar pela pagina de login
// if (!isset($_SESSION["usuario"])) {
//     header("Location:" . $url_base . "login.php");
// } 

?>
<!doctype html>
<html lang="pt-br">

<head>

    <title>Administrador</title>
   <!-- fav icon -->
   <link rel="icon" type="image/png" sizes="16x16" href="../../imagens/fav-icon/favicon-16x16.png">
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <!-- jQuery  v3.7.1. -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- link do plugin DataTables do jQuery  -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>


</head>

<body>
    <!-- header -->
    <header>
        <!-- place navbar here -->
        <nav class="navbar navbar-expand navbar-light bg-light">
            <div class="nav navbar-nav">
                <!-- <a class="nav-item nav-link active" href="<?php echo $url_base; ?>index.php" aria-current="page">Administrador <span class="visually-hidden">(current)</span></a> -->
                <a class="nav-item nav-link" href="<?php echo $url_base; ?>section/banners/listar.php">Banners</a>
                <a class="nav-item nav-link" href="<?php echo $url_base; ?>section/collaborators/listar.php">Colaboradores</a>
                <a class="nav-item nav-link" href="<?php echo $url_base; ?>section/testimonials/listar.php">Depoimentos</a>
                <a class="nav-item nav-link" href="<?php echo $url_base; ?>section/menu/listar.php">Menú</a>
                <a class="nav-item nav-link" href="<?php echo $url_base; ?>section/comments/listar.php">Comentários</a>
                <a class="nav-item nav-link" href="<?php echo $url_base; ?>section/users/listar.php">Usuarios</a>

                <a class="nav-item nav-link" href="<?php echo $url_base; ?>templates/encerrar.php">Sair</a>
            </div>
            
        </nav>

    </header>
    <main>
        <section class="container">

        