<?php

class UsuarioController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function processarFormularioUsuario($postData, $id = null) {
        $nome = $postData['nome'];
        $email = $postData['email'];

        if ($id) {
            // Editar usuário
            $this->editarUsuario($id, $nome, $email);
        } else {
            // Cadastrar novo usuário
            $this->cadastrarUsuario($nome, $email);
        }
    }

    public function cadastrarUsuario($nome, $email) {
        $stmt = $this->conn->prepare("INSERT INTO usuarios (nome, email) VALUES (?, ?)");

        if (!$stmt) {
            // Se a preparação da declaração falhar, imprime um erro
            echo "Erro na preparação da declaração: " . $this->conn->error;
            return;
        }

        $stmt->bind_param("ss", $nome, $email);

        $result = $stmt->execute();

        if (!$result) {
            // Se a execução da declaração falhar, imprime um erro
            echo "Erro na execução da declaração: " . $stmt->error;
        }

        $stmt->close();
        }
    
        public function editarUsuario($id, $nome, $email) {
        $stmt = $this->conn->prepare("UPDATE usuarios SET nome = ?, email = ? WHERE id = ?");
        $stmt->bind_param("ssi", $nome, $email, $id);
        $stmt->execute();
    }

    public function excluirUsuario($id) {
        $stmt = $this->conn->prepare("DELETE FROM usuarios WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }

    public function listarUsuarios() {
        $result = $this->conn->query("SELECT id, nome, email FROM usuarios");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function obterUsuarioPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
        public function getUsuarioById($usuarioId) {
            // Prepara a declaração SQL
            $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE id = ?");
            $stmt->bind_param("i", $usuarioId);
    
            // Executa a declaração
            $stmt->execute();
    
            // Obtém o resultado
            $result = $stmt->get_result();
    
            // Obtém os dados do usuário
            $usuario = $result->fetch_assoc();
    
            // Fecha a declaração
            $stmt->close();
    
            return $usuario;
        }
    
        public function atualizarUsuario($usuarioId, $nome, $email) {
            // Prepara a declaração SQL para atualizar o usuário
            $stmt = $this->conn->prepare("UPDATE usuarios SET nome = ?, email = ? WHERE id = ?");
            $stmt->bind_param("ssi", $nome, $email, $usuarioId);
    
            // Executa a declaração
            $stmt->execute();
    
            // Fecha a declaração
            $stmt->close();
        }
    
    
}
