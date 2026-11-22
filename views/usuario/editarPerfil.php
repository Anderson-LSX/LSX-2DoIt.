<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Perfil</title>
    <link rel="icon" type="image/png" href="public/img/favicon-2-do-it.png" />
</head>
<body>

<!-- Cabeçalho da página -->
<div class="card-headers">
    <h1>Editar Perfil</h1>
    <p>Atualize os dados do seu perfil.</p>
</div>

<!-- Breadcrumb -->
<div class="breadcrumbs">
    <p class="breadcrumbs-p">
        <a class="breadcrumbs-a" href="index.php?controller=home&method=index">Home</a> &gt;
        <a class="breadcrumbs-a" href="index.php?controller=usuario&method=meuPerfil">Meu Perfil</a> &gt;
        Editar Perfil
    </p>
</div>

<!-- Card com o formulário -->
<div class="card">

<?php if (!empty($_GET['sucesso'])): ?>
    <div class="msg-sucesso msg-sucesso-form">
        Dados atualizados com sucesso!
    </div>
<?php endif; ?>

    <form action="index.php?controller=usuario&method=salvarEdicao" method="POST">
        <input type="hidden" name="usu_id" value="<?= htmlspecialchars($dadosParaView['id'] ?? '') ?>">

        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" required
               value="<?= htmlspecialchars($dadosParaView['nome'] ?? '') ?>"><br><br>

        <label for="apelido">Apelido (opcional):</label><br>
        <input type="text" id="apelido" name="apelido"
               value="<?= htmlspecialchars($dadosParaView['apelido'] ?? '') ?>"><br><br>

        <label for="idade">Idade:</label><br>
        <input type="number" id="idade" name="idade" required min="1" max="120"
               value="<?= htmlspecialchars($dadosParaView['idade'] ?? '') ?>"><br><br>

        <button type="submit">
            Salvar
        </button>
    </form>
</div>

</body>
</html>
