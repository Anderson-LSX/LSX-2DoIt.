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

<!-- Breadcrumb -->
<div style="margin-left: 220px; margin-right: 220px; margin-top: 40px; margin-bottom: 10px;">
    <p style="font-size: 14px; color: #555;">
        <a href="index.php?controller=home&method=index" style="text-decoration: none; color: #555;">
            Home
        </a> &gt; Minhas tarefas
    </p>
</div>

<?php if (!empty($dadosParaView['sucesso'])): ?>
    <div style="color: green; font-weight: bold; margin: 10px 220px;">
        <?= htmlspecialchars($dadosParaView['sucesso']) ?>
    </div>
<?php endif; ?>

<!-- Card principal -->
<div style="border: 1px solid black; padding: 20px; margin-left: 220px; margin-right: 220px; margin-bottom: 20px;">
    <h1>Minhas Tarefas</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.</p>
</div>

<!-- Botão nova tarefa -->
<div style="margin: 20px 220px 10px 220px;">
    <form action="index.php" method="GET" style="display: inline;">
        <input type="hidden" name="controller" value="novaTarefa">
        <input type="hidden" name="method" value="novaTarefa">
        <button type="submit">+ Nova Tarefa</button>
    </form>
</div>

<!-- Tabela para gestão de tarefas -->
<table border="1" cellpadding="8" cellspacing="0" style="margin: 0 220px 20px 220px; width: calc(100% - 440px); border-collapse: collapse;">
    <thead>
        <tr>
            <th>Título</th>
            <th>Tipo da Tarefa</th>
            <th>Vencimento da Tarefa</th>
            <th>Prioridade</th>
            <th>Status</th>
            <th style="text-align: center;">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($tarefas)): ?>

                  <?php foreach ($tarefas as $tarefa): ?>
                <tr>
                    <td><?= htmlspecialchars($tarefa['TASK_TITULO']) ?></td>
                    <td><?= htmlspecialchars($tarefa['TASK_TIPOTAREFA']) ?></td>
                    <td><?= htmlspecialchars(date('d/m/Y H:i', strtotime($tarefa['TASK_DATAFIM']))) ?></td>
                    <td><?= htmlspecialchars(ucfirst($tarefa['TASK_PRIORIDADE'])) ?></td>
                    <td><?= htmlspecialchars(ucfirst($tarefa['TASK_STATUS'])) ?></td>
                    <td style="text-align: center;">

                        <!-- Botão Ver usando GET -->
                        <a href="index.php?controller=tarefa&method=detalhesTarefa&task_id=<?= $tarefa['TASK_ID'] ?>"
                           style="text-decoration: none;">
                            <button type="button">Ver</button>
                        </a>

                        <!-- Botão Editar (mantido com POST) -->
                        <a href="index.php?controller=tarefa&method=editarTarefa&task_id=<?= $tarefa['TASK_ID'] ?>"
                            style="text-decoration: none;">
                            <button type="button">Editar</button>
                        </a>

                        <!-- Botão Apagar (mantido com POST por enquanto) -->
                        <form action="index.php?controller=tarefa&method=apagar" method="POST" style="display: inline;">
                            <input type="hidden" name="task_id" value="<?= $tarefa['TASK_ID'] ?>">
                            <button type="submit" onclick="return confirm('Confirma exclusão?')">Apagar</button>
                        </form>

                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" style="text-align:center;">Nenhuma tarefa encontrada.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<!-- Rodapé fixo padrão -->
<footer style="
    position: fixed;
    border: 1px solid black;
    padding: 20px;
    bottom: 0;
    left: 220px;
    right: 220px;
    padding: 10px 20px 10px 20px;
    background: none;
    z-index: 999;
">
    <p align="right">&copy; <?= date('Y') ?> Organizador. Todos os direitos reservados.</p>
</footer>
