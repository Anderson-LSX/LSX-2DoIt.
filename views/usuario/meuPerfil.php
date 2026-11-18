<link rel="icon" type="image/png" href="public/img/favicon-2-do-it.png" />

<!-- Card principal -->
<div class="card-headers">
    <h1>Meu Perfil</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.</p>
</div>

<!-- Breadcrumb -->
<div class="breadcrumbs">
    <p style="font-size: 14px; color: #555;">
        <a href="index.php?controller=home&method=index" style="text-decoration: none; color: #555;">
            Home
        </a> &gt; Meu Perfil
    </p>
</div>


<!-- Card com dados do perfil -->
<div class="card">
    <!-- Botão de edição no canto superior direito -->
    

    <a href="index.php?controller=usuario&method=editarPerfil"
       style="
           position: absolute;
           top: 330px;
           right: 250px;
           padding: 8px 12px;
           background-color: white;
           border: 1px solid black;
           text-decoration: none;
           color: black;
           font-weight: bold;
           cursor: pointer;
           z-index: 10;
           box-sizing: border-box;
       ">
        Editar
    </a>

    <p><strong>Nome:</strong> <?= htmlspecialchars($dadosParaView['nome']) ?></p>
    <p><strong>ID do Usuário:</strong> <?= htmlspecialchars($dadosParaView['id']) ?></p>
    <p><strong>Apelido:</strong> <?= !empty($dadosParaView['apelido']) ? htmlspecialchars($dadosParaView['apelido']) : '—' ?></p>
    <p><strong>Idade:</strong> <?= htmlspecialchars($dadosParaView['idade']) ?> anos</p>
</div>



