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
            die("Erro na conexão: " . $conn->connect_error);
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

    // Métodos que retornam números - views
    public function getQtdProximasTarefas($login) {
    // Conecta ao banco via método conectar()
    $conn = $this->conectar();

    $quantidade = 0;

    // Consulta a view correta de tarefas pendentes para o usuário
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

    // Consulta o ID do usuário com base no login
    $sqlUsuario = "SELECT USU_ID FROM usuario WHERE USU_LOGIN = ?";
    $stmtUsuario = $conn->prepare($sqlUsuario);
    $stmtUsuario->bind_param("s", $login);
    $stmtUsuario->execute();
    $resultadoUsuario = $stmtUsuario->get_result();

    if ($rowUsuario = $resultadoUsuario->fetch_assoc()) {
        $usuId = $rowUsuario['USU_ID'];

        // Consulta a view que já traz o total de tarefas concluídas nos últimos 30 dias
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

    // Buscar ID do usuário pelo login
    $sqlId = "SELECT USU_ID FROM USUARIO WHERE USU_LOGIN = ?";
    $stmtId = $conn->prepare($sqlId);
    $stmtId->bind_param("s", $login);
    $stmtId->execute();
    $resultId = $stmtId->get_result();

    if ($row = $resultId->fetch_assoc()) {
        $usu_id = $row['USU_ID'];

        // Agora consulta a view com o ID do usuário
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

    // Primeiro, pega o USU_ID do usuário pelo login
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

    // Método que retorna array detalhado para tabela
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

    // Busca o ID do usuário a partir do login
    $stmt = $conn->prepare("SELECT USU_ID FROM USUARIO WHERE USU_LOGIN = ?");
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $stmt->bind_result($usu_id);
    $stmt->fetch();
    $stmt->close();

    // Busca todas as tarefas do usuário
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

    // Busca as últimas tarefas com status CONCLUÍDA, ordena pela data de realização desc (mais recentes primeiro), limite 10
    $sql = "
        SELECT TASK_ID, TASK_TITULO, TASK_TIPOTAREFA, TASK_PRIORIDADE, TASK_DATAINICIO, TASK_DATAFIM, TASK_DATAREALIZACAO, TASK_STATUS
        FROM TAREFAS
        WHERE USU_ID = ? AND TASK_STATUS = 'CONCLUÍDA'
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
