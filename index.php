<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Configuração para destruir a sessão após x segundos de inatividade 
if (isset($_SESSION['ultimo_acesso']) && (time() - $_SESSION['ultimo_acesso'] > 1800)) {

    // Antes de destruir ou limpar a sessão, seta flag para avisar que sessão expirou
    $_SESSION['sessao_expirada'] = true;

    // Remove dados de login da sessão para deslogar o usuário
    unset($_SESSION['usuario_logado'], $_SESSION['usuario_nome'], $_SESSION['usuario_id']);

    // Atualiza o último acesso para evitar redirecionamento em loop
    $_SESSION['ultimo_acesso'] = time();

    header("Location: index.php?controller=auth&method=login");
    exit;
}

// Atualiza o timestamp da última atividade
$_SESSION['ultimo_acesso'] = time();

// Captura controller e método da URL
if (!isset($_GET['controller']) && !isset($_GET['method'])) {
    if (isset($_SESSION['usuario_logado'])) {
        $controller = 'home';
        $method = 'index';
    } else {
        $controller = 'auth';
        $method = 'login';
    }
} else {
    $controller = $_GET['controller'];
    $method = $_GET['method'];
}

// Rotas livres sem necessidade de login
$rotasLivres = [
    'auth/login',
    'auth/loginSubmit',
    'auth/cadastro',
    'auth/cadastroSubmit',
    'auth/esqueciSenha',
    'auth/validaDadosParaReset',
    'auth/novaSenha',
    'auth/processaNovaSenha'
];

$rotaAtual = "$controller/$method";

// Valida login para rotas que não são livres
if (!in_array($rotaAtual, $rotasLivres)) {
    require_once 'controllers/authController.php';
    if (class_exists('authController') && method_exists('authController', 'checkLogin')) {
        $sessaoAtiva = authController::checkLogin();
        if ($sessaoAtiva === false) {
            header('Location: index.php?controller=auth&method=login&expirado=1');
            exit;
        }
    } else {
        die("Erro de autenticação: método checkLogin não encontrado.");
    }
}

// Ajuste para controller 'novaTarefa' -> 'tarefa'
if ($controller === 'novaTarefa') {
    $controller = 'tarefa';
}

// Ajuste para controller 'perfil' -> 'usuario'
if ($controller === 'perfil') {
    $controller = 'usuario';
}

$controllerFile = "controllers/{$controller}Controller.php";

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controllerClass = $controller . "Controller";

    if (class_exists($controllerClass)) {
        $obj = new $controllerClass();

        if (method_exists($obj, $method)) {
            $resultado = $obj->$method();

            // Exceção: se controller for 'home' e método 'index', usa 'home.php' como nome da view
            if ($controller === 'home' && $method === 'index') {
                $viewFile = "views/home/home.php";
            } else {
                $viewFile = "views/{$controller}/{$method}.php";
            }

            if (file_exists($viewFile)) {
                if (is_array($resultado)) {
                    
                    // isso cria variáveis na view com o nome das chaves do array
                    extract($resultado); 
                    // Definir os dados para a view dentro de um array padrão
                    $dadosParaView = $resultado;
                }
                require_once $viewFile;
            } else {
                echo "Erro: Arquivo da view '$viewFile' não encontrado.";
            }
        } else {
            echo "Erro: Método '$method' não encontrado em $controllerClass.";
        }
    } else {
        echo "Erro: Classe do controller '$controllerClass' não encontrada.";
    }
} else {
    echo "Erro: Arquivo do controller '$controllerFile' não encontrado.";
}
