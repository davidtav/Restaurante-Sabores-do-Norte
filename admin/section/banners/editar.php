<?php
//inclusão ao banco de dados
include("../../bd.php");

//editar registros
if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET["txtID"])) ? $_GET["txtID"] : "";
    $sentenca = $conexao->prepare("SELECT * FROM `tbl_banners`WHERE id=:id");
    $sentenca->bindParam(":id", $txtID);
    $sentenca->execute();

    $registro = $sentenca->fetch(PDO::FETCH_LAZY);
    $titulo = $registro["titulo"];
    $descricao = $registro["descricao"];
    $link = $registro["link"];
}
if ($_POST) {
    $txtID = (isset($_GET["txtID"])) ? $_GET["txtID"] : "";
    $titulo = (isset($_POST["titulo"])) ? $_POST["titulo"] : "";
    $descricao = (isset($_POST["descricao"])) ? $_POST["descricao"] : "";
    $link = (isset($_POST["link"])) ? $_POST["link"] : "";


    $sentenca = $conexao->prepare("UPDATE `tbl_banners` 
                                   SET  titulo = :titulo, descricao = :descricao, link = :link 
                                   WHERE id=:id;");

    $sentenca->bindParam(":id", $txtID);
    $sentenca->bindParam(":titulo", $titulo);
    $sentenca->bindParam(":descricao", $descricao);
    $sentenca->bindParam(":link", $link);

    $sentenca->execute();

    header("Location:listar.php");
}




//inclusão do arquivo header php
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
                <label for="txtID" class="form-label">id:</label>
                <input type="text" class="form-control" value="<?php echo $txtID; ?>" name="txtID;" id="txtID" aria-describedby="helpId" placeholder=" " />
            </div>

            <div class="mb-3">
                <label for="titulo" class="form-label">titulo:</label>
                <input type="text" class="form-control" value="<?php echo $titulo; ?>" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Escreva o Titulo do banner " />
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição:</label>
                <input type="text" class="form-control" value="<?php echo $descricao; ?>" name="descricao" id="descricao" aria-describedby="helpId" placeholder="Escreva a descrição do banner " />
            </div>
            <div class="mb-3">
                <label for="link" class="form-label">Link:</label>
                <input type="text" class="form-control" value="<?php echo $link; ?>" name="link" id="link" aria-describedby="helpId" placeholder="Insira aqui o link " />
            </div>
            <button type="submit" class="btn btn-success">Editar Banner</button>
            <a name="" id="" class="btn btn-primary" href="listar.php" role="button">Cancelar</a>

        </form>

    </div>
    <div class="card-footer text-muted">
    </div>
</div>
<?php include("../../templates/footer.php"); ?>