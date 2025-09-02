

<!-- Botão de retorno padrão no canto superior esquerdo -->
<div style="position: absolute; top: 20px; left: 20px;">
    <a href="index.php?controller=home&method=index"
       style="
           display: inline-block;
           padding: 10px 15px;
           background-color: white;
           border: 1px solid black;
           text-decoration: none;
           color: black;
           font-weight: bold;
       ">
        &#8592; Voltar
    </a>
</div>



<!-- Card principal -->
<div class="card card-headers">
    <h1>Meu Perfil</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.</p>
</div>

<!-- Breadcrumb -->
<div style="margin-left: 220px; margin-right: 220px; margin-top: 40px; margin-bottom: 10px;">
    <p style="font-size: 14px; color: #555;">
        <a href="index.php?controller=home&method=index" style="text-decoration: none; color: #555;">
            Home
        </a> &gt; Meu Perfil
    </p>
</div>


<!-- Card com dados do perfil -->
<div style="
    position: relative;
    border: 1px solid black;
    padding: 20px;
    margin: 20px 220px 80px 220px;
    background: white;
    box-sizing: border-box;
">
    <a href="index.php?controller=usuario&method=editarPerfil"
       style="
           position: absolute;
           top: 10px;
           right: 10px;
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

<!-- Footer fixo padrão -->
<footer style="
    position: fixed;
    border: 1px solid black;
    padding: 10px 20px;
    bottom: 0;
    left: 220px;
    right: 220px;
    background: #fff;
    z-index: 999;
">
    <p align="right">&copy; <?= date('Y') ?> Organizador. Todos os direitos reservados.</p>
</footer>


