<!-- configurando para exibir a mensagem de erro caso usuario ou senha incorretos -->
<?php 
//verfica se existe erro na sessão
$erro = $_SESSION['error'] ?? null;
unset($_SESSION['error']);
?>
<!-- fav icon -->
<link rel="icon" type="image/png" sizes="16x16" href="../../imagens/fav-icon/favicon-16x16.png">
<div class="container">
    <div class="row">
        <div class="col"></div>

        <div class="col">
            <br><br>
            <div class="card text-center">
                <div class="card-header">Login</div>
                <div class="card-body">

                    <form action="?rota=login_submit" method="post">
                        <div class="container">
                            <div class="mb-3">
                                <label for="usuario" class="form-label">Usuario:</label>
                                <input type="text" class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="" required />
                            </div>
                            <div class="mb-3">
                                <label for="senha" class="form-label">Senha:</label>
                                <input type="password" class="form-control" name="senha" id="senha" placeholder="" required />
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Entrar
                            </button>
                    </form>
                    <!-- alerta em caso de erro -->
                    <?php if (!empty($erro)): ?>
                        <div class="alert alert-danger mt-3 p-2 text-center"  id="mensagem-erro">
                            <?= $erro; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>

    <div class="col"></div>
</div>

</div>
<script>
  function removerMensagem() {
    const elementoMensagem = document.getElementById("mensagem-erro");
    elementoMensagem.parentNode.removeChild(elementoMensagem);
  }  
  setTimeout(removerMensagem, 2000) // 2000 milissegundos = 2 segundos;
</script>
