<?php
//inclusão ao banco de dados
include("../../bd.php");
//inserir informações no banco de dados
if ($_POST) {

    $opiniao = (isset($_POST["opiniao"])) ? $_POST["opiniao"] : "";
    $nome = (isset($_POST["nome"])) ? $_POST["nome"] : "";

    $sentenca = $conexao->prepare("INSERT INTO `tbl_depoimentos` (`id`, `opiniao`, `nome`) VALUES (NULL, :opiniao, :nome);");
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
                <label for="opiniao" class="form-label">Depoimento:</label>
                <input type="text" class="form-control" name="opiniao" id="opiniao" aria-describedby="helpId" placeholder="Insira a Opinião " />
            </div>
            <div class="mb-3">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" class="form-control" name="nome" id="nome" aria-describedby="helpId" placeholder="Insira aqui o Nome " />
            </div>
            <button type="submit" class="btn btn-success">Inserir depoimento</button>
            <a name="" id="" class="btn btn-primary" href="listar.php" role="button">Cancelar</a>

        </form>

    </div>
    <div class="card-footer text-muted">
    </div>
</div>

<!-- fim template -->
<!-- inclusão do arquivo footer php -->
<?php include("../../templates/footer.php"); ?>