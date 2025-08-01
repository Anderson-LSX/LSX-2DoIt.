<!-- Estilização inline básica conforme padrão -->

<!-- Breadcrumb -->
<div style="margin-left: 220px; margin-right: 220px; margin-top: 40px; margin-bottom: 10px;">
    <p style="font-size: 14px; color: #555;">
        <a href="index.php?controller=home&method=index" style="text-decoration: none; color: #555;">
            Home
        </a> &gt; Estatísticas
    </p>
</div>

<!-- Card principal -->
<div style="border: 1px solid black; padding: 20px; margin-left: 220px; margin-right: 220px; margin-bottom: 20px;">

    <!-- Título -->
    <h1>Estatísticas</h1>

    <!-- Texto Lorem Ipsum -->
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.</p>

</div>

<div style="
    position: relative;
    border: 1px solid black;
    padding: 20px;
    margin: 20px 220px 80px 220px;
    background: white;
    box-sizing: border-box;
">

<main>

    <!-- Seção de resumo geral do usuário -->
    <h2 onclick="toggleLista('resumo')" id="titulo-resumo">Resumo geral</h2>
    <ul id="resumo" class="oculto">
        <li>Total de tarefas cadastradas: <span class="valor">--</span></li>
        <li>Tempo de uso total do sistema: <span class="valor">-- dias</span></li>
    </ul>

    <!-- Seção de estatísticas por status da tarefa -->
    <h2 onclick="toggleLista('status')" id="titulo-status">Por Status</h2>
    <ul id="status" class="oculto">
        <li>Número de tarefas concluídas: <span class="valor">--</span></li>
        <li>Porcentagem de tarefas concluídas: <span class="valor">--%</span></li>
        <li>Número de tarefas com prazo vencido: <span class="valor">--</span></li>
        <li>Porcentagem de tarefas com prazo vencido: <span class="valor">--%</span></li>
        <li>Número de tarefas com prazo pendente: <span class="valor">--</span></li>
        <li>Porcentagem de tarefas pendentes: <span class="valor">--%</span></li>
    </ul>

    <!-- Seção com estatísticas relacionadas à prioridade das tarefas -->
    <h2 onclick="toggleLista('prioridade')" id="titulo-prioridade">Por Prioridade</h2>
    <ul id="prioridade" class="oculto">
        <li>Quantidade de tarefas baixa prioridade: <span class="valor">--</span></li>
        <li>Porcentagem de tarefas baixa prioridade: <span class="valor">--%</span></li>
        <li>Quantidade de tarefas média prioridade: <span class="valor">--</span></li>
        <li>Porcentagem de tarefas média prioridade: <span class="valor">--%</span></li>
        <li>Quantidade de tarefas alta prioridade: <span class="valor">--</span></li>
        <li>Porcentagem de tarefas alta prioridade: <span class="valor">--%</span></li>
        <li>Tarefas de prioridade alta ainda pendentes: <span class="valor">--</span></li>
    </ul>

    <!-- Seção de análises relacionadas ao tempo -->
    <h2 onclick="toggleLista('tempo')" id="titulo-tempo">Por tempo</h2>
    <ul id="tempo" class="oculto">
        <li>Tarefas criadas neste mês: <span class="valor">--</span></li>
        <li>Tarefas concluídas neste mês: <span class="valor">--</span></li>
        <li>Tempo médio para concluir uma tarefa (concluídas): <span class="valor">-- dias</span></li>
    </ul>

    <!-- Seção final com estatísticas complementares -->
    <h2 onclick="toggleLista('outras')" id="titulo-outras">Outras análises</h2>
    <ul id="outras" class="oculto">
        <li>Tarefas sem data de realização e já com prazo vencido: <span class="valor">--</span></li>
        <li>Média de tarefas criadas por semana nos últimos 30 dias: <span class="valor">--</span></li>
    </ul>

</main>

<!-- CSS do dropdown -->
<style>
    /* Oculta as listas inicialmente */
    .oculto {
        display: none;
    }

    /* Estiliza o título como botão clicável */
    h2 {
        cursor: pointer;
        user-select: none;
        position: relative;
        padding-right: 20px;
    }

    /* Seta indicadora de dropdown (padrão: ▼) */
    h2::after {
        content: "▼"; /* Ícone de seta para baixo */
        position: absolute;
        right: 0;
        font-size: 14px;
        transition: transform 0.3s ease;
    }

    /* Roda a seta para cima quando o dropdown estiver aberto */
    h2.ativo::after {
        transform: rotate(-180deg); /* seta invertida: ▲ */
    }
</style>

<!-- JavaScript do dropdown -->
<script>
    function toggleLista(id) {
        const lista = document.getElementById(id);              // Seleciona a lista <ul>
        const titulo = document.getElementById('titulo-' + id); // Seleciona o <h2> correspondente

        // Alterna a classe para mostrar ou esconder a lista
        lista.classList.toggle("oculto");

        // Alterna a classe para girar a seta visualmente
        titulo.classList.toggle("ativo");
    }
</script>



</div>

<!-- Footer padrão -->
<footer style="text-align: center; margin-top: 50px; font-size: 12px; color: #888;">
    
</footer>

<footer style="
    position: fixed;
    border: 1px solid black;
    padding: 20px;
    bottom: 0;
    left: 220px; /* respeita a largura da barra lateral */
    right: 220px;
    padding: 10px 20px 10px 20px;
    background: none;
    z-index: 999;
">
    <p align="right">&copy; <?= date('Y') ?> Organizador. Todos os direitos reservados.</p>
</footer>
