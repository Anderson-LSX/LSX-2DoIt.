<?php
require_once 'models/homeModel.php';

class homeController {
    public function index() {
        
        $login = $_SESSION['usuario_logado'];

        $model = new homeModel();

        // Busca valores numéricos (contagens)
        $nomeParaExibir = $model->getNomeParaExibir($login);
        $proximasTarefasQtd = $model->getQtdProximasTarefas($login);
        $qtdConcluidasUlt30Dias = $model->getQtdConcluidasUlt30Dias($login);
        $totalTarefas = $model->getTotalTarefas($login);
        $tarefasAltaPrioridade = $model->getTarefasAltaPrioridade($login);
        $tarefasPendentes = $model->getTarefasPendentes($login);
        $tarefasAtrasadas = $model->getTarefasAtrasadas($login);

        // Busca lista detalhada para cards de tabela
        $proximasTarefasTabela = $model->getProximasTarefasTabela($login);
        $tarefasAtrasadasTabela = $model->getTarefasAtrasadasTabela($login);
        $todasTarefasTabela = $model->getTodasTarefasTabela($login);
        $ultimasTarefasRealizadasTabela = $model->getUltimasTarefasRealizadasTabela($login);

        // Monta array para passar à view
        $dadosParaView = [
            'anoAtual' => date('Y'),
            'nomeParaExibir' => $nomeParaExibir,
            'proximasTarefasQtd' => $proximasTarefasQtd,
            'qtdConcluidasUlt30Dias' => $qtdConcluidasUlt30Dias,
            'totalTarefas' => $totalTarefas,
            'tarefasAltaPrioridade' => $tarefasAltaPrioridade,
            'tarefasPendentes' => $tarefasPendentes,
            'tarefasAtrasadas' => $tarefasAtrasadas,
            'proximasTarefasTabela' => $proximasTarefasTabela,
            'tarefasAtrasadasTabela' => $tarefasAtrasadasTabela,
            'todasTarefasTabela' => $todasTarefasTabela,
            'ultimasTarefasRealizadasTabela' => $ultimasTarefasRealizadasTabela 
        ];

        include 'views/home/home.php';
    }
}
