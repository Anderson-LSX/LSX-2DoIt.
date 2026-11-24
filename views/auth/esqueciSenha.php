<!-- Botão de retorno padrão no canto superior esquerdo -->
<div class="btn-voltar-topo">
    <a class="btn-voltar" href="index.php?controller=auth&method=login">
        &#8592; Retornar ao login
    </a>
</div>

<!-- aviso de erro de autenticação -->
<?php if (!empty($erro)): ?>
    <div class="msg-erro msg-erro-topo">
        &#9888; <?= htmlspecialchars($erro) ?>
    </div>
<?php endif; ?>

<!-- Container para centralizar o conteúdo na tela -->
<div class="container-auth">

<!-- Card de recuperação de senha -->
<div class="card-login">

<h1>Esqueci minha senha</h1>
        <h2 class="card-login-subtitulo">Passo 1 de 2: Digite seus dados de acesso para redefinir sua senha</h2>

        <form method="POST" action="index.php?controller=auth&method=validaDadosParaReset">

            <label for="nome">Nome:</label><br>
            <input 
                type="text" 
                name="nome" 
                id="nome"
                required 
                value="<?= htmlspecialchars($dados['nome'] ?? '') ?>"
            ><br><br>

            <label for="idade">Idade:</label><br>
            <input 
                type="number" 
                name="idade" 
                id="idade"
                required 
                value="<?= htmlspecialchars($dados['idade'] ?? '') ?>"
            ><br><br>

            <label for="login">Login:</label><br>
            <input 
                type="text" 
                name="login" 
                id="login"
                required 
                value="<?= htmlspecialchars($dados['login'] ?? '') ?>"
            ><br><br>

            <button type="submit" class="btn-largura-total">Validar</button>

        </form>
</div>
</div>
