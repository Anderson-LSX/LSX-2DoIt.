

<!-- Menu lateral -->
<div style="
    position: fixed;
    left: 20px;
    top: 40%;
    transform: translateY(-50%);
    width: 150px;
    padding: 20px;
    border: 1px solid black;
">
    <h3>Menu</h3>
    <ul style="list-style: none; padding: 0;">
        <li><a href="index.php?controller=novaTarefa&method=novaTarefa">Nova Tarefa</a></li>
        <li><a href="index.php?controller=tarefa&method=gestaoTarefa">Minhas tarefas</a></li>
        <li><a href="index.php?controller=estatisticas&method=estatisticas">Estatísticas</a></li>
        <li><a href="index.php?controller=perfil&method=meuPerfil">Meu Perfil</a></li>
        <li>Definições</li>
        <li><a href="index.php?controller=auth&method=logout">Logout</a></li>
    </ul>
</div>

<!-- Card de boas-vindas -->
<div style="border: 1px solid black; padding: 20px; margin-left: 220px; margin-right: 220px; margin-bottom: 20px; margin-top: 40px;">
    <h1>Bonjour, <?= htmlspecialchars($nomeParaExibir) ?>!</h1>
</div>

<!-- cards estatisticas-->

<!-- Linha divisória -->
    <div style="
        
        height: 1px;
        background-color: black;
        margin-bottom: 10px;
        margin-left: 220px;
        margin-right: 220px;
    "></div>

    <!-- DIV PAI dos Cards estatísticos -->
    <div style="
        display: flex;
        justify-content: space-between;
        gap: 10px;
        flex-wrap: nowrap;
        margin-left: 220px;
        margin-right: 220px;
        display: flex;
        gap: 20px;
        margin-bottom: 20px;">

        <!-- Card: Próximas Tarefas -->
<div style="border: 1px solid black; padding: 20px; width: 48%; display: inline-block; margin: 1%;">
    <h3>Próximas Tarefas</h3>
    <?php if (!empty($dadosParaView['proximasTarefas'])): ?>
        <ul>
            <?php foreach ($dadosParaView['proximasTarefas'] as $t): ?>
                <li>
                    <?= htmlspecialchars($t['TASK_TITULO']) ?> —
                    <?= date('d/m/Y H:i', strtotime($t['TASK_DATAFIM'])) ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Sem tarefas próximas.</p>
    <?php endif; ?>
</div>


        <!-- card 2: Qtd tarefas concluidas ult 30 dias -->
        <div style="border: 1px solid black; padding: 15px; flex: 1 1 14%; min-width: 120px;">
            <h4>Quantidade de tarefas concluidas nos ultimos 30 dias</h4>
            <p><?= $qtdConcluidasUlt30Dias ?? 0 ?></p>
        </div>

        <!-- card 3: Total de tarefas cadastradas -->
        <div style="border: 1px solid black; padding: 15px; flex: 1 1 14%; min-width: 120px;">
            <h4>Total de tarefas cadastradas</h4>
            <p><?= $totalTarefas ?></p>
        </div>

        <!-- card 4: Alta prioridade -->
        <div style="border: 1px solid black; padding: 15px; flex: 1 1 14%; min-width: 120px;">
            <h4>Alta prioridade</h4>
            <p><?= $tarefasAltaPrioridade ?></p>
        </div>

        <!-- card 5: Tarefas Pendentes -->
        <div style="border: 1px solid black; padding: 15px; flex: 1 1 14%; min-width: 120px;">
            <h4>Tarefas Pendentes</h4>
                <p><?= $tarefasPendentes ?></p>

        </div>

        <!-- card 6: Tarefas atrasadas -->
        <div style="border: 1px solid black; padding: 15px; flex: 1 1 14%; min-width: 120px;">
            <h4>Tarefas atrasadas</h4>
                <p><?= $tarefasAtrasadas ?></p>

        </div>

    </div>


<!-- cards tabela prox tarefas-->
<div style="border: 1px solid black; margin-left: 220px; margin-right: 220px; display: flex; gap: 20px; margin-bottom: 20px;">
            <h3>Próximas tarefas</h3>
    </div>

    <!-- cards tabela tarefas em atraso-->
    <div style="border: 1px solid black; margin-left: 220px; margin-right: 220px; display: flex; gap: 20px; margin-bottom: 20px;">
        <h3>Tarefas em atraso</h3>
    </div>


<!-- cards tabela Todas as tarefas -->
<div style="border: 1px solid black; margin-left: 220px; margin-right: 220px; display: flex; gap: 20px; margin-bottom: 20px;">
        <h3>Todas as tarefas</h3>
    </div>

    <!-- cards tabela tarefas realizadas -->
    <div style="border: 1px solid black; margin-left: 220px; margin-right: 220px; display: flex; gap: 20px; margin-bottom: 20px;">
        <h3>Ultimas Tarefas realizadas</h3>
    </div>


<!-- Linha divisória -->
<div style="
        
        height: 1px;
        background-color: black;
        margin-bottom: 10px;
        margin-left: 220px;
        margin-right: 220px;
    "></div>

<!-- Footer fixo -->
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
    <p align="right">&copy; <?= htmlspecialchars($dadosParaView['anoAtual']) ?> Organizador. Todos os direitos reservados.</p>

    
</footer>