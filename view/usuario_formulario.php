<?php
include_once '../config/Database.php';
include_once '../controller/UsuarioController.php';

$database = new Database();
$conn = $database->getConnection();

$usuarioController = new UsuarioController($conn);

// Lógica para processar a exclusão do Usuário
if (isset($_GET['excluir'])) {
    $idExcluir = $_GET['excluir'];
    $usuarioController->excluirUsuario($idExcluir);
}

// Obter a lista de usuários
$usuarios = $usuarioController->listarUsuarios();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Formulário de Usuário</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Lista de Usuários</h1>

    <ul>
        <?php foreach ($usuarios as $usuario) : ?>
            <li>
                Nome: <?= $usuario['nome'] ?>  
                Email: <?= $usuario['email'] ?>
                <a href="editar_usuario.php?id=<?= $usuario['id'] ?>&nome=<?= $usuario['nome']  ?>">Editar</a> | 
                <a href="usuario_formulario.php?excluir=<?= $usuario['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir este usuário?')">Excluir</a>
            </li>
        <?php endforeach; ?>
    </ul>

    <a href="cadastro_usuario.php">Novo Usuário</a>
    <a href="../index.php">Voltar</a>
</body>
</html>
