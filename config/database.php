<?php

class Database {
    private $host = 'localhost';
    private $db = 'meu_projeto';
    private $user = 'root';
    private $password = '';
    private $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->db);

        if ($this->conn->connect_error) {
            die('Erro na conexão com o banco de dados: ' . $this->conn->connect_error);
        }

        $this->conn->set_charset("utf8");
    }

    public function getConnection() {
        return $this->conn;
    }
}
