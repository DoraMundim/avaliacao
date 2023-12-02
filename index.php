<?php
include_once 'config/database.php';
include_once 'controller/UsuarioController.php';
include_once 'controller/ProdutoController.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Meu Projeto</title>
    <link rel="stylesheet" href="/MeuProjeto/view/style.css">
</head>
<body>
    <h1>Meu Projeto</h1>

    <div class="container">

    <a href="./view/usuario_formulario.php">Novo Usuário</a>
    <a href="./view/produto_formulario.php">Novo Produto</a>

    </div>


</body>
</html>
