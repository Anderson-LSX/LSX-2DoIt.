<link rel="icon" type="image/png" href="public/img/favicon-2-do-it.png" />


<!-- Card principal -->
<div class="card-headers">
    <h1>Definições</h1>
    <p>Nesta seção, você pode ajustar as preferências da sua conta e da aplicação.</p>
</div>

<!-- Breadcrumb -->
<div class="breadcrumbs">
    <p class="breadcrumbs-p">
        <a class="breadcrumbs-a" href="index.php?controller=home&method=index">
            Home
        </a> &gt; Definições
    </p>
</div>

<!-- Card com dados de definições -->
<div class="card card-definicoes">

    <!-- Abas (Geral | Minha senha) -->
    <div class="abas-settings">
        <button class="button-aba-settings aba-inicial" onclick="mostrarAba('geral')" id="abaGeral">
            <spam>Geral</spam>
        </button>
        <button class="button-aba-settings" onclick="mostrarAba('senha')" id="abaSenha">
            <spam>Minha senha</spam>
        </button>
    </div>

    <!-- Conteúdo da aba Geral -->
    <div id="conteudoGeral">
        <h2>Configurações Gerais</h2>

        <!-- Tema -->
        <div class="campo-form">
            <label for="tema"><strong>Tema:</strong></label><br>
            <select id="tema" name="tema" class="input-config input-config-200">
                <option value="default">Default</option>
                <option value="indigo">Indigo</option>
                <option value="clear">Clear</option>
                <option value="meia-noite">Meia-Noite</option>
                <option value="win-98">Win-98</option>
            </select>
        </div>

        <!-- Saudação dinâmica -->
        <div class="campo-form">
            <label class="label-toggle">
                <span class="label-toggle-texto">Saudação dinâmica     </span>
                <input type="checkbox" id="toggleSaudacaoDinamica" class="oculto">
                <span class="switch"></span>
            </label>
        </div>

        <!-- Saudação personalizada -->
        <div class="campo-form-compacto">
            <label class="label-toggle">
                <span class="label-toggle-texto">Saudação personalizada</span>
                <input type="checkbox" id="toggleSaudacaoPersonalizada" class="oculto">
                <span class="switch"></span>
            </label>
        </div>

        <!-- Campo de texto da Saudação personalizada -->
        <div class="campo-form">
            <input type="text" id="inputSaudacaoPersonalizada" placeholder="Digite sua saudação personalizada" disabled
                   class="input-config">
        </div>

        <!-- Apagar conta -->
        <div>
            <a class="link-perigo" href="index.php?controller=definicoes&method=apagarConta">
                Apagar minha conta
            </a>
        </div>
    </div>

    <!-- Conteúdo da aba Minha senha -->
    <div id="conteudoSenha" class="oculto">
        <h2>Alterar Senha</h2>

        <!-- Campo: Nova senha -->
        <div class="campo-form-medio">
            <label for="novaSenha"><strong>Nova senha:</strong></label><br>
            <input type="password" id="novaSenha" name="novaSenha" class="input-config input-config-300">
        </div>

        <!-- Campo: Confirmar nova senha -->
        <div class="campo-form">
            <label for="confirmarSenha"><strong>Confirmar nova senha:</strong></label><br>
            <input type="password" id="confirmarSenha" name="confirmarSenha" class="input-config input-config-300">
        </div>

        <button> 
            Salvar nova senha
        </button>
    </div>

</div>

<!-- Script JS abas e botões chave -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleDinamica = document.getElementById('toggleSaudacaoDinamica');
        const togglePersonalizada = document.getElementById('toggleSaudacaoPersonalizada');
        const inputSaudacao = document.getElementById('inputSaudacaoPersonalizada');

        toggleDinamica.addEventListener('change', function() {
            if (this.checked) {
                console.log('Saudação dinâmica ativada');
            } else {
                console.log('Saudação dinâmica desativada');
            }
        });

        function atualizarInput() {
            inputSaudacao.disabled = !togglePersonalizada.checked;
        }

        togglePersonalizada.addEventListener('change', function() {
            atualizarInput();
            if (this.checked) {
                console.log('Saudação personalizada ativada');
            } else {
                console.log('Saudação personalizada desativada');
            }
        });

        // Inicializa estado do input no carregamento
        atualizarInput();
    });

    function mostrarAba(qual) {
        const abaGeral = document.getElementById('abaGeral');
        const abaSenha = document.getElementById('abaSenha');
        const conteudoGeral = document.getElementById('conteudoGeral');
        const conteudoSenha = document.getElementById('conteudoSenha');

        // Limpa os estados anteriores das abas (inicial, ativa, inativa)
        ['aba-inicial', 'aba-ativa', 'aba-inativa'].forEach(function(classe) {
            abaGeral.classList.remove(classe);
            abaSenha.classList.remove(classe);
        });

        if (qual === 'geral') {
            conteudoGeral.classList.remove('oculto');
            conteudoSenha.classList.add('oculto');
            abaGeral.classList.add('aba-ativa');
            abaSenha.classList.add('aba-inativa');
        } else {
            conteudoGeral.classList.add('oculto');
            conteudoSenha.classList.remove('oculto');
            abaGeral.classList.add('aba-inativa');
            abaSenha.classList.add('aba-ativa');
        }
    }
</script>

