<!-- Card centralizado -->
<div style="
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    border: 1px solid black;
    padding: 30px;
    background: white;
    width: 90%;
    max-width: 400px;
    box-sizing: border-box;
    text-align: center;
">

    <h2 style="margin-bottom: 20px;">Confirmar exclusão da conta</h2>
    <p style="margin-bottom: 30px;">
        Tem certeza que deseja apagar sua conta?<br>
        Esta ação <strong>não pode ser desfeita</strong>.
    </p>

    <div style="display: flex; justify-content: center; gap: 20px;">
        <a href="index.php?controller=definicoes&method=definicoes" 
           style="
               padding: 10px 20px;
               border: 1px solid black;
               background-color: white;
               font-weight: bold;
               text-decoration: none;
               cursor: pointer;
               flex: 1;
               max-width: 120px;
               text-align: center;
           ">
            Cancelar
        </a>

        <a href="index.php?controller=usuario&method=apagarContaConfirmada" 
           style="
               padding: 10px 20px;
               border: none;
               background-color: red;
               color: white;
               font-weight: bold;
               text-decoration: none;
               cursor: pointer;
               flex: 1;
               max-width: 120px;
               text-align: center;
           ">
            Apagar
        </a>
    </div>
</div>
