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
        move_uploaded_file($tmp_foto, "../../../imagens/colaboradores/" . $nome_foto);
    }


    //demais envios
    $titulo = (isset($_POST["titulo"])) ? $_POST["titulo"] : "";
    $descricao = (isset($_POST["descricao"])) ? $_POST["descricao"] : "";
    $linkinstagram = (isset($_POST["linkinstagram"])) ? $_POST["linkinstagram"] : "";
    $linklinkedin = (isset($_POST["linklinkedin"])) ? $_POST["linklinkedin"] : "";
    $linkfacebook = (isset($_POST["linkfacebook"])) ? $_POST["linkfacebook"] : "";

    $sentenca = $conexao->prepare("INSERT INTO `tbl_colaboradores` (`id`, `titulo`, `descricao`, `linkinstagram`, `linklinkedin`, `linkfacebook`, `foto`) VALUES (NULL, :titulo, :descricao, :linkinstagram, :linklinkedin, :linkfacebook, :foto);");



    $sentenca->bindParam(":foto", $nome_foto);
    $sentenca->bindParam(":titulo", $titulo);
    $sentenca->bindParam(":descricao", $descricao);
    $sentenca->bindParam(":linkinstagram", $linkinstagram);
    $sentenca->bindParam(":linklinkedin", $linklinkedin);
    $sentenca->bindParam(":linkfacebook", $linkfacebook);


    $sentenca->execute();
    header("Location:listar.php");
}

include("../../templates/header.php");
?>

<br>
<div class="card">
    <div class="card-header">
        Colaboradores
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="foto" class=" form-label">Foto:</label>
                <input type="file" class="form-control" name="foto" id="foto" placeholder="" />
            </div>
            <div class="mb-3">
                <label for="titulo" class="form-label">Nome:</label>
                <input type="text" class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Escreva o Nome do Colaborador" />
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição:</label>
                <input type="text" class="form-control" name="descricao" id="descricao" aria-describedby="helpId" placeholder="Escreva a descrição do Colaborador " />
            </div>
            <div class="mb-3">
                <label for="linkinstagram" class="form-label"> Instagram:</label>
                <input type="text" class="form-control" name="linkinstagram" id="linkinstagram" aria-describedby="helpId" placeholder="Insira aqui o link " />
            </div>
            <div class="mb-3">
                <label for="linklinkedin" class="form-label"> LinkedIn:</label>
                <input type="text" class="form-control" name="linklinkedin" id="linklinkedin" aria-describedby="helpId" placeholder="Insira aqui o link " />
            </div>
            <div class="mb-3">
                <label for="linkfacebook" class="form-label"> Facebook:</label>
                <input type="text" class="form-control" name="linkfacebook" id="linkfacebook" aria-describedby="helpId" placeholder="Insira aqui o link " />
            </div>
            <button type="submit" class="btn btn-success">Cadastrar Colaborador</button>
            <a name="" id="" class="btn btn-primary" href="listar.php" role="button">Cancelar</a>
        </form>

    </div>
    <div class="card-footer text-muted">
    </div>
</div>

<?php include("../../templates/footer.php"); ?>