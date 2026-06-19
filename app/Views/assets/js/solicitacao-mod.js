

function abrirModalAdocao() {
    document.getElementById('modalAdocaoPi').style.display = 'flex';
}

function fecharModalAdocao() {
    document.getElementById('modalAdocaoPi').style.display = 'none';
}

function abrirModalRecusa() {
    document.getElementById("modalRecusa").style.display = "flex";
}

function fecharModalRecusa() {
    document.getElementById("modalRecusa").style.display = "none";
}

document.addEventListener("DOMContentLoaded", function () {

    let linhaSelecionadaAdocao = null;

    const modalRecusaAdocao =
    document.getElementById("modalRecusaAdocao");


    /* RECUSAR */
    document.querySelectorAll(".recusar-adocao")
    .forEach(botao => {

        botao.addEventListener("click", function () {

            linhaSelecionadaAdocao =
            this.closest(".solicitacao-pi-linha");

            modalRecusaAdocao.style.display = "flex";

        });

    });


    /* FECHAR */
    document.getElementById("fecharRecusaAdocao")
    .addEventListener("click", function () {

        modalRecusaAdocao.style.display = "none";

    });


    /* FECHAR FORA */
    modalRecusaAdocao.addEventListener("click", function (e) {

        if (e.target === modalRecusaAdocao) {
            modalRecusaAdocao.style.display = "none";
        }

    });


    /* CONFIRMAR RECUSA */
    document.querySelector(".confirmar-recusa-adocao")
    .addEventListener("click", function () {

        if (!linhaSelecionadaAdocao) return;

        let status =
        linhaSelecionadaAdocao.querySelector(".solicitacao-pi-status");

        status.textContent = "Recusado";

        status.classList.remove("pendente", "aprovado");
        status.classList.add("recusado");

        modalRecusaAdocao.style.display = "none";

    });


    /* APROVAR */
    document.querySelectorAll(".aprovar-adocao")
    .forEach(botao => {

        botao.addEventListener("click", function () {

            let linha =
            this.closest(".solicitacao-pi-linha");

            let status =
            linha.querySelector(".solicitacao-pi-status");

            status.textContent = "Aprovado";

            status.classList.remove("pendente", "recusado");
            status.classList.add("aprovado");

        });

    });

});


