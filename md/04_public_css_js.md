## Arquivo: public\css\style.css
```css
/*================== geral ==================*/

@import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');
/* Cor de fundo do site e fonte*/
body {
    font-family: 'Roboto', sans-serif;
    background-color: #dededed2;
    margin-right: 0px;
}


/*================== menu lateral ==================*/

/* prototipo de menu lateral customizado */
.menu-lateral-msn {
    position: fixed;
    left: 20px;
    top: 40%;
    transform: translateY(-50%);
    width: 150px;
    padding: 20px;
    border: 1px solid black;
}
/* menu lateral padrÃ£o */
.menu-lateral-default {
    position: fixed;
    left: 20px;
    top: 40%;
    transform: translateY(-50%);
    width: 150px;
    padding: 20px;
    border: 1px solid #E0E0E0;
    background-color: #FFFFFF;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    z-index: 1;
}
/* Objetos do menu lateral padrÃ£o */
.menu-lateral-default ul {
   list-style: none; padding: 0;
}

/* Menu lateral retratil */
.menu-lateral-slide {
    
    position: fixed;
    top: 0%;
    left:0%;
    height: 100%;
    width: 240px;
    padding: 0px;
    background-color: #FFFFFF;
    box-shadow: 3px 0 0 #23007c2f;
    transition: width 0.5s ease;
    overflow: visible;
    z-index: 1;
}

.menu-lateral-slide a span {
  transition: opacity 0.9s ease;
}

.menu-lateral-slide.retraido {
  width: 80px; /* reduz a largura */
  height: 100%;
  padding: 0px;
}

.menu-lateral-slide.retraido a span {
  display: none;
}

/* MantÃ©m o texto oculto enquanto a barra ainda estÃ¡ animando para expandir */
.menu-lateral-slide.expandindo a span {
  display: none;
}

/* Aba do menu: agora Ã© filha do prÃ³prio .menu-lateral-slide,
   por isso acompanha a largura dele sem precisar de transiÃ§Ã£o prÃ³pria
   e sem risco de dessincronia. */
.menu-tab {
    position: absolute;
    top: 10px;
    right: -38px;
    width: 34px;
    height: 36px;
    background-color: #FFFFFF;
    border: 1px solid #b0b0b0;
    border-left: none;
    border-radius: 0 10px 10px 0;
    box-shadow: 3px 0 6px rgba(0,0,0,0.08);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background-color 0.3s ease;
    z-index: -1;
}

.menu-tab:hover {
    background-color: #23007c2f;
}

.menu-lateral-slide .menu-tab i {
    position: absolute;
    font-size: 26px;
    font-weight: bold;
    color: #013a73;
    transition: opacity 0.3s ease, transform 0.3s ease;
}

.menu-tab .icone-expandido {
    opacity: 1;
    transform: rotate(0deg) scale(1);
}

.menu-tab .icone-retraido {
    opacity: 0;
    transform: rotate(-90deg) scale(0.5);
}

.menu-lateral-slide.retraido .menu-tab .icone-expandido {
    opacity: 0;
    transform: rotate(90deg) scale(0.5);
}

.menu-lateral-slide.retraido .menu-tab .icone-retraido {
    opacity: 1;
    transform: rotate(0deg) scale(1);
}

.menu-lateral-slide ul {
   list-style-type: none; 
   padding: 2px;
   font-size: 16px;
   
}

.menu-lateral-slide li {
    padding: 15px 20px;
    transition: background-color 1.0s, font-weight 0.3s, padding 0.4s;
    
}

.menu-lateral-slide li:hover {
    background-color: #002fff42;
    font-weight: bold;
    padding: 15px 5px;
    box-shadow: 3px 0 0 #2f00a55a;
    
}

/*.logoff-section div:hover {
  background-color: #ff0000b8;
  
 }
*/

.menu-lateral-slide a {
  text-decoration: none;
  color: inherit;
  line-height: 30px;
  display: flex;
  gap: 18px;
}

.menu-lateral-slide i {
    font-size: 35px;
    color: #013a73;
    
    
   
}

.titulo-menu {
    display: flex;
    flex-direction: row;
    font-size: 20px;
    color: #013a73;
    overflow: hidden;
    box-sizing: border-box;
    height: 116px;
    padding-left: 0px;
    padding-right: 0px;
    padding-top: 20px;
    padding-bottom: 35px;
    justify-content: space-between;
    align-items: center;
    
}

.logo-completa,
.logo-reduzida {
    flex-shrink: 0;
}

.logo-completa { width: 240px; }
.logo-reduzida { width: 80px; display: none; }

.logo-completa img,
.logo-reduzida img {
    display: block;
    margin: 0 auto;
}

.logo-completa img,
.logo-reduzida img {
    display: block;
    margin: 0 auto;
    height: 40px;
    width: auto;
}

.menu-lateral-slide.retraido .logo-completa { display: none; }
.menu-lateral-slide.retraido .logo-reduzida { display: block; }

/*================== cards ==================*/

/*Estrutura padrÃ£o do tipo card*/
.card {
    background-color: #FFFFFF;
    border-radius: 8px;
    border: 2px solid #c0c0c0;
    box-shadow: 0 3px 8px rgba(0,0,0,0.1);
    margin-left: 250px;
    margin-bottom: 20px;
    margin-right: 220px;
    padding: 20px;
}
/* Estrutura card login */
.card-login {
    background-color: #FFFFFF;
    border-radius: 8px;
    border: 1px solid #d0d0d0;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    padding: 40px 60px;
    margin: 60px auto;
    max-width: 400px;
}

/* Fundo exclusivo da tela de login */
.login-bg-stripe {
    position: fixed;
    top: 0;
    left: 0;
    width: 35%;
    height: 100%;
    background-color: #3a3a3a;
    z-index: 0;
}

/* Container que posiciona o card de login na tela */
.login-wrapper {
    position: fixed;
    top: 50%;
    left: 35%;
    transform: translate(-50%, -50%);
    z-index: 1;
}

.logo-login {
    display: block;
    margin: 0 auto 15px auto;
    height: 50px;
}

/* Estrutura card headers */
.card-headers {
    margin-top: -15px;
    margin-bottom: 20px;
    padding-top: 20px;
    padding-bottom: 30px;
    padding-left: 270px;
    padding-right: 250px;
    background-color: #FFFFFF;
    width: 100%vw;
    height: 75px;
    border: 2px solid #c0c0c0;
    box-shadow: 0 3px 0px rgba(0,0,0,0.1);

}
/* Estrutura para o contÃªiner dos cards de views numericas da home */
.card-views-home-father {
  display: flex;
  justify-content: space-between;
  gap: 10px;
  margin-left: 250px;
  margin-right: 220px;
  
}
/*cards de views numericas da home */
.card-views-home {
    background-color: #FFFFFF;
    border-radius: 8px;
    border: 1px solid #d0d0d0;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    margin-bottom: 20px;
    padding: 30px;
    width: 100px;
    height: 100px;
    
}

.card-static{
    position: relative;
    margin: 20px 250px 80px 220px;
    box-sizing: border-box;
    background-color: #FFFFFF;
    border-radius: 8px;
    border: 1px solid #d0d0d0;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    padding: 40px;

}
/* Titulo do card home */
.titulo-secao {
    font-size: 18px;
    font-weight: bold;
       /* mantÃ©m largura e posicionamento originais */
}

.card-interativo {
    margin: 20px 220px 20px 250px;
    box-sizing: border-box;
    background-color: #ceffdb;
    border-radius: 8px;
    border: 3px solid #00d6529d;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    padding: 30px;
    font-size: 18px;
    font-weight: bold;
    color: #333333d4;
}

/*================== formulÃ¡rios ==================*/

/* Estilo campos de formulÃ¡rio */
input, textarea, select {
    background-color: #FFFFFF;
    border-radius: 8px;
    border: 1px solid rgb(165, 165, 165);
   
    padding: 12px;
    margin-bottom: 16px;
    width: 100%;
    max-width: 400px;
    box-sizing: border-box;
}


/*================== botÃµes gerais ==================*/

/* Estilo visual botÃµes */
button {
    border-radius: 6px;
    padding: 10px 16px;
    background-color: #013a73; /* azul padrÃ£o do LinkedIn, opcional */
    color: white;
    border: none;
    font-weight: bold;
    cursor: pointer;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}
/* Estilos visuais botÃ£o voltar */
.button-voltar {
    position: absolute;
    top: 40px;
    left: 20px;
}

.button-voltar.voltar {
    
           display: inline-block;
           padding: 10px 15px;
           background-color: white;
           border: 1px solid black;
           text-decoration: none;
           color: black;
           font-weight: bold;
}
/* Estilo visual botÃµes de aba em settings */
.button-aba-settings{
flex: 1;
padding: 10px;
border: none;
font-weight: bold;
cursor: pointer;
border-bottom: 2px solid black;
background-color: white;
}


/*================== Breadcrumbs ==================*/

/* Estilo visual Breadcrumbs */
.breadcrumbs {
    margin-left: 250px;
    margin-right: 220px;
    margin-top: 40px;
    margin-bottom: 10px;
}
/* Tela atual no breadcrumb - sem link*/
.breadcrumbs-p {
  font-size: 14px;
  color: #555;
}
/* Telas anteriores no breadcrumb - com link*/
.breadcrumbs-a {
  text-decoration: none;
  color: #555;
}


/*================== Footer ==================*/

/* Footer fixo todas as paginas exceto modais */
.footer {
    position: fixed;
    padding: 0px 0px;
    bottom: -1px;
    width: 100%;
    background-color: #ffffff;
    border: 1px solid #d0d0d0;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    
}

.footer p {
    text-align: right;
    margin-right: 100px;
    color: #000000;
    font-size: 12px;
    font-weight: bold;  
}


/*================== Tabelas ==================*/

/* Tabela de tarefas */
.tabela-tarefas {
  border-collapse: collapse;
  width: 100%;
  
}

/* Table headers */
.tabela-tarefas th {
  background-color: #e0e0e0;
  padding: 12px;
  text-align: left;
  border-bottom: 2px solid #ddd;
  font-weight: bold;
}

/* Table cells */
.tabela-tarefas td {
  padding: 10px;
  border-bottom: 1px solid #eee;
}
/* Table rows on hover */
.tabela-tarefas tr:hover {
  background-color: #fafafa;
}
/* Linhas (rows) Ã­mpares da tabela */
.tabela-tarefas tbody tr:nth-child(odd) {
  background-color: #ffffff; /* fundo claro */
}
/* Linhas (rows) pares da tabela */
.tabela-tarefas tbody tr:nth-child(even) {
  background-color: #ebebeb; /* fundo mais escuro */
}
/* Recurso visual para tabela vazia */
.sem-tarefas {
  text-align: center;
  font-style: italic;
  color: #777;
}

.sem-tarefas-info{
  margin: 0 220px 50px 220px;
  background-color: #f7f7f7;
  padding: 12px;
  text-align: left;
  border-bottom: 2px solid #ddd;
  font-weight: bold;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);

}


/*================== Objetos de tabela ==================*/

/* Status */
.status {
  padding: 4px 8px;
  border-radius: 4px;
  font-weight: bold;
  color: #fff;
}

.status-concluÃ­da { background-color: #5cb85c; }
.status-atrasada { background-color: #f04e4e; }
.status-pendente { background-color: #d69200; }
.status-andamento { background-color: #5f4fec; }

/* Prioridade */
.tag {
  display: inline-block;
  padding: 3px 6px;
  border-radius: 12px;
  font-size: 12px;
  font-weight: bold;
  color: #fff;
  height: 20px;
  width: 60px;
  text-align: center;
}

.prioridade-alta { background-color: #013a73; }
.prioridade-alta::after { content: "ðŸŸ©"; }
.prioridade-mÃ©dia { background-color: #013a73; }
.prioridade-mÃ©dia::after { content: "ðŸŸ¨"; }
.prioridade-baixa { background-color: #013a73; }
.prioridade-baixa::after { content: "ðŸŸ¥"; }

/* BotÃµes de aÃ§Ã£o dentro da tabela */
.acoes {
  text-align: center;
}

.btn {
  border: none;
  cursor: pointer;
  margin: 0 2px;
  font-size: 16px;
  padding: 5px 5px;
  border-radius: 8px;
}

.btn.ver { background-color: #3a3a3a; color: #fff; }
.btn.editar { background-color: #013a73; color: #fff; }
.btn.apagar { background-color: #9c0000; color: #fff; }
.btn:hover { opacity: 0.8; }


/*================== Objetos em geral ==================*/

spam {
  color: black;
}

/* Area segura: Bloco invisivel para que objetos nÃ£o fiquem atrÃ¡s do footer */
.area-segura {
    padding: 20px;
  }

  /*================== Modais ==================*/

  /* Overlay do modal: Fundo escuro */
 #overlay {
    position: fixed; 
    width: 100vw; height: 100vh; 
    top: 0; left: 0;
    background: rgba(0,0,0,0.5); 
    display: none; 
    justify-content: center; 
    align-items: center;
    z-index: 1;
 }
 /* ConteÃºdo do modal */
#modalContent {
    font-size: 14px;
    background: #fff; 
    padding: 20px; 
    border-radius: 8px; 
    top: 5%; left: 40%; 
    max-width: 400px; 
    position: fixed; 
    box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    z-index: 1;
}

  /* Estilo Ãºnico para o conteÃºdo (formulÃ¡rio) de todos os modais */
  .modal-form label {
      font-weight: bold;
  }

  .modal-form input,
  .modal-form textarea,
  .modal-form select {
      width: 100%;
      padding: 8px;
      margin-bottom: 20px;
      border: 1px solid #000;
      box-sizing: border-box;
  }

  .modal-form .acoes-modal {
      text-align: right;
      margin-top: 20px;
  }

  .radiobox-modais {
    display: flex;
    gap: 10px;
    margin-bottom: 10px;"
  }


  /*================= Splash ===================*/

  /* Splash Screen */
#splash {
  position: fixed;
  top: 0; left: 0;
  width: 100vw; height: 100vh;
  background: #cacaca;
  color: #333333d4;
  display: block;
  
  align-items: center;
  opacity: 0;
  
  z-index: 9999; /* fica acima de tudo */
}

#splash.active {
  opacity: 1;
}

/* Logo */
#splash .logo {
  width: 120px;
  margin-bottom: 20px;
  display: block;
  align-items: center;
}

/* Ãrea dos Ã­cones */
.icons {
  display: flex;
  gap: 20px;
  justify-content: center;
  margin-bottom: 20px;
}

.icon-box {
  width: 60px;
  height: 60px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #fff;        /* cor da caixa */
  border: 2px solid #013a73; /* borda */
  border-radius: 8px;      /* arredondado */
  box-shadow: 0 2px 6px rgba(0,0,0,0.2);
  font-size: 2rem;
  opacity: 0;              /* controlado pelo JS */
  transition: opacity 1s ease;
}

#loading-message {
  text-align: center;
  opacity: 0;
  transition: opacity 0.5s ease;
  font-size: 1.2rem;
  margin-top: 20px;
  
}

/* Barra de progresso */
.progress {
  width: 100%;
  height: 30px;
  background: #ffffff;
  border-radius: 12px;
  overflow: hidden;
  margin-top: 20px;
}

.progress-bar {
  width: 0%;
  height: 100%;
  background: #013a73; 
  transition: width 2s ease;
}

/* Card da animaÃ§Ã£o (loading-screen) */
#loading-screen {
  background-color: #FFFFFF;
  border-radius: 8px;
  border: 1px solid #d0d0d0;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  padding: 30px;
  max-width: 400px;          /* igual ao login */
  margin: 60px auto;         /* igual ao login */
  opacity: 0;
  transition: opacity 2s ease;
}

#welcome-screen {
  opacity: 0;
  transition: opacity 2s ease;
  font-size: 100px;

  display: flex;
  justify-content: center;   /* centraliza horizontalmente */
  align-items: center;       /* centraliza verticalmente */
  text-align: center;

  /* ocupa toda a Ã¡rea da tela */
  position: fixed;
  top: 0; left: 0;
  width: 100vw;
  height: 100vh;
}

#loading-screen.visible,
#welcome-screen.visible {
  opacity: 1;
}

/* AnimaÃ§Ã£o de fade */
@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

/* Estado inicial da home (usado sÃ³ na splash) */
.main-content.fade-target {
  opacity: 0;
  transition: opacity 0.1s ease;
}

/* Estado visÃ­vel com fade */
.main-content.fade-target.visible {
  opacity: 1;
}
```n
## Arquivo: public\css\style.css_legado
```css
/*================== geral ==================*/

@import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');
/* Cor de fundo do site e fonte*/
body {
    font-family: 'Roboto', sans-serif;
    background-color: #dededed2;
    margin-right: 0px;
}


/*================== menu lateral ==================*/

/* prototipo de menu lateral customizado */
.menu-lateral-msn {
    position: fixed;
    left: 20px;
    top: 40%;
    transform: translateY(-50%);
    width: 150px;
    padding: 20px;
    border: 1px solid black;
}
/* menu lateral padrÃ£o */
.menu-lateral-default {
    position: fixed;
    left: 20px;
    top: 40%;
    transform: translateY(-50%);
    width: 150px;
    padding: 20px;
    border: 1px solid #E0E0E0;
    background-color: #FFFFFF;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    z-index: 1;
}
/* Objetos do menu lateral padrÃ£o */
.menu-lateral-default ul {
   list-style: none; padding: 0;
}

/* Menu lateral retratil */
.menu-lateral-slide {
    
    position: fixed;
    top: 0%;
    left:0%;
    height: 100%;
    width: 240px;
    padding: 0px;
    background-color: #FFFFFF;
    box-shadow: 3px 0 0 #23007c2f;
    transition: width 0.3s ease;
    overflow: hidden;
    z-index: 1;
}

.menu-lateral-slide.retraido {
  width: 80px; /* reduz a largura */
  height: 100%;
  padding: 0px;
  }

.menu-lateral-slide.retraido ul {
  list-style-type: none; 
  padding: 2px;
  
  
}

.menu-lateral-slide.retraido li {
  padding: 0px 10px;
  transition: background-color 1.0s, font-weight 0.3s, padding 0.4s;
  border: 1px solid #23007c2f;
}

.menu-lateral-slide.retraido li:hover {
  background-color: #002fff42;
    font-weight: bold;
    padding: 0px 5px;
    box-shadow: 3px 0 0 #2f00a55a;
  
}

.menu-lateral-slide.retraido a span {
  
  pointer-events: none;
  visibility: hidden;
  
}

.menu-lateral-slide.retraido i {
    margin: 5px 0px;  
    padding: 5px 5px;
    border-radius: 10px;
    width: 35px;
    border: 1px solid #23007c2f;

}

.btn-expandir {
    margin: 5px 0px;  
    padding: 10px 5px;
    border-radius: 10px;
    width: 35px;
    transition: background-color 1.0s;
}

.btn-expandir:hover {
    background-color: #23007c2f;
    font-weight: bold;
    cursor: pointer;
    
}

.btn-expandir :active {
  border: 2px solid #23007c2f;
  
}

.menu-lateral-slide ul {
   list-style-type: none; 
   padding: 2px;
   font-size: 16px;
   
}

.menu-lateral-slide li {
    padding: 15px 20px;
    transition: background-color 1.0s, font-weight 0.3s, padding 0.4s;
    
}

.menu-lateral-slide li:hover {
    background-color: #002fff42;
    font-weight: bold;
    padding: 15px 5px;
    box-shadow: 3px 0 0 #2f00a55a;
    
}

/*.logoff-section div:hover {
  background-color: #ff0000b8;
  
 }
*/

.menu-lateral-slide a {
  text-decoration: none;
  color: inherit;
  line-height: 30px;
  display: flex;
  gap: 18px;
}

.menu-lateral-slide i {
    font-size: 35px;
    color: #013a73;
    
    
   
}

.titulo-menu {
    display: flex;
    flex-direction: row;
    font-size: 20px;
    color: #013a73;
    padding-left: 10px;
    padding-right: 10px;
    padding-top: 20px;
    padding-bottom: 35px;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #b0b0b0;
}

/*================== cards ==================*/

/*Estrutura padrÃ£o do tipo card*/
.card {
    background-color: #FFFFFF;
    border-radius: 8px;
    border: 2px solid #c0c0c0;
    box-shadow: 0 3px 8px rgba(0,0,0,0.1);
    margin-left: 250px;
    margin-bottom: 20px;
    margin-right: 220px;
    padding: 20px;
}
/* Estrutura card login */
.card-login {
    background-color: #FFFFFF;
    border-radius: 8px;
    border: 1px solid #d0d0d0;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    padding: 30px;
    margin: 60px auto;
    max-width: 400px;
}
/* Estrutura card headers */
.card-headers {
    margin-top: -15px;
    margin-bottom: 20px;
    padding-top: 20px;
    padding-bottom: 30px;
    padding-left: 270px;
    padding-right: 250px;
    background-color: #FFFFFF;
    width: 100%vw;
    height: 75px;
    border: 2px solid #c0c0c0;
    box-shadow: 0 3px 0px rgba(0,0,0,0.1);

}
/* Estrutura para o contÃªiner dos cards de views numericas da home */
.card-views-home-father {
  display: flex;
  justify-content: space-between;
  gap: 10px;
  margin-left: 250px;
  margin-right: 220px;
  
}
/*cards de views numericas da home */
.card-views-home {
    background-color: #FFFFFF;
    border-radius: 8px;
    border: 1px solid #d0d0d0;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    margin-bottom: 20px;
    padding: 30px;
    width: 100px;
    height: 100px;
    
}

.card-static{
    position: relative;
    margin: 20px 250px 80px 220px;
    box-sizing: border-box;
    background-color: #FFFFFF;
    border-radius: 8px;
    border: 1px solid #d0d0d0;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    padding: 40px;

}
/* Titulo do card home */
.titulo-secao {
    font-size: 18px;
    font-weight: bold;
       /* mantÃ©m largura e posicionamento originais */
}

.card-interativo {
    margin: 20px 220px 20px 250px;
    box-sizing: border-box;
    background-color: #ceffdb;
    border-radius: 8px;
    border: 3px solid #00d6529d;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    padding: 30px;
    font-size: 18px;
    font-weight: bold;
    color: #333333d4;
}

/*================== formulÃ¡rios ==================*/

/* Estilo campos de formulÃ¡rio */
input, textarea, select {
    background-color: #FFFFFF;
    border-radius: 8px;
    border: 1px solid rgb(165, 165, 165);
   
    padding: 12px;
    margin-bottom: 16px;
    width: 100%;
    max-width: 400px;
    box-sizing: border-box;
}


/*================== botÃµes gerais ==================*/

/* Estilo visual botÃµes */
button {
    border-radius: 6px;
    padding: 10px 16px;
    background-color: #013a73; /* azul padrÃ£o do LinkedIn, opcional */
    color: white;
    border: none;
    font-weight: bold;
    cursor: pointer;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}
/* Estilos visuais botÃ£o voltar */
.button-voltar {
    position: absolute;
    top: 40px;
    left: 20px;
}

.button-voltar.voltar {
    
           display: inline-block;
           padding: 10px 15px;
           background-color: white;
           border: 1px solid black;
           text-decoration: none;
           color: black;
           font-weight: bold;
}
/* Estilo visual botÃµes de aba em settings */
.button-aba-settings{
flex: 1;
padding: 10px;
border: none;
font-weight: bold;
cursor: pointer;
border-bottom: 2px solid black;
background-color: white;
}


/*================== Breadcrumbs ==================*/

/* Estilo visual Breadcrumbs */
.breadcrumbs {
    margin-left: 250px;
    margin-right: 220px;
    margin-top: 40px;
    margin-bottom: 10px;
}
/* Tela atual no breadcrumb - sem link*/
.breadcrumbs-p {
  font-size: 14px;
  color: #555;
}
/* Telas anteriores no breadcrumb - com link*/
.breadcrumbs-a {
  text-decoration: none;
  color: #555;
}


/*================== Footer ==================*/

/* Footer fixo todas as paginas exceto modais */
.footer {
    position: fixed;
    padding: 0px 0px;
    bottom: -1px;
    width: 100%;
    background-color: #ffffff;
    border: 1px solid #d0d0d0;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    
}

.footer p {
    text-align: right;
    margin-right: 100px;
    color: #000000;
    font-size: 14px;
    font-weight: bold;  
}


/*================== Tabelas ==================*/

/* Tabela de tarefas */
.tabela-tarefas {
  border-collapse: collapse;
  width: 100%;
  
}

/* Table headers */
.tabela-tarefas th {
  background-color: #e0e0e0;
  padding: 12px;
  text-align: left;
  border-bottom: 2px solid #ddd;
  font-weight: bold;
}

/* Table cells */
.tabela-tarefas td {
  padding: 10px;
  border-bottom: 1px solid #eee;
}
/* Table rows on hover */
.tabela-tarefas tr:hover {
  background-color: #fafafa;
}
/* Linhas (rows) Ã­mpares da tabela */
.tabela-tarefas tbody tr:nth-child(odd) {
  background-color: #ffffff; /* fundo claro */
}
/* Linhas (rows) pares da tabela */
.tabela-tarefas tbody tr:nth-child(even) {
  background-color: #ebebeb; /* fundo mais escuro */
}
/* Recurso visual para tabela vazia */
.sem-tarefas {
  text-align: center;
  font-style: italic;
  color: #777;
}

.sem-tarefas-info{
  margin: 0 220px 50px 220px;
  background-color: #f7f7f7;
  padding: 12px;
  text-align: left;
  border-bottom: 2px solid #ddd;
  font-weight: bold;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);

}


/*================== Objetos de tabela ==================*/

/* Status */
.status {
  padding: 4px 8px;
  border-radius: 4px;
  font-weight: bold;
  color: #fff;
}

.status-concluÃ­da { background-color: #5cb85c; }
.status-atrasada { background-color: #f04e4e; }
.status-pendente { background-color: #d69200; }
.status-andamento { background-color: #5f4fec; }

/* Prioridade */
.tag {
  display: inline-block;
  padding: 3px 6px;
  border-radius: 12px;
  font-size: 12px;
  font-weight: bold;
  color: #fff;
  height: 20px;
  width: 60px;
  text-align: center;
}

.prioridade-alta { background-color: #013a73; }
.prioridade-alta::after { content: "ðŸŸ©"; }
.prioridade-mÃ©dia { background-color: #013a73; }
.prioridade-mÃ©dia::after { content: "ðŸŸ¨"; }
.prioridade-baixa { background-color: #013a73; }
.prioridade-baixa::after { content: "ðŸŸ¥"; }

/* BotÃµes de aÃ§Ã£o dentro da tabela */
.acoes {
  text-align: center;
}

.btn {
  border: none;
  cursor: pointer;
  margin: 0 2px;
  font-size: 16px;
  padding: 5px 5px;
  border-radius: 8px;
}

.btn.ver { background-color: #3a3a3a; color: #fff; }
.btn.editar { background-color: #013a73; color: #fff; }
.btn.apagar { background-color: #9c0000; color: #fff; }
.btn:hover { opacity: 0.8; }


/*================== Objetos em geral ==================*/

spam {
  color: black;
}

/* Area segura: Bloco invisivel para que objetos nÃ£o fiquem atrÃ¡s do footer */
.area-segura {
    padding: 20px;
  }

  /*================== Modais ==================*/

  /* Overlay do modal: Fundo escuro */
 #overlay {
    position: fixed; 
    width: 100vw; height: 100vh; 
    top: 0; left: 0;
    background: rgba(0,0,0,0.5); 
    display: none; 
    justify-content: center; 
    align-items: center;
    z-index: 1;
 }
 /* ConteÃºdo do modal */
 #modalContent {
    font-size: 14px;
    background: #fff; 
    padding: 20px; 
    border-radius: 8px; 
    top: 5%; left: 40%; 
    max-width: 400px; 
    position: fixed; 
    box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    max-height: 500px;
    z-index: 1;
    
    
 }

  .inputs-modais {
    background-color: #FFFFFF;
    border-radius: 8px;
    border: 1px solid rgb(234, 6, 6);
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    padding: 5px;
    margin-bottom: 10px;
    width: 300px;
    height: 30px;
    box-sizing: border-box;
  }

  .radiobox-modais {
    display: flex;
    gap: 10px;
    margin-bottom: 10px;"
  }


  /*================= Splash ===================*/

  /* Splash Screen */
#splash {
  position: fixed;
  top: 0; left: 0;
  width: 100vw; height: 100vh;
  background: #cacaca;
  color: #333333d4;
  display: block;
  
  align-items: center;
  opacity: 0;
  
  z-index: 9999; /* fica acima de tudo */
}

#splash.active {
  opacity: 1;
}

/* Logo */
#splash .logo {
  width: 120px;
  margin-bottom: 20px;
}

/* Ãrea dos Ã­cones */
.icons {
  display: flex;
  gap: 20px;
  justify-content: center;
  margin-bottom: 20px;
}

.icon-box {
  width: 60px;
  height: 60px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #fff;        /* cor da caixa */
  border: 2px solid #013a73; /* borda */
  border-radius: 8px;      /* arredondado */
  box-shadow: 0 2px 6px rgba(0,0,0,0.2);
  font-size: 2rem;
  opacity: 0;              /* controlado pelo JS */
  transition: opacity 1s ease;
}

#loading-message {
  text-align: center;
  opacity: 0;
  transition: opacity 0.5s ease;
  font-size: 1.2rem;
  margin-top: 20px;
  
}

/* Barra de progresso */
.progress {
  width: 100%;
  height: 30px;
  background: #ffffff;
  border-radius: 12px;
  overflow: hidden;
  margin-top: 20px;
}

.progress-bar {
  width: 0%;
  height: 100%;
  background: #013a73; 
  transition: width 2s ease;
}

/* Card da animaÃ§Ã£o (loading-screen) */
#loading-screen {
  background-color: #FFFFFF;
  border-radius: 8px;
  border: 1px solid #d0d0d0;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  padding: 30px;
  max-width: 400px;          /* igual ao login */
  margin: 60px auto;         /* igual ao login */
  opacity: 0;
  transition: opacity 2s ease;
}

#welcome-screen {
  opacity: 0;
  transition: opacity 2s ease;
  font-size: 100px;

  display: flex;
  justify-content: center;   /* centraliza horizontalmente */
  align-items: center;       /* centraliza verticalmente */
  text-align: center;

  /* ocupa toda a Ã¡rea da tela */
  position: fixed;
  top: 0; left: 0;
  width: 100vw;
  height: 100vh;
}

#loading-screen.visible,
#welcome-screen.visible {
  opacity: 1;
}

/* AnimaÃ§Ã£o de fade */
@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

/* Estado inicial da home (usado sÃ³ na splash) */
.main-content.fade-target {
  opacity: 0;
  transition: opacity 0.1s ease;
}

/* Estado visÃ­vel com fade */
.main-content.fade-target.visible {
  opacity: 1;
}


```n
## Arquivo: public\css\style2.css
```css
@import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');

/* Cor de fundo geral do site */
body {
    font-family: 'Roboto', sans-serif ;
    background-color: #171717;
    color: #ffffffc0
}

/* Estrutura base para cards */
.card {
    background-color: #3d3d3d;
    border-radius: 8px;
    border: 1px solid #404040;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 30px;
    margin: 60px auto;
    max-width: 400px;
}

/* Estilo global para campos de formulÃ¡rio (exceto botÃµes) */
input,
textarea,
select {
    background-color: #FFFFFF;
    border-radius: 8px;
    border: 1px solid rgb(165, 165, 165);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 12px;
    margin-bottom: 16px;
    width: 100%;
    max-width: 400px;
    box-sizing: border-box;
}

/* Estilo visual exclusivo para botÃµes */
button {
    border-radius: 6px;
    padding: 10px 16px;
    background-color: #6f6f6f; 
    color: white;
    border: none;
    font-weight: bold;
    cursor: pointer;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

       
```n
## Arquivo: public\js\script.js
```javascript
/* FunÃ§Ãµes de modal */

function abrirModal() {
  // Exibe overlay
  const overlay = document.getElementById('overlay');
  overlay.style.display = 'flex';

  // Limpa conteÃºdo anterior (evita duplicaÃ§Ã£o)
  const modal = document.getElementById('modalContent');
  // Corrigido: X apenas fecha o modal, sem redirecionar
  modal.innerHTML = '<span onclick="document.getElementById(\'overlay\').style.display=\'none\';" style="cursor:pointer; position:absolute; top:10px; right:15px; font-size:20px; font-weight:bold; color:#000;">X</span>';

  // Carrega conteÃºdo da pÃ¡gina via fetch
  fetch('index.php?controller=novaTarefa&method=novaTarefa', {
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
  .then(response => response.text())
  .then(html => {
    modal.innerHTML += html;
  })
  .catch(err => {
    modal.innerHTML += "<p style='color:red;'>Erro ao carregar conteÃºdo.</p>";
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
    .catch(err => { modal.innerHTML += "<p style='color:red;'>Erro ao carregar ediÃ§Ã£o da tarefa.</p>"; });

  overlay.onclick = function(e) { if (e.target === overlay) overlay.style.display = 'none'; };
}

function abrirModalApagar(taskId) {
  const overlay = document.getElementById('overlay');
  overlay.style.display = 'flex';
  const modal = document.getElementById('modalContent');
  modal.innerHTML = `
    <h2>Tem certeza?</h2>
    <p>Esta aÃ§Ã£o nÃ£o pode ser desfeita.</p>
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
      "Organizando a bagunÃ§a"
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
        // mostra Ã­cone
        boxes[step].style.opacity = 1;

        // mostra frase correspondente (inclusive a primeira)
        msgEl.textContent = messages[step];
        msgEl.style.opacity = 1;

        // atualiza barra
        progressBar.style.width = ((step + 1) / totalSteps) * 100 + "%";

        step++;
        setTimeout(showStep, TEMPO_ENTRE_ICONES);
      } else {
        // terminou carregamento â†’ fade-out do loading
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

```n
