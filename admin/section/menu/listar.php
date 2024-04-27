<?php
//inclusão ao banco de dados
include("../../bd.php");
//conexão ao banco de dados
$sentenca = $conexao->prepare("SELECT * FROM `tbl_cardapio`");
$sentenca->execute();

$lista_cardapio = $sentenca->fetchAll(PDO::FETCH_ASSOC);

//apagar registros juntamente com a imagem salva na pasta colaboradores
if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET["txtID"])) ? $_GET["txtID"] : "";
    //processo para deletar a foto do arquivo
    $sentenca = $conexao->prepare("SELECT * FROM tbl_cardapio WHERE id=:id");
    $sentenca->bindParam(":id", $txtID);
    $sentenca->execute();

    $registro_foto = $sentenca->fetch(PDO::FETCH_LAZY);

    if (isset($registro_foto['foto'])) {
        if (file_exists("../../../imagens/cardapio/" . $registro_foto['foto'])) {
            unlink("../../../imagens/cardapio/" . $registro_foto['foto']);
        }
    }
    //apagar do banco de dados    
    $sentenca = $conexao->prepare("DELETE FROM tbl_cardapio WHERE id=:id");
    $sentenca->bindParam(":id", $txtID);
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
        <a name="" id="" class="btn btn-primary" href="criar.php" role="button">Adicionar registro</a>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Preço</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- inicio foreach -->
                    <?php foreach ($lista_cardapio as $cardapio) {  ?>
                        <tr class="">
                            <td scope="row"><?php echo $cardapio['id']; ?></td>
                            <td scope="row">
                                <img src="../../../imagens/cardapio/<?php echo $cardapio['foto']; ?>" width="50" srcset="">
                            </td>
                            <td scope="row"><?php echo $cardapio['nome']; ?></td>
                            <td scope="row"><?php echo $cardapio['descricao']; ?></td>
                            <td scope="row"><?php echo $cardapio['preco']; ?></td>

                            <td scope="row">
                                <a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $cardapio['id']; ?>" role="button">Editar</a>
                                <a name="" id="" class="btn btn-danger" href="listar.php?txtID=<?php echo $cardapio['id']; ?>" role="button">Excluir</a>
                            </td>
                        </tr>
                    <?php } ?>
                    <!-- fim foreach -->

                </tbody>
            </table>
        </div>


    </div>
</div>
<!-- fim template -->

<!-- inclusão do arquivo footer php -->
<?php include("../../templates/footer.php"); ?>