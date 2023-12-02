<?php
include_once '../config/Database.php';
include_once '../controller/ProdutoController.php';

$database = new Database();
$conn = $database->getConnection();

$produtoController = new ProdutoController($conn);

// Lógica para processar a exclusão do Produto
if (isset($_GET['excluir'])) {
    $idExcluir = $_GET['excluir'];
    $produtoController->excluirProduto($idExcluir);
}

// Obter a lista de produtos
$produtos = $produtoController->listarProdutos();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Formulário de Produto</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Lista de Produtos</h1>

    <ul>
        <?php foreach ($produtos as $produto) : ?>
            <li>
                <?= $produto['nome'] ?> -  <?= $produto['preco'] ?>
                <a href="editar_produto.php?id=<?= $produto['id'] ?>&nome=<?= $produto['nome'] ?>"><a href="editar_produto.php?id=<?= $produto['id'] ?>&nome=<?= $produto['nome'] ?>">Editar</a>
                <a href="produto_formulario.php?excluir=<?= $produto['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir este produto?')">Excluir</a>
            </li>
        <?php endforeach; ?>
    </ul>

    <a href="cadastro_produto.php">Novo Produto</a>
    <a href="../index.php">Voltar</a>
</body>
</html>
