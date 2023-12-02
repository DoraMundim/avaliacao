<?php
include_once '../config/Database.php';
include_once '../controller/ProdutoController.php';

$database = new Database();
$conn = $database->getConnection();

$produtoController = new ProdutoController($conn);

// Lógica para processar o formulário de cadastro de Produto
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $preco = isset($_POST['preco']) ? $_POST['preco'] : '';

    $produtoController->cadastrarProduto($nome, $preco);

    // Após cadastrar, redireciona para a página principal de produtos
    header("Location: produto_formulario.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Produto</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Cadastro de Produto</h1>

    <!-- Formulário de cadastro de Produto -->
    <form action="cadastro_produto.php" method="post">
        <label for="nome">Nome do Produto:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="preco">Preço do Produto:</label>
        <input type="number" id="preco" name="preco" step="0.01" required>

        <button type="submit" name="cadastrarProduto">Cadastrar Produto</button>
    </form>

    <a href="produto_formulario.php">Cancelar</a>
</body>
</html>
