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
    <div>
        <p>
            <a href="index.php?controller=home&method=index">
                Home
            </a> &gt; 
            <a href="index.php?controller=tarefa&method=gestaoTarefa">
                Minhas tarefas
            </a> &gt; 
            Editar
        </p>
    </div>

    <!-- Card principal -->
    <div>
        <!-- Botão X para voltar -->
        <a href="index.php?controller=tarefa&method=gestaoTarefa">
            X
        </a>

        <!-- Título -->
        <h1>Editar Tarefa</h1>
<?php else: ?>
    <!-- Quando for modal -->
    <h2>Editar Tarefa</h2>
<?php endif; ?>

<!-- Formulário de edição -->
<form method="POST" action="index.php?controller=tarefa&method=atualizar" class="modal-form">
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
        maxlength="280"><?= htmlspecialchars($dadosParaView['descricao'] ?? '') ?></textarea>

    <div class="acoes-modal">
        <button type="submit">Salvar Alterações</button>
    </div>
</form>

<?php if ($direto): ?>
    </div> <!-- fecha card -->

    <!-- Rodapé padrão -->
    <footer>
        <p>&copy; <?= date('Y') ?> Organizador. Todos os direitos reservados.</p>
    </footer>
<?php endif; ?>