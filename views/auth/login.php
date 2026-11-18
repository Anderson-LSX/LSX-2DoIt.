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

<!-- Alerta se a sessão do usuário expirou -->
<?php if (!empty($sessao_expirada)): ?>
    <script>
        alert("Sua sessão expirou por inatividade. Faça login novamente.");
    </script>
<?php endif; ?>

<!-- Card principal do formulário de login -->
<div class='card-login'>
    <img src="public/img/logo-2-do-it.png" alt="2Do it." class="logo-login">
    
    <p style="text-align: center;">Entre ou cadastre-se</p>

    <!-- Formulário de login -->
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
        <span>Ainda não tá com a gente? </span>
        <a href="index.php?controller=auth&method=cadastro">Chega mais!</a>
    </div>
</div>

</div> <!-- fecha .login-wrapper -->