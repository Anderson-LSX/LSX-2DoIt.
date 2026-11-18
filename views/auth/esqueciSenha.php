<!-- Botão de retorno padrão no canto superior esquerdo -->
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

<!-- aviso de erro de autenticação -->
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

<!-- Container para centralizar o conteúdo na tela -->
<div style="
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    flex-direction: column;
">

<!-- Card de recuperação de senha -->
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
