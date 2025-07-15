<?php
// cadastroSubmit.php - View com card centralizado e borda preta fina
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Cadastro - Sucesso</title>
</head>
<body style="display:flex; justify-content:center; align-items:center; height:100vh; margin:0;">

    <div style="
        border: 1px solid black;
        padding: 20px 40px;
        max-width: 400px;
        text-align: center;
        box-sizing: border-box;
    ">
        <h1>Cadastro realizado com sucesso</h1>
        <p>Faça login com seus dados para utilizar o sistema.</p>

        <form action="index.php" method="get" style="margin-top: 20px;">
            <button type="submit" style="
                padding: 8px 16px;
                cursor: pointer;
                font-size: 16px;
            ">Continuar</button>
        </form>
    </div>

</body>
</html>
