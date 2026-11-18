<?php
// Detecta se está sendo carregada diretamente (fora do modal via fetch)
$direto = !isset($_SERVER['HTTP_X_REQUESTED_WITH']);
?>

<!-- Conteúdo da Nova Tarefa -->
<?php if ($direto): ?>
    <!-- Botão X para fechar quando acessada diretamente -->
    <a href="index.php?controller=tarefa&method=gestaoTarefa" 
       style="position: absolute; top: 10px; right: 15px; text-decoration: none; font-size: 20px; font-weight: bold; color: #000;">
        X
    </a>
<?php endif; ?>

<h1>Nova tarefa</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.</p>

<!-- Mensagem de erro, se existir -->
<?php if (!empty($dadosParaView['erro'])): ?>
    <div style="color: red; font-weight: bold; margin-bottom: 15px;">
        <?= htmlspecialchars($dadosParaView['erro']) ?>
    </div>
<?php endif; ?>

<!-- Formulário de Nova Tarefa -->
<form method="POST" action="index.php?controller=tarefa&method=salvar" class="modal-form" style="margin-top: 20px;">

    <!-- Campo: Título da Tarefa -->
    <label for="titulo">Título da tarefa*</label><br>
    <input type="text" id="titulo" name="titulo" required
        value="<?= isset($_POST['titulo']) ? htmlspecialchars($_POST['titulo']) : '' ?>"><br>

    <!-- Campo: Tipo da Tarefa -->
    <label for="tipotarefa">Tipo da tarefa*</label><br>
    <input type="text" id="tipotarefa" name="tipotarefa" required
        value="<?= isset($_POST['tipotarefa']) ? htmlspecialchars($_POST['tipotarefa']) : '' ?>"><br>

    <!-- Campo: Prioridade da Tarefa -->
    <label>Prioridade*</label><br>
    <div class="radiobox-modais">
        <label>
            <input type="radio" name="prioridade" value="baixa" <?= (isset($dadosParaView['prioridadePadrao']) && strtolower($dadosParaView['prioridadePadrao']) === 'baixa') ? 'checked' : '' ?>>
            Baixa
        </label>
        <label>
            <input type="radio" name="prioridade" value="média" <?= (isset($dadosParaView['prioridadePadrao']) && strtolower($dadosParaView['prioridadePadrao']) === 'média') ? 'checked' : '' ?>>
            Média
        </label>
        <label>
            <input type="radio" name="prioridade" value="alta" <?= (isset($dadosParaView['prioridadePadrao']) && strtolower($dadosParaView['prioridadePadrao']) === 'alta') ? 'checked' : '' ?>>
            Alta
        </label>
    </div>

    <!-- Campo: Data de Vencimento -->
    <label for="datafim">Data de Vencimento*</label><br>
    <input 
        type="datetime-local"                     
        id="datafim"                             
        name="datafim"                           
        value="<?= isset($dadosParaView['dataVencimento']) ? htmlspecialchars($dadosParaView['dataVencimento']) : '' ?>" 
    >
<br>
    <!-- Campo: Descrição da Tarefa -->
    <label for="descricao">Descrição</label><br>
    <textarea 
        id="descricao" 
        name="descricao"
        placeholder="<?= isset($dadosParaView['descricaoPlaceholder']) ? htmlspecialchars($dadosParaView['descricaoPlaceholder']) : '' ?>" 
        style="
            height: 80px;  
            resize: none;   
            overflow-y: auto; 
        "
        maxlength="280"><?= isset($dadosParaView['descricaoConteudo']) ? htmlspecialchars($dadosParaView['descricaoConteudo']) : '' ?></textarea>

    <!-- Botão Salvar -->
    <div class="acoes-modal">
        <button type="submit">
            Salvar Tarefa
        </button>
    </div>
</form>