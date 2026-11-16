
document.addEventListener("DOMContentLoaded", function () {

    // ELEMENTOS DA PÁGINA
    const notificacoes = document.querySelectorAll(".card-noti");
    const filtro = document.querySelector(".filtro");

    const iconeDetalhe = document.querySelector(".icone-detalhe i");
    const tituloDetalhe = document.querySelector(".painel-detalhes h2");
    const textoDetalhe = document.querySelector(".painel-detalhes p");
    const informacoes = document.querySelectorAll(".info-extra span");

    // DADOS DAS NOTIFICAÇÕES
    const detalhes = [
        {
            tipo: "Usuário",
            titulo: "Novo usuário cadastrado",
            texto: "Maria Silva criou uma conta na plataforma e aguarda análise inicial.",
            data: "Hoje às 14:20"
        },
        {
            tipo: "Animais",
            titulo: "Novo animal publicado",
            texto: "Thor foi cadastrado na plataforma e está disponível para adoção.",
            data: "Hoje às 14:10"
        },
        {
            tipo: "Publicações",
            titulo: "Nova publicação",
            texto: "Uma nova publicação foi enviada e está aguardando revisão.",
            data: "Hoje às 13:55"
        },
        {
            tipo: "Sistema",
            titulo: "Sistema atualizado",
            texto: "O backup do sistema foi concluído com sucesso.",
            data: "Hoje"
        }
    ];

    // ÍCONES DAS NOTIFICAÇÕES
    const icones = [
        "fa-user-plus",
        "fa-paw",
        "fa-file-alt",
        "fa-cog"
    ];

    // SELECIONAR NOTIFICAÇÃO
    notificacoes.forEach(function (card, index) {

        card.addEventListener("click", function () {

            // Remove a seleção anterior
            notificacoes.forEach(function (item) {
                item.classList.remove("ativo");
            });

            // Destaca a notificação clicada
            card.classList.add("ativo");

            // Atualiza o painel de detalhes
            const detalhe = detalhes[index];

            tituloDetalhe.textContent = detalhe.titulo;
            textoDetalhe.textContent = detalhe.texto;

            iconeDetalhe.className = "fas " + icones[index];

            informacoes[0].textContent = detalhe.tipo;
            informacoes[1].textContent = detalhe.data;

        });

    });

    // FILTRAR NOTIFICAÇÕES
    filtro.addEventListener("change", function () {

        const categoria = filtro.value;

        notificacoes.forEach(function (card) {

            const icone = card.querySelector("i");

            let mostrar = false;

            if (categoria === "Todas") {
                mostrar = true;
            } 
            else if (categoria === "Usuários" && icone.classList.contains("fa-user-plus")) {
                mostrar = true;
            } 
            else if (categoria === "Animais" && icone.classList.contains("fa-paw")) {
                mostrar = true;
            } 
            else if (categoria === "Publicações" && icone.classList.contains("fa-file-alt")) {
                mostrar = true;
            } 
            else if (categoria === "Sistema" && icone.classList.contains("fa-cog")) {
                mostrar = true;
            }

            card.style.display = mostrar ? "flex" : "none";

        });

    });

});
