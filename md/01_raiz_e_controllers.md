## Arquivo: controllers\authController.php
```php
<?php
// Importa a model que cuida dos dados do usuÃ¡rio
require_once __DIR__ . '/../models/authModel.php';

class authController {

    private $authModel; // atributo para a model
    private const SESSION_TIMEOUT = 3600; // tempo de inatividade em segundos

    public function __construct() {
        $this->authModel = new authModel();
    }

    // =================== LOGIN ===================
    // MÃ©todo estÃ¡tico para checar se o usuÃ¡rio estÃ¡ logado e sessÃ£o vÃ¡lida
    
    public static function checkLogin() {
        if (!isset($_SESSION['usuario_logado'])) {
            return false;
        }

        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > self::SESSION_TIMEOUT)) {
            session_unset();
            session_destroy();
            return false;
        }

        $_SESSION['LAST_ACTIVITY'] = time();
        return true;
    }

    // Exibe a pÃ¡gina de login
    public function login() {
        // Inicializa variÃ¡veis que serÃ£o enviadas para a view
        $sessao_expirada = false;
        $erro_login = '';

        if (isset($_GET['expirado']) && $_GET['expirado'] == 1) {
            $sessao_expirada = true;
        }

        // Busca mensagem de erro de login na sessÃ£o, se existir
        if (isset($_SESSION['erro_login'])) {
            $erro_login = $_SESSION['erro_login'];
            unset($_SESSION['erro_login']); // Limpa o erro para prÃ³xima requisiÃ§Ã£o
        }

        // Retorna os dados que serÃ£o usados na view
        return [
            'sessao_expirada' => $sessao_expirada,
            'erro_login' => $erro_login
        ];
    }

    // Processa o formulÃ¡rio de login enviado pelo usuÃ¡rio
    public function loginSubmit() {
        $login = trim($_POST['login'] ?? ''); // Remove espaÃ§os extras
        $senha = $_POST['senha'] ?? ''; // Captura senha

        // ValidaÃ§Ã£o bÃ¡sica: campos obrigatÃ³rios
        if (empty($login) || empty($senha)) {
            $_SESSION['erro_login'] = "Login e senha sÃ£o obrigatÃ³rios.";
            header("Location: index.php?controller=auth&method=login");
            exit;
        }

         // Busca usuÃ¡rio no banco via model
        $usuario = $this->authModel->findByLogin($login);

        // Valida se usuÃ¡rio existe e senha estÃ¡ correta
        if ($usuario && password_verify($senha, $usuario['usu_senha'])) {
            // Cria sessÃ£o para usuÃ¡rio logado
            $_SESSION['usuario_logado'] = $login;
            $_SESSION['usuario_nome'] = $usuario['usu_nome'];
            $_SESSION['usuario_id'] = $usuario['usu_id'];
            $_SESSION['LAST_ACTIVITY'] = time();

            // Flag para mostrar splash apenas apÃ³s login
            $_SESSION['show_splash'] = true;

            // Redireciona para pÃ¡gina inicial apÃ³s login
            header("Location: index.php?controller=home&method=index");
            exit;
        } else {
            // UsuÃ¡rio nÃ£o encontrado ou senha incorreta
            $_SESSION['erro_login'] = $usuario ? "Senha incorreta." : "UsuÃ¡rio nÃ£o encontrado.";
            header("Location: index.php?controller=auth&method=login");
            exit;
        }
    }

    // =================== RECUPERAÃ‡ÃƒO DE SENHA ===================

    public function esqueciSenha() {
        $erro = $_SESSION['erro_esqueci_senha'] ?? null;
        $dados = $_SESSION['dados_esqueci_senha'] ?? [];

        unset($_SESSION['erro_esqueci_senha'], $_SESSION['dados_esqueci_senha']);

        return [
            'erro' => $erro,
            'dados' => $dados
        ];
    }

    public function validaDadosParaReset() {
        $nome = trim($_POST['nome'] ?? '');
        $idade = trim($_POST['idade'] ?? '');
        $login = trim($_POST['login'] ?? '');

        $dados = ['nome' => $nome, 'idade' => $idade, 'login' => $login];

        if (!$nome || !$idade || !$login) {
            $_SESSION['erro_esqueci_senha'] = "Todos os campos sÃ£o obrigatÃ³rios.";
            $_SESSION['dados_esqueci_senha'] = $dados;
            header('Location: index.php?controller=auth&method=esqueciSenha');
            exit;
        }

        if (!filter_var($idade, FILTER_VALIDATE_INT)) {
            $_SESSION['erro_esqueci_senha'] = "Idade invÃ¡lida.";
            $_SESSION['dados_esqueci_senha'] = $dados;
            header('Location: index.php?controller=auth&method=esqueciSenha');
            exit;
        }

        $usuario = $this->authModel->findByNomeIdadeLogin($nome, (int)$idade, $login);

        if ($usuario) {
            $_SESSION['reset_login'] = $login;
            unset($_SESSION['erro_esqueci_senha'], $_SESSION['dados_esqueci_senha']);
            header('Location: index.php?controller=auth&method=novaSenha');
            exit;
        } else {
            $_SESSION['erro_esqueci_senha'] = "Dados invÃ¡lidos para redefiniÃ§Ã£o de senha.";
            $_SESSION['dados_esqueci_senha'] = $dados;
            header('Location: index.php?controller=auth&method=esqueciSenha');
            exit;
        }
    }

    public function novaSenha() {
        if (!isset($_SESSION['reset_login'])) {
            return ['erro' => 'SessÃ£o expirada. Recomece o processo.'];
        }

        $erro = $_SESSION['erro_nova_senha'] ?? null;
        unset($_SESSION['erro_nova_senha']);

        return ['erro' => $erro];
    }

    public function processaNovaSenha() {
        if (!isset($_SESSION['reset_login'])) {
            header('Location: index.php?controller=auth&method=esqueciSenha');
            exit;
        }

        $novaSenha = trim($_POST['nova_senha'] ?? '');
        $login = $_SESSION['reset_login'];

        if ($novaSenha === '') {
            $_SESSION['erro_nova_senha'] = 'Senha invÃ¡lida.';
            header('Location: index.php?controller=auth&method=novaSenha');
            exit;
        }

        $senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);
        $sucesso = $this->authModel->updateSenha($login, $senhaHash);

        if ($sucesso) {
            unset($_SESSION['reset_login']);
            header('Location: index.php?controller=auth&method=senhaRedefinida');
            exit;
        }

        $_SESSION['erro_nova_senha'] = 'Falha ao atualizar senha. Tente novamente.';
        header('Location: index.php?controller=auth&method=novaSenha');
        exit;
    }

    public function senhaRedefinida() {
        return [];
    }

    // =================== CADASTRO ===================

   public function cadastro() {
    // Recupera dados e erros da sessÃ£o se existirem
    $erros = $_SESSION['erros_cadastro'] ?? [];
    $dados = $_SESSION['dados_cadastro'] ?? [];
    $sucesso = $_SESSION['sucesso_cadastro'] ?? null;

    unset($_SESSION['erros_cadastro'], $_SESSION['dados_cadastro'], $_SESSION['sucesso_cadastro']);

    return [
        'errosPrincipal' => $erros['principal'] ?? null,
        'erroCheckbox' => $erros['aceita_termos'] ?? null,
        'nomeVal' => htmlspecialchars($dados['nome'] ?? ''),
        'apelidoVal' => htmlspecialchars($dados['apelido'] ?? ''),
        'idadeVal' => htmlspecialchars($dados['idade'] ?? ''),
        'loginVal' => htmlspecialchars($dados['login'] ?? ''),
        'aceitaTermosChecked' => !empty($dados['aceitaTermos']) ? 'checked' : '',
        'sucesso' => $sucesso
    ];
}


    public function cadastroSubmit() {
        $nome = trim($_POST['nome'] ?? '');
        $apelido = trim($_POST['apelido'] ?? '');
        $idade = trim($_POST['idade'] ?? '');
        $login = trim($_POST['login'] ?? '');
        $senha = $_POST['senha'] ?? '';
        $repeteSenha = $_POST['repetir_senha'] ?? '';
        $aceitaTermos = $_POST['aceita_termos'] ?? '';

        $erroPrincipal = null;
        $erroCheckbox = null;

        // Verifica se login jÃ¡ existe - prioridade alta
        if ($this->authModel->existsLogin($login)) {
            $erroPrincipal = "Login jÃ¡ estÃ¡ em uso. Escolha outro.";
        } else {
            if ($nome === '' || $idade === '' || $login === '') {
                $erroPrincipal = 'Todos os campos, exceto "apelido" sÃ£o de preenchimento obrigatÃ³rio.';
            } elseif ($senha === '' || $repeteSenha === '') {
                $erroPrincipal = 'Todos os campos, exceto "apelido" sÃ£o de preenchimento obrigatÃ³rio.';
            } elseif (!filter_var($idade, FILTER_VALIDATE_INT)) {
                $erroPrincipal = 'Idade invÃ¡lida.';
            } elseif ($senha !== $repeteSenha) {
                $erroPrincipal = 'As senhas nÃ£o conferem.';
            }
        }

        if (!$aceitaTermos) {
            $erroCheckbox = "VocÃª deve aceitar os termos para continuar.";
        }

            if ($erroPrincipal || $erroCheckbox) {
        $_SESSION['erros_cadastro'] = [
            'principal' => $erroPrincipal,
            'aceita_termos' => $erroCheckbox
        ];
        $_SESSION['dados_cadastro'] = [
            'nome' => $nome,
            'apelido' => $apelido,
            'idade' => $idade,
            'login' => $login,
            'aceitaTermos' => $aceitaTermos
        ];
        header("Location: index.php?controller=auth&method=cadastro");
        exit;
        }

        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        $dadosUsuario = [
            'nome' => $nome,
            'apelido' => $apelido,
            'idade' => (int)$idade,
            'login' => $login,
            'senhaHash' => $senhaHash
        ];

        $inseriu = $this->authModel->insertUser($dadosUsuario);

        if ($inseriu) {
            return ['sucesso' => 'Cadastro realizado com sucesso! FaÃ§a login a seguir.'];
        } else {
            return ['erro' => 'Falha ao cadastrar usuÃ¡rio.'];
        }
    }

    // =================== LOGOUT ===================

    public function logout() {
        $_SESSION = [];
        session_destroy();
        header("Location: index.php?controller=auth&method=login");
        exit;
    }
}

```n
## Arquivo: controllers\definicoesController.php
```php
<?php

class definicoesController
{
    public function definicoes()
    {
        // Aqui vocÃª pode futuramente carregar dados, se necessÃ¡rio.
        $dadosParaView = []; // Inicialmente vazio

        require_once __DIR__ . '/../views/definicoes/definicoes.php';
    }

    public function apagarConta()
{
    require_once __DIR__ . '/../views/definicoes/apagarConta.php';
}

}

```n
## Arquivo: controllers\estatisticasController.php
```php
<?php
class estatisticasController {

    // MÃ©todo para exibir a pÃ¡gina de estatÃ­sticas
    public function estatisticas() {
        // Por enquanto, nÃ£o hÃ¡ dados, sÃ³ retorna array vazio para a view
        return [];
    }
}

```n
## Arquivo: controllers\homeController.php
```php
<?php
require_once 'models/homeModel.php';

class homeController {
    public function index() {
        
        $login = $_SESSION['usuario_logado'];

        $model = new homeModel();

        // Busca valores numÃ©ricos (contagens)
        $nomeParaExibir = $model->getNomeParaExibir($login);
        $proximasTarefasQtd = $model->getQtdProximasTarefas($login);
        $qtdConcluidasUlt30Dias = $model->getQtdConcluidasUlt30Dias($login);
        $totalTarefas = $model->getTotalTarefas($login);
        $tarefasAltaPrioridade = $model->getTarefasAltaPrioridade($login);
        $tarefasPendentes = $model->getTarefasPendentes($login);
        $tarefasAtrasadas = $model->getTarefasAtrasadas($login);

        // Busca lista detalhada para cards de tabela
        $proximasTarefasTabela = $model->getProximasTarefasTabela($login);
        $tarefasAtrasadasTabela = $model->getTarefasAtrasadasTabela($login);
        $todasTarefasTabela = $model->getTodasTarefasTabela($login);
        $ultimasTarefasRealizadasTabela = $model->getUltimasTarefasRealizadasTabela($login);

        // Monta array para passar Ã  view
        $dadosParaView = [
            'anoAtual' => date('Y'),
            'nomeParaExibir' => $nomeParaExibir,
            'proximasTarefasQtd' => $proximasTarefasQtd,
            'qtdConcluidasUlt30Dias' => $qtdConcluidasUlt30Dias,
            'totalTarefas' => $totalTarefas,
            'tarefasAltaPrioridade' => $tarefasAltaPrioridade,
            'tarefasPendentes' => $tarefasPendentes,
            'tarefasAtrasadas' => $tarefasAtrasadas,
            'proximasTarefasTabela' => $proximasTarefasTabela,
            'tarefasAtrasadasTabela' => $tarefasAtrasadasTabela,
            'todasTarefasTabela' => $todasTarefasTabela,
            'ultimasTarefasRealizadasTabela' => $ultimasTarefasRealizadasTabela 
        ];

        include 'views/home/home.php';
    }
}

```n
## Arquivo: controllers\tarefaController.php
```php
<?php
require_once __DIR__ . '/../models/tarefaModel.php';  // Importa o model da tarefa para acesso aos dados
require_once __DIR__ . '/authController.php';        // Importa controller de autenticaÃ§Ã£o (se necessÃ¡rio)

class tarefaController {

    // MÃ©todo para exibir o formulÃ¡rio de criaÃ§Ã£o de nova tarefa
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
            'prioridadePadrao'      => 'mÃ©dia',
            'descricaoConteudo'     => $_POST['descricao'] ?? '',
            'descricaoPlaceholder'  => 'Digite aqui (mÃ¡x. 280 caracteres)',
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
            $_SESSION['erro'] = 'TÃ­tulo Ã© obrigatÃ³rio';
            header("Location: index.php?controller=tarefa&method=novaTarefa");
            exit;
        }

        if ($tipotarefa === '') {
            $_SESSION['erro'] = 'Tipo da tarefa Ã© obrigatÃ³rio';
            header("Location: index.php?controller=tarefa&method=novaTarefa");
            exit;
        }

        if (!$this->validarData($datafim)) {
            $_SESSION['erro'] = 'Data de vencimento invÃ¡lida. Deve ser no mÃ­nimo 5 minutos Ã  frente.';
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

    // MÃ©todo corrigido para exibir os detalhes da tarefa, com as chaves minÃºsculas
    public function detalhesTarefa() {
        $taskId = $_GET['task_id'] ?? null;

        if (!$taskId) {
            $_SESSION['erro'] = 'Tarefa nÃ£o identificada.';
            header("Location: index.php?controller=tarefa&method=gestaoTarefa");
            exit;
        }

        $tarefaModel = new tarefaModel();

        $tarefa = $tarefaModel->buscarTarefaPorIdEUsuario($taskId, $_SESSION['usuario_id']);

        if (!$tarefa) {
            $_SESSION['erro'] = 'Tarefa nÃ£o encontrada ou acesso nÃ£o autorizado.';
            header("Location: index.php?controller=tarefa&method=gestaoTarefa");
            exit;
        }

        // Converte todas as chaves para minÃºsculas
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
    // Pega o ID da tarefa via parÃ¢metro GET 'task_id'
    $taskId = $_GET['task_id'] ?? null;

    // Se nÃ£o receber o ID, redireciona para a gestÃ£o de tarefas com erro
    if (!$taskId) {
        $_SESSION['erro'] = 'Tarefa nÃ£o identificada.';
        header("Location: index.php?controller=tarefa&method=gestaoTarefa");
        exit;
    }

    // Instancia o model para acessar os dados
    $tarefaModel = new tarefaModel();

    // Busca a tarefa pelo ID e pelo usuÃ¡rio logado para garantir que Ã© dele
    $tarefa = $tarefaModel->buscarTarefaPorIdEUsuario($taskId, $_SESSION['usuario_id']);

    // Se a tarefa nÃ£o existir ou nÃ£o pertencer ao usuÃ¡rio, redireciona com erro
    if (!$tarefa) {
        $_SESSION['erro'] = 'Tarefa nÃ£o encontrada ou acesso nÃ£o autorizado.';
        header("Location: index.php?controller=tarefa&method=gestaoTarefa");
        exit;
    }

    // Converte todas as chaves do array para minÃºsculas para facilitar o uso na view
    $tarefa = array_change_key_case($tarefa, CASE_LOWER);

    // Retorna um array com os dados da tarefa para serem usados na view de ediÃ§Ã£o
    return [
        'id'             => $tarefa['task_id'] ?? '',           // ID da tarefa
        'titulo'         => $tarefa['task_titulo'] ?? '',       // TÃ­tulo da tarefa
        'descricao'      => $tarefa['task_descricao'] ?? '',    // DescriÃ§Ã£o da tarefa
        'tipo'           => $tarefa['task_tipotarefa'] ?? '',   // Tipo da tarefa
        'prioridade'     => $tarefa['task_prioridade'] ?? '',   // Prioridade
        'dataVencimento' => $tarefa['task_datafim'] ?? '',      // Data de vencimento
        'dataMinima'     => date('Y-m-d\TH:i'),                 // Data mÃ­nima permitida para alteraÃ§Ã£o (agora)
        'erro'           => $_SESSION['erro'] ?? null,          // Mensagem de erro, se houver
        'sucesso'        => $_SESSION['sucesso'] ?? null        // Mensagem de sucesso, se houver
    ];
}

public function atualizar() {
    // Garante que o usuÃ¡rio esteja logado
    $usu_id = $_SESSION['usuario_id'] ?? null;
    if (!$usu_id) {
        header("Location: index.php?controller=auth&method=login&expirado=1");
        exit;
    }

    // Coleta dados do formulÃ¡rio
    $taskId     = $_POST['task_id'] ?? null;
    $titulo     = trim($_POST['titulo'] ?? '');
    $tipotarefa = trim($_POST['tipotarefa'] ?? '');
    $prioridade = $_POST['prioridade'] ?? '';
    $datafim    = $_POST['datafim'] ?? '';
    $descricao  = trim($_POST['descricao'] ?? '');

    // ValidaÃ§Ã£o bÃ¡sica
    if (!$taskId || $titulo === '' || $tipotarefa === '' || !$this->validarData($datafim)) {
        $_SESSION['erro'] = 'Preencha todos os campos corretamente.';
        header("Location: index.php?controller=tarefa&method=editarTarefa&task_id=$taskId");
        exit;
    }

    // Define o status como 'pendente' durante a ediÃ§Ã£o (se nÃ£o for editado diretamente pelo usuÃ¡rio)
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
        $_SESSION['erro'] = 'Tarefa nÃ£o identificada.';
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

```n
## Arquivo: controllers\usuarioController.php
```php
<?php
require_once __DIR__ . '/../models/usuarioModel.php';

class usuarioController {
    
    public function meuPerfil()
    {
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: index.php?controller=auth&method=login");
            exit;
        }

        require_once __DIR__ . '/../models/usuarioModel.php';

        $usuarioModel = new usuarioModel();

        $id = $_SESSION['usuario_id'];

        $usuario = $usuarioModel->buscarUsuarioPorId($id);

        if ($usuario) {
            $dadosParaView = [
                'id' => $usuario['USU_ID'],
                'nome' => $usuario['USU_NOME'],
                'apelido' => $usuario['USU_APELIDO'],
                'idade' => $usuario['USU_IDADE']
            ];

            require_once __DIR__ . '/../views/usuario/meuPerfil.php';
        } else {
            echo "UsuÃ¡rio nÃ£o encontrado.";
        }
    }
    
    public function editarPerfil()
    {
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: index.php?controller=auth&method=login");
            exit;
        }

        require_once __DIR__ . '/../models/usuarioModel.php';

        $usuarioModel = new usuarioModel();

        $id = $_SESSION['usuario_id'];

        $usuario = $usuarioModel->buscarUsuarioPorId($id);

        if ($usuario) {
            $dadosParaView = [
                'id' => $usuario['USU_ID'],
                'nome' => $usuario['USU_NOME'],
                'apelido' => $usuario['USU_APELIDO'],
                'idade' => $usuario['USU_IDADE']
            ];

            require_once __DIR__ . '/../views/usuario/editarPerfil.php';
        } else {
            echo "UsuÃ¡rio nÃ£o encontrado.";
        }
    }

    public function salvarEdicao()
{
    // Verifica se o usuÃ¡rio estÃ¡ logado
    if (!isset($_SESSION['usuario_id'])) {
        // Se nÃ£o estiver logado, redireciona para a pÃ¡gina de login
        header("Location: index.php?controller=auth&method=login");
        exit;
    }

    // ObtÃ©m os dados enviados via POST, utilizando trim para limpar espaÃ§os extras
    $id = $_SESSION['usuario_id'];  // ID do usuÃ¡rio da sessÃ£o, para garantir seguranÃ§a
    $nome = trim($_POST['nome'] ?? '');
    $apelido = trim($_POST['apelido'] ?? '');
    $idade = intval($_POST['idade'] ?? 0);

    // ValidaÃ§Ãµes simples: nome nÃ£o pode estar vazio e idade deve ser maior que zero
    if ($nome === '' || $idade <= 0) {
        // Aqui vocÃª pode implementar redirecionamento com mensagem de erro, por enquanto exibe erro simples
        echo "Nome Ã© obrigatÃ³rio e idade deve ser maior que zero.";
        exit;
    }

    // Inclui o model para poder atualizar o usuÃ¡rio
    require_once __DIR__ . '/../models/usuarioModel.php';
    $usuarioModel = new usuarioModel();

    // Chama o mÃ©todo para atualizar o usuÃ¡rio no banco de dados
    $sucesso = $usuarioModel->atualizarUsuario($id, $nome, $apelido, $idade);

    if ($sucesso) {
        // Se atualizaÃ§Ã£o foi bem-sucedida, redireciona para a pÃ¡gina do perfil com parÃ¢metro de sucesso
        header("Location: index.php?controller=usuario&method=meuPerfil&sucesso=1");
        exit;
    } else {
        // Em caso de erro na atualizaÃ§Ã£o, mostra mensagem
        echo "Erro ao atualizar os dados.";
        exit;
    }
    }



}

```n
