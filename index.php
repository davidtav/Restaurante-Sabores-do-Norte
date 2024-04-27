<?php
include("admin/bd.php");
//seção  banners
$sentenca = $conexao->prepare("SELECT * FROM tbl_banners ORDER BY id DESC limit 1 ");
$sentenca->execute();
$lista_banners = $sentenca->fetchAll(PDO::FETCH_ASSOC);

// seção  colaboradores
$sentenca = $conexao->prepare("SELECT * FROM tbl_colaboradores ORDER BY id DESC limit 3");
$sentenca->execute();
$lista_colaboradores = $sentenca->fetchAll(PDO::FETCH_ASSOC);

// seção  depoimentos
$sentenca = $conexao->prepare("SELECT * FROM tbl_depoimentos ORDER BY id DESC limit 4");
$sentenca->execute();
$lista_depoimentos = $sentenca->fetchAll(PDO::FETCH_ASSOC);

// seção  Menú
$sentenca = $conexao->prepare("SELECT * FROM tbl_cardapio ORDER BY id DESC limit 4");
$sentenca->execute();
$lista_cardapio = $sentenca->fetchAll(PDO::FETCH_ASSOC);

// seção  fale conosco
if ($_POST) {
    //sanitização dos dados enviados
    $nome = filter_var($_POST["nome"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    $mensagem = filter_var($_POST["mensagem"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if ($nome && $email && $mensagem) {
        $sql = "INSERT INTO tbl_faleconosco (nome,email,mensagem)VALUES(:nome,:email,:mensagem)";
        $sentenca = $conexao->prepare($sql);
        $sentenca->bindParam(":nome", $nome, PDO::PARAM_STR);
        $sentenca->bindParam(":email", $email, PDO::PARAM_STR);
        $sentenca->bindParam(":mensagem", $mensagem, PDO::PARAM_STR);
        $sentenca->execute();
    }
    header("Location:index.php");
}


?>
<!doctype html>
<html lang="pt-br">

<head>
    <title>Sabores do Norte</title>
    <!-- fav icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="imagens/fav-icon/favicon-16x16.png">
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="background-color: rgb(135, 30, 30) !important">
        <div class="container">
            <a href="#" class="navbar-brand"> <i class="fas fa-utensils"></i> Restaurante Sabores do Norte</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle-navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Menu navegação-->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="nav navbar-nav ml-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="#inicio">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#cardapio">Cardápio Degustação</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#chefs">Chefs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#depoimentos">Depoimentos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#faleConosco">Fale conosco</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#horario">Horário de atendimento</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Banner -->
    <section id="inicio" class="container-fluid p-0">
        <div class="banner-img" style="position:relative; background:url('imagens/banners/wallpaper.png') center/cover no-repeat;height:400px ">

            <div class="banner-text" style="position:absolute; top:50%; left:50%; transform:translate(-50%,-50%);text-align:center;color:#fff;">

                <!-- foreach da seção banners -->
                <?php foreach ($lista_banners as $banner) { ?>
                    <h1 style="color:rgb(135, 30, 30) !important">
                        <?php echo $banner['titulo']; ?>
                    </h1>
                    <p style="color:rgb(135, 30, 30) !important">
                        <?php echo $banner['descricao']; ?>
                    </p>
                    <a  href="<?php echo $banner['link']; ?>" class="btn btn-primary">Ver nosso cardápio</a>
                <?php } ?>
                <!-- fim foreach  -->
            </div>
        </div>
    </section>
    <!-- banner 2 -->
    <section class="container mt-4 text-center">
        <div class="jumbotron bg-dark text-white" style="background-color: rgb(135, 30, 30) !important">
            <br>
            <h2>Bem Vindo ao Restaurante Sabores do Norte</h2>
            <p>
                Descubra o sabor e a cultura amazônica, venha nos visitar !
            </p>
            <br>
        </div>
    </section>
    <!-- nossos Chefs -->
    <section class="container mt-4 text-center" id="chefs">
        <h2>Nossos Chefs</h2>
        <div class="row">

            <!-- foreach da seção colaboladores -->
            <?php foreach ($lista_colaboradores as $colaborador) { ?>
                <div class="col-md-4">
                    <div class="card">
                        <img class="card-img-top" src="imagens/colaboradores/<?php echo $colaborador['foto']; ?>" alt="<?php echo $colaborador['titulo']; ?>">

                        <div class="card-body">
                            <h5 class="card-title"><?php echo $colaborador['titulo']; ?></h5>
                            <p class="card-text">
                                <?php echo $colaborador['descricao']; ?>
                            </p>
                            <div class="social-icons mt-3">
                                <a class="text-dark me-2" href="<?php echo $colaborador['linkfacebook']; ?>" target="_blank"><i class="fab fa-facebook"></i></a>
                                <a class="text-dark me-2" href="<?php echo $colaborador['linkinstagram']; ?>" target="_blank"><i class="fab fa-instagram"></i></a>
                                <a class="text-dark me-2" href="<?php echo $colaborador['linklinkedin']; ?>" target="_blank"><i class="fab fa-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <!-- fim foreach  -->

        </div>
    </section>
    <!-- Depoimentos -->
    <section class="bg-light py-5" id="depoimentos">
        <div class="container">

            <h2 class="text-center mb-4">Depoimentos</h2>
            <div class="row">
                <!-- foreach da seção colaboladores -->
                <?php foreach ($lista_depoimentos as $depoimento) { ?>
                    <div class="col-md-6 d-flex">
                        <div class="card mb-4 w-100">
                            <div class="card-body">
                                <p class="card-text"><?php echo $depoimento['opiniao']; ?></p>
                            </div>
                            <div class="card-footer text-muted">
                                <?php echo $depoimento['nome']; ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <!-- fim foreach  -->
            </div>
        </div>
    </section>
    <!-- Cardápio  -->
    <section class="container mt-4" id="cardapio">
        <h2 class="text-center">Cárdapio Degustação</h2>
        <br>
        <div class="row row-cols-1 row-cols-md-4 g-4 ">

            <!-- foreach da seção Menú -->
            <?php foreach ($lista_cardapio as $cardapio) { ?>
                <div class="col d-flex">
                    <div class="card">
                        <img class="card-img-top" src="imagens/cardapio/<?php echo $cardapio['foto']; ?>" alt="<?php echo $cardapio['nome']; ?>">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php echo $cardapio['nome']; ?>
                            </h5>
                            <p class="card-text">
                                <?php echo $cardapio['descricao']; ?>
                            </p>
                            <p class="card-text">
                                <strong>Preço R$<?php echo $cardapio['preco']; ?></strong>
                            </p>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <!-- fim foreach  -->

        </div>
    </section>
    <!-- Sessão de Contato -->
    <section class="container mt-4" id="faleConosco">
        <h2>Fale Conosco</h2>


        <form action="?" method="post">
            <div class="mb-3">
                <label for="name">Nome</label>
                <input class="form-control" type="text" name="nome" placeholder="escreva seu nome" Required><br>
            </div>
            <div class="mb-3">
                <label for="email">Email</label>
                <input class="form-control" type="email" name="email" placeholder="escreva seu email" Required><br>
            </div>
            <div class="mb-3">
                <label for="message">Mensagem</label>
                <textarea class="form-control" name="mensagem" cols="5  0" rows="6"></textarea>
            </div>
            <input class="btn btn-primary" type="submit" value="enviar">
        </form>


    </section>
    <br>
    <br>
    <!-- horario de funcionamento -->
    <div class="text-center bg-light p-4" id="horario">
        <h3 class="mb-4">Horario de atendimento</h3>
        <div>
            <p><strong>Terça a Domingo</strong></p>
            <p><strong>11:00 as 18:00</strong></p>
        </div>
    </div>
    <footer class="bg-dark text-light text-center py-3" style="background-color: rgb(135, 30, 30) !important">
        <!-- place footer here -->
        <p>&copy; 2024 Restaurante Sabores do Norte, todos os direitos reservados</p>
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>

</body>

</html>