<!-- Botão de retorno padrão no canto superior esquerdo -->
<div class="btn-voltar-topo">
    <a class="btn-voltar" href="index.php?controller=auth&method=login">
        &#8592; Retornar ao login
    </a>
</div>

<?php
// cadastro.php - View do formulário de cadastro com estilo de card centralizado e comentários detalhados

// Recebe os dados passados pelo controller via $dadosParaView
// Esses dados são usados para preencher os campos e mostrar erros
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
    <title>Cadastro de Usuário</title>
</head>
<!-- Corpo da página estilizado para centralizar vertical e horizontalmente o conteúdo -->
<body class="body-cadastro">

    <!-- Div que funciona como card contendo o formulário, com borda preta fina e padding -->
    <div class="card-login">

        <!-- Título da página -->
        <h1>Cadastro de Usuário</h1>
        <p class="card-login-subtitulo">Preencha os campos abaixo para criar sua conta</p>

        <!-- Exibe a mensagem principal de erro, se existir -->
        <?php if ($erroPrincipal): ?>
            <p class="msg-erro msg-erro-form">
                <?= htmlspecialchars($erroPrincipal) ?>
            </p>
        <?php endif; ?>

        <!-- Formulário de cadastro que envia os dados para o método cadastroSubmit do controller auth -->
        <form action="index.php?controller=auth&method=cadastroSubmit" method="post" novalidate>

            <!-- Campo nome, obrigatório -->
            <div class="campo-auth">
                <label for="nome">Nome*:</label><br />
                <input 
                    type="text" 
                    id="nome" 
                    name="nome" 
                    value="<?= htmlspecialchars($nomeVal) ?>"
                    required 
                    class="input-auth"/>
            </div>

            <!-- Campo apelido, opcional -->
            <div class="campo-auth">
                <label for="apelido">Apelido:</label><br />
                <input 
                    type="text" 
                    id="apelido" 
                    name="apelido" 
                    value="<?= htmlspecialchars($apelidoVal) ?>" 
                    class="input-auth" 
                />
            </div>

            <!-- Campo idade, obrigatório -->
            <div class="campo-auth">
                <label for="idade">Idade*:</label><br />
                <input 
                    type="number" 
                    id="idade" 
                    name="idade" 
                    value="<?= htmlspecialchars($idadeVal) ?>" 
                    required 
                    class="input-auth" 
                />
            </div>

            <!-- Campo login, obrigatório -->
            <div class="campo-auth">
                <label for="login">Login*:</label><br />
                <input 
                    type="text" 
                    id="login" 
                    name="login" 
                    value="<?= htmlspecialchars($loginVal) ?>" 
                    required 
                    class="input-auth" 
                />
            </div>

            <!-- Campo senha, obrigatório -->
            <div class="campo-auth">
                <label for="senha">Senha*:</label><br />
                <input 
                    type="password" 
                    id="senha" 
                    name="senha" 
                    required 
                    class="input-auth" 
                />
            </div>

            <!-- Campo repetir senha, obrigatório -->
            <div class="campo-auth">
                <label for="repetir_senha">Repetir Senha*:</label><br />
                <input 
                    type="password" 
                    id="repetir_senha" 
                    name="repetir_senha" 
                    required 
                    class="input-auth" 
                />
            </div>

            <!-- Checkbox de aceite dos termos, obrigatório -->
            <div class="campo-auth">
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
                    <p class="msg-erro msg-erro-campo">
                        <?= htmlspecialchars($erroCheckbox) ?>
                    </p>
                <?php endif; ?>
            </div>

            <!-- Botão de envio do formulário -->
            <button type="submit" class="btn-auth">
                Cadastrar
            </button>
        </form>
    </div>

</body>
</html>
