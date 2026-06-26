<div class="fab-acessibilidade">

    <!-- BOTÃO PRINCIPAL -->
    <button id="fabBtn" class="fab-main">
        <img src="../../assets/img/acessibilidade.png" alt="Acessibilidade">
    </button>

    <!-- MENU -->
    <div id="fabMenu" class="fab-menu">

        <button onclick="lerPagina()">🔊</button>
        <button onclick="toggleDark()">🌙</button>
        <button onclick="aumentarFonte()">🔍+</button>
        <button onclick="diminuirFonte()">🔎-</button>
        <button onclick="toggleContraste()">🎨</button>

    </div>

</div>


<script>

document.addEventListener("DOMContentLoaded", function () {

    /* ==========================
       CONTROLE TAMANHO FONTE
    ========================== */

    let nivelFonte = 0;
    let maxFonte = 3;   // máximo aumentar 3 vezes
    let minFonte = -2; // máximo diminuir 2 vezes


    /* ==========================
       ABRIR MENU
    ========================== */

    const fabBtn = document.getElementById("fabBtn");

    fabBtn.addEventListener("click", function () {
        document.querySelector(".fab-acessibilidade")
            .classList.toggle("ativo");
    });


    /* ==========================
       FUNÇÕES GLOBAIS
    ========================== */

    window.lerPagina = function () {

        let texto = document.body.innerText;

        let fala = new SpeechSynthesisUtterance(texto);
        fala.lang = "pt-BR";
        fala.rate = 1;

        speechSynthesis.cancel();
        speechSynthesis.speak(fala);
    }


    window.toggleDark = function () {
        document.body.classList.toggle("dark-mode");
    }


    window.toggleContraste = function () {
        document.body.classList.toggle("contraste");
    }


    window.aumentarFonte = function () {

        if (nivelFonte >= maxFonte) return;

        let elementos = document.querySelectorAll(
            "body *:not(.fab-acessibilidade):not(.fab-acessibilidade *)"
        );

        elementos.forEach(el => {

            let tamanho = parseFloat(
                window.getComputedStyle(el).fontSize
            );

            if (!isNaN(tamanho)) {
                el.style.fontSize = (tamanho + 2) + "px";
            }

        });

        nivelFonte++;
    }


    window.diminuirFonte = function () {

        if (nivelFonte <= minFonte) return;

        let elementos = document.querySelectorAll(
            "body *:not(.fab-acessibilidade):not(.fab-acessibilidade *)"
        );

        elementos.forEach(el => {

            let tamanho = parseFloat(
                window.getComputedStyle(el).fontSize
            );

            if (!isNaN(tamanho)) {
                el.style.fontSize = (tamanho - 2) + "px";
            }

        });

        nivelFonte--;
    }

});

</script>