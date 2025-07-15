<!-- Botão de retorno no canto superior esquerdo -->
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

        <!-- Formulário de redefinição -->
        <form method="POST" action="index.php?controller=auth&method=processaNovaSenha">

            <label>Nova Senha:</label><br>
            <input type="password" name="nova_senha" required
                style="width: 100%; padding: 8px; margin-bottom: 15px;"><br>

            <button type="submit" style="width: 100%; padding: 10px;">Atualizar Senha</button>
        </form>
    </div>
</div>
