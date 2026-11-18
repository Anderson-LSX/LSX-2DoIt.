# Componente: Login

## 1. Objetivo
Permitir que o usuário se autentique no sistema usando login e senha previamente cadastrados.

## 2. Tabela de elementos do componente View (`login.php`)

| Linha | Elemento | Tipo | Classe / ID / Name | Função |
|-------|---------|------|------------------|--------|
| 1     | `<?php if (!empty($erro_login)): ?>` | PHP condicional | — | Verifica se há mensagem de erro de login |
| 2-8   | `<div>` | Container de erro | Inline styles | Exibe a mensagem de login incorreto `$erro_login` |
| 7     | `<?= htmlspecialchars($erro_login) ?>` | Texto | — | Mostra a mensagem de erro |
| 10    | `<?php if (!empty($sessao_expirada)): ?>` | PHP condicional | — | Verifica se a sessão expirou |
| 11-13 | `<script>` | JS | — | Alerta de sessão expirada |
| 16    | `<div class='card-login'>` | Container principal | `card-login` | Container do formulário |
| 17    | `<h1>` | Título | — | “Login” |
| 18    | `<p>` | Subtítulo | — | “Entre ou cadastre-se” |
| 20    | `<form method="POST" action="index.php?controller=auth&method=loginSubmit">` | Formulário | — | Envia dados para Controller |
| 21    | `<label>Login:</label>` | Label | — | Indica campo login |
| 22    | `<input type="text" name="login">` | Input | name=`login` | Recebe login do usuário |
| 24    | `<label>Senha:</label>` | Label | — | Indica campo senha |
| 25    | `<input type="password" name="senha">` | Input | name=`senha` | Recebe senha do usuário |
| 27    | `<button type="submit">Entrar</button>` | Botão | — | Submete formulário |
| 30-35 | `<div>` + links | Container | Inline | Links “Esqueci senha” e “Cadastro” |


Trechos integrantes do componente Login na View (login.php)

<?php if (!empty($erro_login)): ?>
    <div style="
        border: 1px solid black;
        color: red;
        font-weight: bold;
        padding: 5px;
        margin: 60px auto;
        max-width: 450px;
        text-align: center;
    ">
        &#9888; <?= htmlspecialchars($erro_login) ?>
    </div>
<?php endif; ?>

<?php if (!empty($sessao_expirada)): ?>
    <script>
        alert("Sua sessão expirou por inatividade. Faça login novamente.");
    </script>
<?php endif; ?>

<div class='card-login'>
    <h1 style="text-align: center;">Login</h1>
    <p style="text-align: center;">Entre ou cadastre-se</p>

    <form method="POST" action="index.php?controller=auth&method=loginSubmit" style="margin-top: 20px;">
        <label>Login:</label><br>
        <input type="text" name="login" required style="width: 100%; padding: 8px; margin-bottom: 15px;"><br>

        <label>Senha:</label><br>
        <input type="password" name="senha" required style="width: 100%; padding: 8px; margin-bottom: 20px;"><br>

        <button type="submit" style="width: 100%; padding: 10px;">Entrar</button>
    </form>

    <div style="margin-top: 20px; text-align: center;">
        <a href="index.php?controller=auth&method=esqueciSenha">Esqueci minha senha</a><br><br>
        <span>Ainda não tá com a gente? </span>
        <a href="index.php?controller=auth&method=cadastro">Chega mais!</a>
    </div>
</div>


---

## 3. Controller (`authController.php`)

### Método `login()`
- Prepara dados para renderizar a view.
- Variáveis importantes:
  - `$erro_login`
  - `$sessao_expirada`

Trechos integrantes do componente Login na controller

public function login() {
    $sessao_expirada = false;
    $erro_login = '';

    if (isset($_SESSION['sessao_expirada']) && $_SESSION['sessao_expirada'] === true) {
        $sessao_expirada = true;
        unset($_SESSION['sessao_expirada']);
    }

    if (isset($_SESSION['erro_login'])) {
        $erro_login = $_SESSION['erro_login'];
        unset($_SESSION['erro_login']);
    }

    return [
        'sessao_expirada' => $sessao_expirada,
        'erro_login' => $erro_login
    ];
}

---


### Método `loginSubmit()`
- Recebe `$_POST['login']` e `$_POST['senha']`.
- Valida campos vazios → define erro.
- Busca usuário no banco via `authModel->findByLogin($login)`.
- Verifica senha com `password_verify`.
- Se válido → define sessões:
  - `$_SESSION['usuario_logado']`
  - `$_SESSION['usuario_nome']`
  - `$_SESSION['usuario_id']`
- Se inválido → define `$_SESSION['erro_login']` e redireciona.

public function loginSubmit() {
    $login = trim($_POST['login'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if (empty($login) || empty($senha)) {
        $_SESSION['erro_login'] = "Login e senha são obrigatórios.";
        header("Location: index.php?controller=auth&method=login");
        exit;
    }

    $usuario = $this->authModel->findByLogin($login);

    if ($usuario && password_verify($senha, $usuario['usu_senha'])) {
        $_SESSION['usuario_logado'] = $login;
        $_SESSION['usuario_nome'] = $usuario['usu_nome'];
        $_SESSION['usuario_id'] = $usuario['usu_id'];

        header("Location: index.php?controller=home&method=index");
        exit;
    } else {
        $_SESSION['erro_login'] = $usuario ? "Senha incorreta." : "Usuário não encontrado.";
        header("Location: index.php?controller=auth&method=login");
        exit;
    }
}


---

## 4. Model (`authModel.php`)

| Método | Função |
|--------|--------|
| `__construct()` | Cria conexão MySQL |
| `findByLogin(string $login)` | Busca usuário pelo login |
| `__destruct()` | Fecha conexão com banco |

Trechos integrantes do componente Login na model

class authModel {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli("127.0.0.1", "root", "12345", "projeto_x", 3308);
        if ($this->conn->connect_error) {
            die("Erro de conexão: " . $this->conn->connect_error);
        }
    }

    public function findByLogin(string $login) {
        $stmt = $this->conn->prepare("SELECT usu_id, usu_nome, usu_apelido, usu_idade, usu_login, usu_senha FROM usuario WHERE usu_login = ?");
        $stmt->bind_param("s", $login);
        $stmt->execute();
        $result = $stmt->get_result();
        $usuario = $result->fetch_assoc();
        $stmt->close();
        return $usuario ?: null;
    }

    public function __destruct() {
        $this->conn->close();
    }
}



---

## 5. Fluxo do componente

1. Usuário acessa página de login → Controller `login()`.
2. View renderizada → mostra erros ou sessão expirada.
3. Usuário envia formulário → Controller `loginSubmit()`.
4. Controller chama Model → busca usuário.
5. Verifica senha:
   - Se correto → define sessão → redireciona para Home.
   - Se incorreto → define erro → redireciona para login.

---

## 6. Sessões / Variáveis

| Variável | Função |
|----------|--------|
| `$_SESSION['usuario_logado']` | Flag usuário logado |
| `$_SESSION['usuario_nome']` | Nome do usuário logado |
| `$_SESSION['usuario_id']` | ID do usuário logado |
| `$_SESSION['erro_login']` | Mensagem de erro de login |
| `$_SESSION['sessao_expirada']` | Flag sessão expirada |

---

## 7. Checklist de desenvolvimento

- [x] View completa com formulário, inputs, botão, mensagens e links.
- [x] Controller com métodos `login()` e `loginSubmit()`.
- [x] Model com método `findByLogin()` e conexão segura.
- [x] Sessões criadas corretamente.
- [x] Fluxo do usuário documentado.
- [x] Comentários explicativos.
- [x] Elementos da view, classes, inputs e botões listados.
- [x] Segurança: prepared statements + `password_verify`.
