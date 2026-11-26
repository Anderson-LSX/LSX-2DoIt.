<!-- Botão de retorno no canto superior esquerdo -->
<div class="btn-voltar-topo">
    <a class="btn-voltar" href="index.php?controller=auth&method=esqueciSenha">
        &#8592; Retornar ao Passo 1
    </a>
</div>

<!-- Container centralizado para o card -->
<div class="container-auth">

    <!-- Card principal -->
    <div class="card-login">
        <h1>Nova Senha</h1>
        <h2 class="card-login-subtitulo">Passo 2 de 2:<br> Digite sua nova senha</h2>

        <!-- Formulário de redefinição -->
        <form method="POST" action="index.php?controller=auth&method=processaNovaSenha" class="form-auth">
            <label for="nova_senha">Nova Senha:</label><br>
            <input type="password" name="nova_senha" id="nova_senha" required><br>

            <button type="submit" class="btn-largura-total">Atualizar Senha</button>
        </form>
    </div>
</div>
