<?php
//inclusão ao banco de dados
include("../../bd.php");

//recebendo os dados para editar no index
if ($_POST) {

    $txtID = (isset($_GET["txtID"])) ? $_GET["txtID"] : "";
    $nome = (isset($_POST["nome"])) ? $_POST["nome"] : "";
    $descricao = (isset($_POST["descricao"])) ? $_POST["descricao"] : "";
    $preco = (isset($_POST["preco"])) ? $_POST["preco"] : "";



    $sentenca = $conexao->prepare("UPDATE `tbl_cardapio` SET nome = :nome, descricao = :descricao, preco=:preco WHERE id=:id");

    $sentenca->bindParam(":id", $txtID);
    $sentenca->bindParam(":nome", $nome);
    $sentenca->bindParam(":descricao", $descricao);
    $sentenca->bindParam(":preco", $preco);


    $sentenca->execute();


    header("Location:listar.php");

    //processo para atualizar a foto
    $foto = (isset($_FILES["foto"]["name"])) ? $_FILES["foto"]["name"] : "";
    $tmp_foto = $_FILES["foto"]["tmp_name"];

    if ($foto != "") {
        $data_foto = new DateTime();
        $nome_foto = $data_foto->getTimestamp() . "_" . $foto;
        move_uploaded_file($tmp_foto, "../../../imagens/cardapio/" . $nome_foto);

        //deletar a foto do arquivo após atualização
        $sentenca = $conexao->prepare("SELECT * FROM tbl_cardapio WHERE id=:id");
        $sentenca->bindParam(":id", $txtID);
        $sentenca->execute();

        $registro_foto = $sentenca->fetch(PDO::FETCH_LAZY);

        if (isset($registro_foto['foto'])) {
            if (file_exists("../../../imagens/cardapio/" . $registro_foto['foto'])) {
                unlink("../../../imagens/cardapio/" . $registro_foto['foto']);
            }
        }
        $sentenca = $conexao->prepare(
            "UPDATE `tbl_cardapio` SET foto = :foto WHERE id=:id;"
        );
        $sentenca->bindParam(":foto", $nome_foto);
        $sentenca->bindParam(":id", $txtID);
        $sentenca->execute();
    }
}


//editar registros
if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET["txtID"])) ? $_GET["txtID"] : "";
    $sentenca = $conexao->prepare("SELECT * FROM `tbl_cardapio`WHERE id=:id");
    $sentenca->bindParam(":id", $txtID);
    $sentenca->execute();
    $registro = $sentenca->fetch(PDO::FETCH_LAZY);
    $foto = $registro["foto"];

    //recuperar os dados para exibir na tabela
    $nome = $registro["nome"];
    $descricao = $registro["descricao"];
    $preco = $registro["preco"];
}






//inclusão do arquivo header php
include("../../templates/header.php");
?>
<br>
<div class="card">
    <div class="card-header">
        Cardapio
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="txtID" class="form-label">id:</label>
                <input type="text" class="form-control" value="<?php echo $txtID; ?>" name="txtID;" id="txtID" aria-describedby="helpId" placeholder=" " />
            </div>

            <div class="mb-3">
                <label for="foto" class=" form-label">Foto:</label><br>
                <img src="../../../imagens/cardapio/<?php echo $foto; ?>" alt="" width="400" margin="auto">
                <input type="file" class=" form-control" name=" foto" id="foto" placeholder="" />
            </div>

            <div class="mb-3">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" value="<?php echo $nome; ?>" class=" form-control" name="nome" id="nome" aria-describedby="helpId" placeholder="Escreva o Nome do prato" />
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição:</label>
                <input type="text" value="<?php echo $descricao; ?>" class=" form-control" name="descricao" id="descricao" aria-describedby="helpId" placeholder="Escreva a descrição do Colaborador " />
            </div>
            <div class="mb-3">
                <label for="preco" class="form-label"> Preco:</label>
                <input type="number" value="<?php echo $preco; ?>" class=" form-control" name="preco" id="preco" aria-describedby="helpId" placeholder="Insira aqui o preço " />
            </div>
            <button type="submit" class="btn btn-success">Atualizar</button>
            <a name="" id="" class="btn btn-primary" href="listar.php" role="button">Cancelar</a>
        </form>

    </div>
    <div class="card-footer text-muted">
    </div>
</div>

<!-- inclusão do arquivo footer php -->
<?php include("../../templates/footer.php"); ?>