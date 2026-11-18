<?php
require_once __DIR__ . '/../models/tarefaModel.php';  // Importa o model da tarefa para acesso aos dados
require_once __DIR__ . '/authController.php';        // Importa controller de autenticação (se necessário)

class tarefaController {

    // Método para exibir o formulário de criação de nova tarefa
    public function novaTarefa() {
        date_default_timezone_set('America/Sao_Paulo');
        $dataPadrao = new DateTime();
        $dataPadrao->modify('+5 minutes');

        $erro = $_SESSION['erro'] ?? null;
        $sucesso = $_SESSION['sucesso'] ?? null;

        unset($_SESSION['erro'], $_SESSION['sucesso']);

        return [
            'dataVencimento'        => $dataPadrao->format('Y-m-d\TH:i'),
            'dataMinima'            => $dataPadrao->format('Y-m-d\TH:i'),
            'prioridadePadrao'      => 'média',
            'descricaoConteudo'     => $_POST['descricao'] ?? '',
            'descricaoPlaceholder'  => 'Digite aqui (máx. 280 caracteres)',
            'anoAtual'              => date('Y'),
            'erro'                  => $erro,
            'sucesso'               => $sucesso
        ];
    }

    private function validarData($data) {
        date_default_timezone_set('America/Sao_Paulo');
        $dataSelecionada = strtotime($data);
        $dataMinima = strtotime('+5 minutes');
        return ($dataSelecionada >= $dataMinima);
    }

    public function salvar() {
        $titulo      = trim($_POST['titulo'] ?? '');
        $descricao   = trim($_POST['descricao'] ?? '');
        $tipotarefa  = trim($_POST['tipotarefa'] ?? '');
        $prioridade  = $_POST['prioridade'] ?? '';
        $datafim     = $_POST['datafim'] ?? '';

        if ($titulo === '') {
            $_SESSION['erro'] = 'Título é obrigatório';
            header("Location: index.php?controller=tarefa&method=novaTarefa");
            exit;
        }

        if ($tipotarefa === '') {
            $_SESSION['erro'] = 'Tipo da tarefa é obrigatório';
            header("Location: index.php?controller=tarefa&method=novaTarefa");
            exit;
        }

        if (!$this->validarData($datafim)) {
            $_SESSION['erro'] = 'Data de vencimento inválida. Deve ser no mínimo 5 minutos à frente.';
            header("Location: index.php?controller=tarefa&method=novaTarefa");
            exit;
        }

        $tarefaModel = new tarefaModel();

        $resultado = $tarefaModel->criarTarefa([
            'titulo'     => $titulo,
            'descricao'  => $descricao,
            'tipotarefa' => $tipotarefa,
            'prioridade' => $prioridade,
            'datafim'    => $datafim,
            'usu_id'     => $_SESSION['usuario_id'] ?? null
        ]);

        if ($resultado['sucesso']) {
            $_SESSION['sucesso'] = 'Tarefa salva com sucesso!';
            header("Location: index.php?controller=home&method=index");
            exit;
        } else {
            $_SESSION['erro'] = $resultado['erro'] ?? 'Erro ao salvar a tarefa.';
            header("Location: index.php?controller=tarefa&method=novaTarefa");
            exit;
        }
    }

    public function gestaoTarefa() {
        $usu_id = $_SESSION['usuario_id'] ?? null;

        if (!$usu_id) {
            header("Location: index.php?controller=auth&method=login&expirado=1");
            exit;
        }

        $tarefaModel = new tarefaModel();
        $tarefas = $tarefaModel->listarTarefasPorUsuario($usu_id);

        $sucesso = $_SESSION['sucesso'] ?? null;
    unset($_SESSION['sucesso']);

        return [
            'tarefas' => $tarefas
        ];
    }

    // Método corrigido para exibir os detalhes da tarefa, com as chaves minúsculas
    public function detalhesTarefa() {
        $taskId = $_GET['task_id'] ?? null;

        if (!$taskId) {
            $_SESSION['erro'] = 'Tarefa não identificada.';
            header("Location: index.php?controller=tarefa&method=gestaoTarefa");
            exit;
        }

        $tarefaModel = new tarefaModel();

        $tarefa = $tarefaModel->buscarTarefaPorIdEUsuario($taskId, $_SESSION['usuario_id']);

        if (!$tarefa) {
            $_SESSION['erro'] = 'Tarefa não encontrada ou acesso não autorizado.';
            header("Location: index.php?controller=tarefa&method=gestaoTarefa");
            exit;
        }

        // Converte todas as chaves para minúsculas
        $tarefa = array_change_key_case($tarefa, CASE_LOWER);

        return [
            'id'             => $tarefa['task_id'] ?? '',
            'titulo'         => $tarefa['task_titulo'] ?? '',
            'descricao'      => $tarefa['task_descricao'] ?? '',
            'tipo'           => $tarefa['task_tipotarefa'] ?? '',
            'prioridade'     => $tarefa['task_prioridade'] ?? '',
            'dataVencimento' => $tarefa['task_datafim'] ?? '',
            'dataMinima'     => date('Y-m-d\TH:i')
        ];
    }

    public function editarTarefa() {
    // Pega o ID da tarefa via parâmetro GET 'task_id'
    $taskId = $_GET['task_id'] ?? null;

    // Se não receber o ID, redireciona para a gestão de tarefas com erro
    if (!$taskId) {
        $_SESSION['erro'] = 'Tarefa não identificada.';
        header("Location: index.php?controller=tarefa&method=gestaoTarefa");
        exit;
    }

    // Instancia o model para acessar os dados
    $tarefaModel = new tarefaModel();

    // Busca a tarefa pelo ID e pelo usuário logado para garantir que é dele
    $tarefa = $tarefaModel->buscarTarefaPorIdEUsuario($taskId, $_SESSION['usuario_id']);

    // Se a tarefa não existir ou não pertencer ao usuário, redireciona com erro
    if (!$tarefa) {
        $_SESSION['erro'] = 'Tarefa não encontrada ou acesso não autorizado.';
        header("Location: index.php?controller=tarefa&method=gestaoTarefa");
        exit;
    }

    // Converte todas as chaves do array para minúsculas para facilitar o uso na view
    $tarefa = array_change_key_case($tarefa, CASE_LOWER);

    // Retorna um array com os dados da tarefa para serem usados na view de edição
    return [
        'id'             => $tarefa['task_id'] ?? '',           // ID da tarefa
        'titulo'         => $tarefa['task_titulo'] ?? '',       // Título da tarefa
        'descricao'      => $tarefa['task_descricao'] ?? '',    // Descrição da tarefa
        'tipo'           => $tarefa['task_tipotarefa'] ?? '',   // Tipo da tarefa
        'prioridade'     => $tarefa['task_prioridade'] ?? '',   // Prioridade
        'dataVencimento' => $tarefa['task_datafim'] ?? '',      // Data de vencimento
        'dataMinima'     => date('Y-m-d\TH:i'),                 // Data mínima permitida para alteração (agora)
        'erro'           => $_SESSION['erro'] ?? null,          // Mensagem de erro, se houver
        'sucesso'        => $_SESSION['sucesso'] ?? null        // Mensagem de sucesso, se houver
    ];
}

public function atualizar() {
    // Garante que o usuário esteja logado
    $usu_id = $_SESSION['usuario_id'] ?? null;
    if (!$usu_id) {
        header("Location: index.php?controller=auth&method=login&expirado=1");
        exit;
    }

    // Coleta dados do formulário
    $taskId     = $_POST['task_id'] ?? null;
    $titulo     = trim($_POST['titulo'] ?? '');
    $tipotarefa = trim($_POST['tipotarefa'] ?? '');
    $prioridade = $_POST['prioridade'] ?? '';
    $datafim    = $_POST['datafim'] ?? '';
    $descricao  = trim($_POST['descricao'] ?? '');

    // Validação básica
    if (!$taskId || $titulo === '' || $tipotarefa === '' || !$this->validarData($datafim)) {
        $_SESSION['erro'] = 'Preencha todos os campos corretamente.';
        header("Location: index.php?controller=tarefa&method=editarTarefa&task_id=$taskId");
        exit;
    }

    // Define o status como 'pendente' durante a edição (se não for editado diretamente pelo usuário)
    $status = 'pendente';

    // Model
    $tarefaModel = new tarefaModel();

    // Atualiza no banco
    $resultado = $tarefaModel->atualizarTarefa([
        'task_id'     => $taskId,
        'usu_id'      => $usu_id,
        'titulo'      => $titulo,
        'tipotarefa'  => $tipotarefa,
        'prioridade'  => $prioridade,
        'datafim'     => $datafim,
        'descricao'   => $descricao,
        'status'      => $status
    ]);

    // Verifica o resultado
    if ($resultado['sucesso']) {
        $_SESSION['sucesso'] = 'Tarefa atualizada com sucesso!';
        header("Location: index.php?controller=tarefa&method=gestaoTarefa");
        exit;
    } else {
        $_SESSION['erro'] = $resultado['erro'] ?? 'Erro ao atualizar a tarefa.';
        header("Location: index.php?controller=tarefa&method=editarTarefa&task_id=$taskId");
        exit;
    }
}

public function apagarTarefa() {
    $taskId = $_POST['task_id'] ?? $_GET['task_id'] ?? null;

    if (!$taskId) {
        $_SESSION['erro'] = 'Tarefa não identificada.';
        header("Location: index.php?controller=tarefa&method=gestaoTarefa");
        exit;
    }

    $usu_id = $_SESSION['usuario_id'] ?? null;
    if (!$usu_id) {
        header("Location: index.php?controller=auth&method=login&expirado=1");
        exit;
    }

    $tarefaModel = new tarefaModel();
    $resultado = $tarefaModel->apagarTarefa($taskId, $usu_id);

    if ($resultado['sucesso']) {
        $_SESSION['sucesso'] = 'Tarefa apagada com sucesso!';
    } else {
        $_SESSION['erro'] = $resultado['erro'] ?? 'Erro ao apagar a tarefa.';
    }

    header("Location: index.php?controller=tarefa&method=gestaoTarefa");
    exit;
}


}
