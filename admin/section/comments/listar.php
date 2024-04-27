<?php
//inclusão ao banco de dados
include("../../bd.php");

//conexão ao banco de dados
$sentenca = $conexao->prepare("SELECT * FROM `tbl_faleconosco`");
$sentenca->execute();

//apagar registros
if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET["txtID"])) ? $_GET["txtID"] : "";
    $sentenca = $conexao->prepare("DELETE FROM `tbl_faleconosco` WHERE id=:id");
    $sentenca->bindParam(":id", $txtID);
    $sentenca->execute();

    header("Location:listar.php");
}

$lista_comentarios = $sentenca->fetchAll(PDO::FETCH_ASSOC);

//inclusão do arquivo header php
include("../../templates/header.php");
?>
<br>
<div class="card">
    <div class="card-header">
        Comentários
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Mensagem</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- inicio foreach -->
                    <?php foreach ($lista_comentarios as $comentario) {  ?>
                        <tr class="">
                            <td scope="row"><?php echo $comentario['id']; ?></td>
                            <td><?php echo $comentario['nome']; ?></td>
                            <td><?php echo $comentario['email']; ?></td>
                            <td><?php echo $comentario['mensagem']; ?></td>
                            <td>
                                <a name="" id="" class="btn btn-danger" href="listar.php?txtID=<?php echo $comentario['id']; ?>" role="button">Excluir</a>
                            </td>
                        </tr>
                    <?php } ?>
                    <!-- fim foreach -->
                </tbody>
            </table>
        </div>

    </div>
    <div class="card-footer text-muted">

    </div>
</div>

<!-- inclusão do arquivo footer php -->
<?php include("../../templates/footer.php"); ?>