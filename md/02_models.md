## Arquivo: models\authModel.php
```php
<?php
class authModel {

    private $conn;

    public function __construct() {
        // Cria conexÃ£o com o banco de dados
        $this->conn = new mysqli("127.0.0.1", "root", "12345", "projeto_x", 3308);

        // Verifica erro de conexÃ£o
        if ($this->conn->connect_error) {
            die("Erro de conexÃ£o: " . $this->conn->connect_error);
        }
    }

    // FunÃ§Ã£o para buscar usuario por Login
    public function findByLogin(string $login) {
        // Prepara query SQL segura usando prepared statement
        $stmt = $this->conn->prepare("SELECT usu_id, usu_nome, usu_apelido, usu_idade, usu_login, usu_senha FROM usuario WHERE usu_login = ?");
        $stmt->bind_param("s", $login); // Substitui ? pelo login do usuÃ¡rio
        $stmt->execute();
        $result = $stmt->get_result(); // Executa e captura resultado
        $usuario = $result->fetch_assoc(); // Retorna array associativo do usuÃ¡rio
        $stmt->close(); // Fecha statement
        return $usuario ?: null; // Retorna null se nÃ£o encontrar
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
        $this->close(); // Fecha a conexÃ£o ao final da execuÃ§Ã£o
    }

    public function close() {
        $this->conn->close();
    }
}

```n
## Arquivo: models\estatisticasModel.php
```php

```n
## Arquivo: models\homeModel.php
```php
<?php
class homeModel {

    private $host = "127.0.0.1";
    private $usuario = "root";
    private $senha = "12345";
    private $banco = "projeto_x";
    private $porta = 3308;

    private function conectar() {
        $conn = new mysqli($this->host, $this->usuario, $this->senha, $this->banco, $this->porta);
        if ($conn->connect_error) {
            die("Erro na conexÃ£o: " . $conn->connect_error);
        }
        return $conn;
    }

    public function getNomeParaExibir($login) {
        $conn = $this->conectar();
        $stmt = $conn->prepare("SELECT USU_NOME, USU_APELIDO FROM USUARIO WHERE USU_LOGIN = ?");
        $stmt->bind_param("s", $login);
        $stmt->execute();
        $stmt->bind_result($nome, $apelido);
        $stmt->fetch();
        $stmt->close();
        $conn->close();
        return !empty($apelido) ? $apelido : $nome;
    }

    // MÃ©todos que retornam nÃºmeros - views
    public function getQtdProximasTarefas($login) {
    // Conecta ao banco via mÃ©todo conectar()
    $conn = $this->conectar();

    $quantidade = 0;

    // Consulta a view correta de tarefas pendentes para o usuÃ¡rio
    $sql = "SELECT tarefas_pendentes FROM vw_tarefas_pendentes_por_usuario WHERE USU_ID = (SELECT USU_ID FROM USUARIO WHERE USU_LOGIN = ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $login);
    $stmt->execute();

    $resultado = $stmt->get_result();

    if ($resultado && $row = $resultado->fetch_assoc()) {
        $quantidade = $row['tarefas_pendentes'];
    }

    $stmt->close();
    $conn->close();

    return $quantidade;
    }

    public function getQtdConcluidasUlt30Dias($login) {
    $conn = $this->conectar();
    $quantidade = 0;

    // Consulta o ID do usuÃ¡rio com base no login
    $sqlUsuario = "SELECT USU_ID FROM usuario WHERE USU_LOGIN = ?";
    $stmtUsuario = $conn->prepare($sqlUsuario);
    $stmtUsuario->bind_param("s", $login);
    $stmtUsuario->execute();
    $resultadoUsuario = $stmtUsuario->get_result();

    if ($rowUsuario = $resultadoUsuario->fetch_assoc()) {
        $usuId = $rowUsuario['USU_ID'];

        // Consulta a view que jÃ¡ traz o total de tarefas concluÃ­das nos Ãºltimos 30 dias
        $sqlView = "SELECT tarefas_concluidas_ult_30dias FROM vw_tarefas_concluidas_ult_30dias WHERE USU_ID = ?";
        $stmtView = $conn->prepare($sqlView);
        $stmtView->bind_param("i", $usuId);
        $stmtView->execute();
        $resultadoView = $stmtView->get_result();

        if ($rowView = $resultadoView->fetch_assoc()) {
            $quantidade = $rowView['tarefas_concluidas_ult_30dias'];
        }

        $stmtView->close();
    }

    $stmtUsuario->close();
    $conn->close();

    return $quantidade;
    }

    public function getTotalTarefas($login) {
    $conn = $this->conectar();
    $total = 0;

    $sql = "
        SELECT COUNT(*) AS total
        FROM TAREFAS
        WHERE USU_ID = (
            SELECT USU_ID FROM usuario WHERE USU_LOGIN = ?
        )
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    if ($row = $resultado->fetch_assoc()) {
        $total = $row['total'];
    }

    $stmt->close();
    $conn->close();

    return $total;
    }

    public function getTarefasAltaPrioridade($login) {
    $conn = $this->conectar();

    // Recupera o USU_ID pelo login
    $stmt = $conn->prepare("SELECT USU_ID FROM USUARIO WHERE USU_LOGIN = ?");
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $stmt->bind_result($usu_id);
    $stmt->fetch();
    $stmt->close();

    $tarefasAltaPrioridade = 0;

    // Consulta a view para contar tarefas com prioridade 'alta'
    $sql = "SELECT tarefas_alta_prioridade FROM vw_tarefas_alta_prioridade_por_usuario WHERE USU_ID = ?";
    $stmt2 = $conn->prepare($sql);
    $stmt2->bind_param("i", $usu_id);
    $stmt2->execute();
    $stmt2->bind_result($tarefasAltaPrioridade);
    $stmt2->fetch();

    $stmt2->close();
    $conn->close();

    return $tarefasAltaPrioridade ?: 0; // Se null, retorna 0
    }

    public function getTarefasPendentes($login) {
    $conn = $this->conectar();

    // Buscar ID do usuÃ¡rio pelo login
    $sqlId = "SELECT USU_ID FROM USUARIO WHERE USU_LOGIN = ?";
    $stmtId = $conn->prepare($sqlId);
    $stmtId->bind_param("s", $login);
    $stmtId->execute();
    $resultId = $stmtId->get_result();

    if ($row = $resultId->fetch_assoc()) {
        $usu_id = $row['USU_ID'];

        // Agora consulta a view com o ID do usuÃ¡rio
        $sql = "SELECT tarefas_pendentes FROM vw_tarefas_pendentes_por_usuario WHERE USU_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $usu_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            return $row['tarefas_pendentes'];
        }
    }

    return 0;
    }

    public function getTarefasAtrasadas($login) {
    $conn = $this->conectar();

    // Primeiro, pega o USU_ID do usuÃ¡rio pelo login
    $stmtUsu = $conn->prepare("SELECT USU_ID FROM USUARIO WHERE USU_LOGIN = ?");
    $stmtUsu->bind_param("s", $login);
    $stmtUsu->execute();
    $stmtUsu->bind_result($usu_id);
    $stmtUsu->fetch();
    $stmtUsu->close();

    $quantidade = 0;

    // Busca na view a quantidade de tarefas atrasadas
    $stmt = $conn->prepare("SELECT tarefas_atrasadas FROM vw_tarefas_atrasadas_por_usuario WHERE USU_ID = ?");
    $stmt->bind_param("i", $usu_id);
    $stmt->execute();
    $stmt->bind_result($quantidade);
    $stmt->fetch();
    $stmt->close();

    $conn->close();

    return $quantidade ?? 0;
    }

    // MÃ©todo que retorna array detalhado para tabela
    public function getProximasTarefasTabela($login) {
        $conn = $this->conectar();
        $tarefas = [];
        $sql = "
            SELECT 
                TASK_ID, TASK_TITULO, TASK_TIPOTAREFA, TASK_PRIORIDADE, TASK_DATAINICIO, TASK_DATAFIM, TASK_STATUS
            FROM TAREFAS
            WHERE USU_ID = (
                SELECT USU_ID FROM usuario WHERE USU_LOGIN = ?
            )
            AND TASK_DATAFIM >= CURDATE()
            AND TASK_STATUS = 'PENDENTE'
            ORDER BY TASK_DATAFIM ASC
            LIMIT 10
        ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $login);
        $stmt->execute();
        $resultado = $stmt->get_result();
        while ($row = $resultado->fetch_assoc()) {
            $tarefas[] = $row;
        }
        $stmt->close();
        $conn->close();
        return $tarefas;
    }

    public function getTarefasAtrasadasTabela($login) {
    $conn = $this->conectar();

    // Primeiro, recupera o USU_ID a partir do login
    $stmt = $conn->prepare("SELECT USU_ID FROM USUARIO WHERE USU_LOGIN = ?");
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $stmt->bind_result($usu_id);
    $stmt->fetch();
    $stmt->close();

    // Agora, chama a procedure que retorna as tarefas atrasadas
    $tarefas = [];

    $call = $conn->prepare("CALL ObterTarefasAtrasadas(?)");
    $call->bind_param("i", $usu_id);
    $call->execute();
    $resultado = $call->get_result();

    while ($row = $resultado->fetch_assoc()) {
        $tarefas[] = $row;
    }

    $call->close();
    $conn->close();

    return $tarefas;
    }

    public function getTodasTarefasTabela($login) {
    $conn = $this->conectar();

    // Busca o ID do usuÃ¡rio a partir do login
    $stmt = $conn->prepare("SELECT USU_ID FROM USUARIO WHERE USU_LOGIN = ?");
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $stmt->bind_result($usu_id);
    $stmt->fetch();
    $stmt->close();

    // Busca todas as tarefas do usuÃ¡rio
    $tarefas = [];

    $sql = "
        SELECT 
            TASK_ID,
            TASK_TITULO,
            TASK_TIPOTAREFA,
            TASK_PRIORIDADE,
            TASK_DATAINICIO,
            TASK_DATAFIM,
            TASK_STATUS
        FROM TAREFAS
        WHERE USU_ID = ?
        ORDER BY TASK_DATAINICIO DESC
        LIMIT 20
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usu_id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    while ($row = $resultado->fetch_assoc()) {
        $tarefas[] = $row;
    }

    $stmt->close();
    $conn->close();

    return $tarefas;
    }

    public function getUltimasTarefasRealizadasTabela($login) {
    $conn = $this->conectar();

    // Busca o USU_ID pelo login
    $stmt = $conn->prepare("SELECT USU_ID FROM USUARIO WHERE USU_LOGIN = ?");
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $stmt->bind_result($usu_id);
    $stmt->fetch();
    $stmt->close();

    $tarefas = [];

    // Busca as Ãºltimas tarefas com status CONCLUÃDA, ordena pela data de realizaÃ§Ã£o desc (mais recentes primeiro), limite 10
    $sql = "
        SELECT TASK_ID, TASK_TITULO, TASK_TIPOTAREFA, TASK_PRIORIDADE, TASK_DATAINICIO, TASK_DATAFIM, TASK_DATAREALIZACAO, TASK_STATUS
        FROM TAREFAS
        WHERE USU_ID = ? AND TASK_STATUS = 'CONCLUÃDA'
        ORDER BY TASK_DATAREALIZACAO DESC
        LIMIT 10
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usu_id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    while ($row = $resultado->fetch_assoc()) {
        $tarefas[] = $row;
    }

    $stmt->close();
    $conn->close();

    return $tarefas;
}



}

```n
## Arquivo: models\tarefaModel.php
```php
<?php
class tarefaModel {
    private $pdo;

    public function __construct() {
        $this->conectarBanco();
    }

    // Conecta ao banco MySQL usando PDO com configuraÃ§Ãµes corretas e tratamento de exceÃ§Ã£o
    private function conectarBanco() {
        try {
            $this->pdo = new PDO(
                'mysql:host=127.0.0.1;port=3308;dbname=projeto_x',
                'root',
                '12345',
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,        // LanÃ§a exceÃ§Ãµes em erros SQL
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC   // Retorna arrays associativos nas consultas
                ]
            );
        } catch (PDOException $e) {
            die("Erro de conexÃ£o: " . $e->getMessage());             // Finaliza a execuÃ§Ã£o se nÃ£o conectar
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
                ':prioridade'  => $dados['prioridade'] ?? 'mÃ©dia', // padrÃ£o em minÃºsculo para casar com a view
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

            // Executa a query substituindo :usu_id pelo valor do usuÃ¡rio
            $stmt->execute([':usu_id' => $usu_id]);

            // Retorna todas as linhas resultantes como array associativo
            return $stmt->fetchAll();

        } catch (PDOException $e) {
            // Em caso de erro, retorna array vazio para evitar quebra da aplicaÃ§Ã£o
            return [];
        }
    }

    /**
     * Busca uma tarefa pelo ID e pelo ID do usuÃ¡rio.
     * Garante que o usuÃ¡rio sÃ³ acesse suas prÃ³prias tarefas.
     *
     * @param int $taskId ID da tarefa
     * @param int $usuarioId ID do usuÃ¡rio logado
     * @return array|null Retorna os dados da tarefa ou null se nÃ£o encontrar
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

        // Executa a atualizaÃ§Ã£o com os dados fornecidos
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
            return ['sucesso' => false, 'erro' => 'Nenhuma alteraÃ§Ã£o feita ou tarefa nÃ£o encontrada.'];
        }

    } catch (PDOException $e) {
        return ['sucesso' => false, 'erro' => 'Erro ao atualizar tarefa: ' . $e->getMessage()];
    }
}

public function apagarTarefa($taskId, $usu_id): array {
    try {
        $sql = "DELETE FROM TAREFAS WHERE TASK_ID = :task_id AND USU_ID = :usu_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':task_id', $taskId, PDO::PARAM_INT);
        $stmt->bindParam(':usu_id', $usu_id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return ['sucesso' => true];
        } else {
            return ['sucesso' => false, 'erro' => 'Tarefa nÃ£o encontrada ou nÃ£o pertence ao usuÃ¡rio.'];
        }
    } catch (PDOException $e) {
        return ['sucesso' => false, 'erro' => 'Erro ao apagar tarefa: ' . $e->getMessage()];
    }
}

}

```n
## Arquivo: models\tarefaModel_legado.php
```php
<?php
class tarefaModel {
    private $pdo;

    public function __construct() {
        $this->conectarBanco();
    }

    // Conecta ao banco MySQL usando PDO com configuraÃ§Ãµes corretas e tratamento de exceÃ§Ã£o
    private function conectarBanco() {
        try {
            $this->pdo = new PDO(
                'mysql:host=127.0.0.1;port=3308;dbname=projeto_x',
                'root',
                '12345',
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,        // LanÃ§a exceÃ§Ãµes em erros SQL
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC   // Retorna arrays associativos nas consultas
                ]
            );
        } catch (PDOException $e) {
            die("Erro de conexÃ£o: " . $e->getMessage());             // Finaliza a execuÃ§Ã£o se nÃ£o conectar
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
                ':prioridade'  => $dados['prioridade'] ?? 'mÃ©dia', // padrÃ£o em minÃºsculo para casar com a view
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

            // Executa a query substituindo :usu_id pelo valor do usuÃ¡rio
            $stmt->execute([':usu_id' => $usu_id]);

            // Retorna todas as linhas resultantes como array associativo
            return $stmt->fetchAll();

        } catch (PDOException $e) {
            // Em caso de erro, retorna array vazio para evitar quebra da aplicaÃ§Ã£o
            return [];
        }
    }

    /**
     * Busca uma tarefa pelo ID e pelo ID do usuÃ¡rio.
     * Garante que o usuÃ¡rio sÃ³ acesse suas prÃ³prias tarefas.
     *
     * @param int $taskId ID da tarefa
     * @param int $usuarioId ID do usuÃ¡rio logado
     * @return array|null Retorna os dados da tarefa ou null se nÃ£o encontrar
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

        // Executa a atualizaÃ§Ã£o com os dados fornecidos
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
            return ['sucesso' => false, 'erro' => 'Nenhuma alteraÃ§Ã£o feita ou tarefa nÃ£o encontrada.'];
        }

    } catch (PDOException $e) {
        return ['sucesso' => false, 'erro' => 'Erro ao atualizar tarefa: ' . $e->getMessage()];
    }
}



}

```n
## Arquivo: models\usuarioModel.php
```php
<?php

class usuarioModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli("127.0.0.1", "root", "12345", "projeto_x", 3308);
        if ($this->conn->connect_error) {
            die("Erro de conexÃ£o: " . $this->conn->connect_error);
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
    // Prepara a query para atualizar o usuÃ¡rio pelo ID
    $sql = "UPDATE usuario SET USU_NOME = ?, USU_APELIDO = ?, USU_IDADE = ? WHERE USU_ID = ?";
    
    $stmt = $this->conn->prepare($sql);
    if (!$stmt) {
        die("Erro na preparaÃ§Ã£o da query: " . $this->conn->error);
    }
    
    // Vincula os parÃ¢metros (string, string, int, int)
    $stmt->bind_param("ssii", $nome, $apelido, $idade, $id);
    
    // Executa a query
    $resultado = $stmt->execute();
    
    // Fecha o statement para liberar recursos
    $stmt->close();
    
    // Retorna true em caso de sucesso, false em caso de falha
    return $resultado;
}



}


```n
