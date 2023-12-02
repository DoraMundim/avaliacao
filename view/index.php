<?php
include_once '../config/Database.php';
include_once '../controller/UsuarioController.php';
include_once '../controller/ProdutoController.php';

$database = new Database();
$conn = $database->getConnection();

$usuarioController = new UsuarioController($conn);
$produtoController = new ProdutoController($conn);

// Lógica para processar o formulário de Usuário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuarioController->processarFormularioUsuario($_POST);
    $produtoController->processarFormularioProduto($_POST);
}

// Obter listas de usuários e produtos
$usuarios = $usuarioController->listarUsuarios();
$produtos = $produtoController->listarProdutos();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Meu Projeto</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Meu Projeto</h1>

    <!-- Links para os formulários -->
    <a href="../view/cadastro_usuario.php">Novo Usuário</a>
    <a href="../view/produto_formulario.php">Novo Produto</a>

    <!-- Lista de Usuários -->
    <h2>Usuários</h2>
    <ul>
        <?php foreach ($usuarios as $usuario): ?>
            <li>
                <span>ID: <?= $usuario['id'] ?></span>
                <span>Nome: <?= $usuario['nome'] ?></span>
                <span>Email: <?= $usuario['email'] ?></span>
                <form action="../view/usuario_formulario.php" method="post" style="display: inline;">
                    <input type="hidden" name="id" value="<?= $usuario['id'] ?>">
                    <button type="submit" name="editarUsuario">Editar</button>
                </form>
                <form action="../view/index.php" method="post" style="display: inline;">
                    <input type="hidden" name="id" value="<?= $usuario['id'] ?>">
                    <button type="submit" name="excluirUsuario">Excluir</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- Lista de Produtos -->
    <h2>Produtos</h2>
    <ul>
        <?php foreach ($produtos as $produto): ?>
            <li>
                <span>ID: <?= $produto['id'] ?></span>
                <span>Nome: <?= $produto['nome'] ?></span>
                <span>Preço: <?= $produto['preco'] ?></span>
                <form action="../view/produto_formulario.php" method="post" style="display: inline;">
                    <input type="hidden" name="id" value="<?= $produto['id'] ?>">
                    <button type="submit" name="editarProduto">Editar</button>
                </form>
                <form action="../view/index.php" method="post" style="display: inline;">
                    <input type="hidden" name="id" value="<?= $produto['id'] ?>">
                    <button type="submit" name="excluirProduto">Excluir</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
