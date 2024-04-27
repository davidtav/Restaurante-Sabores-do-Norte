<?php
//inclusão ao banco de dados
include("../../bd.php");
//inserir informações no banco de dados
if ($_POST) {
    //subir foto
    $foto = (isset($_FILES["foto"]["name"])) ? $_FILES["foto"]["name"] : "";
    $data_foto = new DateTime();
    $nome_foto = $data_foto->getTimestamp() . "_" . $foto;
    $tmp_foto = $_FILES["foto"]["tmp_name"];

    if ($tmp_foto != "") {
        move_uploaded_file($tmp_foto, "../../../imagens/cardapio/" . $nome_foto);
    }


    //demais envios
    $nome = (isset($_POST["nome"])) ? $_POST["nome"] : "";
    $descricao = (isset($_POST["descricao"])) ? $_POST["descricao"] : "";
    $preco = (isset($_POST["preco"])) ? $_POST["preco"] : "";


    $sentenca = $conexao->prepare("INSERT INTO `tbl_cardapio` (`id`, `foto`, `nome`, `descricao`, `preco`) VALUES (NULL,:foto, :nome, :descricao, :preco);");



    $sentenca->bindParam(":foto", $nome_foto);
    $sentenca->bindParam(":nome", $nome);
    $sentenca->bindParam(":descricao", $descricao);
    $sentenca->bindParam(":preco", $preco);


    $sentenca->execute();
    header("Location:listar.php");
}




//inclusão do arquivo header php
include("../../templates/header.php");
?>
<br>
<div class="card">
    <div class="card-header">
        Cardápio
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="foto" class=" form-label">Foto:</label>
                <input type="file" class="form-control" name="foto" id="foto" placeholder="" />
            </div>
            <div class="mb-3">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" class="form-control" name="nome" id="nome" aria-describedby="helpId" placeholder="Escreva o Nome do prato" />
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição:</label>
                <input type="text" class="form-control" name="descricao" id="descricao" aria-describedby="helpId" placeholder="Escreva a descrição do prato " />
            </div>
            <div class="mb-3">
                <label for="preco" class="form-label"> Preço:</label>
                <input type="text" class="form-control" name="linkinstagram" id="linkinstagram" aria-describedby="helpId" placeholder="Insira aqui o link " />
            </div>

            <button type="submit" class="btn btn-success">Cadastrar prato</button>
            <a name="" id="" class="btn btn-primary" href="listar.php" role="button">Cancelar</a>
        </form>

    </div>
    <div class="card-footer text-muted">
    </div>
</div>

<!-- inclusão do arquivo footer php -->
<?php include("../../templates/footer.php"); ?>