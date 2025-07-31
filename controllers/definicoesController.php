<?php

class definicoesController
{
    public function definicoes()
    {
        // Aqui você pode futuramente carregar dados, se necessário.
        $dadosParaView = []; // Inicialmente vazio

        require_once __DIR__ . '/../views/definicoes/definicoes.php';
    }

    public function apagarConta()
{
    require_once __DIR__ . '/../views/definicoes/apagarConta.php';
}

}
