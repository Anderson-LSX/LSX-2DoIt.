<!DOCTYPE html>
<html lang="pt-BR">


    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
        <!-- Link único para CSS -->
        <link rel="stylesheet" href="public/css/style.css" />
        <!-- Icones menu -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

        <link rel="icon" type="image/png" href="public/img/favicon-2-do-it.png" />

        <title>LSix 2Do-It.</title>
    </head>

    <body>

        <!-- Splash -->
        <?php if(isset($_SESSION['show_splash']) && $_SESSION['show_splash'] === true): ?> 
        <div id="splash">
            <div id="loading-screen" class="visible">
                <img src="public/img/logo-2-do-it.png" alt="Logo" class="logo">
                <p>Um momento enquanto preparamos tudo...</p>
                <br><br>

                <div class="icons">
                    <div class="icon-box"><i class="bi bi-stickies"></i></div>
                    <div class="icon-box"><i class="bi bi-emoji-laughing"></i></div>
                    <div class="icon-box"><i class="bi bi-bookmark-check"></i></div>
                    <div class="icon-box"><i class="bi bi-pin-angle"></i></div>
                    <div class="icon-box"><i class="bi bi-stars"></i></div>
                </div>
            

            <!-- Barra de progresso -->
            <div class="progress">
                <div class="progress-bar"></div>
            </div>

            <!-- Frases abaixo do loading -->
            <div class="loading-texts">
                <p id="loading-message"></p>
            </div>
        </div>
            
            <div id="welcome-screen">
                <p>Bem-vindo</p>
            </div>
    </div>

        <?php 
        // reseta a flag para não repetir
        $_SESSION['show_splash'] = false; 
        endif; ?>

        <nav class="menu-lateral-slide">
            <div class="menu-tab" onclick="toggleMenu()">
    <i class="bi bi-list icone-expandido"></i>
    <i class="bi bi-three-dots-vertical icone-retraido"></i>
</div>

            <div class="titulo-menu">
                <span class="logo-completa">
                    <img src="public/img/logo-2-do-it.png" alt="2Do it.">
                </span>
                <span class="logo-reduzida">
                    <img src="public/img/favicon-2-do-it.png" alt="2Do it">
                </span>
                
            </div>
            <ul>
                <li><a href="#" onclick="abrirModal()">
                    <i class="bi bi-plus-lg"></i>
                    <span>Nova Tarefa</span>
                    </a>
                </li>

                <li><a href="index.php?controller=home&method=index">
                    <i class="bi bi-house"></i>
                    <span>Home</span>
                    </a>
                </li>

                <li><a href="index.php?controller=tarefa&method=gestaoTarefa">
                    <i class="bi bi-card-checklist"></i>
                    <span>Minhas tarefas</span>
                    </a>
                </li>

                <li><a href="index.php?controller=estatisticas&method=estatisticas">
                    <i class="bi bi-bar-chart"></i>
                    <span>Estatísticas</span>
                    </a>
                </li>
        
                <li><a href="index.php?controller=perfil&method=meuPerfil">
                    <i class="bi bi-person"></i>
                    <span>Perfil</span>
                    </a>
                </li>
        
                <li><a href="#">
                    <i class="bi bi-card-image"></i>
                    <span>Meu espaço</span>
                    </a>
                </li>

                <li><a href="#">
                    <i class="bi bi-trash"></i>
                    <span>Triturador de papel</span>
                    </a>
                </li>

                 <li><a href="index.php?controller=definicoes&method=definicoes">
                    <i class="bi bi-gear"></i>
                    <span>Definições</span>
                    </a>
                </li>

                <li onmouseover="this.style.backgroundColor='#ff000090'; this.style.color='black'" onmouseout="this.style.backgroundColor='white'; this.style.color='black'">
                <a href="index.php?controller=auth&method=logout">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Sair</span>
                    </a>
                </li>
            </ul>
        </nav>
        
        

        <div class="main-content">
            <?php
                if (isset($conteudo)) {echo $conteudo;}
                // Conteúdo das views injetado aqui
            ?>
            <div class="area-segura"></div>
        </div>

        <!-- Footer fixo -->
        <footer class="footer">
            <p>
                &copy; <?= date('Y') ?> LSiX 2Do-it. Todos os direitos reservados.
            </p>
        </footer>

        <!-- Modal -->
        <div id="overlay">
            <div id="modalContent">
        <!-- Conteúdo da view será injetado aqui -->
            </div>
        </div>

        


        


<!-- Script único para JS -->
        <script src="public/js/script.js"></script> 
    </body>

</html>
