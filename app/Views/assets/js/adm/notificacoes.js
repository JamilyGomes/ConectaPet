document.addEventListener("DOMContentLoaded", function () {

    const notificacoes = document.querySelectorAll(".card-noti");
    const filtro = document.querySelector(".filtro");

    const iconeDetalhe = document.querySelector(".icone-detalhe i");
    const tituloDetalhe = document.querySelector(".conteudo-detalhes h2");
    const textoDetalhe = document.querySelector(".conteudo-detalhes > p");
    const tipoDetalhe = document.querySelector(".info-extra span:first-child");
    const dataDetalhe = document.querySelector(".info-extra span:last-child");

    // Selecionar uma notificação
    notificacoes.forEach(function (notificacao) {

        notificacao.addEventListener("click", function () {

            // Remove a seleção anterior
            notificacoes.forEach(function (card) {
                card.classList.remove("ativo");
            });

            // Destaca a notificação clicada
            notificacao.classList.add("ativo");

            // Captura as informações da notificação
            const icone = notificacao.querySelector("i").className;
            const titulo = notificacao.querySelector("h4").textContent;
            const texto = notificacao.querySelector("p").textContent;
            const data = notificacao.querySelector("span").textContent;

            // Atualiza o painel de detalhes
            iconeDetalhe.className = icone;
            tituloDetalhe.textContent = titulo;
            textoDetalhe.textContent = texto;
            dataDetalhe.textContent = "Data: " + data;

            // Identifica a categoria
            let tipo = "Sistema";

            if (icone.includes("user")) {
                tipo = "Usuários";
            } else if (icone.includes("paw")) {
                tipo = "Animais";
            } else if (icone.includes("file")) {
                tipo = "Publicações";
            }

            tipoDetalhe.textContent = "Tipo: " + tipo;

        });

    });

    // Filtrar notificações
    filtro.addEventListener("change", function () {

        const categoriaSelecionada = filtro.value;

        notificacoes.forEach(function (notificacao) {

            const icone = notificacao.querySelector("i").className;

            let categoria = "Sistema";

            if (icone.includes("user")) {
                categoria = "Usuários";
            } else if (icone.includes("paw")) {
                categoria = "Animais";
            } else if (icone.includes("file")) {
                categoria = "Publicações";
            }

            if (categoriaSelecionada === "Todas" || categoriaSelecionada === categoria) {
                notificacao.style.display = "flex";
            } else {
                notificacao.style.display = "none";
            }

        });

    });

});