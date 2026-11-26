<!-- Faixa de fundo exclusiva da tela de login -->
<div class="login-bg-stripe"></div>

<div class="login-wrapper">

<!-- Exibe mensagem de erro de login caso exista -->
<?php if (!empty($erro_login)): ?>
    <div class="msg-erro msg-erro-topo">
        &#9888; <?= htmlspecialchars($erro_login) ?>
    </div>
<?php endif; ?>

<!-- Alerta se a sessão do usuário expirou -->
<?php if (!empty($sessao_expirada)): ?>
    <script>
        alert("Sua sessão expirou por inatividade. Faça login novamente.");
    </script>
<?php endif; ?>

<!-- Card principal do formulário de login -->
<div class='card-login'>
    <img src="public/img/logo-2-do-it.png" alt="2Do it." class="logo-login">
    
    <p class="texto-centralizado">Entre ou cadastre-se</p>

    <!-- Formulário de login -->
    <form method="POST" action="index.php?controller=auth&method=loginSubmit" class="form-auth">
        <label for="login">Login:</label><br>
        <input type="text" name="login" id="login" required><br>

        <label for="senha">Senha:</label><br>
        <input type="password" name="senha" id="senha" required><br>

        <button type="submit" class="btn-largura-total">Entrar</button>
    </form>

    <!-- Links adicionais -->
    <div class="card-login-links">
        <a href="index.php?controller=auth&method=esqueciSenha">Esqueci minha senha</a><br><br>
        <span>Ainda não tá com a gente? </span>
        <a href="index.php?controller=auth&method=cadastro">Chega mais!</a>
    </div>
</div>

</div> <!-- fecha .login-wrapper -->