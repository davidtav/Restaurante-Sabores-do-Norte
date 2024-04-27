<?php
//inclusão ao banco de dados
include("../../bd.php");

//editar registros
if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET["txtID"])) ? $_GET["txtID"] : "";
    $sentenca = $conexao->prepare("SELECT * FROM `tbl_depoimentos`WHERE id=:id");
    $sentenca->bindParam(":id", $txtID);
    $sentenca->execute();

    $registro = $sentenca->fetch(PDO::FETCH_LAZY);
    $opiniao = $registro["opiniao"];
    $nome = $registro["nome"];
}
if ($_POST) {
    $txtID = (isset($_GET["txtID"])) ? $_GET["txtID"] : "";
    $opiniao = (isset($_POST["opiniao"])) ? $_POST["opiniao"] : "";
    $nome = (isset($_POST["nome"])) ? $_POST["nome"] : "";



    $sentenca = $conexao->prepare("UPDATE `tbl_depoimentos` SET  opiniao = :opiniao, nome = :nome WHERE id=:id;");

    $sentenca->bindParam(":id", $txtID);
    $sentenca->bindParam(":opiniao", $opiniao);
    $sentenca->bindParam(":nome", $nome);


    $sentenca->execute();

    header("Location:listar.php");
}

//inclusão do arquivo header php
include("../../templates/header.php");
?>
<!-- template -->
<br>
<div class="card">
    <div class="card-header">
        Depoimentos
    </div>
    <div class="card-body">

        <form action="" method="post">

            <div class="mb-3">
                <label for="txtID" class="form-label">id:</label>
                <input type="text" class="form-control" value="<?php echo $txtID; ?>" name="txtID;" id="txtID" aria-describedby="helpId" placeholder=" " />
            </div>

            <div class="mb-3">
                <label for="opiniao" class="form-label">Depoimento:</label>
                <input type="text" class="form-control" value="<?php echo $opiniao; ?>" name="opiniao" id="opiniao" aria-describedby="helpId" placeholder="Escreva o depoimento" />
            </div>
            <div class="mb-3">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" class="form-control" value="<?php echo $nome; ?>" name="nome" id="nome" aria-describedby="helpId" placeholder="Escreva o nome " />
            </div>
            <button type="submit" class="btn btn-success">Editar Depoimento</button>
            <a name="" id="" class="btn btn-primary" href="listar.php" role="button">Cancelar</a>

        </form>

    </div>
    <div class="card-footer text-muted">
    </div>
</div>

<!-- fim template -->
<!-- inclusão do arquivo footer php -->
<?php include("../../templates/footer.php"); ?>