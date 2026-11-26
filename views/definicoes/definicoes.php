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

<!-- Área de definições: menu de seções ao lado + card da seção escolhida -->
<div class="layout-secoes">

    <!-- Menu das seções: cada link mostra o card correspondente -->
    <nav class="card menu-secoes">
        <p class="titulo-secao">Seções</p>
        <ul>
            <li><a href="#geral" class="ativo" data-secao="geral" onclick="mostrarSecao('geral'); return false;">Geral</a></li>
            <li><a href="#senha" data-secao="senha" onclick="mostrarSecao('senha'); return false;">Minha senha</a></li>
            <li><a href="#" class="link-perigo" onclick="abrirModalApagarConta(); return false;">Apagar minha conta</a></li>
        </ul>
    </nav>

    <div class="conteudo-secoes">

        <!-- Seção Geral -->
        <section id="geral" class="card card-definicoes">
            <h2 class="titulo-secao">Configurações Gerais</h2>

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
        </section>

        <!-- Seção Minha senha -->
        <section id="senha" class="card card-definicoes oculto">
            <h2 class="titulo-secao">Alterar Senha</h2>

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
        </section>

    </div>
</div>

<!-- Script JS do menu de seções e botões chave -->
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

    // Mostra apenas o card da seção escolhida e destaca o item correspondente no menu
    function mostrarSecao(qual) {
        document.querySelectorAll('.conteudo-secoes > section').forEach(function(secao) {
            secao.classList.toggle('oculto', secao.id !== qual);
        });

        document.querySelectorAll('.menu-secoes a').forEach(function(link) {
            link.classList.toggle('ativo', link.dataset.secao === qual);
        });
    }
</script>
