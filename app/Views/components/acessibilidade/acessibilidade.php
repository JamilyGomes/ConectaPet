<div class="fab-acessibilidade">

    <!-- Botão principal -->
    <button id="fabBtn" class="fab-main" type="button" aria-label="Abrir menu de acessibilidade">
        <img src="../../assets/img/acessibilidade.png" alt="Acessibilidade">
    </button>

    <!-- Menu -->
    <div id="fabMenu" class="fab-menu">

        <button type="button" onclick="lerPagina()" title="Leitor de tela">
            🔊
        </button>

        <button type="button" onclick="toggleDark()" title="Modo escuro">
            🌙
        </button>

        <button type="button" onclick="aumentarFonte()" title="Aumentar fonte">
            🔍+
        </button>

        <button type="button" onclick="diminuirFonte()" title="Diminuir fonte">
            🔎-
        </button>

        <button type="button" onclick="toggleContraste()" title="Alto contraste">
            🎨
        </button>

    </div>

</div>

<script src="../../assets/js/acessibilidade.js"></script>