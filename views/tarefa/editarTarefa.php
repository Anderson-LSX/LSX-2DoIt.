<?php
if (!isset($dadosParaView)) {
    echo "ERRO: dadosParaView não está definido.";
    exit;
}

// Detecta se está sendo carregada diretamente (fora do modal via fetch)
$direto = !isset($_SERVER['HTTP_X_REQUESTED_WITH']);
?>

<?php if ($direto): ?>
    <!-- Breadcrumb -->
    <div style="margin-left: 220px; margin-right: 220px; margin-top: 40px; margin-bottom: 10px;">
        <p style="font-size: 14px; color: #555;">
            <a href="index.php?controller=home&method=index" style="text-decoration: none; color: #555;">
                Home
            </a> &gt; 
            <a href="index.php?controller=tarefa&method=gestaoTarefa" style="text-decoration: none; color: #555;">
                Minhas tarefas
            </a> &gt; 
            Editar
        </p>
    </div>

    <!-- Card principal -->
    <div style="border: 1px solid black; padding: 20px; margin-left: 220px; margin-right: 220px; margin-bottom: 20px; position: relative;">
        <!-- Botão X para voltar -->
        <a href="index.php?controller=tarefa&method=gestaoTarefa" 
           style="position: absolute; top: 10px; right: 15px; text-decoration: none; font-size: 20px; font-weight: bold; color: #000;">
            X
        </a>

        <!-- Título -->
        <h1>Editar Tarefa</h1>
<?php else: ?>
    <!-- Quando for modal -->
    <h2>Editar Tarefa</h2>
<?php endif; ?>

<!-- Formulário de edição -->
<form method="POST" action="index.php?controller=tarefa&method=atualizar" class="modal-form" style="margin-top: 20px;">
    <input type="hidden" name="task_id" value="<?= htmlspecialchars($dadosParaView['id'] ?? '') ?>">

    <label for="titulo">Título*</label><br>
    <input type="text" id="titulo" name="titulo" required
        value="<?= htmlspecialchars($dadosParaView['titulo'] ?? '') ?>"><br>

    <label for="tipotarefa">Tipo*</label><br>
    <input type="text" id="tipotarefa" name="tipotarefa" required
        value="<?= htmlspecialchars($dadosParaView['tipo'] ?? '') ?>"><br>

    <label>Prioridade*</label><br>
    <div class="radiobox-modais">
        <label><input type="radio" name="prioridade" value="baixa" <?= (isset($dadosParaView['prioridade']) && strtolower($dadosParaView['prioridade']) === 'baixa') ? 'checked' : '' ?>> Baixa</label>
        <label><input type="radio" name="prioridade" value="média" <?= (isset($dadosParaView['prioridade']) && strtolower($dadosParaView['prioridade']) === 'média') ? 'checked' : '' ?>> Média</label>
        <label><input type="radio" name="prioridade" value="alta" <?= (isset($dadosParaView['prioridade']) && strtolower($dadosParaView['prioridade']) === 'alta') ? 'checked' : '' ?>> Alta</label>
    </div>

    <label for="datafim">Data de Vencimento*</label><br>
    <input type="datetime-local" id="datafim" name="datafim"
        value="<?= isset($dadosParaView['dataVencimento']) ? htmlspecialchars($dadosParaView['dataVencimento']) : '' ?>">

    <label for="descricao">Descrição</label><br>
    <textarea id="descricao" name="descricao"
        style="height: 120px; resize: none; overflow-y: auto;"
        maxlength="280"><?= htmlspecialchars($dadosParaView['descricao'] ?? '') ?></textarea>

    <div class="acoes-modal">
        <button type="submit">Salvar Alterações</button>
    </div>
</form>

<?php if ($direto): ?>
    </div> <!-- fecha card -->

    <!-- Rodapé padrão -->
    <footer style="position: fixed; border: 1px solid black; padding: 20px; bottom: 0; left: 220px; right: 220px; background: none; z-index: 999;">
        <p align="right">&copy; <?= date('Y') ?> Organizador. Todos os direitos reservados.</p>
    </footer>
<?php endif; ?>