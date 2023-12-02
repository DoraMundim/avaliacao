<?php
include_once '../config/Database.php';
include_once '../controller/ProdutoController.php';

$database = new Database();
$conn = $database->getConnection();

$produtoController = new ProdutoController($conn);

// Verifica se foi fornecido um ID válido na URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $produtoId = $_GET['id'];

    // Obtém os dados do produto com base no ID
    $produto = $produtoController->getProdutoById($produtoId);

    if (!$produto) {
        // Redireciona se o produto não for encontrado
        header("Location: produto_formulario.php");
        exit();
    }
} else {
    // Redireciona se não houver ID fornecido
    header("Location: produto_formulario.php");
    exit();
}

// Lógica para processar o formulário de edição
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $preco = isset($_POST['preco']) ? $_POST['preco'] : '';

    // Atualiza o produto no banco de dados
    $produtoController->atualizarProduto($produtoId, $nome, $preco);

    // Redireciona para a página principal de produtos
    header("Location: produto_formulario.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Editar Produto</h1>

    <!-- Formulário de edição de produto -->
    <form action="editar_produto.php?id=<?= $produtoId ?>" method="post">
        <label for="nome">Nome do Produto:</label>
        <input type="text" id="nome" name="nome" value="<?= $produto['nome'] ?>" required>

        <label for="preco">Preço do Produto:</label>
        <input type="number" id="preco" name="preco" value="<?= $produto['preco'] ?>" step="0.01" required>

        <button type="submit" name="editarProduto">Salvar Edições</button>
    </form>

    <a href="produto_formulario.php">Cancelar</a>
</body>
</html>
