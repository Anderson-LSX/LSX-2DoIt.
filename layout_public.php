<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Link CSS público mínimo -->
    <link rel="stylesheet" href="public/css/style.css" />

    <title>LSix 2Do-It.</title>
    <link rel="icon" type="image/png" href="public/img/favicon-2-do-it.png" />
</head>

<body>
    <div class="main-content">
        <?php if (isset($conteudo)) { echo $conteudo; } ?>
    </div>

    <script src="public/js/script.js"></script>
</body>

</html>