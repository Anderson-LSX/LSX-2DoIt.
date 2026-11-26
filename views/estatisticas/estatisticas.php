<!-- Botão de retorno padrão no canto superior esquerdo -->
<div class="btn-voltar-topo">
    <a class="btn-voltar" href="index.php?controller=home&method=index">
        &#8592; Voltar
    </a>
</div>

<!-- Cabeçalho da página -->
<div class="card-headers">

    <!-- Título -->
    <h1>Estatísticas</h1>

    <!-- Texto Lorem Ipsum -->
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.</p>

</div>

<!-- Breadcrumb -->
<div class="breadcrumbs">
    <p class="breadcrumbs-p">
        <a class="breadcrumbs-a" href="index.php?controller=home&method=index">
            Home
        </a> &gt; Estatísticas
    </p>
</div>

<!-- Área de estatísticas: menu de seções ao lado + seções -->
<div class="layout-secoes">

    <!-- Menu das seções: cada link rola a página até a seção correspondente -->
    <nav class="card menu-secoes">
        <p class="titulo-secao">Seções</p>
        <ul>
            <li><a href="#resumo">Resumo geral</a></li>
            <li><a href="#status">Por Status</a></li>
            <li><a href="#prioridade">Por Prioridade</a></li>
            <li><a href="#tempo">Por tempo</a></li>
            <li><a href="#outras">Outras análises</a></li>
        </ul>
    </nav>

    <main class="conteudo-secoes">

        <!-- Seção de resumo geral do usuário -->
        <section id="resumo" class="card">
            <h2 class="titulo-secao">Resumo geral</h2>
            <ul>
                <li>Total de tarefas cadastradas: <span class="valor">--</span></li>
                <li>Tempo de uso total do sistema: <span class="valor">-- dias</span></li>
            </ul>
        </section>

        <!-- Seção de estatísticas por status da tarefa -->
        <section id="status" class="card">
            <h2 class="titulo-secao">Por Status</h2>
            <ul>
                <li>Número de tarefas concluídas: <span class="valor">--</span></li>
                <li>Porcentagem de tarefas concluídas: <span class="valor">--%</span></li>
                <li>Número de tarefas com prazo vencido: <span class="valor">--</span></li>
                <li>Porcentagem de tarefas com prazo vencido: <span class="valor">--%</span></li>
                <li>Número de tarefas com prazo pendente: <span class="valor">--</span></li>
                <li>Porcentagem de tarefas pendentes: <span class="valor">--%</span></li>
            </ul>
        </section>

        <!-- Seção com estatísticas relacionadas à prioridade das tarefas -->
        <section id="prioridade" class="card">
            <h2 class="titulo-secao">Por Prioridade</h2>
            <ul>
                <li>Quantidade de tarefas baixa prioridade: <span class="valor">--</span></li>
                <li>Porcentagem de tarefas baixa prioridade: <span class="valor">--%</span></li>
                <li>Quantidade de tarefas média prioridade: <span class="valor">--</span></li>
                <li>Porcentagem de tarefas média prioridade: <span class="valor">--%</span></li>
                <li>Quantidade de tarefas alta prioridade: <span class="valor">--</span></li>
                <li>Porcentagem de tarefas alta prioridade: <span class="valor">--%</span></li>
                <li>Tarefas de prioridade alta ainda pendentes: <span class="valor">--</span></li>
            </ul>
        </section>

        <!-- Seção de análises relacionadas ao tempo -->
        <section id="tempo" class="card">
            <h2 class="titulo-secao">Por tempo</h2>
            <ul>
                <li>Tarefas criadas neste mês: <span class="valor">--</span></li>
                <li>Tarefas concluídas neste mês: <span class="valor">--</span></li>
                <li>Tempo médio para concluir uma tarefa (concluídas): <span class="valor">-- dias</span></li>
            </ul>
        </section>

        <!-- Seção final com estatísticas complementares -->
        <section id="outras" class="card">
            <h2 class="titulo-secao">Outras análises</h2>
            <ul>
                <li>Tarefas sem data de realização e já com prazo vencido: <span class="valor">--</span></li>
                <li>Média de tarefas criadas por semana nos últimos 30 dias: <span class="valor">--</span></li>
            </ul>
        </section>

    </main>
</div>
