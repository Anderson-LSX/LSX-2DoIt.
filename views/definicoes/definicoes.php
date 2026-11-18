<link rel="icon" type="image/png" href="public/img/favicon-2-do-it.png" />


<!-- Card principal -->
<div class="card-headers">
    <h1>Definições</h1>
    <p>Nesta seção, você pode ajustar as preferências da sua conta e da aplicação.</p>
</div>

<!-- Breadcrumb -->
<div class="breadcrumbs">
    <p style="font-size: 14px; color: #555;">
        <a href="index.php?controller=home&method=index" style="text-decoration: none; color: #555;">
            Home
        </a> &gt; Definições
    </p>
</div>

<!-- Card com dados de definições -->
<div class="card">

    <!-- Abas (Geral | Minha senha) -->
    <div style="display: flex; margin-bottom: 20px; gap: 20px;">
        <button class="button-aba-settings" onclick="mostrarAba('geral')" id="abaGeral"  style="border-bottom: 5px solid black;">
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
        <div style="margin-bottom: 20px;">
            <label for="tema"><strong>Tema:</strong></label><br>
            <select id="tema" name="tema" style="padding: 8px; width: 200px; border: 1px solid black;">
                <option value="default">Default</option>
                <option value="indigo">Indigo</option>
                <option value="clear">Clear</option>
                <option value="meia-noite">Meia-Noite</option>
                <option value="win-98">Win-98</option>
            </select>
        </div>

        <!-- Saudação dinâmica -->
        <div style="margin-bottom: 20px;">
            <label style="display: flex; align-items: center; cursor: pointer;">
                <span style="margin-right: 10px;">Saudação dinâmica     </span>
                <input type="checkbox" id="toggleSaudacaoDinamica" style="display:none;">
                <span class="switch"></span>
            </label>
        </div>

        <!-- Saudação personalizada -->
        <div style="margin-bottom: 10px;">
            <label style="display: flex; align-items: center; cursor: pointer;">
                <span style="margin-right: 10px;">Saudação personalizada</span>
                <input type="checkbox" id="toggleSaudacaoPersonalizada" style="display:none;">
                <span class="switch"></span>
            </label>
        </div>

        <!-- Campo de texto da Saudação personalizada -->
        <div style="margin-bottom: 20px;">
            <input type="text" id="inputSaudacaoPersonalizada" placeholder="Digite sua saudação personalizada" disabled
                   style="padding: 8px; width: 100%; max-width: 400px; border: 1px solid black; box-sizing: border-box;">
        </div>

        <!-- Apagar conta -->
        <div>
            <a href="index.php?controller=definicoes&method=apagarConta" style="color: red; text-decoration: none; font-weight: bold;">
                Apagar minha conta
            </a>
        </div>
    </div>

    <!-- Conteúdo da aba Minha senha -->
    <div id="conteudoSenha" style="display: none;">
        <h2>Alterar Senha</h2>

        <!-- Campo: Nova senha -->
        <div style="margin-bottom: 15px;">
            <label for="novaSenha"><strong>Nova senha:</strong></label><br>
            <input type="password" id="novaSenha" name="novaSenha" style="padding: 8px; width: 300px; border: 1px solid black;">
        </div>

        <!-- Campo: Confirmar nova senha -->
        <div style="margin-bottom: 20px;">
            <label for="confirmarSenha"><strong>Confirmar nova senha:</strong></label><br>
            <input type="password" id="confirmarSenha" name="confirmarSenha" style="padding: 8px; width: 300px; border: 1px solid black;">
        </div>

        <button> 
            Salvar nova senha
        </button>
    </div>

</div>

<!-- Estilos para botões chave -->
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 24px;
  background-color: #ccc;
  border-radius: 12px;
  transition: background-color 0.3s;
}
.switch::before {
  content: "";
  position: absolute;
  left: 2px;
  top: 2px;
  width: 20px;
  height: 20px;
  background-color: white;
  border-radius: 50%;
  transition: transform 0.3s;
}
input[type="checkbox"]:checked + .switch {
  background-color: #4caf50;
}
input[type="checkbox"]:checked + .switch::before {
  transform: translateX(26px);
}
label {
  user-select: none;
}
</style>

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

        if (qual === 'geral') {
            conteudoGeral.style.display = 'block';
            conteudoSenha.style.display = 'none';
            abaGeral.style.borderBottom = '2px solid black';
            abaSenha.style.borderBottom = 'none';
        } else {
            conteudoGeral.style.display = 'none';
            conteudoSenha.style.display = 'block';
            abaGeral.style.borderBottom = 'none';
            abaSenha.style.borderBottom = '2px solid black';
        }
    }
</script>

