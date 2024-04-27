<?php
//inclusão ao banco de dados
include("../../bd.php");
//inserir informações no banco de dados
if ($_POST) {
    $usuario = (isset($_POST["usuario"])) ? $_POST["usuario"] : "";
    $senha = (isset($_POST["senha"])) ? $_POST["senha"] : "";
    $senha = md5($senha);
    $email = (isset($_POST["email"])) ? $_POST["email"] : "";

    $sentenca = $conexao->prepare("INSERT INTO `tbl_usuarios` (`id`, `usuario`, `senha`, `email`) VALUES (NULL, :usuario, :senha, :email);");

    $sentenca->bindParam(":usuario", $usuario);
    $sentenca->bindParam(":senha", $senha);
    $sentenca->bindParam(":email", $email);



    $sentenca->execute();
    header("Location:listar.php");
}



include("../../templates/header.php");
?>
<br>
<div class="card">
    <div class="card-header">
        Usuarios
    </div>
    <div class="card-body">
        <form action="" method="post">
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario:</label>
                <input type="text" class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Escreva o nome do usuario" />
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha:</label>
                <input type="password" class="form-control" name="senha" id="senha" aria-describedby="helpId" placeholder="digite sua senha " required />
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">email:</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="Insira aqui seu email " />
            </div>
            <button type="submit" class="btn btn-success">Cadastrar usuário</button>
            <a name="" id="" class="btn btn-primary" href="listar.php" role="button">Cancelar</a>

        </form>

    </div>
    <div class="card-footer text-muted"></div>
</div>


<?php include("../../templates/footer.php"); ?>