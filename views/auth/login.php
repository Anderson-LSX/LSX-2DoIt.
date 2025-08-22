<?php if (!empty($erro_login)): ?>
    <div style="
        border: 1px solid black;  /* Borda preta ao redor */
        color: red;               /* Texto em vermelho */
        font-weight: bold;        /* Negrito para destaque */
        padding: 5px;            /* Espaço interno */
        margin: 60px auto;     /* Centraliza e define 20px de espaço abaixo */
        max-width: 450px;         /* Largura máxima para alinhar com o formulário */
        text-align: center;           /* Centraliza o texto */
    ">
        &#9888; <?= htmlspecialchars($erro_login) ?> <!-- Ícone de alerta + mensagem -->
    </div>
<?php endif; ?>


<?php if (!empty($sessao_expirada)): ?>
    <script>
        alert("Sua sessão expirou por inatividade. Faça login novamente.");
    </script>
<?php endif; ?>


<div class='card'>
    <h1 style="text-align: center;">Login</h1>
    <h2 style="text-align: center; font-size: 16px;">Entre ou cadastre-se</h2>

    <form method="POST" action="index.php?controller=auth&method=loginSubmit" style="margin-top: 20px;">
        <label>Login:</label><br>
        <input type="text" name="login" required style="width: 100%; padding: 8px; margin-bottom: 15px;"><br>

        <label>Senha:</label><br>
        <input type="password" name="senha" required style="width: 100%; padding: 8px; margin-bottom: 20px;"><br>

        <button type="submit" style="width: 100%; padding: 10px;">Entrar</button>
    </form>

    <div style="margin-top: 20px; text-align: center;">
        <a href="index.php?controller=auth&method=esqueciSenha">Esqueci minha senha</a><br><br>
        <span>Ainda não tem uma conta? </span>
        <a href="index.php?controller=auth&method=cadastro">Cadastre-se</a>
    </div>
</div>
