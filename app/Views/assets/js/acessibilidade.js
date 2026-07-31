document.addEventListener("DOMContentLoaded", () => {
    let nivelFonte = 0;
    const maxFonte = 3;
    const minFonte = -2;
    let leituraAtiva = false;
    let ultimoTexto = "";
    let timerLeitura;

    const fab = document.querySelector(".fab-acessibilidade");

    // Se a página não tiver o componente, não faz nada
    if (!fab) return;

    const fabBtn = document.getElementById("fabBtn");

    // Abrir/fechar menu
    fabBtn.addEventListener("click", () => {
        fab.classList.toggle("ativo");
    });

    // =========================
    // LEITOR DE TELA
    // =========================
    window.lerPagina = () => {
        leituraAtiva = !leituraAtiva;
        speechSynthesis.cancel();

        document.body.classList.toggle("modo-leitura", leituraAtiva);
    };

    // =========================
    // MODO ESCURO
    // =========================
    window.toggleDark = () => {
        document.body.classList.toggle("dark-mode");
    };

    // =========================
    // ALTO CONTRASTE
    // =========================
    window.toggleContraste = () => {
        document.body.classList.toggle("contraste");
    };

    // =========================
    // AUMENTAR FONTE
    // =========================
    window.aumentarFonte = () => {
        if (nivelFonte >= maxFonte) return;

        document.querySelectorAll("body *:not(.fab-acessibilidade)").forEach(el => {
            const tamanho = parseFloat(getComputedStyle(el).fontSize);

            if (!isNaN(tamanho)) {
                el.style.fontSize = (tamanho + 2) + "px";
            }
        });

        nivelFonte++;
    };

    // =========================
    // DIMINUIR FONTE
    // =========================
    window.diminuirFonte = () => {
        if (nivelFonte <= minFonte) return;

        document.querySelectorAll("body *:not(.fab-acessibilidade)").forEach(el => {
            const tamanho = parseFloat(getComputedStyle(el).fontSize);

            if (!isNaN(tamanho)) {
                el.style.fontSize = (tamanho - 2) + "px";
            }
        });

        nivelFonte--;
    };

    // =========================
    // LEITURA AO PASSAR O MOUSE
    // =========================
    document.body.addEventListener("mousemove", (e) => {
        if (!leituraAtiva) return;
        if (e.target.closest(".fab-acessibilidade")) return;

        clearTimeout(timerLeitura);

        timerLeitura = setTimeout(() => {
            const elemento = e.target;

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

            if (elemento.classList.contains("favoritos-cards")) return;

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

            if (!texto) return;

            texto = texto.trim();

            if (texto === ultimoTexto) return;

            ultimoTexto = texto;

            speechSynthesis.cancel();

            const fala = new SpeechSynthesisUtterance(texto);
            fala.lang = "pt-BR";
            fala.rate = 1;

            speechSynthesis.speak(fala);

        }, 100);
    });

    // =========================
    // PARAR LEITURA
    // =========================
    document.body.addEventListener("mouseleave", () => {
        speechSynthesis.cancel();
        ultimoTexto = "";
    });

    document.body.addEventListener("mouseout", () => {
        speechSynthesis.cancel();
    });
});