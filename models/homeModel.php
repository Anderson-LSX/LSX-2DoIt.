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


    public function getQtdConcluidasUlt30Dias($login) {}
    public function getTotalTarefas($login) {}
    public function getTarefasAltaPrioridade($login) {}
    public function getTarefasPendentes($login) {}
    public function getTarefasAtrasadas($login) {}

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
