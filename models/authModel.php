<?php
class authModel {

    private $conn;

    public function __construct() {
        $this->conn = new mysqli("127.0.0.1", "root", "12345", "projeto_x", 3308);

        if ($this->conn->connect_error) {
            die("Erro de conexão: " . $this->conn->connect_error);
        }
    }

    public function findByLogin(string $login) {
        $stmt = $this->conn->prepare("SELECT usu_id, usu_nome, usu_apelido, usu_idade, usu_login, usu_senha FROM usuario WHERE usu_login = ?");
        $stmt->bind_param("s", $login);
        $stmt->execute();
        $result = $stmt->get_result();
        $usuario = $result->fetch_assoc();
        $stmt->close();
        return $usuario ?: null;
    }

    public function existsLogin(string $login): bool {
        $stmt = $this->conn->prepare("SELECT usu_id FROM usuario WHERE usu_login = ?");
        $stmt->bind_param("s", $login);
        $stmt->execute();
        $stmt->store_result();
        $existe = $stmt->num_rows > 0;
        $stmt->close();
        return $existe;
    }

    public function insertUser(array $dados): bool {
        $stmt = $this->conn->prepare("INSERT INTO usuario (usu_nome, usu_apelido, usu_idade, usu_login, usu_senha) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "ssiss",
            $dados['nome'],
            $dados['apelido'],
            $dados['idade'],
            $dados['login'],
            $dados['senhaHash']
        );
        $executou = $stmt->execute();
        $stmt->close();
        return $executou;
    }

    public function updateSenha(string $login, string $senhaHash): bool {
        $stmt = $this->conn->prepare("UPDATE usuario SET usu_senha = ? WHERE usu_login = ?");
        $stmt->bind_param("ss", $senhaHash, $login);
        $executou = $stmt->execute();
        $stmt->close();
        return $executou;
    }

    public function findByNomeIdadeLogin(string $nome, int $idade, string $login) {
        $stmt = $this->conn->prepare("SELECT usu_login FROM usuario WHERE usu_nome = ? AND usu_idade = ? AND usu_login = ?");
        $stmt->bind_param("sis", $nome, $idade, $login);
        $stmt->execute();
        $result = $stmt->get_result();
        $usuario = $result->fetch_assoc();
        $stmt->close();
        return $usuario ?: null;
    }

    public function __destruct() {
        $this->close();
    }

    public function close() {
        $this->conn->close();
    }
}
