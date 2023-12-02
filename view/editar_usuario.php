<?php
include_once '../config/Database.php';
include_once '../controller/UsuarioController.php';

$database = new Database();
$conn = $database->getConnection();

$usuarioController = new UsuarioController($conn);

// Verifica se foi fornecido um ID válido na URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $usuarioId = $_GET['id'];

    // Obtém os dados do usuário com base no ID
    $usuario = $usuarioController->getUsuarioById($usuarioId);

    if (!$usuario) {
        // Redireciona se o usuário não for encontrado
        header("Location: usuario_formulario.php");
        exit();
    }
} else {
    // Redireciona se não houver ID fornecido
    header("Location: usuario_formulario.php");
    exit();
}

// Lógica para processar o formulário de edição
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';

    // Atualiza o usuário no banco de dados
    $usuarioController->atualizarUsuario($usuarioId, $nome, $email);

    // Redireciona para a página principal de usuários
    header("Location: usuario_formulario.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Editar Usuário</h1>

    <!-- Formulário de edição de usuário -->
    <form action="editar_usuario.php?id=<?= $usuarioId ?>" method="post">
        <label for="nome">Nome do Usuário:</label>
        <input type="text" id="nome" name="nome" value="<?= $usuario['nome'] ?>" required>

        <label for="email">E-mail do Usuário:</label>
        <input type="email" id="email" name="email" value="<?= $usuario['email'] ?>" required>

        <button type="submit" name="editarUsuario">Salvar Edições</button>
    </form>

    <a href="usuario_formulario.php">Cancelar</a>
</body>
</html>
