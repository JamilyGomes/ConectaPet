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


        /* ==========================
           ABRIR MENU
        ========================== */
        const fabBtn = document.getElementById("fabBtn");

        fabBtn.addEventListener("click", function() {
            document.querySelector(".fab-acessibilidade")
                .classList.toggle("ativo");
        });


        /* ==========================
           LEITOR
        ========================== */
        window.lerPagina = function() {
            leituraAtiva = !leituraAtiva;
            speechSynthesis.cancel();


            if (leituraAtiva) {
                document.body.classList.add("modo-leitura");
            } else {
                document.body.classList.remove("modo-leitura");
            }
        };



        /* ==========================
           DARK MODE
        ========================== */

        window.toggleDark = function() {
            document.body.classList.toggle("dark-mode");
        };


        /* ==========================
           CONTRASTE
        ========================== */
        window.toggleContraste = function() {
            document.body.classList.toggle("contraste");
        };



        /* ==========================
           AUMENTAR FONTE
        ========================== */

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


        /* ==========================
           DIMINUIR FONTE
        ========================== */

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

        /* ==========================
           LEITURA POR HOVER
        ========================== */

        document.body.addEventListener("mousemove", function(e) {

            if (!leituraAtiva)
                return;

            if (e.target.closest(".fab-acessibilidade"))
                return;

            clearTimeout(timerLeitura);

            timerLeitura = setTimeout(() => {

                let elemento = e.target;

                // ignora containers grandes (cards/divs)
                if (elemento.children.length > 1)
                    return;
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


        /* ==========================
           PARAR AO SAIR DO ELEMENTO
        ========================== */


        document.body.addEventListener("mouseleave", function() {
            speechSynthesis.cancel();
            ultimoTexto = "";

        });


        document.body.addEventListener("mouseout", function() {
            speechSynthesis.cancel();

        });
    });
</script>