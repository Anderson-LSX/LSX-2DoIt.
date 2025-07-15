<?php
require_once __DIR__ . '/../models/usuarioModel.php';

class usuarioController {
    
    public function meuPerfil()
    {
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: index.php?controller=auth&method=login");
            exit;
        }

        require_once __DIR__ . '/../models/UsuarioModel.php';

        $usuarioModel = new UsuarioModel();

        $id = $_SESSION['usuario_id'];

        $usuario = $usuarioModel->buscarUsuarioPorId($id);

        if ($usuario) {
            $dadosParaView = [
                'id' => $usuario['USU_ID'],
                'nome' => $usuario['USU_NOME'],
                'apelido' => $usuario['USU_APELIDO'],
                'idade' => $usuario['USU_IDADE']
            ];

            require_once __DIR__ . '/../views/usuario/meuPerfil.php';
        } else {
            echo "Usuário não encontrado.";
        }
    }
    
    public function editarPerfil()
    {
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: index.php?controller=auth&method=login");
            exit;
        }

        require_once __DIR__ . '/../models/UsuarioModel.php';

        $usuarioModel = new UsuarioModel();

        $id = $_SESSION['usuario_id'];

        $usuario = $usuarioModel->buscarUsuarioPorId($id);

        if ($usuario) {
            $dadosParaView = [
                'id' => $usuario['USU_ID'],
                'nome' => $usuario['USU_NOME'],
                'apelido' => $usuario['USU_APELIDO'],
                'idade' => $usuario['USU_IDADE']
            ];

            require_once __DIR__ . '/../views/usuario/editarPerfil.php';
        } else {
            echo "Usuário não encontrado.";
        }
    }

public function salvarEdicao()
{
    // Verifica se o usuário está logado
    if (!isset($_SESSION['usuario_id'])) {
        // Se não estiver logado, redireciona para a página de login
        header("Location: index.php?controller=auth&method=login");
        exit;
    }

    // Obtém os dados enviados via POST, utilizando trim para limpar espaços extras
    $id = $_SESSION['usuario_id'];  // ID do usuário da sessão, para garantir segurança
    $nome = trim($_POST['nome'] ?? '');
    $apelido = trim($_POST['apelido'] ?? '');
    $idade = intval($_POST['idade'] ?? 0);

    // Validações simples: nome não pode estar vazio e idade deve ser maior que zero
    if ($nome === '' || $idade <= 0) {
        // Aqui você pode implementar redirecionamento com mensagem de erro, por enquanto exibe erro simples
        echo "Nome é obrigatório e idade deve ser maior que zero.";
        exit;
    }

    // Inclui o model para poder atualizar o usuário
    require_once __DIR__ . '/../models/UsuarioModel.php';
    $usuarioModel = new UsuarioModel();

    // Chama o método para atualizar o usuário no banco de dados
    $sucesso = $usuarioModel->atualizarUsuario($id, $nome, $apelido, $idade);

    if ($sucesso) {
        // Se atualização foi bem-sucedida, redireciona para a página do perfil com parâmetro de sucesso
        header("Location: index.php?controller=usuario&method=meuPerfil&sucesso=1");
        exit;
    } else {
        // Em caso de erro na atualização, mostra mensagem
        echo "Erro ao atualizar os dados.";
        exit;
    }
}



}
