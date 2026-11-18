
function abrirModalAdocao() {
    document.getElementById('modalAdocaoPi').style.display = 'flex';
}

function fecharModalAdocao() {
    document.getElementById('modalAdocaoPi').style.display = 'none';
}

function abrirModalRecusa() {
    document.getElementById("modalRecusaAdocao").style.display = "flex";
}

function fecharModalRecusa() {
    document.getElementById("modalRecusaAdocao").style.display = "none";
}

function abrirModalQuestionario() {
    document.getElementById("modalQuestionario").style.display = "flex";
}

function fecharModalQuestionario() {
    document.getElementById("modalQuestionario").style.display = "none";
}

document.addEventListener("DOMContentLoaded", function () {

    let linhaSelecionadaAdocao = null;
    let linhaDetalhesAdocao = null;

    // ABRIR DETALHES DA SOLICITAÇÃO
    document.querySelectorAll(".visualizar-mod")
        .forEach(botao => {

            botao.addEventListener("click", function () {

                linhaDetalhesAdocao =
                    this.closest(".solicitacao-pi-linha");

            });

        });


    const modalRecusaAdocao =
        document.getElementById("modalRecusaAdocao");

    // RECUSAR
    document.querySelectorAll(".recusar-mod")
        .forEach(botao => {

            botao.addEventListener("click", function () {

                linhaSelecionadaAdocao =
                    this.closest(".solicitacao-pi-linha");

                modalRecusaAdocao.style.display = "flex";

            });

        });

    // FECHAR
    document.getElementById("fecharRecusaAdocao")
        .addEventListener("click", function () {

            modalRecusaAdocao.style.display = "none";

        });

    // FECHAR FORA
    modalRecusaAdocao.addEventListener("click", function (e) {

        if (e.target === modalRecusaAdocao) {
            modalRecusaAdocao.style.display = "none";
        }

    });

    // CONFIRMAR RECUSA
    document.querySelector(".confirmar-recusa-adocao")
        .addEventListener("click", function () {

            if (!linhaSelecionadaAdocao) return;

            let status =
                linhaSelecionadaAdocao.querySelector(".solicitacao-pi-status");

            status.textContent = "Recusado";

            status.classList.remove("pendente", "aprovado");
            status.classList.add("recusado");

            modalRecusaAdocao.style.display = "none";

            linhaSelecionadaAdocao = null;

        });

    // APROVAR PELA TABELA
    document.querySelectorAll(".aprovar-mod")
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

    // APROVAR PELO MODAL DE DETALHES
    document.querySelector(".btn-aprovar-pi")
        .addEventListener("click", function () {

            if (!linhaDetalhesAdocao) return;

            let status =
                linhaDetalhesAdocao.querySelector(".solicitacao-pi-status");

            status.textContent = "Aprovado";

            status.classList.remove("pendente", "recusado");
            status.classList.add("aprovado");

            fecharModalAdocao();

            linhaDetalhesAdocao = null;

        });

    // RECUSAR PELO MODAL DE DETALHES
    document.querySelector(".btn-recusar-pi")
        .addEventListener("click", function () {

            if (!linhaDetalhesAdocao) return;

            linhaSelecionadaAdocao = linhaDetalhesAdocao;

            fecharModalAdocao();

            abrirModalRecusa();

        });
});