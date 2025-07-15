<?php

class usuarioModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli("127.0.0.1", "root", "12345", "projeto_x", 3308);
        if ($this->conn->connect_error) {
            die("Erro de conexão: " . $this->conn->connect_error);
        }
    }

    public function buscarUsuarioPorId($id)
{
    $sql = "SELECT USU_ID, USU_NOME, USU_APELIDO, USU_IDADE FROM usuario WHERE USU_ID = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    $usuario = $resultado->fetch_assoc();

    $stmt->close();
    // Remova a linha $this->conn->close(); daqui

    return $usuario;
}

public function atualizarUsuario($id, $nome, $apelido, $idade)
{
    // Prepara a query para atualizar o usuário pelo ID
    $sql = "UPDATE usuario SET USU_NOME = ?, USU_APELIDO = ?, USU_IDADE = ? WHERE USU_ID = ?";
    
    $stmt = $this->conn->prepare($sql);
    if (!$stmt) {
        die("Erro na preparação da query: " . $this->conn->error);
    }
    
    // Vincula os parâmetros (string, string, int, int)
    $stmt->bind_param("ssii", $nome, $apelido, $idade, $id);
    
    // Executa a query
    $resultado = $stmt->execute();
    
    // Fecha o statement para liberar recursos
    $stmt->close();
    
    // Retorna true em caso de sucesso, false em caso de falha
    return $resultado;
}



}

