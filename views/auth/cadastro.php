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
<body style="display:flex; justify-content:center; align-items:center; height:100vh; margin:0;">

    <!-- Div que funciona como card contendo o formulário, com borda preta fina e padding -->
    <div style="
        border: 1px solid black;         /* Borda preta fina */
        padding: 20px 40px;              /* Espaçamento interno vertical e horizontal */
        max-width: 400px;                /* Largura máxima do card */
        width: 100%;                    /* Ocupa 100% do container pai até o max-width */
        box-sizing: border-box;          /* Inclui borda e padding na largura total */
        text-align: center;              /* Centraliza texto dentro do card */
    ">

        <!-- Título da página -->
        <h1>Cadastro de Usuário</h1>

        <!-- Exibe a mensagem principal de erro, se existir -->
        <?php if ($erroPrincipal): ?>
            <p style="color: red; font-weight: bold; margin-bottom: 15px;">
                <?= htmlspecialchars($erroPrincipal) ?>
            </p>
        <?php endif; ?>

        <!-- Formulário de cadastro que envia os dados para o método cadastroSubmit do controller auth -->
        <form action="index.php?controller=auth&method=cadastroSubmit" method="post" novalidate>

            <!-- Campo nome, obrigatório -->
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

            <!-- Campo idade, obrigatório -->
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

            <!-- Campo login, obrigatório -->
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

            <!-- Campo senha, obrigatório -->
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

            <!-- Campo repetir senha, obrigatório -->
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

            <!-- Checkbox de aceite dos termos, obrigatório -->
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

            <!-- Botão de envio do formulário -->
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
