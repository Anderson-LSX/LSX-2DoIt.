<!-- Estilização inline básica conforme padrão -->


<!-- Breadcrumb -->
<div style="margin-left: 220px; margin-right: 220px; margin-top: 40px; margin-bottom: 10px;">
    <p style="font-size: 14px; color: #555;">
        <a href="index.php?controller=home&method=index" style="text-decoration: none; color: #555;">
            Home
        </a> &gt; 
        <a href="index.php?controller=tarefa&method=gestaoTarefa" style="text-decoration: none; color: #555;">
            Minhas tarefas
        </a> &gt; 
        Nova tarefa
    </p>
</div>

<!-- Card principal -->
<div style="border: 1px solid black; padding: 20px; margin-left: 220px; margin-right: 220px; margin-bottom: 20px; position: relative;">

<!-- Botão X -->
    <a href="index.php?controller=tarefa&method=gestaoTarefa" 
       style="position: absolute; top: 10px; right: 15px; text-decoration: none; font-size: 20px; font-weight: bold; color: #000;">
        X
    </a>

    <!-- Título -->
    <h1>Nova tarefa</h1>

    
    <!-- Descrição -->
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.</p>

    <!-- Mensagem de erro, se existir -->
<?php if (!empty($dadosParaView['erro'])): ?>
    <div style="color: red; font-weight: bold; margin-bottom: 15px;">
        <?= htmlspecialchars($dadosParaView['erro']) ?>
    </div>
<?php endif; ?>

    <!-- Formulário de Nova Tarefa -->
    <form method="POST" action="index.php?controller=tarefa&method=salvar" style="margin: 0 220px;">

        <!-- Campo: Título da Tarefa -->
        <label for="titulo" style="font-weight: bold;">Título da tarefa*</label><br>
        <input type="text" id="titulo" name="titulo" required
            style="width: 100%; padding: 8px; margin-bottom: 20px; border: 1px solid #000;"
            value="<?= isset($_POST['titulo']) ? htmlspecialchars($_POST['titulo']) : '' ?>"><br>

        <!-- Campo: Tipo da Tarefa -->
        <label for="tipotarefa" style="font-weight: bold;">Tipo da tarefa*</label><br>
        <input type="text" id="tipotarefa" name="tipotarefa" required
            style="width: 100%; padding: 8px; margin-bottom: 20px; border: 1px solid #000;"
            value="<?= isset($_POST['tipotarefa']) ? htmlspecialchars($_POST['tipotarefa']) : '' ?>"><br>

        <!-- Campo: Prioridade da Tarefa -->
        <label style="font-weight: bold;">Prioridade*</label><br>
        <div style="display: flex; gap: 10px; margin-bottom: 20px;">
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
<label for="datafim" style="font-weight: bold;">Data de Vencimento*</label><br>
<input 
    type="datetime-local"                     
    id="datafim"                             
    name="datafim"                           
    value="<?= isset($dadosParaView['dataVencimento']) ? htmlspecialchars($dadosParaView['dataVencimento']) : '' ?>" 
    min="<?= isset($dadosParaView['dataMinima']) ? htmlspecialchars($dadosParaView['dataMinima']) : '' ?>"      
    step="60" 
    required
    style="width: 100%; padding: 8px; margin-bottom: 20px; border: 1px solid #000;"
>


        <!-- Campo: Descrição da Tarefa -->
        <label for="descricao" style="font-weight: bold;">Descrição</label><br>
        <textarea 
            id="descricao" 
            name="descricao"
            placeholder="<?= isset($dadosParaView['descricaoPlaceholder']) ? htmlspecialchars($dadosParaView['descricaoPlaceholder']) : '' ?>" 
            style="
                width: 100%; 
                height: 120px;  
                padding: 8px; 
                margin-bottom: 20px; 
                border: 1px solid #000;
                resize: none;   
                overflow-y: auto; 
            "
            maxlength="280"><?= isset($dadosParaView['descricaoConteudo']) ? htmlspecialchars($dadosParaView['descricaoConteudo']) : '' ?></textarea>

        <!-- Botão Salvar -->
        <div style="text-align: right; margin-top: 20px;">
            <button type="submit">
                Salvar Tarefa
            </button>
        </div>
    </form>
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
