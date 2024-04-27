<?php
//inclusão ao banco de dados
include("../../bd.php");
//recebendo os dados para editar no index
if ($_POST) {

    $txtID = (isset($_GET["txtID"])) ? $_GET["txtID"] : "";
    $titulo = (isset($_POST["titulo"])) ? $_POST["titulo"] : "";
    $descricao = (isset($_POST["descricao"])) ? $_POST["descricao"] : "";
    $linkinstagram = (isset($_POST["linkinstagram"])) ? $_POST["linkinstagram"] : "";
    $linklinkedin = (isset($_POST["linklinkedin"])) ? $_POST["linklinkedin"] : "";
    $linkfacebook = (isset($_POST["linkfacebook"])) ? $_POST["linkfacebook"] : "";


    $sentenca = $conexao->prepare("UPDATE `tbl_colaboradores` SET titulo = :titulo, descricao = :descricao,                 linkinstagram = :linkinstagram, linklinkedin = :linklinkedin, linkfacebook = :linkfacebook WHERE id=:id");

    $sentenca->bindParam(":id", $txtID);
    $sentenca->bindParam(":titulo", $titulo);
    $sentenca->bindParam(":descricao", $descricao);
    $sentenca->bindParam(":linkinstagram", $linkinstagram);
    $sentenca->bindParam(":linklinkedin", $linklinkedin);
    $sentenca->bindParam(":linkfacebook", $linkfacebook);


    $sentenca->execute();

    //processo para atualizar a foto
    $foto = (isset($_FILES["foto"]["name"])) ? $_FILES["foto"]["name"] : "";
    $tmp_foto = $_FILES["foto"]["tmp_name"];

    if ($foto != "") {
        $data_foto = new DateTime();
        $nome_foto = $data_foto->getTimestamp() . "_" . $foto;
        move_uploaded_file($tmp_foto, "../../../imagens/colaboradores/" . $nome_foto);

        //deletar a foto do arquivo após atualização
        $sentenca = $conexao->prepare("SELECT * FROM tbl_colaboradores WHERE id=:id");
        $sentenca->bindParam(":id", $txtID);
        $sentenca->execute();

        $registro_foto = $sentenca->fetch(PDO::FETCH_LAZY);

        if (isset($registro_foto['foto'])) {
            if (file_exists("../../../imagens/colaboradores/" . $registro_foto['foto'])) {
                unlink("../../../imagens/colaboradores/" . $registro_foto['foto']);
            }
        }
        $sentenca = $conexao->prepare(
            "UPDATE `tbl_colaboradores` SET foto = :foto WHERE id=:id;"
        );
        $sentenca->bindParam(":foto", $nome_foto);
        $sentenca->bindParam(":id", $txtID);
        $sentenca->execute();
    }
}


//editar registros
if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET["txtID"])) ? $_GET["txtID"] : "";
    $sentenca = $conexao->prepare("SELECT * FROM `tbl_colaboradores`WHERE id=:id");
    $sentenca->bindParam(":id", $txtID);
    $sentenca->execute();
    $registro = $sentenca->fetch(PDO::FETCH_LAZY);
    $foto = $registro["foto"];

    //recuperar os dados para exibeir na tabela
    $titulo = $registro["titulo"];
    $descricao = $registro["descricao"];
    $linkinstagram = $registro["linkinstagram"];
    $linklinkedin = $registro["linklinkedin"];
    $linkfacebook = $registro["linkfacebook"];
}



//inclusão do arquivo header php
include("../../templates/header.php");

?>
<br>
<div class="card">
    <div class="card-header">
        Colaborador(a)
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="txtID" class="form-label">id:</label>
                <input type="text" class="form-control" value="<?php echo $txtID; ?>" name="txtID;" id="txtID" aria-describedby="helpId" placeholder=" " />
            </div>

            <div class="mb-3">
                <label for="foto" class=" form-label">Foto:</label><br>
                <img src="../../../imagens/colaboradores/<?php echo $foto; ?>" alt="" width="400" margin="auto">
                <input type="file" class=" form-control" name=" foto" id="foto" placeholder="" />
            </div>

            <div class="mb-3">
                <label for="titulo" class="form-label">Nome:</label>
                <input type="text" value="<?php echo $titulo; ?>" class=" form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Escreva o Nome do Colaborador" />
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição:</label>
                <input type="text" value="<?php echo $descricao; ?>" class=" form-control" name="descricao" id="descricao" aria-describedby="helpId" placeholder="Escreva a descrição do Colaborador " />
            </div>
            <div class="mb-3">
                <label for="linkinstagram" class="form-label"> Instagram:</label>
                <input type="text" value="<?php echo $linkinstagram; ?>" class=" form-control" name="linkinstagram" id="linkinstagram" aria-describedby="helpId" placeholder="Insira aqui o link " />
            </div>
            <div class="mb-3">
                <label for="linklinkedin" class="form-label"> LinkedIn:</label>
                <input type="text" value="<?php echo $linklinkedin; ?>" class=" form-control" name="linklinkedin" id="linklinkedin" aria-describedby="helpId" placeholder="Insira aqui o link " />
            </div>
            <div class="mb-3">
                <label for="linkfacebook" class="form-label"> Facebook:</label>
                <input type="text" value="<?php echo $linkfacebook; ?>" class=" form-control" name="linkfacebook" id="linkfacebook" aria-describedby="helpId" placeholder="Insira aqui o link " />
            </div>
            <button type="submit" class="btn btn-success">Atualizar</button>
            <a name="" id="" class="btn btn-primary" href="listar.php" role="button">Cancelar</a>
        </form>

    </div>
    <div class="card-footer text-muted">
    </div>
</div>


<?php include("../../templates/footer.php"); ?>