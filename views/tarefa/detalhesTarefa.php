<?php
if (!isset($dadosParaView)) {
    echo "ERRO: dadosParaView não está definido.";
    exit;
}?>

<!-- Breadcrumb -->
<div style="margin-left: 220px; margin-right: 220px; margin-top: 40px; margin-bottom: 10px;">
    <p style="font-size: 14px; color: #555;">
        <a href="index.php?controller=home&method=index" style="text-decoration: none; color: #555;">
            Home
        </a> &gt; 
        <a href="index.php?controller=tarefa&method=gestaoTarefa" style="text-decoration: none; color: #555;">
            Minhas tarefas
        </a> &gt; 
        Detalhes
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
    <h1>Detalhes</h1>

    <!-- Exibição dos campos -->
    <p><strong>Título:</strong> <?= htmlspecialchars($dadosParaView['titulo'] ?? '') ?></p>
<p><strong>Tipo:</strong> <?= htmlspecialchars($dadosParaView['tipo'] ?? '') ?></p>
<p><strong>Prioridade:</strong> <?= htmlspecialchars($dadosParaView['prioridade'] ?? '') ?></p>
<p><strong>Data de Vencimento:</strong> 
    <?= isset($dadosParaView['dataVencimento']) ? date('d/m/Y H:i', strtotime($dadosParaView['dataVencimento'])) : '' ?>
</p>
<p><strong>Descrição:</strong><br>
    <?= nl2br(htmlspecialchars($dadosParaView['descricao'] ?? '')) ?>
</p>

</div>

<!-- Rodapé padrão -->
<footer style="position: fixed; border: 1px solid black; padding: 20px; bottom: 0; left: 220px; right: 220px; background: none; z-index: 999;">
    <p align="right">&copy; <?= date('Y') ?> Organizador. Todos os direitos reservados.</p>
</footer>
