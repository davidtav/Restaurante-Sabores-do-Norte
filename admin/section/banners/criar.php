<?php
//inclusão ao banco de dados
include("../../bd.php");
//inserir informações no banco de dados
if ($_POST) {
    $titulo = (isset($_POST["titulo"])) ? $_POST["titulo"] : "";
    $descricao = (isset($_POST["descricao"])) ? $_POST["descricao"] : "";
    $link = (isset($_POST["link"])) ? $_POST["link"] : "";

    $sentenca = $conexao->prepare("INSERT INTO `tbl_banners` (`id`, `titulo`, `descricao`, `link`) VALUES (NULL, :titulo, :descricao, :link);");

    $sentenca->bindParam(":titulo", $titulo);
    $sentenca->bindParam(":descricao", $descricao);
    $sentenca->bindParam(":link", $link);



    $sentenca->execute();
    header("Location:listar.php");
}



include("../../templates/header.php");
?>
<br>
<div class="card">
    <div class="card-header">
        Banners
    </div>
    <div class="card-body">

        <form action="" method="post">
            <div class="mb-3">
                <label for="titulo" class="form-label">Titulo:</label>
                <input type="text" class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Escreva o Titulo do banner" />
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição:</label>
                <input type="text" class="form-control" name="descricao" id="descricao" aria-describedby="helpId" placeholder="Escreva a descrição do banner " />
            </div>
            <div class="mb-3">
                <label for="link" class="form-label">Link:</label>
                <input type="text" class="form-control" name="link" id="link" aria-describedby="helpId" placeholder="Insira aqui o link " />
            </div>
            <button type="submit" class="btn btn-success">Criar Banner</button>
            <a name="" id="" class="btn btn-primary" href="listar.php" role="button">Cancelar</a>

        </form>

    </div>
    <div class="card-footer text-muted">
    </div>
</div>

<?php include("../../templates/footer.php"); ?>
