<?php
// Importa a model que cuida dos dados do usuário
require_once __DIR__ . '/../models/authModel.php';

class authController {

    private $authModel; // atributo para a model
    private const SESSION_TIMEOUT = 3600; // tempo de inatividade em segundos

    public function __construct() {
        $this->authModel = new authModel();
    }

    // =================== LOGIN ===================
    // Método estático para checar se o usuário está logado e sessão válida
    
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

    // Exibe a página de login
    public function login() {
        // Inicializa variáveis que serão enviadas para a view
        $sessao_expirada = false;
        $erro_login = '';

        if (isset($_GET['expirado']) && $_GET['expirado'] == 1) {
            $sessao_expirada = true;
        }

        // Busca mensagem de erro de login na sessão, se existir
        if (isset($_SESSION['erro_login'])) {
            $erro_login = $_SESSION['erro_login'];
            unset($_SESSION['erro_login']); // Limpa o erro para próxima requisição
        }

        // Retorna os dados que serão usados na view
        return [
            'sessao_expirada' => $sessao_expirada,
            'erro_login' => $erro_login
        ];
    }

    // Processa o formulário de login enviado pelo usuário
    public function loginSubmit() {
        $login = trim($_POST['login'] ?? ''); // Remove espaços extras
        $senha = $_POST['senha'] ?? ''; // Captura senha

        // Validação básica: campos obrigatórios
        if (empty($login) || empty($senha)) {
            $_SESSION['erro_login'] = "Login e senha são obrigatórios.";
            header("Location: index.php?controller=auth&method=login");
            exit;
        }

         // Busca usuário no banco via model
        $usuario = $this->authModel->findByLogin($login);

        // Valida se usuário existe e senha está correta
        if ($usuario && password_verify($senha, $usuario['usu_senha'])) {
            // Cria sessão para usuário logado
            $_SESSION['usuario_logado'] = $login;
            $_SESSION['usuario_nome'] = $usuario['usu_nome'];
            $_SESSION['usuario_id'] = $usuario['usu_id'];
            $_SESSION['LAST_ACTIVITY'] = time();

            // Flag para mostrar splash apenas após login
            $_SESSION['show_splash'] = true;

            // Redireciona para página inicial após login
            header("Location: index.php?controller=home&method=index");
            exit;
        } else {
            // Usuário não encontrado ou senha incorreta
            $_SESSION['erro_login'] = $usuario ? "Senha incorreta." : "Usuário não encontrado.";
            header("Location: index.php?controller=auth&method=login");
            exit;
        }
    }

    // =================== RECUPERAÇÃO DE SENHA ===================

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
            $_SESSION['erro_esqueci_senha'] = "Todos os campos são obrigatórios.";
            $_SESSION['dados_esqueci_senha'] = $dados;
            header('Location: index.php?controller=auth&method=esqueciSenha');
            exit;
        }

        if (!filter_var($idade, FILTER_VALIDATE_INT)) {
            $_SESSION['erro_esqueci_senha'] = "Idade inválida.";
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
            $_SESSION['erro_esqueci_senha'] = "Dados inválidos para redefinição de senha.";
            $_SESSION['dados_esqueci_senha'] = $dados;
            header('Location: index.php?controller=auth&method=esqueciSenha');
            exit;
        }
    }

    public function novaSenha() {
        if (!isset($_SESSION['reset_login'])) {
            return ['erro' => 'Sessão expirada. Recomece o processo.'];
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
            $_SESSION['erro_nova_senha'] = 'Senha inválida.';
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
    // Recupera dados e erros da sessão se existirem
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

        // Verifica se login já existe - prioridade alta
        if ($this->authModel->existsLogin($login)) {
            $erroPrincipal = "Login já está em uso. Escolha outro.";
        } else {
            if ($nome === '' || $idade === '' || $login === '') {
                $erroPrincipal = 'Todos os campos, exceto "apelido" são de preenchimento obrigatório.';
            } elseif ($senha === '' || $repeteSenha === '') {
                $erroPrincipal = 'Todos os campos, exceto "apelido" são de preenchimento obrigatório.';
            } elseif (!filter_var($idade, FILTER_VALIDATE_INT)) {
                $erroPrincipal = 'Idade inválida.';
            } elseif ($senha !== $repeteSenha) {
                $erroPrincipal = 'As senhas não conferem.';
            }
        }

        if (!$aceitaTermos) {
            $erroCheckbox = "Você deve aceitar os termos para continuar.";
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
            return ['sucesso' => 'Cadastro realizado com sucesso! Faça login a seguir.'];
        } else {
            return ['erro' => 'Falha ao cadastrar usuário.'];
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
