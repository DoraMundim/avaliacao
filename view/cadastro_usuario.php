<?php
include_once '../config/Database.php';
include_once '../controller/UsuarioController.php';

$database = new Database();
$conn = $database->getConnection();

$usuarioController = new UsuarioController($conn);

// Lógica para processar o formulário de cadastro de Usuário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $usuarioController->cadastrarUsuario($nome, $email);

    // Após cadastrar, redireciona para a página principal
    header("Location: usuario_formulario.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Cadastro de Usuário</h1>

    <!-- Formulário de cadastro de Usuário -->
    <form action="cadastro_usuario.php" method="post">
        <label for="nome">Nome do Usuário:</label>
        <input type="text" id="nome" name="nome" required>
        <label for="email">Email do Usuário:</label>
        <input type="text" id="email" name="email" required>


        <button type="submit" name="cadastrarUsuario">Cadastrar Usuário</button>
    </form>

    <a href="usuario_formulario.php">Cancelar</a>
</body>
</html>
