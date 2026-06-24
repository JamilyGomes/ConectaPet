<div class="fab-acessibilidade">

    <button id="fabBtn" class="fab-main">
        <img src="../../assets/img/acessibilidade.png" alt="">
    </button>

    <div id="fabMenu" class="fab-menu">

        <button onclick="lerPagina()">🔊</button>
        <button onclick="toggleDark()">🌙</button>
        <button onclick="aumentarFonte()">🔍+</button>
        <button onclick="diminuirFonte()">🔎-</button>
        <button onclick="toggleContraste()">🎨</button>

    </div>

</div>

<script>
    /* ABRIR MENU */
    document.getElementById("fabBtn").addEventListener("click", () => {
        document.querySelector(".fab-acessibilidade").classList.toggle("ativo");
    });

    /* 🔊 LEITOR DE PÁGINA */
    function lerPagina() {
        let texto = document.body.innerText;

        let fala = new SpeechSynthesisUtterance(texto);
        fala.lang = "pt-BR";
        fala.rate = 1;

        speechSynthesis.cancel();
        speechSynthesis.speak(fala);
    }

    /* 🌙 DARK MODE */
    function toggleDark() {
        document.body.classList.toggle("dark-mode");
    }

    /* 🎨 CONTRASTE */
    function toggleContraste() {
        document.body.classList.toggle("contraste");
    }

    /* 🔍 A+ */
    /*     function aumentarFonte() {
            let tamanho = parseFloat(getComputedStyle(document.body).fontSize);
            document.body.style.fontSize = (tamanho + 2) + "px";
        } */

    /* 🔎 A- */
    /*     function diminuirFonte() {
            let tamanho = parseFloat(getComputedStyle(document.body).fontSize);
            document.body.style.fontSize = (tamanho - 2) + "px";
        } */

    /*  */

    function aumentarFonte() {
        let elementos = document.querySelectorAll(
            "body *:not(.fab-acessibilidade):not(.fab-acessibilidade *)"
        );

        elementos.forEach(el => {
            let tamanho = parseFloat(window.getComputedStyle(el).fontSize);

            if (!isNaN(tamanho)) {
                el.style.fontSize = (tamanho + 2) + "px";
            }
        });
    }

    function diminuirFonte() {
        let elementos = document.querySelectorAll(
            "body *:not(.fab-acessibilidade):not(.fab-acessibilidade *)"
        );

        elementos.forEach(el => {
            let tamanho = parseFloat(window.getComputedStyle(el).fontSize);

            if (!isNaN(tamanho)) {
                el.style.fontSize = (tamanho - 2) + "px";
            }
        });
    }
</script>