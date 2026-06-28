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
    document.addEventListener("DOMContentLoaded", function() {
        let nivelFonte = 0;
        let maxFonte = 3;
        let minFonte = -2;
        let leituraAtiva = false;
        let ultimoTexto = "";
        let timerLeitura;


        // abrir menu 
        const fabBtn = document.getElementById("fabBtn");

        fabBtn.addEventListener("click", function() {
            document.querySelector(".fab-acessibilidade")
                .classList.toggle("ativo");
        });


        // leitor

        window.lerPagina = function() {
            leituraAtiva = !leituraAtiva;
            speechSynthesis.cancel();


            if (leituraAtiva) {
                document.body.classList.add("modo-leitura");
            } else {
                document.body.classList.remove("modo-leitura");
            }
        };



        // dark mode

        window.toggleDark = function() {
            document.body.classList.toggle("dark-mode");
        };


        // contraste 
        window.toggleContraste = function() {
            document.body.classList.toggle("contraste");
        };

        // aumentar fonte 

        window.aumentarFonte = function() {
            if (nivelFonte >= maxFonte) return;

            let elementos = document.querySelectorAll(
                "body *:not(.fab-acessibilidade)"
            );


            elementos.forEach(el => {
                let tamanho = parseFloat(
                    getComputedStyle(el).fontSize
                );


                if (!isNaN(tamanho)) {
                    el.style.fontSize =
                        (tamanho + 2) + "px";
                }
            });

            nivelFonte++;
        };


        // diminuir fonte 

        window.diminuirFonte = function() {

            if (nivelFonte <= minFonte) return;

            let elementos = document.querySelectorAll(
                "body *:not(.fab-acessibilidade)"
            );


            elementos.forEach(el => {
                let tamanho = parseFloat(
                    getComputedStyle(el).fontSize
                );

                if (!isNaN(tamanho)) {
                    el.style.fontSize =
                        (tamanho - 2) + "px";
                }
            });

            nivelFonte--;
        };

        // leitura por hover

        document.body.addEventListener("mousemove", function(e) {

            if (!leituraAtiva)
                return;

            if (e.target.closest(".fab-acessibilidade"))
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

                // Permite a div do dropdown
                if (
                    elemento.tagName !== "DIV" &&
                    !tagsPermitidas.includes(elemento.tagName)
                ) {
                    return;
                }

                // Se for uma DIV, somente a fav-dd-selected pode ser lida
                if (
                    elemento.tagName === "DIV" &&
                    !elemento.classList.contains("fav-dd-selected")
                ) {
                    return;
                }

                // Se estiver em um card, lê apenas quando o mouse estiver
                // realmente sobre um elemento do card.
                if (elemento.classList.contains("favoritos-cards")) {
                    return;
                }

                // Se o alvo for apenas o container do card, ignora.
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
                let fala =
                    new SpeechSynthesisUtterance(texto);
                fala.lang = "pt-BR";
                fala.rate = 1;
                speechSynthesis.speak(fala);


            }, 100);
        });


        // parar ao sair do elemento 
        document.body.addEventListener("mouseleave", function() {
            speechSynthesis.cancel();
            ultimoTexto = "";

        });


        document.body.addEventListener("mouseout", function() {
            speechSynthesis.cancel();

        });
    });
</script>