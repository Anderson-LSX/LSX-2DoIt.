<?php
// $dadosParaView traz os dados da tarefa para preencher os campos no formulário
?>

<!-- Breadcrumb -->
<div style="margin-left: 220px; margin-right: 220px; margin-top: 40px; margin-bottom: 10px;">
    <p style="font-size: 14px; color: #555;">
        <a href="index.php?controller=home&method=index" style="text-decoration: none; color: #555;">Home</a> &gt;
        <a href="index.php?controller=tarefa&method=gestaoTarefa" style="text-decoration: none; color: #555;">Minhas tarefas</a> &gt;
        Editar
    </p>
</div>

<!-- Card principal -->
<div style="border: 1px solid black; padding: 20px; margin-left: 220px; margin-right: 220px; margin-bottom: 20px; position: relative;">
    
<!-- Botão X no canto superior direito -->
    <a href="index.php?controller=tarefa&method=gestaoTarefa" 
       style="position: absolute; top: 10px; right: 15px; text-decoration: none; font-size: 20px; font-weight: bold; color: #000;">
        X
    </a>

<h1>Editar</h1>

    <form action="index.php?controller=tarefa&method=atualizar" method="POST" style="max-width: 600px;">
        <input type="hidden" name="task_id" value="<?= htmlspecialchars($dadosParaView['id'] ?? '') ?>">

        <label for="titulo">Título:</label><br>
        <input type="text" id="titulo" name="titulo" required
               value="<?= htmlspecialchars($dadosParaView['titulo'] ?? '') ?>" style="width: 100%;"><br><br>

        <label for="tipotarefa">Tipo da tarefa:</label><br>
        <input type="text" id="tipotarefa" name="tipotarefa" required
               value="<?= htmlspecialchars($dadosParaView['tipo'] ?? '') ?>" style="width: 100%;"><br><br>

        <label for="prioridade">Prioridade:</label><br>
        <select id="prioridade" name="prioridade" required style="width: 100%;">
            <?php
            $prioridades = ['alta', 'média', 'baixa'];
            $prioridadeSelecionada = strtolower($dadosParaView['prioridade'] ?? 'média');
            foreach ($prioridades as $p):
            ?>
                <option value="<?= $p ?>" <?= ($p === $prioridadeSelecionada) ? 'selected' : '' ?>>
                    <?= ucfirst($p) ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="datafim">Data de vencimento:</label><br>
        <input type="datetime-local" id="datafim" name="datafim" required
               value="<?= htmlspecialchars($dadosParaView['dataVencimento'] ?? '') ?>" style="width: 100%;"><br><br>

        <!-- Campo Status -->
        <label for="status">Status:</label><br>
        <select id="status" name="status" required style="width: 100%;">
            <?php
            $statuses = ['pendente', 'concluída', 'cancelada'];
            $statusSelecionado = strtolower($dadosParaView['status'] ?? 'pendente');
            foreach ($statuses as $s):
            ?>
                <option value="<?= $s ?>" <?= ($s === $statusSelecionado) ? 'selected' : '' ?>>
                    <?= ucfirst($s) ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>
        
        <label for="descricao">Descrição:</label><br>
        <textarea id="descricao" name="descricao" rows="5" maxlength="280"
                  style="width: 100%;"><?= htmlspecialchars($dadosParaView['descricao'] ?? '') ?></textarea><br><br>

        <button type="submit">
        Salvar alterações</button>
        
    </form>
</div>

<!-- Rodapé padrão -->
<footer style="position: fixed; border: 1px solid black; padding: 20px; bottom: 0; left: 220px; right: 220px; background: none; z-index: 999;">
    <p align="right">&copy; <?= date('Y') ?> Organizador. Todos os direitos reservados.</p>
</footer>
