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

<?php if (!empty($dadosParaView['sucesso'])): ?>
    <div style="color: green; font-weight: bold; margin: 10px 220px;">
        <?= htmlspecialchars($dadosParaView['sucesso']) ?>
    </div>
<?php endif; ?>

<!-- Card header -->
<div class="card-headers">
    <h1>Minhas Tarefas</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.</p>
</div>

<!-- Breadcrumb -->
<div class="breadcrumbs">
    <p class="breadcrumbs-p">
        <a class="breadcrumbs-a" href="index.php?controller=home&method=index">
            Home
        </a> &gt; Minhas tarefas
    </p>
</div>

<div class="card">
<!-- Botão nova tarefa -->
<div>
    <button onclick="abrirModal()">+ Nova Tarefa</button>
</div>
<br>
<!-- Tabela para gestão de tarefas -->
<table class="tabela-tarefas">
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
                    <td>
                        <span class="tag prioridade-<?= strtolower($tarefa['TASK_PRIORIDADE']) ?>">
                            <?= htmlspecialchars(ucfirst($tarefa['TASK_PRIORIDADE'])) ?>
                        </span>
                    </td>
                    <td>
                        <span class="status status-<?= strtolower($tarefa['TASK_STATUS']) ?>">
                            <?= htmlspecialchars(ucfirst($tarefa['TASK_STATUS'])) ?>
                        </span>
                    </td>
                    <td class="acoes">
                        <button class="btn ver" onclick="abrirModalVer(<?= $tarefa['TASK_ID'] ?>)">
                            <i class="bi bi-eye"></i>
                        </button>
                        <button class="btn editar" onclick="abrirModalEditar(<?= $tarefa['TASK_ID'] ?>)">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn apagar" onclick="abrirModalApagar(<?= $tarefa['TASK_ID'] ?>)">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="sem-tarefas">Nenhuma tarefa encontrada.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<div class="area-segura"></div>

</div>