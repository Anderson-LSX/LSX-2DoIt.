<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Perfil</title>
</head>
<body>

<!-- Breadcrumb -->
<div style="margin-left: 220px; margin-right: 220px; margin-top: 40px; margin-bottom: 10px;">
    <p style="font-size: 14px; color: #555;">
        <a href="index.php?controller=home&method=index" style="text-decoration: none; color: #555;">Home</a> &gt;
        <a href="index.php?controller=usuario&method=meuPerfil" style="text-decoration: none; color: #555;">Meu Perfil</a> &gt;
        Editar Perfil
    </p>
</div>

<!-- Card principal -->
<div style="border: 1px solid black; padding: 20px; margin-left: 220px; margin-right: 220px; margin-bottom: 20px; position: relative;">

    <!-- Botão X no canto superior direito -->
    <a href="index.php?controller=usuario&method=meuPerfil" 
       style="position: absolute; top: 10px; right: 15px; text-decoration: none; font-size: 20px; font-weight: bold; color: #000;">
        X
    </a>

    <h1>Editar Perfil</h1>
    
<?php if (!empty($_GET['sucesso'])): ?>
    <div style="color: green; font-weight: bold; margin-bottom: 20px;">
        Dados atualizados com sucesso!
    </div>
<?php endif; ?>

    <form action="index.php?controller=usuario&method=salvarEdicao" method="POST" style="max-width: 600px;">
        <input type="hidden" name="usu_id" value="<?= htmlspecialchars($dadosParaView['id'] ?? '') ?>">

        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" required
               value="<?= htmlspecialchars($dadosParaView['nome'] ?? '') ?>" style="width: 100%;"><br><br>

        <label for="apelido">Apelido (opcional):</label><br>
        <input type="text" id="apelido" name="apelido"
               value="<?= htmlspecialchars($dadosParaView['apelido'] ?? '') ?>" style="width: 100%;"><br><br>

        <label for="idade">Idade:</label><br>
        <input type="number" id="idade" name="idade" required min="1" max="120"
               value="<?= htmlspecialchars($dadosParaView['idade'] ?? '') ?>" style="width: 100%;"><br><br>

        <button type="submit" style="padding: 10px 20px; font-weight: bold; border: 1px solid black; background-color: white; cursor: pointer;">
            Salvar
        </button>
    </form>
</div>

<!-- Rodapé padrão -->
<footer style="position: fixed; border: 1px solid black; padding: 20px; bottom: 0; left: 220px; right: 220px; background: none; z-index: 999;">
    <p align="right">&copy; <?= date('Y') ?> Organizador. Todos os direitos reservados.</p>
</footer>

</body>
</html>
