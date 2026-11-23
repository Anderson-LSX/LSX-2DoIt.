<link rel="icon" type="image/png" href="public/img/favicon-2-do-it.png" />

<!-- Card principal -->
<div class="card-headers">
    <h1>Meu Perfil</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.</p>
</div>

<!-- Breadcrumb -->
<div class="breadcrumbs">
    <p class="breadcrumbs-p">
        <a class="breadcrumbs-a" href="index.php?controller=home&method=index">
            Home
        </a> &gt; Meu Perfil
    </p>
</div>


<!-- Card com dados do perfil -->
<div class="card card-relativo">
    <!-- Botão de edição no canto superior direito -->
    

   

    <p><strong>Nome:</strong> <?= htmlspecialchars($dadosParaView['nome']) ?></p>
    <p><strong>ID do Usuário:</strong> <?= htmlspecialchars($dadosParaView['id']) ?></p>
    <p><strong>Apelido:</strong> <?= !empty($dadosParaView['apelido']) ? htmlspecialchars($dadosParaView['apelido']) : '—' ?></p>
    <p><strong>Idade:</strong> <?= htmlspecialchars($dadosParaView['idade']) ?> anos</p>


 <a href="index.php?controller=usuario&method=editarPerfil" class="btn editar">
  Editar
</a>
</div>



