<?php
class tarefaModel {
    private $pdo;

    public function __construct() {
        $this->conectarBanco();
    }

    // Conecta ao banco MySQL usando PDO com configurações corretas e tratamento de exceção
    private function conectarBanco() {
        try {
            $this->pdo = new PDO(
                'mysql:host=127.0.0.1;port=3308;dbname=projeto_x',
                'root',
                '12345',
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,        // Lança exceções em erros SQL
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC   // Retorna arrays associativos nas consultas
                ]
            );
        } catch (PDOException $e) {
            die("Erro de conexão: " . $e->getMessage());             // Finaliza a execução se não conectar
        }
    }

    // Insere nova tarefa no banco com os dados recebidos do controller
    public function criarTarefa(array $dados): array {
        try {
            $stmt = $this->pdo->prepare("
                INSERT INTO TAREFAS (
                    TASK_TITULO,
                    TASK_DESCRICAO,
                    TASK_TIPOTAREFA,
                    TASK_PRIORIDADE,
                    TASK_DATAFIM,
                    USU_ID
                ) VALUES (
                    :titulo,
                    :descricao,
                    :tipotarefa,
                    :prioridade,
                    :datafim,
                    :usu_id
                )
            ");

            // Executa a query com os dados passados
            $stmt->execute([
                ':titulo'      => $dados['titulo'],
                ':descricao'   => $dados['descricao'] ?? null,
                ':tipotarefa'  => $dados['tipotarefa'],
                ':prioridade'  => $dados['prioridade'] ?? 'média', // padrão em minúsculo para casar com a view
                ':datafim'     => $dados['datafim'] ?? null,
                ':usu_id'      => $dados['usu_id']
            ]);

            // Retorna sucesso com o ID da tarefa criada
            return [
                'sucesso' => true,
                'id' => $this->pdo->lastInsertId()
            ];
        } catch (PDOException $e) {
            // Em caso de erro retorna array com sucesso=false e mensagem de erro
            return [
                'sucesso' => false,
                'erro' => "Erro ao criar tarefa: " . $e->getMessage()
            ];
        }
    }

    public function listarTarefasPorUsuario(int $usu_id): array {
        try {
            // Prepara a query para buscar os campos desejados da tabela TAREFAS
            $stmt = $this->pdo->prepare("
                SELECT 
                    TASK_ID,           
                    TASK_TITULO,       
                    TASK_TIPOTAREFA,   
                    TASK_DATAFIM,      
                    TASK_PRIORIDADE,   
                    TASK_STATUS        
                FROM TAREFAS
                WHERE USU_ID = :usu_id    
                ORDER BY TASK_DATAFIM ASC
            ");

            // Executa a query substituindo :usu_id pelo valor do usuário
            $stmt->execute([':usu_id' => $usu_id]);

            // Retorna todas as linhas resultantes como array associativo
            return $stmt->fetchAll();

        } catch (PDOException $e) {
            // Em caso de erro, retorna array vazio para evitar quebra da aplicação
            return [];
        }
    }

    /**
     * Busca uma tarefa pelo ID e pelo ID do usuário.
     * Garante que o usuário só acesse suas próprias tarefas.
     *
     * @param int $taskId ID da tarefa
     * @param int $usuarioId ID do usuário logado
     * @return array|null Retorna os dados da tarefa ou null se não encontrar
     */
   public function buscarTarefaPorIdEUsuario($taskId, $usuarioId) {
    try {
        $stmt = $this->pdo->prepare("
            SELECT * FROM TAREFAS 
            WHERE TASK_ID = :taskId AND USU_ID = :usuarioId
            LIMIT 1
        ");
        $stmt->execute([
            ':taskId' => $taskId,
            ':usuarioId' => $usuarioId
        ]);

        // Busca o resultado como array associativo para facilitar o uso na view
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado ?: null;

    } catch (PDOException $e) {
        // Aqui pode registrar o erro num log se desejar
        return null;
    }
}

public function atualizarTarefa(array $dados): array {
    try {
        // Prepara o SQL para atualizar os campos da tarefa
        $sql = "
            UPDATE TAREFAS
            SET 
                TASK_TITULO     = :titulo,
                TASK_TIPOTAREFA = :tipotarefa,
                TASK_PRIORIDADE = :prioridade,
                TASK_DATAFIM    = :datafim,
                TASK_DESCRICAO  = :descricao
            WHERE TASK_ID = :task_id AND USU_ID = :usu_id
        ";

        $stmt = $this->pdo->prepare($sql);

        // Executa a atualização com os dados fornecidos
        $stmt->execute([
            ':titulo'     => $dados['titulo'],
            ':tipotarefa' => $dados['tipotarefa'],
            ':prioridade' => $dados['prioridade'],
            ':datafim'    => $dados['datafim'],
            ':descricao'  => $dados['descricao'],
            ':task_id'    => $dados['task_id'],
            ':usu_id'     => $dados['usu_id']
        ]);

        // Verifica se alguma linha foi afetada
        if ($stmt->rowCount() > 0) {
            return ['sucesso' => true];
        } else {
            return ['sucesso' => false, 'erro' => 'Nenhuma alteração feita ou tarefa não encontrada.'];
        }

    } catch (PDOException $e) {
        return ['sucesso' => false, 'erro' => 'Erro ao atualizar tarefa: ' . $e->getMessage()];
    }
}


}
