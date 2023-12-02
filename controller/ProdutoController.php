<?php

class ProdutoController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function processarFormularioProduto($postData, $id = null) {
        $nome = isset($postData['nome']) ? $postData['nome'] : '';
        $preco = isset($postData['preco']) ? $postData['preco'] : '';
    
        if ($id) {
            // Editar produto
            $this->editarProduto($id, $nome, $preco);
        } else {
            // Cadastrar novo produto
            $this->cadastrarProduto($nome, $preco);
        }
    }
    
    public function cadastrarProduto($nome, $preco) {
        $stmt = $this->conn->prepare("INSERT INTO produtos (nome, preco) VALUES (?, ?)");
        $stmt->bind_param("sd", $nome, $preco);
        $stmt->execute();
    }

    public function editarProduto($id, $nome, $preco) {
        $stmt = $this->conn->prepare("UPDATE produtos SET nome = ?, preco = ? WHERE id = ?");
        $stmt->bind_param("sdi", $nome, $preco, $id);
        $stmt->execute();
    }

    public function excluirProduto($id) {
        $stmt = $this->conn->prepare("DELETE FROM produtos WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }

    public function listarProdutos() {
        $result = $this->conn->query("SELECT * FROM produtos");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function obterProdutoPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM produtos WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getProdutoById($produtoId) {
        // Prepara a declaração SQL
        $stmt = $this->conn->prepare("SELECT * FROM produtos WHERE id = ?");
        $stmt->bind_param("i", $produtoId);

        // Executa a declaração
        $stmt->execute();

        // Obtém o resultado
        $result = $stmt->get_result();

        // Obtém os dados do produto
        $produto = $result->fetch_assoc();

        // Fecha a declaração
        $stmt->close();

        return $produto;
    }

    public function atualizarProduto($produtoId, $nome, $preco) {
        // Prepara a declaração SQL para atualizar o produto
        $stmt = $this->conn->prepare("UPDATE produtos SET nome = ?, preco = ? WHERE id = ?");
        $stmt->bind_param("sdi", $nome, $preco, $produtoId);

        // Executa a declaração
        $stmt->execute();

        // Fecha a declaração
        $stmt->close();
    }


}
