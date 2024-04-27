<?php 
//destroi a sessão
session_destroy();

//redireciona para a pagina inicial 
header('Location:index.php?rota=home');

