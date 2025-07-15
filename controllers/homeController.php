<?php
class homeController {
    public function index() {

        $dadosParaView = array(
            'anoAtual' => date('Y')    
    );

        $login = $_SESSION['usuario_logado']; // Login do usuário logado

        // === Define o nome a ser exibido no card de boas-vindas ===
$conn = new mysqli("127.0.0.1", "root", "12345", "projeto_x", 3308);
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT USU_NOME, USU_APELIDO FROM USUARIO WHERE USU_LOGIN = ?");
$stmt->bind_param("s", $login);
$stmt->execute();
$stmt->bind_result($nome, $apelido);
$stmt->fetch();
$stmt->close();
$conn->close();

$nomeParaExibir = !empty($apelido) ? $apelido : $nome;



        // ===============================
        // Card 1: Tarefas a vencer nos próximos 7 dias
        // ===============================

        $tarefasProximas = 0; // Valor padrão

        // Conexão com o banco
        $conn = new mysqli("127.0.0.1", "root", "12345", "projeto_x", 3308);
        if ($conn->connect_error) {
            die("Erro na conexão: " . $conn->connect_error);
        }

        // Consulta para obter a quantidade de tarefas a vencer em 7 dias
        $stmt = $conn->prepare("
            SELECT V.tarefas_a_vencer_7dias
            FROM vw_tarefas_a_vencer_prox_7dias V
            JOIN usuario U ON U.USU_ID = V.USU_ID
            WHERE U.USU_LOGIN = ?
        ");
        $stmt->bind_param("s", $login);
        $stmt->execute();
        $stmt->bind_result($tarefasProximas);
        $stmt->fetch();
        $stmt->close();

        // ===============================
        // Card 2: Tarefas concluídas nos últimos 30 dias
        // ===============================

        $qtdConcluidasUlt30Dias = 0; // Valor padrão

        // Consulta para obter tarefas concluídas nos últimos 30 dias
        $stmt2 = $conn->prepare("
            SELECT V.tarefas_concluidas_ult_30dias
            FROM vw_tarefas_concluidas_ult_30dias V
            JOIN usuario U ON U.USU_ID = V.USU_ID
            WHERE U.USU_LOGIN = ?
        ");
        $stmt2->bind_param("s", $login);
        $stmt2->execute();
        $stmt2->bind_result($qtdConcluidasUlt30Dias);
        $stmt2->fetch();
        $stmt2->close();

        $conn->close(); // Encerra conexão

        // Garante que a variável tenha valor numérico
        if (!isset($qtdConcluidasUlt30Dias)) {
            $qtdConcluidasUlt30Dias = 0;
        }

        // ========== Card estatístico 3: Total de tarefas cadastradas ==========
$totalTarefas = 0;

// Nova conexão com o banco de dados
$conn = new mysqli("127.0.0.1", "root", "12345", "projeto_x", 3308);
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Prepara consulta SQL na view com base no login em sessão
$stmt = $conn->prepare("
    SELECT V.total_tarefas
    FROM vw_total_tarefas_por_usuario V
    JOIN usuario U ON U.USU_ID = V.USU_ID
    WHERE U.USU_LOGIN = ?
");

// Usa o login da sessão como parâmetro
$stmt->bind_param("s", $login);
$stmt->execute();
$stmt->bind_result($totalTarefas);
$stmt->fetch();
$stmt->close();
$conn->close();

// Garante valor zero se não houver resultado
if (!isset($totalTarefas)) {
    $totalTarefas = 0;
}


// ================== CARD 4: Tarefas de Alta Prioridade ==================

// Pega o login do usuário logado
$login = $_SESSION['usuario_logado'];

// Inicializa a variável de tarefas de alta prioridade
$tarefasAltaPrioridade = 0;

// Conecta ao banco
$conn = new mysqli("127.0.0.1", "root", "12345", "projeto_x", 3308);
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Prepara a consulta para buscar as tarefas de alta prioridade da view
$stmt = $conn->prepare("
    SELECT V.tarefas_alta_prioridade
    FROM vw_tarefas_alta_prioridade_por_usuario V
    JOIN usuario U ON U.USU_ID = V.USU_ID
    WHERE U.USU_LOGIN = ?
");
$stmt->bind_param("s", $login);
$stmt->execute();
$stmt->bind_result($tarefasAltaPrioridade);
$stmt->fetch();
$stmt->close();
$conn->close();

// Garante valor numérico se não houver resultados
if (!isset($tarefasAltaPrioridade)) {
    $tarefasAltaPrioridade = 0;
}


// ==============================
// Card 5: Tarefas Pendentes
// ==============================

// Reutiliza o login da sessão
$login = $_SESSION['usuario_logado'];

// Inicializa a variável
$tarefasPendentes = 0;

// Nova conexão com o banco
$conn = new mysqli("127.0.0.1", "root", "12345", "projeto_x", 3308);

// Verifica se houve erro na conexão
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Prepara a consulta para a view de tarefas pendentes
$stmt = $conn->prepare("
    SELECT V.tarefas_pendentes
    FROM vw_tarefas_pendentes_por_usuario V
    JOIN usuario U ON U.USU_ID = V.USU_ID
    WHERE U.USU_LOGIN = ?
");

// Passa o login como parâmetro
$stmt->bind_param("s", $login);
$stmt->execute();
$stmt->bind_result($tarefasPendentes);
$stmt->fetch();
$stmt->close();
$conn->close();

// Garante que um valor zero será usado caso a consulta não traga resultados
if (!isset($tarefasPendentes)) {
    $tarefasPendentes = 0;
}

// ==============================
// Card 6: Tarefas Atrasadas
// ==============================

// Recupera o login do usuário da sessão
$login = $_SESSION['usuario_logado'];

// Inicializa variável com valor padrão
$tarefasAtrasadas = 0;

// Cria nova conexão com o banco
$conn = new mysqli("127.0.0.1", "root", "12345", "projeto_x", 3308);

// Verifica se a conexão falhou
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Prepara a query para consultar a view de tarefas atrasadas
$stmt = $conn->prepare("
    SELECT V.tarefas_atrasadas
    FROM vw_tarefas_atrasadas_por_usuario V
    JOIN usuario U ON U.USU_ID = V.USU_ID
    WHERE U.USU_LOGIN = ?
");

// Passa o login como parâmetro
$stmt->bind_param("s", $login);

// Executa a consulta
$stmt->execute();

// Associa o resultado à variável
$stmt->bind_result($tarefasAtrasadas);
$stmt->fetch();

// Finaliza a consulta e fecha a conexão
$stmt->close();
$conn->close();

// Garante que a variável tenha um valor numérico
if (!isset($tarefasAtrasadas)) {
    $tarefasAtrasadas = 0;
}



        // ===============================
        // Exibe a view da home com os dados carregados
        // ===============================
        include 'views/home/home.php';
    }
}
