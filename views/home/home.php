<!-- Menu lateral 
 // comentado para ocultar temporariamente
<div class="menu-lateral-default">
    <h3>Menu</h3>
    <ul>
        <-- Alterado para abrir modal ->
        <li><a href="#" onclick="abrirModal()">Nova Tarefa</a></li>
        <li><a href="index.php?controller=tarefa&method=gestaoTarefa">Minhas tarefas</a></li>
        <li><a href="index.php?controller=estatisticas&method=estatisticas">Estatísticas</a></li>
        <li><a href="index.php?controller=perfil&method=meuPerfil">Meu Perfil</a></li>
        <li><a href="index.php?controller=definicoes&method=definicoes">Definições</a></li>
        <li><a href="index.php?controller=auth&method=logout">Logout</a></li>
    </ul>
</div>
-->

<link rel="icon" type="image/png" href="public/img/favicon-2-do-it.png" />

<!-- Card headers de boas-vindas -->
    <div class="card-headers">
    <h1>Bonjour, <?= htmlspecialchars($dadosParaView['nomeParaExibir']) ?>!</h1>
    </div>

<!-- Um futuro card interativo-->
    <div class="card-interativo">Naquela direção 👈 vive um Chapeleiro. E naquela outra direção 👉 vive uma Lebre de Março. Visite qualquer um dos dois: ambos são loucos. 😸😹🐈</div>
<!-- Linha divisória 
<div style="height: 1px; background-color: black; margin-bottom: 10px; margin-left: 220px; margin-right: 220px;"></div>
-->

<!-- DIV PAI dos Cards estatísticos -->
    <div class="card-views-home-father">
    
    <!-- Card: Próximas Tarefas -->
    <div class="card-views-home">
        <spam>Próximas Tarefas</spam>
        <p><?= isset($dadosParaView['proximasTarefasQtd']) ? $dadosParaView['proximasTarefasQtd'] : '0' ?></p>
    </div>

    <!-- Card: Tarefas Concluídas ult 30 dias -->
    <div class="card-views-home">
        <spam>Tarefas concluídas nos últimos 30 dias</spam>
        <p><?= $dadosParaView['qtdConcluidasUlt30Dias'] ?? 0 ?></p>
    </div>

    <!-- Card: Total de tarefas cadastradas -->
    <div class="card-views-home">
        <spam>Total de tarefas cadastradas</spam>
        <p><?= $dadosParaView['totalTarefas'] ?? 0 ?></p>
    </div>

    <!-- Card: Tarefas com Alta Prioridade -->
    <div class="card-views-home">
        <spam>Alta prioridade</spam>
        <p><?= $dadosParaView['tarefasAltaPrioridade'] ?? 0 ?></p>
    </div>

    <!-- Card: Tarefas Pendentes -->
    <div class="card-views-home">
        <spam>Tarefas Pendentes</spam>
        <p><?= $dadosParaView['tarefasPendentes'] ?? 0 ?></p>
    </div>

    <!-- Card: Tarefas Atrasadas -->
    <div class="card-views-home">
        <spam>Tarefas atrasadas</spam>
        <p><?= $dadosParaView['tarefasAtrasadas'] ?? 0 ?></p>

    </div>
    </div>

<!-- cards tabela prox tarefas -->
    <div class="card">
    <div class="titulo-secao">Próximas tarefas</div>
    <hr><br>
    <?php if (!empty($dadosParaView['proximasTarefasTabela'])): ?>
        <table class="tabela-tarefas">
        <!-- border="1" cellpadding="5" cellspacing="0" style="width: 100%; border-collapse: collapse;"-->
            <thead>
                <tr>
                    <th>ID</th><th>Título</th><th>Tipo</th><th>Prioridade</th><th>Início</th><th>Fim</th><th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dadosParaView['proximasTarefasTabela'] as $tarefa): ?>
                    <tr>
                        <td><?= htmlspecialchars($tarefa['TASK_ID']) ?></td>
                        <td><?= htmlspecialchars($tarefa['TASK_TITULO']) ?></td>
                        <td><?= htmlspecialchars($tarefa['TASK_TIPOTAREFA']) ?></td>
                        <td><?= htmlspecialchars($tarefa['TASK_PRIORIDADE']) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($tarefa['TASK_DATAINICIO'])) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($tarefa['TASK_DATAFIM'])) ?></td>
                        <td><?= htmlspecialchars($tarefa['TASK_STATUS']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?><p class="sem-tarefas-info">Sem tarefas próximas.</p><?php endif; ?>
    </div>    

<!-- cards tabela tarefas em atraso -->
    <div class="card">    
    <div class="titulo-secao">Tarefas em atraso</div>
    <hr><br>
    <?php if (!empty($dadosParaView['tarefasAtrasadasTabela'])): ?>
        <table class="tabela-tarefas">
            <thead>
                <tr>
                    <th>ID</th><th>Título</th><th>Tipo</th><th>Prioridade</th><th>Início</th><th>Vencimento</th><th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dadosParaView['tarefasAtrasadasTabela'] as $t): ?>
                    <tr>
                        <td><?= $t['TASK_ID'] ?></td>
                        <td><?= htmlspecialchars($t['TASK_TITULO']) ?></td>
                        <td><?= htmlspecialchars($t['TASK_TIPOTAREFA']) ?></td>
                        <td><?= $t['TASK_PRIORIDADE'] ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($t['TASK_DATAINICIO'])) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($t['TASK_DATAFIM'])) ?></td>
                        <td><?= $t['TASK_STATUS'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?><p class="sem-tarefas-info">Nenhuma tarefa em atraso.</p><?php endif; ?>
    </div>    

<!-- cards tabela Todas as tarefas -->
    <div class="card">
    <div class="titulo-secao">Todas as tarefas</div>
    <hr><br>
    <?php if (!empty($dadosParaView['todasTarefasTabela'])): ?>
        <table class="tabela-tarefas">
            <thead>
                <tr>
                    <th>ID</th><th>Título</th><th>Tipo</th><th>Prioridade</th><th>Início</th><th>Vencimento</th><th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dadosParaView['todasTarefasTabela'] as $t): ?>
                    <tr>
                        <td><?= $t['TASK_ID'] ?></td>
                        <td><?= htmlspecialchars($t['TASK_TITULO']) ?></td>
                        <td><?= htmlspecialchars($t['TASK_TIPOTAREFA']) ?></td>
                        <td><?= $t['TASK_PRIORIDADE'] ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($t['TASK_DATAINICIO'])) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($t['TASK_DATAFIM'])) ?></td>
                        <td><?= $t['TASK_STATUS'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?><p class="sem-tarefas-info">Não há tarefas cadastradas.</p><?php endif; ?>
    </div>    

<!-- cards tabela tarefas realizadas -->
    <div class="card">
        <div class="titulo-secao">Últimas Tarefas realizadas</div>
        <hr><br>
        <?php if (!empty($dadosParaView['ultimasTarefasRealizadasTabela'])): ?>
            <table class="tabela-tarefas">
                <thead>
                    <tr>
                        <th>ID</th><th>Título</th><th>Tipo</th><th>Prioridade</th><th>Início</th><th>Vencimento</th><th>Data Realização</th><th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dadosParaView['ultimasTarefasRealizadasTabela'] as $t): ?>
                    <tr>
                        <td><?= $t['TASK_ID'] ?></td>
                        <td><?= htmlspecialchars($t['TASK_TITULO']) ?></td>
                        <td><?= htmlspecialchars($t['TASK_TIPOTAREFA']) ?></td>
                        <td><?= $t['TASK_PRIORIDADE'] ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($t['TASK_DATAINICIO'])) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($t['TASK_DATAFIM'])) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($t['TASK_DATAREALIZACAO'])) ?></td>
                        <td><?= $t['TASK_STATUS'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?><p class="sem-tarefas-info">Sem tarefas concluídas.</p><?php endif; ?>
    </div>    


