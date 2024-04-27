<?php
//inclusão ao banco de dados
include("../../bd.php");
//conexão ao banco de dados
$sentenca = $conexao->prepare("SELECT * FROM `tbl_banners`");
$sentenca->execute();

$lista_banners = $sentenca->fetchAll(PDO::FETCH_ASSOC);

//apagar registros
if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET["txtID"])) ? $_GET["txtID"] : "";
    $sentenca = $conexao->prepare("DELETE FROM `tbl_banners` WHERE id=:id");
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
                        <th scope="col">Título</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Link</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- inicio foreach -->
                    <?php foreach ($lista_banners as $key => $value) {  ?>
                    <tr class="">
                        <td scope="row"><?php echo $value['id']; ?></td>
                        <td><?php echo $value['titulo']; ?></td>
                        <td><?php echo $value['descricao']; ?></td>
                        <td><?php echo $value['link']; ?></td>
                        <td>
                            <a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $value['id']; ?>"
                                role="button">Editar</a>
                            <a name="" id="" class="btn btn-danger" href="listar.php?txtID=<?php echo $value['id']; ?>"
                                role="button">Excluir</a>
                        </td>
                    </tr>
                    <?php } ?>
                    <!-- fim foreach -->
                </tbody>
            </table>
        </div>

    </div>
    <div class="card-footer text-muted"></div>
</div>
<!-- fim template -->
<?php include("../../templates/footer.php"); ?>