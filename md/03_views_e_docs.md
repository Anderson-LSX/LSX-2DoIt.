## Arquivo: views\auth\cadastro.php
```php
<!-- BotÃ£o de retorno padrÃ£o no canto superior esquerdo -->
<div style="position: absolute; top: 20px; left: 20px;">
    <a href="index.php?controller=auth&method=login"
       style="
           display: inline-block;
           padding: 10px 15px;
           background-color: white;
           border: 1px solid black;
           text-decoration: none;
           color: black;
           font-weight: bold;
       ">
        &#8592; Retornar ao login
    </a>
</div>

<?php
// cadastro.php - View do formulÃ¡rio de cadastro com estilo de card centralizado e comentÃ¡rios detalhados

// Recebe os dados passados pelo controller via $dadosParaView
// Esses dados sÃ£o usados para preencher os campos e mostrar erros
$erroPrincipal = $dadosParaView['errosPrincipal'] ?? null;    // Mensagem principal de erro
$erroCheckbox = $dadosParaView['erroCheckbox'] ?? null;      // Mensagem de erro do checkbox de aceite
$nomeVal = $dadosParaView['nomeVal'] ?? '';                  // Valor preenchido do campo nome
$apelidoVal = $dadosParaView['apelidoVal'] ?? '';            // Valor preenchido do campo apelido (opcional)
$idadeVal = $dadosParaView['idadeVal'] ?? '';                // Valor preenchido do campo idade
$loginVal = $dadosParaView['loginVal'] ?? '';                // Valor preenchido do campo login
$aceitaTermosChecked = $dadosParaView['aceitaTermosChecked'] ?? '';  // Estado do checkbox (checked ou vazio)
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Cadastro de UsuÃ¡rio</title>
</head>
<!-- Corpo da pÃ¡gina estilizado para centralizar vertical e horizontalmente o conteÃºdo -->
<body style="display:flex; justify-content:center; align-items:center; height:100vh; margin:0;">

    <!-- Div que funciona como card contendo o formulÃ¡rio, com borda preta fina e padding -->
    <div class="card-login">

        <!-- TÃ­tulo da pÃ¡gina -->
        <h1>Cadastro de UsuÃ¡rio</h1>
        <p style="font-size: 16px;">Preencha os campos abaixo para criar sua conta</p>

        <!-- Exibe a mensagem principal de erro, se existir -->
        <?php if ($erroPrincipal): ?>
            <p style="color: red; font-weight: bold; margin-bottom: 15px;">
                <?= htmlspecialchars($erroPrincipal) ?>
            </p>
        <?php endif; ?>

        <!-- FormulÃ¡rio de cadastro que envia os dados para o mÃ©todo cadastroSubmit do controller auth -->
        <form action="index.php?controller=auth&method=cadastroSubmit" method="post" novalidate>

            <!-- Campo nome, obrigatÃ³rio -->
            <div style="margin-bottom: 10px; text-align: left;">
                <label for="nome">Nome*:</label><br />
                <input 
                    type="text" 
                    id="nome" 
                    name="nome" 
                    value="<?= htmlspecialchars($nomeVal) ?>"
                    required 
                    style="width: 100%; padding: 6px;"/>
            </div>

            <!-- Campo apelido, opcional -->
            <div style="margin-bottom: 10px; text-align: left;">
                <label for="apelido">Apelido:</label><br />
                <input 
                    type="text" 
                    id="apelido" 
                    name="apelido" 
                    value="<?= htmlspecialchars($apelidoVal) ?>" 
                    style="width: 100%; padding: 6px;" 
                />
            </div>

            <!-- Campo idade, obrigatÃ³rio -->
            <div style="margin-bottom: 10px; text-align: left;">
                <label for="idade">Idade*:</label><br />
                <input 
                    type="number" 
                    id="idade" 
                    name="idade" 
                    value="<?= htmlspecialchars($idadeVal) ?>" 
                    required 
                    style="width: 100%; padding: 6px;" 
                />
            </div>

            <!-- Campo login, obrigatÃ³rio -->
            <div style="margin-bottom: 10px; text-align: left;">
                <label for="login">Login*:</label><br />
                <input 
                    type="text" 
                    id="login" 
                    name="login" 
                    value="<?= htmlspecialchars($loginVal) ?>" 
                    required 
                    style="width: 100%; padding: 6px;" 
                />
            </div>

            <!-- Campo senha, obrigatÃ³rio -->
            <div style="margin-bottom: 10px; text-align: left;">
                <label for="senha">Senha*:</label><br />
                <input 
                    type="password" 
                    id="senha" 
                    name="senha" 
                    required 
                    style="width: 100%; padding: 6px;" 
                />
            </div>

            <!-- Campo repetir senha, obrigatÃ³rio -->
            <div style="margin-bottom: 10px; text-align: left;">
                <label for="repetir_senha">Repetir Senha*:</label><br />
                <input 
                    type="password" 
                    id="repetir_senha" 
                    name="repetir_senha" 
                    required 
                    style="width: 100%; padding: 6px;" 
                />
            </div>

            <!-- Checkbox de aceite dos termos, obrigatÃ³rio -->
            <div style="margin-bottom: 10px; text-align: left;">
                <input 
                    type="checkbox" 
                    id="aceita_termos" 
                    name="aceita_termos" 
                    value="1" 
                    <?= $aceitaTermosChecked ?>/>
                <label for="aceita_termos">
                    Declaro que li e aceito os 
                    <a href="#" target="_blank" rel="noopener noreferrer">termos</a> <!-- Link futuro -->
                </label>

                <!-- Exibe mensagem de erro do checkbox, se existir -->
                <?php if ($erroCheckbox): ?>
                    <p style="color: red; font-weight: bold; margin-top: 5px;">
                        <?= htmlspecialchars($erroCheckbox) ?>
                    </p>
                <?php endif; ?>
            </div>

            <!-- BotÃ£o de envio do formulÃ¡rio -->
            <button type="submit" style="
                padding: 8px 16px;
                cursor: pointer;
                font-size: 16px;
                margin-top: 10px;
            ">
                Cadastrar
            </button>
        </form>
    </div>

</body>
</html>

```n
## Arquivo: views\auth\cadastroSubmit.php
```php
<?php
// cadastroSubmit.php - View com card centralizado e borda preta fina
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Cadastro - Sucesso</title>
</head>
<body style="display:flex; justify-content:center; align-items:center; height:100vh; margin:0;">

    <div style="
        border: 1px solid black;
        padding: 20px 40px;
        max-width: 400px;
        text-align: center;
        box-sizing: border-box;
    ">
        <h1>Cadastro realizado com sucesso</h1>
        <p>FaÃ§a login com seus dados para utilizar o sistema.</p>

        <form action="index.php" method="get" style="margin-top: 20px;">
            <button type="submit" style="
                padding: 8px 16px;
                cursor: pointer;
                font-size: 16px;
            ">Continuar</button>
        </form>
    </div>

</body>
</html>

```n
## Arquivo: views\auth\cadastro_legado.php
```php
<!-- BotÃ£o de retorno padrÃ£o no canto superior esquerdo -->
<div style="position: absolute; top: 20px; left: 20px;">
    <a href="index.php?controller=auth&method=login"
       style="
           display: inline-block;
           padding: 10px 15px;
           background-color: white;
           border: 1px solid black;
           text-decoration: none;
           color: black;
           font-weight: bold;
       ">
        &#8592; Retornar ao login
    </a>
</div>

<?php
// cadastro.php - View do formulÃ¡rio de cadastro com estilo de card centralizado e comentÃ¡rios detalhados

// Recebe os dados passados pelo controller via $dadosParaView
// Esses dados sÃ£o usados para preencher os campos e mostrar erros
$erroPrincipal = $dadosParaView['errosPrincipal'] ?? null;    // Mensagem principal de erro
$erroCheckbox = $dadosParaView['erroCheckbox'] ?? null;      // Mensagem de erro do checkbox de aceite
$nomeVal = $dadosParaView['nomeVal'] ?? '';                  // Valor preenchido do campo nome
$apelidoVal = $dadosParaView['apelidoVal'] ?? '';            // Valor preenchido do campo apelido (opcional)
$idadeVal = $dadosParaView['idadeVal'] ?? '';                // Valor preenchido do campo idade
$loginVal = $dadosParaView['loginVal'] ?? '';                // Valor preenchido do campo login
$aceitaTermosChecked = $dadosParaView['aceitaTermosChecked'] ?? '';  // Estado do checkbox (checked ou vazio)
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Cadastro de UsuÃ¡rio</title>
</head>
<!-- Corpo da pÃ¡gina estilizado para centralizar vertical e horizontalmente o conteÃºdo -->
<body style="display:flex; justify-content:center; align-items:center; height:100vh; margin:0;">

    <!-- Div que funciona como card contendo o formulÃ¡rio, com borda preta fina e padding -->
    <div style="
        border: 1px solid black;         /* Borda preta fina */
        padding: 20px 40px;              /* EspaÃ§amento interno vertical e horizontal */
        max-width: 400px;                /* Largura mÃ¡xima do card */
        width: 100%;                    /* Ocupa 100% do container pai atÃ© o max-width */
        box-sizing: border-box;          /* Inclui borda e padding na largura total */
        text-align: center;              /* Centraliza texto dentro do card */
    ">

        <!-- TÃ­tulo da pÃ¡gina -->
        <h1>Cadastro de UsuÃ¡rio</h1>

        <!-- Exibe a mensagem principal de erro, se existir -->
        <?php if ($erroPrincipal): ?>
            <p style="color: red; font-weight: bold; margin-bottom: 15px;">
                <?= htmlspecialchars($erroPrincipal) ?>
            </p>
        <?php endif; ?>

        <!-- FormulÃ¡rio de cadastro que envia os dados para o mÃ©todo cadastroSubmit do controller auth -->
        <form action="index.php?controller=auth&method=cadastroSubmit" method="post" novalidate>

            <!-- Campo nome, obrigatÃ³rio -->
            <div style="margin-bottom: 10px; text-align: left;">
                <label for="nome">Nome*:</label><br />
                <input 
                    type="text" 
                    id="nome" 
                    name="nome" 
                    value="<?= htmlspecialchars($nomeVal) ?>"
                    required 
                    style="width: 100%; padding: 6px;"/>
            </div>

            <!-- Campo apelido, opcional -->
            <div style="margin-bottom: 10px; text-align: left;">
                <label for="apelido">Apelido:</label><br />
                <input 
                    type="text" 
                    id="apelido" 
                    name="apelido" 
                    value="<?= htmlspecialchars($apelidoVal) ?>" 
                    style="width: 100%; padding: 6px;" 
                />
            </div>

            <!-- Campo idade, obrigatÃ³rio -->
            <div style="margin-bottom: 10px; text-align: left;">
                <label for="idade">Idade*:</label><br />
                <input 
                    type="number" 
                    id="idade" 
                    name="idade" 
                    value="<?= htmlspecialchars($idadeVal) ?>" 
                    required 
                    style="width: 100%; padding: 6px;" 
                />
            </div>

            <!-- Campo login, obrigatÃ³rio -->
            <div style="margin-bottom: 10px; text-align: left;">
                <label for="login">Login*:</label><br />
                <input 
                    type="text" 
                    id="login" 
                    name="login" 
                    value="<?= htmlspecialchars($loginVal) ?>" 
                    required 
                    style="width: 100%; padding: 6px;" 
                />
            </div>

            <!-- Campo senha, obrigatÃ³rio -->
            <div style="margin-bottom: 10px; text-align: left;">
                <label for="senha">Senha*:</label><br />
                <input 
                    type="password" 
                    id="senha" 
                    name="senha" 
                    required 
                    style="width: 100%; padding: 6px;" 
                />
            </div>

            <!-- Campo repetir senha, obrigatÃ³rio -->
            <div style="margin-bottom: 10px; text-align: left;">
                <label for="repetir_senha">Repetir Senha*:</label><br />
                <input 
                    type="password" 
                    id="repetir_senha" 
                    name="repetir_senha" 
                    required 
                    style="width: 100%; padding: 6px;" 
                />
            </div>

            <!-- Checkbox de aceite dos termos, obrigatÃ³rio -->
            <div style="margin-bottom: 10px; text-align: left;">
                <input 
                    type="checkbox" 
                    id="aceita_termos" 
                    name="aceita_termos" 
                    value="1" 
                    <?= $aceitaTermosChecked ?>/>
                <label for="aceita_termos">
                    Declaro que li e aceito os 
                    <a href="#" target="_blank" rel="noopener noreferrer">termos</a> <!-- Link futuro -->
                </label>

                <!-- Exibe mensagem de erro do checkbox, se existir -->
                <?php if ($erroCheckbox): ?>
                    <p style="color: red; font-weight: bold; margin-top: 5px;">
                        <?= htmlspecialchars($erroCheckbox) ?>
                    </p>
                <?php endif; ?>
            </div>

            <!-- BotÃ£o de envio do formulÃ¡rio -->
            <button type="submit" style="
                padding: 8px 16px;
                cursor: pointer;
                font-size: 16px;
                margin-top: 10px;
            ">
                Cadastrar
            </button>
        </form>
    </div>

</body>
</html>

```n
## Arquivo: views\auth\esqueciSenha.php
```php
<!-- BotÃ£o de retorno padrÃ£o no canto superior esquerdo -->
<div style="position: absolute; top: 20px; left: 20px;">
    <a href="index.php?controller=auth&method=login"
       style="
           display: inline-block;
           padding: 10px 15px;
           background-color: white;
           border: 1px solid black;
           text-decoration: none;
           color: black;
           font-weight: bold;
       ">
        &#8592; Retornar ao login
    </a>
</div>

<!-- aviso de erro de autenticaÃ§Ã£o -->
<?php if (!empty($erro)): ?>
    <div style="
        border: 1px solid black;
        color: red;
        font-weight: bold;
        padding: 10px;
        margin: 0 auto 20px auto;
        max-width: 400px;
        text-align: center;
    ">
        &#9888; <?= htmlspecialchars($erro) ?>
    </div>
<?php endif; ?>

<!-- Container para centralizar o conteÃºdo na tela -->
<div style="
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    flex-direction: column;
">

<!-- Card de recuperaÃ§Ã£o de senha -->
<div class="card-login">

<h1>Esqueci minha senha</h1>
        <h2 style="font-size: 16px;">Passo 1 de 2: Digite seus dados de acesso para redefinir sua senha</h2>

        <form method="POST" action="index.php?controller=auth&method=validaDadosParaReset">

            <label for="nome">Nome:</label><br>
            <input 
                type="text" 
                name="nome" 
                id="nome"
                required 
                value="<?= htmlspecialchars($dados['nome'] ?? '') ?>"
                style="width: 100%; padding: 8px; box-sizing: border-box;"
            ><br><br>

            <label for="idade">Idade:</label><br>
            <input 
                type="number" 
                name="idade" 
                id="idade"
                required 
                value="<?= htmlspecialchars($dados['idade'] ?? '') ?>"
                style="width: 100%; padding: 8px; box-sizing: border-box;"
            ><br><br>

            <label for="login">Login:</label><br>
            <input 
                type="text" 
                name="login" 
                id="login"
                required 
                value="<?= htmlspecialchars($dados['login'] ?? '') ?>"
                style="width: 100%; padding: 8px; box-sizing: border-box;"
            ><br><br>

            <button type="submit" style="width: 100%; padding: 10px;">Validar</button>

        </form>
</div>
</div>

```n
## Arquivo: views\auth\login.php
```php
<!-- Faixa de fundo exclusiva da tela de login -->
<div class="login-bg-stripe"></div>

<div class="login-wrapper">

<!-- Exibe mensagem de erro de login caso exista -->
<?php if (!empty($erro_login)): ?>
    <div style="
        border: 1px solid black;
        color: red;
        font-weight: bold;
        padding: 5px;
        margin: 0 auto 20px auto;
        max-width: 450px;
        text-align: center;
    ">
        &#9888; <?= htmlspecialchars($erro_login) ?> 
    </div>
<?php endif; ?>

<!-- Alerta se a sessÃ£o do usuÃ¡rio expirou -->
<?php if (!empty($sessao_expirada)): ?>
    <script>
        alert("Sua sessÃ£o expirou por inatividade. FaÃ§a login novamente.");
    </script>
<?php endif; ?>

<!-- Card principal do formulÃ¡rio de login -->
<div class='card-login'>
    <img src="public/img/logo-2-do-it.png" alt="2Do it." class="logo-login">
    
    <p style="text-align: center;">Entre ou cadastre-se</p>

    <!-- FormulÃ¡rio de login -->
    <form method="POST" action="index.php?controller=auth&method=loginSubmit" style="margin-top: 20px;">
        <label>Login:</label><br>
        <input type="text" name="login" required style="width: 100%; padding: 8px; margin-bottom: 15px;"><br>

        <label>Senha:</label><br>
        <input type="password" name="senha" required style="width: 100%; padding: 8px; margin-bottom: 20px;"><br>

        <button type="submit" style="width: 100%; padding: 10px;">Entrar</button>
    </form>

    <!-- Links adicionais -->
    <div style="margin-top: 20px; text-align: center;">
        <a href="index.php?controller=auth&method=esqueciSenha">Esqueci minha senha</a><br><br>
        <span>Ainda nÃ£o tÃ¡ com a gente? </span>
        <a href="index.php?controller=auth&method=cadastro">Chega mais!</a>
    </div>
</div>

</div> <!-- fecha .login-wrapper -->
```n
## Arquivo: views\auth\login_legado.php
```php
<!-- Exibe mensagem de erro de login caso exista -->
<?php if (!empty($erro_login)): ?>
    <div style="
        border: 1px solid black;  /* Borda preta ao redor */
        color: red;               /* Texto em vermelho */
        font-weight: bold;        /* Negrito para destaque */
        padding: 5px;            /* EspaÃ§o interno */
        margin: 60px auto;     /* Centraliza e define 20px de espaÃ§o abaixo */
        max-width: 450px;         /* Largura mÃ¡xima para alinhar com o formulÃ¡rio */
        text-align: center;           /* Centraliza o texto */
    ">
        <!-- Ãcone de alerta + mensagem -->    
        &#9888; <?= htmlspecialchars($erro_login) ?> 
    </div>
<?php endif; ?>

<!-- Alerta se a sessÃ£o do usuÃ¡rio expirou -->
<?php if (!empty($sessao_expirada)): ?>
    <script>
        alert("Sua sessÃ£o expirou por inatividade. FaÃ§a login novamente.");
    </script>
<?php endif; ?>

<!-- Card principal do formulÃ¡rio de login -->
<div class='card-login'>
    <h1 style="text-align: center;">Login</h1>
    <p style="text-align: center;">Entre ou cadastre-se</p>

    <!-- FormulÃ¡rio de login -->
    <form method="POST" action="index.php?controller=auth&method=loginSubmit" style="margin-top: 20px;">
        <label>Login:</label><br>
        <input type="text" name="login" required style="width: 100%; padding: 8px; margin-bottom: 15px;"><br>

        <label>Senha:</label><br>
        <input type="password" name="senha" required style="width: 100%; padding: 8px; margin-bottom: 20px;"><br>

        <button type="submit" style="width: 100%; padding: 10px;">Entrar</button>
    </form>

    <!-- Links adicionais -->
    <div style="margin-top: 20px; text-align: center;">
        <a href="index.php?controller=auth&method=esqueciSenha">Esqueci minha senha</a><br><br>
        <span>Ainda nÃ£o tÃ¡ com a gente? </span>
        <a href="index.php?controller=auth&method=cadastro">Chega mais!</a>
    </div>
</div>

```n
## Arquivo: views\auth\novaSenha.php
```php
<!-- BotÃ£o de retorno no canto superior esquerdo -->
<div style="position: absolute; top: 20px; left: 20px;">
    <a href="index.php?controller=auth&method=esqueciSenha"
       style="
           display: inline-block;
           padding: 10px 15px;
           background-color: white;
           border: 1px solid black;
           text-decoration: none;
           color: black;
           font-weight: bold;
       ">
        &#8592; Retornar ao Passo 1
    </a>
</div>

<!-- Container centralizado para o card -->
<div style="
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
">
    <!-- Card principal -->
    <div style="
        border: 1px solid black;
        padding: 30px;
        width: 350px;
        background-color: white;
    ">
        <h1>Nova Senha</h1>
        <h2 style="font-size: 16px;">Passo 2 de 2:<br> Digite sua nova senha</h2>

        <!-- FormulÃ¡rio de redefiniÃ§Ã£o -->
        <form method="POST" action="index.php?controller=auth&method=processaNovaSenha">

            <label>Nova Senha:</label><br>
            <input type="password" name="nova_senha" required
                style="width: 100%; padding: 8px; margin-bottom: 15px;"><br>

            <button type="submit" style="width: 100%; padding: 10px;">Atualizar Senha</button>
        </form>
    </div>
</div>

```n
## Arquivo: views\auth\senhaRedefinida.php
```php
<!-- Container centralizado -->
<div style="
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    flex-direction: column;
    text-align: center;
">

    <div style="
        border: 1px solid black;
        padding: 30px;
        max-width: 400px;
        background-color: white;
    ">
        <h1>Senha atualizada com sucesso!</h1>
        <p>Agora vocÃª pode fazer login com sua nova senha.</p>
        
        <a href="index.php?controller=auth&method=login" style="
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: black;
            color: white;
            text-decoration: none;
            font-weight: bold;
        ">
            Ir para o login
        </a>
    </div>

</div>

```n
## Arquivo: views\definicoes\apagarConta.php
```php
<!-- Card centralizado -->
<div style="
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    border: 1px solid black;
    padding: 30px;
    background: white;
    width: 90%;
    max-width: 400px;
    box-sizing: border-box;
    text-align: center;
">

    <h2 style="margin-bottom: 20px;">Confirmar exclusÃ£o da conta</h2>
    <p style="margin-bottom: 30px;">
        Tem certeza que deseja apagar sua conta?<br>
        Esta aÃ§Ã£o <strong>nÃ£o pode ser desfeita</strong>.
    </p>

    <div style="display: flex; justify-content: center; gap: 20px;">
        <a href="index.php?controller=definicoes&method=definicoes" 
           style="
               padding: 10px 20px;
               border: 1px solid black;
               background-color: white;
               font-weight: bold;
               text-decoration: none;
               cursor: pointer;
               flex: 1;
               max-width: 120px;
               text-align: center;
           ">
            Cancelar
        </a>

        <a href="index.php?controller=usuario&method=apagarContaConfirmada" 
           style="
               padding: 10px 20px;
               border: none;
               background-color: red;
               color: white;
               font-weight: bold;
               text-decoration: none;
               cursor: pointer;
               flex: 1;
               max-width: 120px;
               text-align: center;
           ">
            Apagar
        </a>
    </div>
</div>

```n
## Arquivo: views\definicoes\definicoes.php
```php
<link rel="icon" type="image/png" href="public/img/favicon-2-do-it.png" />


<!-- Card principal -->
<div class="card-headers">
    <h1>DefiniÃ§Ãµes</h1>
    <p>Nesta seÃ§Ã£o, vocÃª pode ajustar as preferÃªncias da sua conta e da aplicaÃ§Ã£o.</p>
</div>

<!-- Breadcrumb -->
<div class="breadcrumbs">
    <p style="font-size: 14px; color: #555;">
        <a href="index.php?controller=home&method=index" style="text-decoration: none; color: #555;">
            Home
        </a> &gt; DefiniÃ§Ãµes
    </p>
</div>

<!-- Card com dados de definiÃ§Ãµes -->
<div class="card">

    <!-- Abas (Geral | Minha senha) -->
    <div style="display: flex; margin-bottom: 20px; gap: 20px;">
        <button class="button-aba-settings" onclick="mostrarAba('geral')" id="abaGeral"  style="border-bottom: 5px solid black;">
            <spam>Geral</spam>
        </button>
        <button class="button-aba-settings" onclick="mostrarAba('senha')" id="abaSenha">
            <spam>Minha senha</spam>
        </button>
    </div>

    <!-- ConteÃºdo da aba Geral -->
    <div id="conteudoGeral">
        <h2>ConfiguraÃ§Ãµes Gerais</h2>

        <!-- Tema -->
        <div style="margin-bottom: 20px;">
            <label for="tema"><strong>Tema:</strong></label><br>
            <select id="tema" name="tema" style="padding: 8px; width: 200px; border: 1px solid black;">
                <option value="default">Default</option>
                <option value="indigo">Indigo</option>
                <option value="clear">Clear</option>
                <option value="meia-noite">Meia-Noite</option>
                <option value="win-98">Win-98</option>
            </select>
        </div>

        <!-- SaudaÃ§Ã£o dinÃ¢mica -->
        <div style="margin-bottom: 20px;">
            <label style="display: flex; align-items: center; cursor: pointer;">
                <span style="margin-right: 10px;">SaudaÃ§Ã£o dinÃ¢mica     </span>
                <input type="checkbox" id="toggleSaudacaoDinamica" style="display:none;">
                <span class="switch"></span>
            </label>
        </div>

        <!-- SaudaÃ§Ã£o personalizada -->
        <div style="margin-bottom: 10px;">
            <label style="display: flex; align-items: center; cursor: pointer;">
                <span style="margin-right: 10px;">SaudaÃ§Ã£o personalizada</span>
                <input type="checkbox" id="toggleSaudacaoPersonalizada" style="display:none;">
                <span class="switch"></span>
            </label>
        </div>

        <!-- Campo de texto da SaudaÃ§Ã£o personalizada -->
        <div style="margin-bottom: 20px;">
            <input type="text" id="inputSaudacaoPersonalizada" placeholder="Digite sua saudaÃ§Ã£o personalizada" disabled
                   style="padding: 8px; width: 100%; max-width: 400px; border: 1px solid black; box-sizing: border-box;">
        </div>

        <!-- Apagar conta -->
        <div>
            <a href="index.php?controller=definicoes&method=apagarConta" style="color: red; text-decoration: none; font-weight: bold;">
                Apagar minha conta
            </a>
        </div>
    </div>

    <!-- ConteÃºdo da aba Minha senha -->
    <div id="conteudoSenha" style="display: none;">
        <h2>Alterar Senha</h2>

        <!-- Campo: Nova senha -->
        <div style="margin-bottom: 15px;">
            <label for="novaSenha"><strong>Nova senha:</strong></label><br>
            <input type="password" id="novaSenha" name="novaSenha" style="padding: 8px; width: 300px; border: 1px solid black;">
        </div>

        <!-- Campo: Confirmar nova senha -->
        <div style="margin-bottom: 20px;">
            <label for="confirmarSenha"><strong>Confirmar nova senha:</strong></label><br>
            <input type="password" id="confirmarSenha" name="confirmarSenha" style="padding: 8px; width: 300px; border: 1px solid black;">
        </div>

        <button> 
            Salvar nova senha
        </button>
    </div>

</div>

<!-- Estilos para botÃµes chave -->
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 24px;
  background-color: #ccc;
  border-radius: 12px;
  transition: background-color 0.3s;
}
.switch::before {
  content: "";
  position: absolute;
  left: 2px;
  top: 2px;
  width: 20px;
  height: 20px;
  background-color: white;
  border-radius: 50%;
  transition: transform 0.3s;
}
input[type="checkbox"]:checked + .switch {
  background-color: #4caf50;
}
input[type="checkbox"]:checked + .switch::before {
  transform: translateX(26px);
}
label {
  user-select: none;
}
</style>

<!-- Script JS abas e botÃµes chave -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleDinamica = document.getElementById('toggleSaudacaoDinamica');
        const togglePersonalizada = document.getElementById('toggleSaudacaoPersonalizada');
        const inputSaudacao = document.getElementById('inputSaudacaoPersonalizada');

        toggleDinamica.addEventListener('change', function() {
            if (this.checked) {
                console.log('SaudaÃ§Ã£o dinÃ¢mica ativada');
            } else {
                console.log('SaudaÃ§Ã£o dinÃ¢mica desativada');
            }
        });

        function atualizarInput() {
            inputSaudacao.disabled = !togglePersonalizada.checked;
        }

        togglePersonalizada.addEventListener('change', function() {
            atualizarInput();
            if (this.checked) {
                console.log('SaudaÃ§Ã£o personalizada ativada');
            } else {
                console.log('SaudaÃ§Ã£o personalizada desativada');
            }
        });

        // Inicializa estado do input no carregamento
        atualizarInput();
    });

    function mostrarAba(qual) {
        const abaGeral = document.getElementById('abaGeral');
        const abaSenha = document.getElementById('abaSenha');
        const conteudoGeral = document.getElementById('conteudoGeral');
        const conteudoSenha = document.getElementById('conteudoSenha');

        if (qual === 'geral') {
            conteudoGeral.style.display = 'block';
            conteudoSenha.style.display = 'none';
            abaGeral.style.borderBottom = '2px solid black';
            abaSenha.style.borderBottom = 'none';
        } else {
            conteudoGeral.style.display = 'none';
            conteudoSenha.style.display = 'block';
            abaGeral.style.borderBottom = 'none';
            abaSenha.style.borderBottom = '2px solid black';
        }
    }
</script>


```n
## Arquivo: views\docs\00_index.md
```markdown
# DocumentaÃ§Ã£o Oficial â€“ Projeto Organizador

Este Ã­ndice contÃ©m todos os componentes do sistema, com links para seus manuais completos.

## Componentes

1. [Login](01_login.md)
2. [Cadastro](02_cadastro.md)
3. [Card de Tarefas](03_card_tarefas.md)
4. [Logout](04_logout.md)
5. [RecuperaÃ§Ã£o de Senha](05_recuperacao_senha.md)
...

```n
## Arquivo: views\docs\01_login.md
```markdown
# Componente: Login

## 1. Objetivo
Permitir que o usuÃ¡rio se autentique no sistema usando login e senha previamente cadastrados.

## 2. Tabela de elementos do componente View (`login.php`)

| Linha | Elemento | Tipo | Classe / ID / Name | FunÃ§Ã£o |
|-------|---------|------|------------------|--------|
| 1     | `<?php if (!empty($erro_login)): ?>` | PHP condicional | â€” | Verifica se hÃ¡ mensagem de erro de login |
| 2-8   | `<div>` | Container de erro | Inline styles | Exibe a mensagem de login incorreto `$erro_login` |
| 7     | `<?= htmlspecialchars($erro_login) ?>` | Texto | â€” | Mostra a mensagem de erro |
| 10    | `<?php if (!empty($sessao_expirada)): ?>` | PHP condicional | â€” | Verifica se a sessÃ£o expirou |
| 11-13 | `<script>` | JS | â€” | Alerta de sessÃ£o expirada |
| 16    | `<div class='card-login'>` | Container principal | `card-login` | Container do formulÃ¡rio |
| 17    | `<h1>` | TÃ­tulo | â€” | â€œLoginâ€ |
| 18    | `<p>` | SubtÃ­tulo | â€” | â€œEntre ou cadastre-seâ€ |
| 20    | `<form method="POST" action="index.php?controller=auth&method=loginSubmit">` | FormulÃ¡rio | â€” | Envia dados para Controller |
| 21    | `<label>Login:</label>` | Label | â€” | Indica campo login |
| 22    | `<input type="text" name="login">` | Input | name=`login` | Recebe login do usuÃ¡rio |
| 24    | `<label>Senha:</label>` | Label | â€” | Indica campo senha |
| 25    | `<input type="password" name="senha">` | Input | name=`senha` | Recebe senha do usuÃ¡rio |
| 27    | `<button type="submit">Entrar</button>` | BotÃ£o | â€” | Submete formulÃ¡rio |
| 30-35 | `<div>` + links | Container | Inline | Links â€œEsqueci senhaâ€ e â€œCadastroâ€ |


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
        alert("Sua sessÃ£o expirou por inatividade. FaÃ§a login novamente.");
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
        <span>Ainda nÃ£o tÃ¡ com a gente? </span>
        <a href="index.php?controller=auth&method=cadastro">Chega mais!</a>
    </div>
</div>


---

## 3. Controller (`authController.php`)

### MÃ©todo `login()`
- Prepara dados para renderizar a view.
- VariÃ¡veis importantes:
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


### MÃ©todo `loginSubmit()`
- Recebe `$_POST['login']` e `$_POST['senha']`.
- Valida campos vazios â†’ define erro.
- Busca usuÃ¡rio no banco via `authModel->findByLogin($login)`.
- Verifica senha com `password_verify`.
- Se vÃ¡lido â†’ define sessÃµes:
  - `$_SESSION['usuario_logado']`
  - `$_SESSION['usuario_nome']`
  - `$_SESSION['usuario_id']`
- Se invÃ¡lido â†’ define `$_SESSION['erro_login']` e redireciona.

public function loginSubmit() {
    $login = trim($_POST['login'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if (empty($login) || empty($senha)) {
        $_SESSION['erro_login'] = "Login e senha sÃ£o obrigatÃ³rios.";
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
        $_SESSION['erro_login'] = $usuario ? "Senha incorreta." : "UsuÃ¡rio nÃ£o encontrado.";
        header("Location: index.php?controller=auth&method=login");
        exit;
    }
}


---

## 4. Model (`authModel.php`)

| MÃ©todo | FunÃ§Ã£o |
|--------|--------|
| `__construct()` | Cria conexÃ£o MySQL |
| `findByLogin(string $login)` | Busca usuÃ¡rio pelo login |
| `__destruct()` | Fecha conexÃ£o com banco |

Trechos integrantes do componente Login na model

class authModel {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli("127.0.0.1", "root", "12345", "projeto_x", 3308);
        if ($this->conn->connect_error) {
            die("Erro de conexÃ£o: " . $this->conn->connect_error);
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

1. UsuÃ¡rio acessa pÃ¡gina de login â†’ Controller `login()`.
2. View renderizada â†’ mostra erros ou sessÃ£o expirada.
3. UsuÃ¡rio envia formulÃ¡rio â†’ Controller `loginSubmit()`.
4. Controller chama Model â†’ busca usuÃ¡rio.
5. Verifica senha:
   - Se correto â†’ define sessÃ£o â†’ redireciona para Home.
   - Se incorreto â†’ define erro â†’ redireciona para login.

---

## 6. SessÃµes / VariÃ¡veis

| VariÃ¡vel | FunÃ§Ã£o |
|----------|--------|
| `$_SESSION['usuario_logado']` | Flag usuÃ¡rio logado |
| `$_SESSION['usuario_nome']` | Nome do usuÃ¡rio logado |
| `$_SESSION['usuario_id']` | ID do usuÃ¡rio logado |
| `$_SESSION['erro_login']` | Mensagem de erro de login |
| `$_SESSION['sessao_expirada']` | Flag sessÃ£o expirada |

---

## 7. Checklist de desenvolvimento

- [x] View completa com formulÃ¡rio, inputs, botÃ£o, mensagens e links.
- [x] Controller com mÃ©todos `login()` e `loginSubmit()`.
- [x] Model com mÃ©todo `findByLogin()` e conexÃ£o segura.
- [x] SessÃµes criadas corretamente.
- [x] Fluxo do usuÃ¡rio documentado.
- [x] ComentÃ¡rios explicativos.
- [x] Elementos da view, classes, inputs e botÃµes listados.
- [x] SeguranÃ§a: prepared statements + `password_verify`.

```n
## Arquivo: views\estatisticas\estatisticas.php
```php
<!-- BotÃ£o de retorno padrÃ£o no canto superior esquerdo -->
<div style="position: absolute; top: 20px; left: 20px;">
    <a href="index.php?controller=home&method=index"
       style="
           display: inline-block;
           padding: 10px 15px;
           background-color: white;
           border: 1px solid black;
           text-decoration: none;
           color: black;
           font-weight: bold;
       ">
        &#8592; Voltar
    </a>
</div>

<!-- Card principal -->
<div class="card-headers">

    <!-- TÃ­tulo -->
    <h1>EstatÃ­sticas</h1>

    <!-- Texto Lorem Ipsum -->
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.</p>

</div>

<!-- Breadcrumb -->
<div class="breadcrumbs">
    <p style="font-size: 14px; color: #555;">
        <a href="index.php?controller=home&method=index" style="text-decoration: none; color: #555;">
            Home
        </a> &gt; EstatÃ­sticas
    </p>
</div>

<div class="card">
    <p><strong>Em breve...</strong></p>
    <!-- Texto Lorem Ipsum -->
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.</p>
</div>



```n
## Arquivo: views\home\home.php
```php
<!-- Menu lateral 
 // comentado para ocultar temporariamente
<div class="menu-lateral-default">
    <h3>Menu</h3>
    <ul>
        <-- Alterado para abrir modal ->
        <li><a href="#" onclick="abrirModal()">Nova Tarefa</a></li>
        <li><a href="index.php?controller=tarefa&method=gestaoTarefa">Minhas tarefas</a></li>
        <li><a href="index.php?controller=estatisticas&method=estatisticas">EstatÃ­sticas</a></li>
        <li><a href="index.php?controller=perfil&method=meuPerfil">Meu Perfil</a></li>
        <li><a href="index.php?controller=definicoes&method=definicoes">DefiniÃ§Ãµes</a></li>
        <li><a href="index.php?controller=auth&method=logout">Logout</a></li>
    </ul>
</div>
-->

<link rel="icon" type="image/png" href="public/img/favicon-2-do-it.png" />

<!-- Card headers de boas-vindas -->
    <div class="card-headers">
    <h1>Bonjour, <?= htmlspecialchars($dadosParaView['nomeParaExibir']) ?>!</h1>
    </div>

<!-- Um futuro card interativo-->
    <div class="card-interativo">Bem-vindo ao seu organizador de tarefas pessoal. 
        Aqui vocÃª pode acompanhar suas tarefas, definir prioridades e manter-se organizado. 
        Vamos comeÃ§ar a organizar seu dia!</div>
<!-- Linha divisÃ³ria 
<div style="height: 1px; background-color: black; margin-bottom: 10px; margin-left: 220px; margin-right: 220px;"></div>
-->

<!-- DIV PAI dos Cards estatÃ­sticos -->
    <div class="card-views-home-father">
    
    <!-- Card: PrÃ³ximas Tarefas -->
    <div class="card-views-home">
        <spam>PrÃ³ximas Tarefas</spam>
        <p><?= isset($dadosParaView['proximasTarefasQtd']) ? $dadosParaView['proximasTarefasQtd'] : '0' ?></p>
    </div>

    <!-- Card: Tarefas ConcluÃ­das ult 30 dias -->
    <div class="card-views-home">
        <spam>Tarefas concluÃ­das nos Ãºltimos 30 dias</spam>
        <p><?= $dadosParaView['qtdConcluidasUlt30Dias'] ?? 0 ?></p>
    </div>

    <!-- Card: Total de tarefas cadastradas -->
    <div class="card-views-home">
        <spam>Total de tarefas cadastradas</spam>
        <p><?= $dadosParaView['totalTarefas'] ?? 0 ?></p>
    </div>

    <!-- Card: Tarefas com Alta Prioridade -->
    <div class="card-views-home">
        <spam>Alta prioridade</spam>
        <p><?= $dadosParaView['tarefasAltaPrioridade'] ?? 0 ?></p>
    </div>

    <!-- Card: Tarefas Pendentes -->
    <div class="card-views-home">
        <spam>Tarefas Pendentes</spam>
        <p><?= $dadosParaView['tarefasPendentes'] ?? 0 ?></p>
    </div>

    <!-- Card: Tarefas Atrasadas -->
    <div class="card-views-home">
        <spam>Tarefas atrasadas</spam>
        <p><?= $dadosParaView['tarefasAtrasadas'] ?? 0 ?></p>

    </div>
    </div>

<!-- cards tabela prox tarefas -->
    <div class="card">
    <div class="titulo-secao">PrÃ³ximas tarefas</div>
    <hr><br>
    <?php if (!empty($dadosParaView['proximasTarefasTabela'])): ?>
        <table class="tabela-tarefas">
        <!-- border="1" cellpadding="5" cellspacing="0" style="width: 100%; border-collapse: collapse;"-->
            <thead>
                <tr>
                    <th>ID</th><th>TÃ­tulo</th><th>Tipo</th><th>Prioridade</th><th>InÃ­cio</th><th>Fim</th><th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dadosParaView['proximasTarefasTabela'] as $tarefa): ?>
                    <tr>
                        <td><?= htmlspecialchars($tarefa['TASK_ID']) ?></td>
                        <td><?= htmlspecialchars($tarefa['TASK_TITULO']) ?></td>
                        <td><?= htmlspecialchars($tarefa['TASK_TIPOTAREFA']) ?></td>
                        <td><?= htmlspecialchars($tarefa['TASK_PRIORIDADE']) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($tarefa['TASK_DATAINICIO'])) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($tarefa['TASK_DATAFIM'])) ?></td>
                        <td><?= htmlspecialchars($tarefa['TASK_STATUS']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?><p class="sem-tarefas-info">Sem tarefas prÃ³ximas.</p><?php endif; ?>
    </div>    

<!-- cards tabela tarefas em atraso -->
    <div class="card">    
    <div class="titulo-secao">Tarefas em atraso</div>
    <hr><br>
    <?php if (!empty($dadosParaView['tarefasAtrasadasTabela'])): ?>
        <table class="tabela-tarefas">
            <thead>
                <tr>
                    <th>ID</th><th>TÃ­tulo</th><th>Tipo</th><th>Prioridade</th><th>InÃ­cio</th><th>Vencimento</th><th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dadosParaView['tarefasAtrasadasTabela'] as $t): ?>
                    <tr>
                        <td><?= $t['TASK_ID'] ?></td>
                        <td><?= htmlspecialchars($t['TASK_TITULO']) ?></td>
                        <td><?= htmlspecialchars($t['TASK_TIPOTAREFA']) ?></td>
                        <td><?= $t['TASK_PRIORIDADE'] ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($t['TASK_DATAINICIO'])) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($t['TASK_DATAFIM'])) ?></td>
                        <td><?= $t['TASK_STATUS'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?><p class="sem-tarefas-info">Nenhuma tarefa em atraso.</p><?php endif; ?>
    </div>    

<!-- cards tabela Todas as tarefas -->
    <div class="card">
    <div class="titulo-secao">Todas as tarefas</div>
    <hr><br>
    <?php if (!empty($dadosParaView['todasTarefasTabela'])): ?>
        <table class="tabela-tarefas">
            <thead>
                <tr>
                    <th>ID</th><th>TÃ­tulo</th><th>Tipo</th><th>Prioridade</th><th>InÃ­cio</th><th>Vencimento</th><th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dadosParaView['todasTarefasTabela'] as $t): ?>
                    <tr>
                        <td><?= $t['TASK_ID'] ?></td>
                        <td><?= htmlspecialchars($t['TASK_TITULO']) ?></td>
                        <td><?= htmlspecialchars($t['TASK_TIPOTAREFA']) ?></td>
                        <td><?= $t['TASK_PRIORIDADE'] ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($t['TASK_DATAINICIO'])) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($t['TASK_DATAFIM'])) ?></td>
                        <td><?= $t['TASK_STATUS'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?><p class="sem-tarefas-info">NÃ£o hÃ¡ tarefas cadastradas.</p><?php endif; ?>
    </div>    

<!-- cards tabela tarefas realizadas -->
    <div class="card">
        <div class="titulo-secao">Ãšltimas Tarefas realizadas</div>
        <hr><br>
        <?php if (!empty($dadosParaView['ultimasTarefasRealizadasTabela'])): ?>
            <table class="tabela-tarefas">
                <thead>
                    <tr>
                        <th>ID</th><th>TÃ­tulo</th><th>Tipo</th><th>Prioridade</th><th>InÃ­cio</th><th>Vencimento</th><th>Data RealizaÃ§Ã£o</th><th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dadosParaView['ultimasTarefasRealizadasTabela'] as $t): ?>
                    <tr>
                        <td><?= $t['TASK_ID'] ?></td>
                        <td><?= htmlspecialchars($t['TASK_TITULO']) ?></td>
                        <td><?= htmlspecialchars($t['TASK_TIPOTAREFA']) ?></td>
                        <td><?= $t['TASK_PRIORIDADE'] ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($t['TASK_DATAINICIO'])) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($t['TASK_DATAFIM'])) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($t['TASK_DATAREALIZACAO'])) ?></td>
                        <td><?= $t['TASK_STATUS'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?><p class="sem-tarefas-info">Sem tarefas concluÃ­das.</p><?php endif; ?>
    </div>    



```n
## Arquivo: views\home\home_legado.php
```php
<!-- Menu lateral -->
<div style="
    position: fixed;
    left: 20px;
    top: 40%;
    transform: translateY(-50%);
    width: 150px;
    padding: 20px;
    border: 1px solid black;
">
    <h3>Menu</h3>
    <ul style="list-style: none; padding: 0;">
        <li><a href="index.php?controller=novaTarefa&method=novaTarefa">Nova Tarefa</a></li>
        <li><a href="index.php?controller=tarefa&method=gestaoTarefa">Minhas tarefas</a></li>
        <li><a href="index.php?controller=estatisticas&method=estatisticas">EstatÃ­sticas</a></li>
        <li><a href="index.php?controller=perfil&method=meuPerfil">Meu Perfil</a></li>
        <li><a href="index.php?controller=definicoes&method=definicoes">DefiniÃ§Ãµes</a></li>
        <li><a href="index.php?controller=auth&method=logout">Logout</a></li>
    </ul>
</div>

<!-- Card headers de boas-vindas -->
<div class="card card-headers">
    <h1>Bonjour, <?= htmlspecialchars($dadosParaView['nomeParaExibir']) ?>!</h1>
</div>

<!-- cards estatisticas-->

<!-- Linha divisÃ³ria -->
<div style="
    height: 1px;
    background-color: black;
    margin-bottom: 10px;
    margin-left: 220px;
    margin-right: 220px;
"></div>

<!-- DIV PAI dos Cards estatÃ­sticos -->
<div style="
    display: flex;
    justify-content: space-between;
    gap: 20px;
    margin-left: 220px;
    margin-right: 220px;
    margin-bottom: 20px;
">

    <!-- Card: PrÃ³ximas Tarefas -->
    <div style="border: 1px solid black; padding: 20px; width: 48%; display: inline-block; margin: 1%;">
    <h3>PrÃ³ximas Tarefas</h3>
    <p style="font-size: 24px; font-weight: bold;">
        <?= isset($dadosParaView['proximasTarefasQtd']) ? $dadosParaView['proximasTarefasQtd'] : '0' ?>
    </p>
    </div>

    <!-- card 2: Qtd tarefas concluidas ult 30 dias -->
    <div style="border: 1px solid black; padding: 15px; flex: 1 1 14%; min-width: 120px;">
        <h4>Quantidade de tarefas concluÃ­das nos Ãºltimos 30 dias</h4>
        <p><?= $dadosParaView['qtdConcluidasUlt30Dias'] ?? 0 ?></p>
    </div>

    <!-- card 3: Total de tarefas cadastradas -->
    <div style="border: 1px solid black; padding: 15px; flex: 1 1 14%; min-width: 120px;">
        <h4>Total de tarefas cadastradas</h4>
        <p><?= $dadosParaView['totalTarefas'] ?? 0 ?></p>
    </div>

    <!-- card 4: Alta prioridade -->
    <div style="border: 1px solid black; padding: 15px; flex: 1 1 14%; min-width: 120px;">
        <h4>Alta prioridade</h4>
        <p><?= $dadosParaView['tarefasAltaPrioridade'] ?? 0 ?></p>
    </div>

    <!-- card 5: Tarefas Pendentes -->
    <div style="border: 1px solid black; padding: 15px; flex: 1 1 14%; min-width: 120px;">
        <h4>Tarefas Pendentes</h4>
        <p><?= $dadosParaView['tarefasPendentes'] ?? 0 ?></p>
    </div>

    <!-- card 6: Tarefas atrasadas -->
    <div style="border: 1px solid black; padding: 15px; flex: 1 1 14%; min-width: 120px;">
        <h4>Tarefas atrasadas</h4>
        <p><?= $dadosParaView['tarefasAtrasadas'] ?? 0 ?></p>
    </div>

</div>

<!-- cards tabela prox tarefas -->
<div style="border: 1px solid black; margin-left: 220px; margin-right: 220px; padding: 15px; margin-bottom: 20px;">
    <h3>PrÃ³ximas tarefas</h3>

    <?php if (!empty($dadosParaView['proximasTarefasTabela'])): ?>
        <table border="1" cellpadding="5" cellspacing="0" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>TÃ­tulo</th>
                    <th>Tipo</th>
                    <th>Prioridade</th>
                    <th>InÃ­cio</th>
                    <th>Fim</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dadosParaView['proximasTarefasTabela'] as $tarefa): ?>
                    <tr>
                        <td><?= htmlspecialchars($tarefa['TASK_ID']) ?></td>
                        <td><?= htmlspecialchars($tarefa['TASK_TITULO']) ?></td>
                        <td><?= htmlspecialchars($tarefa['TASK_TIPOTAREFA']) ?></td>
                        <td><?= htmlspecialchars($tarefa['TASK_PRIORIDADE']) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($tarefa['TASK_DATAINICIO'])) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($tarefa['TASK_DATAFIM'])) ?></td>
                        <td><?= htmlspecialchars($tarefa['TASK_STATUS']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Sem tarefas prÃ³ximas.</p>
    <?php endif; ?>
</div>


<!-- cards tabela tarefas em atraso-->
<div style="border: 1px solid black; margin-left: 220px; margin-right: 220px; padding: 15px; margin-bottom: 20px;">
    <h3>Tarefas em atraso</h3>
    <?php if (!empty($dadosParaView['tarefasAtrasadasTabela'])): ?>
        <table border="1" cellpadding="8" cellspacing="0" width="100%" style="border-collapse: collapse;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>TÃ­tulo</th>
                    <th>Tipo</th>
                    <th>Prioridade</th>
                    <th>InÃ­cio</th>
                    <th>Vencimento</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dadosParaView['tarefasAtrasadasTabela'] as $t): ?>
                    <tr>
                        <td><?= $t['TASK_ID'] ?></td>
                        <td><?= htmlspecialchars($t['TASK_TITULO']) ?></td>
                        <td><?= htmlspecialchars($t['TASK_TIPOTAREFA']) ?></td>
                        <td><?= $t['task_prioridade'] ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($t['TASK_DATAINICIO'])) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($t['TASK_DATAFIM'])) ?></td>
                        <td><?= $t['task_status'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Nenhuma tarefa em atraso.</p>
    <?php endif; ?>
</div>

<!-- cards tabela Todas as tarefas -->
<div style="border: 1px solid black; margin-left: 220px; margin-right: 220px; padding: 15px; margin-bottom: 20px;">
    <h3>Todas as tarefas</h3>
    <?php if (!empty($dadosParaView['todasTarefasTabela'])): ?>
        <table border="1" cellpadding="8" cellspacing="0" width="100%" style="border-collapse: collapse;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>TÃ­tulo</th>
                    <th>Tipo</th>
                    <th>Prioridade</th>
                    <th>InÃ­cio</th>
                    <th>Vencimento</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dadosParaView['todasTarefasTabela'] as $t): ?>
                    <tr>
                        <td><?= $t['TASK_ID'] ?></td>
                        <td><?= htmlspecialchars($t['TASK_TITULO']) ?></td>
                        <td><?= htmlspecialchars($t['TASK_TIPOTAREFA']) ?></td>
                        <td><?= $t['TASK_PRIORIDADE'] ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($t['TASK_DATAINICIO'])) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($t['TASK_DATAFIM'])) ?></td>
                        <td><?= $t['TASK_STATUS'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>NÃ£o hÃ¡ tarefas cadastradas.</p>
    <?php endif; ?>
</div>

<!-- cards tabela tarefas realizadas -->
<div style="border: 1px solid black; margin-left: 220px; margin-right: 220px; padding: 15px; margin-bottom: 20px;">
    <h3>Ãšltimas Tarefas realizadas</h3>
    <?php if (!empty($dadosParaView['ultimasTarefasRealizadasTabela'])): ?>
        <table border="1" cellpadding="8" cellspacing="0" width="100%" style="border-collapse: collapse;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>TÃ­tulo</th>
                    <th>Tipo</th>
                    <th>Prioridade</th>
                    <th>InÃ­cio</th>
                    <th>Vencimento</th>
                    <th>Data RealizaÃ§Ã£o</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dadosParaView['ultimasTarefasRealizadasTabela'] as $t): ?>
                    <tr>
                        <td><?= $t['TASK_ID'] ?></td>
                        <td><?= htmlspecialchars($t['TASK_TITULO']) ?></td>
                        <td><?= htmlspecialchars($t['TASK_TIPOTAREFA']) ?></td>
                        <td><?= $t['TASK_PRIORIDADE'] ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($t['TASK_DATAINICIO'])) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($t['TASK_DATAFIM'])) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($t['TASK_DATAREALIZACAO'])) ?></td>
                        <td><?= $t['TASK_STATUS'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Sem tarefas concluÃ­das.</p>
    <?php endif; ?>
</div>

<!-- Linha divisÃ³ria -->
<div style="
    height: 1px;
    background-color: black;
    margin-bottom: 10px;
    margin-left: 220px;
    margin-right: 220px;
"></div>

<!-- Footer fixo -->
<footer style="
    position: fixed;
    border: 1px solid black;
    padding: 10px 20px;
    bottom: 0;
    left: 220px; /* respeita a largura da barra lateral */
    right: 220px;
    background: #fff;
    z-index: 999;
">
    <p align="right">&copy; <?= htmlspecialchars($dadosParaView['anoAtual']) ?> Organizador. Todos os direitos reservados.</p>
</footer>
<div style="height: 80px;"></div>

```n
## Arquivo: views\tarefa\detalhesTarefa.php
```php
<?php
if (!isset($dadosParaView)) {
    echo "ERRO: dadosParaView nÃ£o estÃ¡ definido.";
    exit;
}

// Detecta se estÃ¡ sendo carregada diretamente (fora do modal via fetch)
$direto = !isset($_SERVER['HTTP_X_REQUESTED_WITH']);
?>

<?php if ($direto): ?>
    <!-- Breadcrumb -->
    <div style="margin-left: 220px; margin-right: 220px; margin-top: 40px; margin-bottom: 10px;">
        <p style="font-size: 14px; color: #555;">
            <a href="index.php?controller=home&method=index" style="text-decoration: none; color: #555;">
                Home
            </a> &gt; 
            <a href="index.php?controller=tarefa&method=gestaoTarefa" style="text-decoration: none; color: #555;">
                Minhas tarefas
            </a> &gt; 
            Detalhes
        </p>
    </div>

    <!-- Card principal -->
    <div style="border: 1px solid black; padding: 20px; margin-left: 220px; margin-right: 220px; margin-bottom: 20px; position: relative;">
        <!-- BotÃ£o X para voltar -->
        <a href="index.php?controller=tarefa&method=gestaoTarefa" 
           style="position: absolute; top: 10px; right: 15px; text-decoration: none; font-size: 20px; font-weight: bold; color: #000;">
            X
        </a>

        <!-- TÃ­tulo -->
        <h1>Detalhes</h1>
<?php else: ?>
    <!-- Quando for modal, tÃ­tulo simples -->
    <h2>Detalhes da Tarefa</h2>
<?php endif; ?>

<!-- ExibiÃ§Ã£o dos campos -->
<p><strong>TÃ­tulo:</strong> <?= htmlspecialchars($dadosParaView['titulo'] ?? '') ?></p>
<p><strong>Tipo:</strong> <?= htmlspecialchars($dadosParaView['tipo'] ?? '') ?></p>
<p><strong>Prioridade:</strong> <?= htmlspecialchars($dadosParaView['prioridade'] ?? '') ?></p>
<p><strong>Data de Vencimento:</strong> 
    <?= isset($dadosParaView['dataVencimento']) ? date('d/m/Y H:i', strtotime($dadosParaView['dataVencimento'])) : '' ?>
</p>
<p><strong>DescriÃ§Ã£o:</strong><br>
    <?= nl2br(htmlspecialchars($dadosParaView['descricao'] ?? '')) ?>
</p>

<?php if ($direto): ?>
    </div> <!-- fecha card -->

    <!-- RodapÃ© padrÃ£o -->
    <footer style="position: fixed; border: 1px solid black; padding: 20px; bottom: 0; left: 220px; right: 220px; background: none; z-index: 999;">
        <p align="right">&copy; <?= date('Y') ?> Organizador. Todos os direitos reservados.</p>
    </footer>
<?php endif; ?>

```n
## Arquivo: views\tarefa\detalhesTarefa_legado.php
```php
<?php
if (!isset($dadosParaView)) {
    echo "ERRO: dadosParaView nÃ£o estÃ¡ definido.";
    exit;
}?>

<!-- Breadcrumb -->
<div style="margin-left: 220px; margin-right: 220px; margin-top: 40px; margin-bottom: 10px;">
    <p style="font-size: 14px; color: #555;">
        <a href="index.php?controller=home&method=index" style="text-decoration: none; color: #555;">
            Home
        </a> &gt; 
        <a href="index.php?controller=tarefa&method=gestaoTarefa" style="text-decoration: none; color: #555;">
            Minhas tarefas
        </a> &gt; 
        Detalhes
    </p>
</div>

<!-- Card principal -->
<div style="border: 1px solid black; padding: 20px; margin-left: 220px; margin-right: 220px; margin-bottom: 20px; position: relative;">

    <!-- BotÃ£o X para voltar -->
    <a href="index.php?controller=tarefa&method=gestaoTarefa" 
       style="position: absolute; top: 10px; right: 15px; text-decoration: none; font-size: 20px; font-weight: bold; color: #000;">
        X
    </a>

    <!-- TÃ­tulo -->
    <h1>Detalhes</h1>

    <!-- ExibiÃ§Ã£o dos campos -->
    <p><strong>TÃ­tulo:</strong> <?= htmlspecialchars($dadosParaView['titulo'] ?? '') ?></p>
<p><strong>Tipo:</strong> <?= htmlspecialchars($dadosParaView['tipo'] ?? '') ?></p>
<p><strong>Prioridade:</strong> <?= htmlspecialchars($dadosParaView['prioridade'] ?? '') ?></p>
<p><strong>Data de Vencimento:</strong> 
    <?= isset($dadosParaView['dataVencimento']) ? date('d/m/Y H:i', strtotime($dadosParaView['dataVencimento'])) : '' ?>
</p>
<p><strong>DescriÃ§Ã£o:</strong><br>
    <?= nl2br(htmlspecialchars($dadosParaView['descricao'] ?? '')) ?>
</p>

</div>

<!-- RodapÃ© padrÃ£o -->
<footer style="position: fixed; border: 1px solid black; padding: 20px; bottom: 0; left: 220px; right: 220px; background: none; z-index: 999;">
    <p align="right">&copy; <?= date('Y') ?> Organizador. Todos os direitos reservados.</p>
</footer>

```n
## Arquivo: views\tarefa\editarTarefa.php
```php
<?php
if (!isset($dadosParaView)) {
    echo "ERRO: dadosParaView nÃ£o estÃ¡ definido.";
    exit;
}

// Detecta se estÃ¡ sendo carregada diretamente (fora do modal via fetch)
$direto = !isset($_SERVER['HTTP_X_REQUESTED_WITH']);
?>

<?php if ($direto): ?>
    <!-- Breadcrumb -->
    <div style="margin-left: 220px; margin-right: 220px; margin-top: 40px; margin-bottom: 10px;">
        <p style="font-size: 14px; color: #555;">
            <a href="index.php?controller=home&method=index" style="text-decoration: none; color: #555;">
                Home
            </a> &gt; 
            <a href="index.php?controller=tarefa&method=gestaoTarefa" style="text-decoration: none; color: #555;">
                Minhas tarefas
            </a> &gt; 
            Editar
        </p>
    </div>

    <!-- Card principal -->
    <div style="border: 1px solid black; padding: 20px; margin-left: 220px; margin-right: 220px; margin-bottom: 20px; position: relative;">
        <!-- BotÃ£o X para voltar -->
        <a href="index.php?controller=tarefa&method=gestaoTarefa" 
           style="position: absolute; top: 10px; right: 15px; text-decoration: none; font-size: 20px; font-weight: bold; color: #000;">
            X
        </a>

        <!-- TÃ­tulo -->
        <h1>Editar Tarefa</h1>
<?php else: ?>
    <!-- Quando for modal -->
    <h2>Editar Tarefa</h2>
<?php endif; ?>

<!-- FormulÃ¡rio de ediÃ§Ã£o -->
<form method="POST" action="index.php?controller=tarefa&method=atualizar" class="modal-form" style="margin-top: 20px;">
    <input type="hidden" name="task_id" value="<?= htmlspecialchars($dadosParaView['id'] ?? '') ?>">

    <label for="titulo">TÃ­tulo*</label><br>
    <input type="text" id="titulo" name="titulo" required
        value="<?= htmlspecialchars($dadosParaView['titulo'] ?? '') ?>"><br>

    <label for="tipotarefa">Tipo*</label><br>
    <input type="text" id="tipotarefa" name="tipotarefa" required
        value="<?= htmlspecialchars($dadosParaView['tipo'] ?? '') ?>"><br>

    <label>Prioridade*</label><br>
    <div class="radiobox-modais">
        <label><input type="radio" name="prioridade" value="baixa" <?= (isset($dadosParaView['prioridade']) && strtolower($dadosParaView['prioridade']) === 'baixa') ? 'checked' : '' ?>> Baixa</label>
        <label><input type="radio" name="prioridade" value="mÃ©dia" <?= (isset($dadosParaView['prioridade']) && strtolower($dadosParaView['prioridade']) === 'mÃ©dia') ? 'checked' : '' ?>> MÃ©dia</label>
        <label><input type="radio" name="prioridade" value="alta" <?= (isset($dadosParaView['prioridade']) && strtolower($dadosParaView['prioridade']) === 'alta') ? 'checked' : '' ?>> Alta</label>
    </div>

    <label for="datafim">Data de Vencimento*</label><br>
    <input type="datetime-local" id="datafim" name="datafim"
        value="<?= isset($dadosParaView['dataVencimento']) ? htmlspecialchars($dadosParaView['dataVencimento']) : '' ?>">

    <label for="descricao">DescriÃ§Ã£o</label><br>
    <textarea id="descricao" name="descricao"
        style="height: 120px; resize: none; overflow-y: auto;"
        maxlength="280"><?= htmlspecialchars($dadosParaView['descricao'] ?? '') ?></textarea>

    <div class="acoes-modal">
        <button type="submit">Salvar AlteraÃ§Ãµes</button>
    </div>
</form>

<?php if ($direto): ?>
    </div> <!-- fecha card -->

    <!-- RodapÃ© padrÃ£o -->
    <footer style="position: fixed; border: 1px solid black; padding: 20px; bottom: 0; left: 220px; right: 220px; background: none; z-index: 999;">
        <p align="right">&copy; <?= date('Y') ?> Organizador. Todos os direitos reservados.</p>
    </footer>
<?php endif; ?>
```n
## Arquivo: views\tarefa\editarTarefa.php_legado
```markdown
<?php
if (!isset($dadosParaView)) {
    echo "ERRO: dadosParaView nÃ£o estÃ¡ definido.";
    exit;
}

// Detecta se estÃ¡ sendo carregada diretamente (fora do modal via fetch)
$direto = !isset($_SERVER['HTTP_X_REQUESTED_WITH']);
?>

<?php if ($direto): ?>
    <!-- Breadcrumb -->
    <div style="margin-left: 220px; margin-right: 220px; margin-top: 40px; margin-bottom: 10px;">
        <p style="font-size: 14px; color: #555;">
            <a href="index.php?controller=home&method=index" style="text-decoration: none; color: #555;">
                Home
            </a> &gt; 
            <a href="index.php?controller=tarefa&method=gestaoTarefa" style="text-decoration: none; color: #555;">
                Minhas tarefas
            </a> &gt; 
            Editar
        </p>
    </div>

    <!-- Card principal -->
    <div style="border: 1px solid black; padding: 20px; margin-left: 220px; margin-right: 220px; margin-bottom: 20px; position: relative;">
        <!-- BotÃ£o X para voltar -->
        <a href="index.php?controller=tarefa&method=gestaoTarefa" 
           style="position: absolute; top: 10px; right: 15px; text-decoration: none; font-size: 20px; font-weight: bold; color: #000;">
            X
        </a>

        <!-- TÃ­tulo -->
        <h1>Editar Tarefa</h1>
<?php else: ?>
    <!-- Quando for modal -->
    <h2>Editar Tarefa</h2>
<?php endif; ?>

<!-- FormulÃ¡rio de ediÃ§Ã£o -->
<form method="POST" action="index.php?controller=tarefa&method=atualizar" style="margin-top: 20px;">
    <input type="hidden" name="task_id" value="<?= htmlspecialchars($dadosParaView['id'] ?? '') ?>">

    <label for="titulo" style="font-weight: bold;">TÃ­tulo*</label><br>
    <input type="text" id="titulo" name="titulo" required
        style="width: 100%; padding: 8px; margin-bottom: 20px; border: 1px solid #000;"
        value="<?= htmlspecialchars($dadosParaView['titulo'] ?? '') ?>"><br>

    <label for="tipotarefa" style="font-weight: bold;">Tipo*</label><br>
    <input type="text" id="tipotarefa" name="tipotarefa" required
        style="width: 100%; padding: 8px; margin-bottom: 20px; border: 1px solid #000;"
        value="<?= htmlspecialchars($dadosParaView['tipo'] ?? '') ?>"><br>

    <label style="font-weight: bold;">Prioridade*</label><br>
    <div style="display: flex; gap: 10px; margin-bottom: 20px;">
        <label><input type="radio" name="prioridade" value="baixa" <?= (isset($dadosParaView['prioridade']) && strtolower($dadosParaView['prioridade']) === 'baixa') ? 'checked' : '' ?>> Baixa</label>
        <label><input type="radio" name="prioridade" value="mÃ©dia" <?= (isset($dadosParaView['prioridade']) && strtolower($dadosParaView['prioridade']) === 'mÃ©dia') ? 'checked' : '' ?>> MÃ©dia</label>
        <label><input type="radio" name="prioridade" value="alta" <?= (isset($dadosParaView['prioridade']) && strtolower($dadosParaView['prioridade']) === 'alta') ? 'checked' : '' ?>> Alta</label>
    </div>

    <label for="datafim" style="font-weight: bold;">Data de Vencimento*</label><br>
    <input type="datetime-local" id="datafim" name="datafim"
        value="<?= isset($dadosParaView['dataVencimento']) ? htmlspecialchars($dadosParaView['dataVencimento']) : '' ?>"
        style="width: 100%; padding: 8px; margin-bottom: 20px; border: 1px solid #000;">

    <label for="descricao" style="font-weight: bold;">DescriÃ§Ã£o</label><br>
    <textarea id="descricao" name="descricao"
        style="width: 100%; height: 120px; padding: 8px; margin-bottom: 20px; border: 1px solid #000; resize: none; overflow-y: auto;"
        maxlength="280"><?= htmlspecialchars($dadosParaView['descricao'] ?? '') ?></textarea>

    <div style="text-align: right; margin-top: 20px;">
        <button type="submit">Salvar AlteraÃ§Ãµes</button>
    </div>
</form>

<?php if ($direto): ?>
    </div> <!-- fecha card -->

    <!-- RodapÃ© padrÃ£o -->
    <footer style="position: fixed; border: 1px solid black; padding: 20px; bottom: 0; left: 220px; right: 220px; background: none; z-index: 999;">
        <p align="right">&copy; <?= date('Y') ?> Organizador. Todos os direitos reservados.</p>
    </footer>
<?php endif; ?>

```n
## Arquivo: views\tarefa\editarTarefa_legado.php
```php
<?php
// $dadosParaView traz os dados da tarefa para preencher os campos no formulÃ¡rio
?>

<!-- Breadcrumb -->
<div style="margin-left: 220px; margin-right: 220px; margin-top: 40px; margin-bottom: 10px;">
    <p style="font-size: 14px; color: #555;">
        <a href="index.php?controller=home&method=index" style="text-decoration: none; color: #555;">Home</a> &gt;
        <a href="index.php?controller=tarefa&method=gestaoTarefa" style="text-decoration: none; color: #555;">Minhas tarefas</a> &gt;
        Editar
    </p>
</div>

<!-- Card principal -->
<div style="border: 1px solid black; padding: 20px; margin-left: 220px; margin-right: 220px; margin-bottom: 20px; position: relative;">
    
<!-- BotÃ£o X no canto superior direito -->
    <a href="index.php?controller=tarefa&method=gestaoTarefa" 
       style="position: absolute; top: 10px; right: 15px; text-decoration: none; font-size: 20px; font-weight: bold; color: #000;">
        X
    </a>

<h1>Editar</h1>

    <form action="index.php?controller=tarefa&method=atualizar" method="POST" style="max-width: 600px;">
        <input type="hidden" name="task_id" value="<?= htmlspecialchars($dadosParaView['id'] ?? '') ?>">

        <label for="titulo">TÃ­tulo:</label><br>
        <input type="text" id="titulo" name="titulo" required
               value="<?= htmlspecialchars($dadosParaView['titulo'] ?? '') ?>" style="width: 100%;"><br><br>

        <label for="tipotarefa">Tipo da tarefa:</label><br>
        <input type="text" id="tipotarefa" name="tipotarefa" required
               value="<?= htmlspecialchars($dadosParaView['tipo'] ?? '') ?>" style="width: 100%;"><br><br>

        <label for="prioridade">Prioridade:</label><br>
        <select id="prioridade" name="prioridade" required style="width: 100%;">
            <?php
            $prioridades = ['alta', 'mÃ©dia', 'baixa'];
            $prioridadeSelecionada = strtolower($dadosParaView['prioridade'] ?? 'mÃ©dia');
            foreach ($prioridades as $p):
            ?>
                <option value="<?= $p ?>" <?= ($p === $prioridadeSelecionada) ? 'selected' : '' ?>>
                    <?= ucfirst($p) ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="datafim">Data de vencimento:</label><br>
        <input type="datetime-local" id="datafim" name="datafim" required
               value="<?= htmlspecialchars($dadosParaView['dataVencimento'] ?? '') ?>" style="width: 100%;"><br><br>

        <!-- Campo Status -->
        <label for="status">Status:</label><br>
        <select id="status" name="status" required style="width: 100%;">
            <?php
            $statuses = ['pendente', 'concluÃ­da', 'cancelada'];
            $statusSelecionado = strtolower($dadosParaView['status'] ?? 'pendente');
            foreach ($statuses as $s):
            ?>
                <option value="<?= $s ?>" <?= ($s === $statusSelecionado) ? 'selected' : '' ?>>
                    <?= ucfirst($s) ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>
        
        <label for="descricao">DescriÃ§Ã£o:</label><br>
        <textarea id="descricao" name="descricao" rows="5" maxlength="280"
                  style="width: 100%;"><?= htmlspecialchars($dadosParaView['descricao'] ?? '') ?></textarea><br><br>

        <button type="submit">
        Salvar alteraÃ§Ãµes</button>
        
    </form>
</div>

<!-- RodapÃ© padrÃ£o -->
<footer style="position: fixed; border: 1px solid black; padding: 20px; bottom: 0; left: 220px; right: 220px; background: none; z-index: 999;">
    <p align="right">&copy; <?= date('Y') ?> Organizador. Todos os direitos reservados.</p>
</footer>

```n
## Arquivo: views\tarefa\gestaoTarefa.php
```php
<!-- BotÃ£o de retorno padrÃ£o no canto superior esquerdo -->
<div style="position: absolute; top: 20px; left: 20px;">
    <a href="index.php?controller=home&method=index"
       style="
           display: inline-block;
           padding: 10px 15px;
           background-color: white;
           border: 1px solid black;
           text-decoration: none;
           color: black;
           font-weight: bold;
       ">
        &#8592; Voltar
    </a>
</div>

<?php if (!empty($dadosParaView['sucesso'])): ?>
    <div style="color: green; font-weight: bold; margin: 10px 220px;">
        <?= htmlspecialchars($dadosParaView['sucesso']) ?>
    </div>
<?php endif; ?>

<!-- Card header -->
<div class="card-headers">
    <h1>Minhas Tarefas</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.</p>
</div>

<!-- Breadcrumb -->
<div class="breadcrumbs">
    <p class="breadcrumbs-p">
        <a class="breadcrumbs-a" href="index.php?controller=home&method=index">
            Home
        </a> &gt; Minhas tarefas
    </p>
</div>

<div class="card">
<!-- BotÃ£o nova tarefa -->
<div>
    <button onclick="abrirModal()">+ Nova Tarefa</button>
</div>
<br>
<!-- Tabela para gestÃ£o de tarefas -->
<table class="tabela-tarefas">
    <thead>
        <tr>
            <th>TÃ­tulo</th>
            <th>Tipo da Tarefa</th>
            <th>Vencimento da Tarefa</th>
            <th>Prioridade</th>
            <th>Status</th>
            <th style="text-align: center;">AÃ§Ãµes</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($tarefas)): ?>
            <?php foreach ($tarefas as $tarefa): ?>
                <tr>
                    <td><?= htmlspecialchars($tarefa['TASK_TITULO']) ?></td>
                    <td><?= htmlspecialchars($tarefa['TASK_TIPOTAREFA']) ?></td>
                    <td><?= htmlspecialchars(date('d/m/Y H:i', strtotime($tarefa['TASK_DATAFIM']))) ?></td>
                    <td>
                        <span class="tag prioridade-<?= strtolower($tarefa['TASK_PRIORIDADE']) ?>">
                            <?= htmlspecialchars(ucfirst($tarefa['TASK_PRIORIDADE'])) ?>
                        </span>
                    </td>
                    <td>
                        <span class="status status-<?= strtolower($tarefa['TASK_STATUS']) ?>">
                            <?= htmlspecialchars(ucfirst($tarefa['TASK_STATUS'])) ?>
                        </span>
                    </td>
                    <td class="acoes">
                        <button class="btn ver" onclick="abrirModalVer(<?= $tarefa['TASK_ID'] ?>)">
                            <i class="bi bi-eye"></i>
                        </button>
                        <button class="btn editar" onclick="abrirModalEditar(<?= $tarefa['TASK_ID'] ?>)">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn apagar" onclick="abrirModalApagar(<?= $tarefa['TASK_ID'] ?>)">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="sem-tarefas">Nenhuma tarefa encontrada.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<div class="area-segura"></div>

</div>
```n
## Arquivo: views\tarefa\gestaoTarefa.php_legado
```markdown
<!-- BotÃ£o de retorno padrÃ£o no canto superior esquerdo -->
<div style="position: absolute; top: 20px; left: 20px;">
    <a href="index.php?controller=home&method=index"
       style="
           display: inline-block;
           padding: 10px 15px;
           background-color: white;
           border: 1px solid black;
           text-decoration: none;
           color: black;
           font-weight: bold;
       ">
        &#8592; Voltar
    </a>
</div>

<?php if (!empty($dadosParaView['sucesso'])): ?>
    <div style="color: green; font-weight: bold; margin: 10px 220px;">
        <?= htmlspecialchars($dadosParaView['sucesso']) ?>
    </div>
<?php endif; ?>

<!-- Card header -->
<div class="card-headers">
    <h1>Minhas Tarefas</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.</p>
</div>

<!-- Breadcrumb -->
<div class="breadcrumbs">
    <p class="breadcrumbs-p">
        <a class="breadcrumbs-a" href="index.php?controller=home&method=index">
            Home
        </a> &gt; Minhas tarefas
    </p>
</div>

<div class="card">
<!-- BotÃ£o nova tarefa -->
<div>
    <button onclick="abrirModal()">+ Nova Tarefa</button>
</div>
<br>
<!-- Tabela para gestÃ£o de tarefas -->
<table class="tabela-tarefas">
    <thead>
        <tr>
            <th>TÃ­tulo</th>
            <th>Tipo da Tarefa</th>
            <th>Vencimento da Tarefa</th>
            <th>Prioridade</th>
            <th>Status</th>
            <th style="text-align: center;">AÃ§Ãµes</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($tarefas)): ?>
            <?php foreach ($tarefas as $tarefa): ?>
                <tr>
                    <td><?= htmlspecialchars($tarefa['TASK_TITULO']) ?></td>
                    <td><?= htmlspecialchars($tarefa['TASK_TIPOTAREFA']) ?></td>
                    <td><?= htmlspecialchars(date('d/m/Y H:i', strtotime($tarefa['TASK_DATAFIM']))) ?></td>
                    <td>
                        <span class="tag prioridade-<?= strtolower($tarefa['TASK_PRIORIDADE']) ?>">
                            <?= htmlspecialchars(ucfirst($tarefa['TASK_PRIORIDADE'])) ?>
                        </span>
                    </td>
                    <td>
                        <span class="status status-<?= strtolower($tarefa['TASK_STATUS']) ?>">
                            <?= htmlspecialchars(ucfirst($tarefa['TASK_STATUS'])) ?>
                        </span>
                    </td>
                    <td class="acoes">
                        <button class="btn ver" onclick="abrirModalVer(<?= $tarefa['TASK_ID'] ?>)">
                            <i class="bi bi-eye"></i>
                        </button>
                        <button class="btn editar" onclick="abrirModalEditar(<?= $tarefa['TASK_ID'] ?>)">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn apagar" onclick="abrirModalApagar(<?= $tarefa['TASK_ID'] ?>)">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="sem-tarefas">Nenhuma tarefa encontrada.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<div class="area-segura"></div>

</div>








```n
## Arquivo: views\tarefa\gestaoTarefa_legado.php
```php
<!-- BotÃ£o de retorno padrÃ£o no canto superior esquerdo -->
<div style="position: absolute; top: 20px; left: 20px;">
    <a href="index.php?controller=home&method=index"
       style="
           display: inline-block;
           padding: 10px 15px;
           background-color: white;
           border: 1px solid black;
           text-decoration: none;
           color: black;
           font-weight: bold;
       ">
        &#8592; Voltar
    </a>
</div>



<?php if (!empty($dadosParaView['sucesso'])): ?>
    <div style="color: green; font-weight: bold; margin: 10px 220px;">
        <?= htmlspecialchars($dadosParaView['sucesso']) ?>
    </div>
<?php endif; ?>

<!-- Card header -->
<div class="card card-headers">
    <h1>Minhas Tarefas</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.</p>
</div>

<!-- Breadcrumb -->
<div style="margin-left: 220px; margin-right: 220px; margin-top: 40px; margin-bottom: 10px;">
    <p style="font-size: 14px; color: #555;">
        <a href="index.php?controller=home&method=index" style="text-decoration: none; color: #555;">
            Home
        </a> &gt; Minhas tarefas
    </p>
</div>

<!-- BotÃ£o nova tarefa -->
<div style="margin: 20px 220px 10px 220px;">
    <form action="index.php" method="GET" style="display: inline;">
        <input type="hidden" name="controller" value="novaTarefa">
        <input type="hidden" name="method" value="novaTarefa">
        <button type="submit">+ Nova Tarefa</button>
    </form>
</div>

<!-- Tabela para gestÃ£o de tarefas -->
<table border="1" cellpadding="8" cellspacing="0" style="margin: 0 220px 20px 220px; width: calc(100% - 440px); border-collapse: collapse;">
    <thead>
        <tr>
            <th>TÃ­tulo</th>
            <th>Tipo da Tarefa</th>
            <th>Vencimento da Tarefa</th>
            <th>Prioridade</th>
            <th>Status</th>
            <th style="text-align: center;">AÃ§Ãµes</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($tarefas)): ?>

                  <?php foreach ($tarefas as $tarefa): ?>
                <tr>
                    <td><?= htmlspecialchars($tarefa['TASK_TITULO']) ?></td>
                    <td><?= htmlspecialchars($tarefa['TASK_TIPOTAREFA']) ?></td>
                    <td><?= htmlspecialchars(date('d/m/Y H:i', strtotime($tarefa['TASK_DATAFIM']))) ?></td>
                    <td><?= htmlspecialchars(ucfirst($tarefa['TASK_PRIORIDADE'])) ?></td>
                    <td><?= htmlspecialchars(ucfirst($tarefa['TASK_STATUS'])) ?></td>
                    <td style="text-align: center;">

                        <!-- BotÃ£o Ver usando GET -->
                        <a href="index.php?controller=tarefa&method=detalhesTarefa&task_id=<?= $tarefa['TASK_ID'] ?>"
                           style="text-decoration: none;">
                            <button type="button">Ver</button>
                        </a>

                        <!-- BotÃ£o Editar (mantido com POST) -->
                        <a href="index.php?controller=tarefa&method=editarTarefa&task_id=<?= $tarefa['TASK_ID'] ?>"
                            style="text-decoration: none;">
                            <button type="button">Editar</button>
                        </a>

                        <!-- BotÃ£o Apagar (mantido com POST por enquanto) -->
                        <form action="index.php?controller=tarefa&method=apagar" method="POST" style="display: inline;">
                            <input type="hidden" name="task_id" value="<?= $tarefa['TASK_ID'] ?>">
                            <button type="submit" onclick="return confirm('Confirma exclusÃ£o?')">Apagar</button>
                        </form>

                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" style="text-align:center;">Nenhuma tarefa encontrada.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<!-- Footer fixo padrÃ£o -->
<footer style="
    position: fixed;
    border: 1px solid black;
    padding: 10px 20px;
    bottom: 0;
    left: 220px;
    right: 220px;
    background: #fff;
    z-index: 999;
">
    <p align="right">&copy; <?= date('Y') ?> Organizador. Todos os direitos reservados.</p>
</footer>

<!-- Footer fixo 
<footer style="
    position: fixed;
    border: 1px solid black;
    padding: 10px 20px;
    bottom: 0;
    left: 220px; 
    right: 220px;
    background: #fff;
    z-index: 999;
">
    <p align="right">&copy; <?= htmlspecialchars($dadosParaView['anoAtual']) ?> Organizador. Todos os direitos reservados.</p>
</footer>
<div style="height: 80px;"></div> -->

```n
## Arquivo: views\tarefa\novaTarefa.php
```php
<?php
// Detecta se estÃ¡ sendo carregada diretamente (fora do modal via fetch)
$direto = !isset($_SERVER['HTTP_X_REQUESTED_WITH']);
?>

<!-- ConteÃºdo da Nova Tarefa -->
<?php if ($direto): ?>
    <!-- BotÃ£o X para fechar quando acessada diretamente -->
    <a href="index.php?controller=tarefa&method=gestaoTarefa" 
       style="position: absolute; top: 10px; right: 15px; text-decoration: none; font-size: 20px; font-weight: bold; color: #000;">
        X
    </a>
<?php endif; ?>

<h1>Nova tarefa</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.</p>

<!-- Mensagem de erro, se existir -->
<?php if (!empty($dadosParaView['erro'])): ?>
    <div style="color: red; font-weight: bold; margin-bottom: 15px;">
        <?= htmlspecialchars($dadosParaView['erro']) ?>
    </div>
<?php endif; ?>

<!-- FormulÃ¡rio de Nova Tarefa -->
<form method="POST" action="index.php?controller=tarefa&method=salvar" class="modal-form" style="margin-top: 20px;">

    <!-- Campo: TÃ­tulo da Tarefa -->
    <label for="titulo">TÃ­tulo da tarefa*</label><br>
    <input type="text" id="titulo" name="titulo" required
        value="<?= isset($_POST['titulo']) ? htmlspecialchars($_POST['titulo']) : '' ?>"><br>

    <!-- Campo: Tipo da Tarefa -->
    <label for="tipotarefa">Tipo da tarefa*</label><br>
    <input type="text" id="tipotarefa" name="tipotarefa" required
        value="<?= isset($_POST['tipotarefa']) ? htmlspecialchars($_POST['tipotarefa']) : '' ?>"><br>

    <!-- Campo: Prioridade da Tarefa -->
    <label>Prioridade*</label><br>
    <div class="radiobox-modais">
        <label>
            <input type="radio" name="prioridade" value="baixa" <?= (isset($dadosParaView['prioridadePadrao']) && strtolower($dadosParaView['prioridadePadrao']) === 'baixa') ? 'checked' : '' ?>>
            Baixa
        </label>
        <label>
            <input type="radio" name="prioridade" value="mÃ©dia" <?= (isset($dadosParaView['prioridadePadrao']) && strtolower($dadosParaView['prioridadePadrao']) === 'mÃ©dia') ? 'checked' : '' ?>>
            MÃ©dia
        </label>
        <label>
            <input type="radio" name="prioridade" value="alta" <?= (isset($dadosParaView['prioridadePadrao']) && strtolower($dadosParaView['prioridadePadrao']) === 'alta') ? 'checked' : '' ?>>
            Alta
        </label>
    </div>

    <!-- Campo: Data de Vencimento -->
    <label for="datafim">Data de Vencimento*</label><br>
    <input 
        type="datetime-local"                     
        id="datafim"                             
        name="datafim"                           
        value="<?= isset($dadosParaView['dataVencimento']) ? htmlspecialchars($dadosParaView['dataVencimento']) : '' ?>" 
    >
<br>
    <!-- Campo: DescriÃ§Ã£o da Tarefa -->
    <label for="descricao">DescriÃ§Ã£o</label><br>
    <textarea 
        id="descricao" 
        name="descricao"
        placeholder="<?= isset($dadosParaView['descricaoPlaceholder']) ? htmlspecialchars($dadosParaView['descricaoPlaceholder']) : '' ?>" 
        style="
            height: 80px;  
            resize: none;   
            overflow-y: auto; 
        "
        maxlength="280"><?= isset($dadosParaView['descricaoConteudo']) ? htmlspecialchars($dadosParaView['descricaoConteudo']) : '' ?></textarea>

    <!-- BotÃ£o Salvar -->
    <div class="acoes-modal">
        <button type="submit">
            Salvar Tarefa
        </button>
    </div>
</form>
```n
## Arquivo: views\tarefa\novaTarefa.php_legado
```markdown
<?php
// Detecta se estÃ¡ sendo carregada diretamente (fora do modal via fetch)
$direto = !isset($_SERVER['HTTP_X_REQUESTED_WITH']);
?>

<!-- ConteÃºdo da Nova Tarefa -->
<?php if ($direto): ?>
    <!-- BotÃ£o X para fechar quando acessada diretamente -->
    <a href="index.php?controller=tarefa&method=gestaoTarefa" 
       style="position: absolute; top: 10px; right: 15px; text-decoration: none; font-size: 20px; font-weight: bold; color: #000;">
        X
    </a>
<?php endif; ?>

<h1>Nova tarefa</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.</p>

<!-- Mensagem de erro, se existir -->
<?php if (!empty($dadosParaView['erro'])): ?>
    <div style="color: red; font-weight: bold; margin-bottom: 15px;">
        <?= htmlspecialchars($dadosParaView['erro']) ?>
    </div>
<?php endif; ?>

<!-- FormulÃ¡rio de Nova Tarefa -->
<form method="POST" action="index.php?controller=tarefa&method=salvar" style="margin-top: 20px;">

    <!-- Campo: TÃ­tulo da Tarefa -->
    <label for="titulo" style="font-weight: bold;">TÃ­tulo da tarefa*</label><br>
    <input class="inputs-modais" type="text" id="titulo" name="titulo" required
        value="<?= isset($_POST['titulo']) ? htmlspecialchars($_POST['titulo']) : '' ?>"><br>

    <!-- Campo: Tipo da Tarefa -->
    <label for="tipotarefa" style="font-weight: bold;">Tipo da tarefa*</label><br>
    <input class="inputs-modais" type="text" id="tipotarefa" name="tipotarefa" required
        
        value="<?= isset($_POST['tipotarefa']) ? htmlspecialchars($_POST['tipotarefa']) : '' ?>"><br>

    <!-- Campo: Prioridade da Tarefa -->
    <label style="font-weight: bold;">Prioridade*</label><br>
    <div class="radiobox-modais">
        <label>
            <input type="radio" name="prioridade" value="baixa" <?= (isset($dadosParaView['prioridadePadrao']) && strtolower($dadosParaView['prioridadePadrao']) === 'baixa') ? 'checked' : '' ?>>
            Baixa
        </label>
        <label>
            <input type="radio" name="prioridade" value="mÃ©dia" <?= (isset($dadosParaView['prioridadePadrao']) && strtolower($dadosParaView['prioridadePadrao']) === 'mÃ©dia') ? 'checked' : '' ?>>
            MÃ©dia
        </label>
        <label>
            <input type="radio" name="prioridade" value="alta" <?= (isset($dadosParaView['prioridadePadrao']) && strtolower($dadosParaView['prioridadePadrao']) === 'alta') ? 'checked' : '' ?>>
            Alta
        </label>
    </div>

    <!-- Campo: Data de Vencimento -->
    <label for="datafim" style="font-weight: bold;">Data de Vencimento*</label><br>
    <input class="inputs-modais"
        type="datetime-local"                     
        id="datafim"                             
        name="datafim"                           
        value="<?= isset($dadosParaView['dataVencimento']) ? htmlspecialchars($dadosParaView['dataVencimento']) : '' ?>" 
        
    >
<br>
    <!-- Campo: DescriÃ§Ã£o da Tarefa -->
    <label for="descricao" style="font-weight: bold;">DescriÃ§Ã£o</label><br>
    <textarea 
        id="descricao" 
        name="descricao"
        placeholder="<?= isset($dadosParaView['descricaoPlaceholder']) ? htmlspecialchars($dadosParaView['descricaoPlaceholder']) : '' ?>" 
        style="
            width: 100%; 
            height: 80px;  
            padding: 8px; 
            margin-bottom: 5px; 
            border: 1px solid #000;
            resize: none;   
            overflow-y: auto; 
        "
        maxlength="280"><?= isset($dadosParaView['descricaoConteudo']) ? htmlspecialchars($dadosParaView['descricaoConteudo']) : '' ?></textarea>

    <!-- BotÃ£o Salvar -->
    <div style="text-align: right; margin-top: 5px;">
        <button type="submit">
            Salvar Tarefa
        </button>
    </div>
</form>

```n
## Arquivo: views\tarefa\novaTarefa_legado2.php
```php
<!-- EstilizaÃ§Ã£o inline bÃ¡sica temporaria -->


<!-- Card principal -->
<div style="border: 1px solid black; padding: 20px; margin-left: 220px; margin-right: 220px; margin-bottom: 20px; position: relative;">

<!-- BotÃ£o X -->
    <a href="index.php?controller=tarefa&method=gestaoTarefa" 
       style="position: absolute; top: 10px; right: 15px; text-decoration: none; font-size: 20px; font-weight: bold; color: #000;">
        X
    </a>

    <!-- TÃ­tulo -->
    <h1>Nova tarefa</h1>

    
    <!-- DescriÃ§Ã£o -->
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.</p>

    <!-- Mensagem de erro, se existir -->
<?php if (!empty($dadosParaView['erro'])): ?>
    <div style="color: red; font-weight: bold; margin-bottom: 15px;">
        <?= htmlspecialchars($dadosParaView['erro']) ?>
    </div>
<?php endif; ?>

    <!-- FormulÃ¡rio de Nova Tarefa -->
    <form method="POST" action="index.php?controller=tarefa&method=salvar" style="margin: 0 220px;">

        <!-- Campo: TÃ­tulo da Tarefa -->
        <label for="titulo" style="font-weight: bold;">TÃ­tulo da tarefa*</label><br>
        <input type="text" id="titulo" name="titulo" required
            style="width: 100%; padding: 8px; margin-bottom: 20px; border: 1px solid #000;"
            value="<?= isset($_POST['titulo']) ? htmlspecialchars($_POST['titulo']) : '' ?>"><br>

        <!-- Campo: Tipo da Tarefa -->
        <label for="tipotarefa" style="font-weight: bold;">Tipo da tarefa*</label><br>
        <input type="text" id="tipotarefa" name="tipotarefa" required
            style="width: 100%; padding: 8px; margin-bottom: 20px; border: 1px solid #000;"
            value="<?= isset($_POST['tipotarefa']) ? htmlspecialchars($_POST['tipotarefa']) : '' ?>"><br>

        <!-- Campo: Prioridade da Tarefa -->
        <label style="font-weight: bold;">Prioridade*</label><br>
        <div style="display: flex; gap: 10px; margin-bottom: 20px;">
            <label>
                <input type="radio" name="prioridade" value="baixa" <?= (isset($dadosParaView['prioridadePadrao']) && strtolower($dadosParaView['prioridadePadrao']) === 'baixa') ? 'checked' : '' ?>>
                Baixa
            </label>
            <label>
                <input type="radio" name="prioridade" value="mÃ©dia" <?= (isset($dadosParaView['prioridadePadrao']) && strtolower($dadosParaView['prioridadePadrao']) === 'mÃ©dia') ? 'checked' : '' ?>>
                MÃ©dia
            </label>
            <label>
                <input type="radio" name="prioridade" value="alta" <?= (isset($dadosParaView['prioridadePadrao']) && strtolower($dadosParaView['prioridadePadrao']) === 'alta') ? 'checked' : '' ?>>
                Alta
            </label>
        </div>

        <!-- Campo: Data de Vencimento -->
<label for="datafim" style="font-weight: bold;">Data de Vencimento*</label><br>
<input 
    type="datetime-local"                     
    id="datafim"                             
    name="datafim"                           
    value="<?= isset($dadosParaView['dataVencimento']) ? htmlspecialchars($dadosParaView['dataVencimento']) : '' ?>" 
    style="width: 100%; padding: 8px; margin-bottom: 20px; border: 1px solid #000;"
>


        <!-- Campo: DescriÃ§Ã£o da Tarefa -->
        <label for="descricao" style="font-weight: bold;">DescriÃ§Ã£o</label><br>
        <textarea 
            id="descricao" 
            name="descricao"
            placeholder="<?= isset($dadosParaView['descricaoPlaceholder']) ? htmlspecialchars($dadosParaView['descricaoPlaceholder']) : '' ?>" 
            style="
                width: 100%; 
                height: 120px;  
                padding: 8px; 
                margin-bottom: 20px; 
                border: 1px solid #000;
                resize: none;   
                overflow-y: auto; 
            "
            maxlength="280"><?= isset($dadosParaView['descricaoConteudo']) ? htmlspecialchars($dadosParaView['descricaoConteudo']) : '' ?></textarea>

        <!-- BotÃ£o Salvar -->
        <div style="text-align: right; margin-top: 20px;">
            <button type="submit">
                Salvar Tarefa
            </button>
        </div>
    </form>
</div>

```n
## Arquivo: views\usuario\editarPerfil.php
```php
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Perfil</title>
    <link rel="icon" type="image/png" href="public/img/favicon-2-do-it.png" />
</head>
<body>

<!-- Breadcrumb -->
<div style="margin-left: 220px; margin-right: 220px; margin-top: 40px; margin-bottom: 10px;">
    <p style="font-size: 14px; color: #555;">
        <a href="index.php?controller=home&method=index" style="text-decoration: none; color: #555;">Home</a> &gt;
        <a href="index.php?controller=usuario&method=meuPerfil" style="text-decoration: none; color: #555;">Meu Perfil</a> &gt;
        Editar Perfil
    </p>
</div>

<!-- Card principal -->
<div style="border: 1px solid black; padding: 20px; margin-left: 220px; margin-right: 220px; margin-bottom: 20px; position: relative;">

    

    <h1>Editar Perfil</h1>
    
<?php if (!empty($_GET['sucesso'])): ?>
    <div style="color: green; font-weight: bold; margin-bottom: 20px;">
        Dados atualizados com sucesso!
    </div>
<?php endif; ?>

    <form action="index.php?controller=usuario&method=salvarEdicao" method="POST" style="max-width: 600px;">
        <input type="hidden" name="usu_id" value="<?= htmlspecialchars($dadosParaView['id'] ?? '') ?>">

        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" required
               value="<?= htmlspecialchars($dadosParaView['nome'] ?? '') ?>" style="width: 100%;"><br><br>

        <label for="apelido">Apelido (opcional):</label><br>
        <input type="text" id="apelido" name="apelido"
               value="<?= htmlspecialchars($dadosParaView['apelido'] ?? '') ?>" style="width: 100%;"><br><br>

        <label for="idade">Idade:</label><br>
        <input type="number" id="idade" name="idade" required min="1" max="120"
               value="<?= htmlspecialchars($dadosParaView['idade'] ?? '') ?>" style="width: 100%;"><br><br>

        <button type="submit" style="padding: 10px 20px; font-weight: bold; border: 1px solid black; background-color: white; cursor: pointer;">
            Salvar
        </button>
    </form>
</div>

<!-- RodapÃ© padrÃ£o -->
<footer style="position: fixed; border: 1px solid black; padding: 20px; bottom: 0; left: 220px; right: 220px; background: none; z-index: 999;">
    <p align="right">&copy; <?= date('Y') ?> Organizador. Todos os direitos reservados.</p>
</footer>

</body>
</html>

```n
## Arquivo: views\usuario\meuPerfil.php
```php
<link rel="icon" type="image/png" href="public/img/favicon-2-do-it.png" />

<!-- Card principal -->
<div class="card-headers">
    <h1>Meu Perfil</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.</p>
</div>

<!-- Breadcrumb -->
<div class="breadcrumbs">
    <p style="font-size: 14px; color: #555;">
        <a href="index.php?controller=home&method=index" style="text-decoration: none; color: #555;">
            Home
        </a> &gt; Meu Perfil
    </p>
</div>


<!-- Card com dados do perfil -->
<div class="card">
    <!-- BotÃ£o de ediÃ§Ã£o no canto superior direito -->
    

    <a href="index.php?controller=usuario&method=editarPerfil"
       style="
           position: absolute;
           top: 330px;
           right: 250px;
           padding: 8px 12px;
           background-color: white;
           border: 1px solid black;
           text-decoration: none;
           color: black;
           font-weight: bold;
           cursor: pointer;
           z-index: 10;
           box-sizing: border-box;
       ">
        Editar
    </a>

    <p><strong>Nome:</strong> <?= htmlspecialchars($dadosParaView['nome']) ?></p>
    <p><strong>ID do UsuÃ¡rio:</strong> <?= htmlspecialchars($dadosParaView['id']) ?></p>
    <p><strong>Apelido:</strong> <?= !empty($dadosParaView['apelido']) ? htmlspecialchars($dadosParaView['apelido']) : 'â€”' ?></p>
    <p><strong>Idade:</strong> <?= htmlspecialchars($dadosParaView['idade']) ?> anos</p>
</div>




```n
