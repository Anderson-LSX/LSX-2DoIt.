/* Funções de modal */

function abrirModal() {
  // Exibe overlay
  const overlay = document.getElementById('overlay');
  overlay.style.display = 'flex';

  // Limpa conteúdo anterior (evita duplicação)
  const modal = document.getElementById('modalContent');
  // Corrigido: X apenas fecha o modal, sem redirecionar
  modal.innerHTML = '<span onclick="document.getElementById(\'overlay\').style.display=\'none\';" style="cursor:pointer; position:absolute; top:10px; right:15px; font-size:20px; font-weight:bold; color:#000;">X</span>';

  // Carrega conteúdo da página via fetch
  fetch('index.php?controller=novaTarefa&method=novaTarefa', {
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
  .then(response => response.text())
  .then(html => {
    modal.innerHTML += html;
  })
  .catch(err => {
    modal.innerHTML += "<p style='color:red;'>Erro ao carregar conteúdo.</p>";
  });

  // Fecha ao clicar fora do card (overlay)
  overlay.onclick = function(e) {
    if (e.target === overlay) {
      overlay.style.display = 'none';
    }
  };
}

function abrirModalVer(taskId) {
  const overlay = document.getElementById('overlay');
  overlay.style.display = 'flex';
  const modal = document.getElementById('modalContent');
  modal.innerHTML = '<span onclick="document.getElementById(\'overlay\').style.display=\'none\';" style="cursor:pointer; position:absolute; top:10px; right:15px; font-size:20px; font-weight:bold; color:#000;">X</span>';

  fetch('index.php?controller=tarefa&method=detalhesTarefa&task_id=' + taskId, {
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
    .then(response => response.text())
    .then(html => { modal.innerHTML += html; })
    .catch(err => { modal.innerHTML += "<p style='color:red;'>Erro ao carregar detalhes da tarefa.</p>"; });

  overlay.onclick = function(e) { if (e.target === overlay) overlay.style.display = 'none'; };
}

function abrirModalEditar(taskId) {
  const overlay = document.getElementById('overlay');
  overlay.style.display = 'flex';
  const modal = document.getElementById('modalContent');
  modal.innerHTML = '<span onclick="document.getElementById(\'overlay\').style.display=\'none\';" style="cursor:pointer; position:absolute; top:10px; right:15px; font-size:20px; font-weight:bold; color:#000;">X</span>';

  fetch('index.php?controller=tarefa&method=editarTarefa&task_id=' + taskId, {
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
    .then(response => response.text())
    .then(html => { modal.innerHTML += html; })
    .catch(err => { modal.innerHTML += "<p style='color:red;'>Erro ao carregar edição da tarefa.</p>"; });

  overlay.onclick = function(e) { if (e.target === overlay) overlay.style.display = 'none'; };
}

function abrirModalApagar(taskId) {
  const overlay = document.getElementById('overlay');
  overlay.style.display = 'flex';
  const modal = document.getElementById('modalContent');
  modal.innerHTML = `
    <h2>Tem certeza?</h2>
    <p>Esta ação não pode ser desfeita.</p>
    <div style="display:flex; gap:10px; justify-content:flex-end; margin-top:20px;">
      <button onclick="document.getElementById('overlay').style.display='none';"
              style="background-color:#c00; color:#fff; padding:10px 20px; border:none; cursor:pointer;">
        Cancelar
      </button>
      <button onclick="confirmarApagar(${taskId})"
              style="background-color:green; color:#fff; padding:10px 20px; border:none; cursor:pointer;">
        Confirmar
      </button>
    </div>
  `;
  overlay.onclick = function(e) { if (e.target === overlay) overlay.style.display = 'none'; };
}

function confirmarApagar(taskId) {
  fetch('index.php?controller=tarefa&method=apagarTarefa', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
      'X-Requested-With': 'XMLHttpRequest'
    },
    body: 'task_id=' + encodeURIComponent(taskId)
  })
  .then(response => response.text())
  .then(html => {
    document.getElementById('overlay').style.display = 'none';
    location.reload();
  })
  .catch(err => {
    document.getElementById('modalContent').innerHTML =
      "<p style='color:red;'>Erro ao apagar tarefa.</p>";
  });
}


function toggleMenu() {
  const menu = document.querySelector(".menu-lateral-slide");
  const estaRetraido = menu.classList.contains("retraido");

  if (estaRetraido) {
    menu.classList.add("expandindo");
    menu.classList.remove("retraido");

    menu.addEventListener("transitionend", function aoTerminarExpandir(e) {
      if (e.propertyName === "width") {
        menu.removeEventListener("transitionend", aoTerminarExpandir);
        const spans = menu.querySelectorAll("a span");
        spans.forEach(span => { span.style.opacity = "0"; });
        menu.classList.remove("expandindo");
        requestAnimationFrame(() => {
          requestAnimationFrame(() => {
            spans.forEach(span => { span.style.opacity = ""; });
          });
        });
      }
    });
  } else {
    menu.classList.remove("expandindo");
    menu.classList.add("retraido");
  }
}


function togglelogo() {
  const menu = document.querySelector(".logo-login");
  const estaRetraido = menu.classList.contains("mini");

  if (estaRetraido) {
    menu.classList.add("expandindo");
    menu.classList.remove("retraido");

    menu.addEventListener("transitionend", function aoTerminarExpandir(e) {
      if (e.propertyName === "width") {
        menu.removeEventListener("transitionend", aoTerminarExpandir);
        const spans = menu.querySelectorAll("a span");
        spans.forEach(span => { span.style.opacity = "0"; });
        menu.classList.remove("expandindo");
        requestAnimationFrame(() => {
          requestAnimationFrame(() => {
            spans.forEach(span => { span.style.opacity = ""; });
          });
        });
      }
    });
  } else {
    menu.classList.remove("expandindo");
    menu.classList.add("retraido");
  }
}



/* Splash Screen */
document.addEventListener("DOMContentLoaded", function() {
  const splash = document.getElementById("splash");
  if (splash) {
    splash.classList.add("active");

    const messages = [
      "Colorindo post-its",
      "Desenhando emojis",
      "Etiquetando prioridades",
      "Alfinetando os alfinetes",
      "Organizando a bagunça"
    ];

    const msgEl = document.getElementById("loading-message");
    const boxes = document.querySelectorAll(".icon-box");
    const progressBar = document.querySelector(".progress-bar");
    const loading = document.getElementById("loading-screen");
    const welcome = document.getElementById("welcome-screen");

    const TEMPO_ENTRE_ICONES = 1000;
    const TEMPO_FADE = 1500;
    const TEMPO_BEM_VINDO = 2000;

    let step = 0;
    const totalSteps = boxes.length;

    const main = document.querySelector(".main-content");
    const footer = document.querySelector(".footer");
    const menu = document.querySelector(".menu-lateral-slide");

    main.classList.add("fade-target");
    main.style.display = "none";
    footer.style.display = "none";
    menu.style.display = "none";

    function showStep() {
      if (step < totalSteps) {
        // mostra ícone
        boxes[step].style.opacity = 1;

        // mostra frase correspondente (inclusive a primeira)
        msgEl.textContent = messages[step];
        msgEl.style.opacity = 1;

        // atualiza barra
        progressBar.style.width = ((step + 1) / totalSteps) * 100 + "%";

        step++;
        setTimeout(showStep, TEMPO_ENTRE_ICONES);
      } else {
        // terminou carregamento → fade-out do loading
        setTimeout(() => {
          loading.style.opacity = 0;
          setTimeout(() => {
            loading.style.display = "none";

            // mostra bem-vindo com fade-in
            welcome.style.display = "flex";
            setTimeout(() => {
              welcome.style.opacity = 1;

              // depois fade-out do bem-vindo
              setTimeout(() => {
                welcome.style.opacity = 0;
                setTimeout(() => {
                  splash.style.display = "none";

                  // mostra layout com fade-in
                  main.style.display = "block";
                  footer.style.display = "block";
                  menu.style.display = "block";

                  setTimeout(() => {
                    main.classList.add("visible");
                  }, 50);
                }, TEMPO_FADE);
              }, TEMPO_BEM_VINDO);
            }, 50);
          }, TEMPO_FADE);
        }, 500);
      }
    }

    showStep();
  }
});
