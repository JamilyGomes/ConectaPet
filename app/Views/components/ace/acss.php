<div class="fab2-acessibilidade">

    <!-- BOTÃO PRINCIPAL -->
    <button id="fab2Btn" class="fab2-main">
        <img src="../../assets/img/acessibilidade.png" alt="Acessibilidade">
    </button>

    <!-- MENU -->
    <div id="fab2Menu" class="fab2-menu">

        <button onclick="lerPagina2()">🔊</button>
        <button onclick="toggleDark2()">🌙</button>
        <button onclick="aumentarFonte2()">🔍+</button>
        <button onclick="diminuirFonte2()">🔎-</button>
        <button onclick="toggleContraste2()">🎨</button>

    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    let nivelFonte = 0;
    let maxFonte = 3;
    let minFonte = -2;
    let leituraAtiva = false;
    let ultimoTexto = "";
    let timerLeitura;

    // abrir menu
    const fab2Btn = document.getElementById("fab2Btn");

    fab2Btn.addEventListener("click", function () {
        document.querySelector(".fab2-acessibilidade")
            .classList.toggle("ativo");
    });

    // leitor
    window.lerPagina2 = function () {

        leituraAtiva = !leituraAtiva;
        speechSynthesis.cancel();

        if (leituraAtiva) {
            document.body.classList.add("modo-leitura");
        } else {
            document.body.classList.remove("modo-leitura");
        }
    };

    // dark mode
    window.toggleDark2 = function () {
        document.body.classList.toggle("dark-mode");
    };

    // contraste
    window.toggleContraste2 = function () {
        document.body.classList.toggle("contraste");
    };

    // aumentar fonte
    window.aumentarFonte2 = function () {

        if (nivelFonte >= maxFonte) return;

        let elementos = document.querySelectorAll(
            "body *:not(.fab2-acessibilidade)"
        );

        elementos.forEach(el => {
            let tamanho = parseFloat(getComputedStyle(el).fontSize);

            if (!isNaN(tamanho)) {
                el.style.fontSize = (tamanho + 2) + "px";
            }
        });

        nivelFonte++;
    };

    // diminuir fonte
    window.diminuirFonte2 = function () {

        if (nivelFonte <= minFonte) return;

        let elementos = document.querySelectorAll(
            "body *:not(.fab2-acessibilidade)"
        );

        elementos.forEach(el => {
            let tamanho = parseFloat(getComputedStyle(el).fontSize);

            if (!isNaN(tamanho)) {
                el.style.fontSize = (tamanho - 2) + "px";
            }
        });

        nivelFonte--;
    };

    // leitura por hover
    document.body.addEventListener("mousemove", function (e) {

        if (!leituraAtiva)
            return;

        if (e.target.closest(".fab2-acessibilidade"))
            return;

        clearTimeout(timerLeitura);

        timerLeitura = setTimeout(() => {

            let elemento = e.target;

            const tagsPermitidas = [
                "H1", "H2", "H3", "H4", "H5", "H6",
                "P", "SPAN", "BUTTON",
                "A", "LABEL",
                "INPUT", "TEXTAREA",
                "IMG"
            ];

            if (
                elemento.tagName !== "DIV" &&
                !tagsPermitidas.includes(elemento.tagName)
            ) {
                return;
            }

            if (
                elemento.tagName === "DIV" &&
                !elemento.classList.contains("fav-dd-selected")
            ) {
                return;
            }

            if (elemento.classList.contains("favoritos-cards")) {
                return;
            }

            if (
                elemento.classList.contains("card-favorito") &&
                elemento === document.elementFromPoint(e.clientX, e.clientY)
            ) {
                return;
            }

            let texto =
                elemento.innerText ||
                elemento.alt ||
                elemento.value;

            if (!texto)
                return;

            texto = texto.trim();

            if (texto === ultimoTexto)
                return;

            ultimoTexto = texto;

            speechSynthesis.cancel();

            let fala = new SpeechSynthesisUtterance(texto);
            fala.lang = "pt-BR";
            fala.rate = 1;

            speechSynthesis.speak(fala);

        }, 100);
    });

    // parar ao sair do elemento
    document.body.addEventListener("mouseleave", function () {
        speechSynthesis.cancel();
        ultimoTexto = "";
    });

    document.body.addEventListener("mouseout", function () {
        speechSynthesis.cancel();
    });

});
</script>