<?php
//inclusão do arquivo header php
include("../../templates/header.php");
//inclusão ao banco de dados
include("../../bd.php");
//conexão ao banco de dados
$sentenca = $conexao->prepare("SELECT * FROM `tbl_usuarios`");
$sentenca->execute();

$lista_usuarios = $sentenca->fetchAll(PDO::FETCH_ASSOC);


//apagar registros
if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET["txtID"])) ? $_GET["txtID"] : "";
    $sentenca = $conexao->prepare("DELETE FROM `tbl_usuarios` WHERE id=:id");
    $sentenca->bindParam(":id", $txtID);
    $sentenca->execute();

    header("Location:listar.php");
}

?>
<br>
<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="criar.php" role="button">Adicionar usuário</a>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Senha</th>
                        <th scope="col">Email</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- inicio foreach -->
                    <?php foreach ($lista_usuarios as $usuario) {  ?>
                        <tr class="">
                            <td scope="row"><?php echo $usuario['id']; ?></td>
                            <td><?php echo $usuario['usuario']; ?></td>
                            <td><?php echo "********"; ?></td>
                            <td><?php echo $usuario['email']; ?></td>
                            <td>
                                <a name="" id="" class="btn btn-danger" href="listar.php?txtID=<?php echo $usuario['id']; ?>" role="button">Excluir</a>
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

<!-- inclusão do arquivo footer php -->
<?php include("../../templates/footer.php"); ?>