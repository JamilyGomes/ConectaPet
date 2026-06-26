
const modalRecusa = document.getElementById("modalRecusa");

let linhaSelecionada = null;


/* ABRIR MODAL */

document.querySelectorAll(".recusar-mod")
    .forEach(botao => {

        botao.addEventListener("click", function () {

            // guarda a linha clicada
            linhaSelecionada = this.closest(".linha-mod");

            // abre modal
            modalRecusa.style.display = "flex";

        });

    });


/* FECHAR BOTÃO */

document
    .getElementById("fecharRecusa")
    .addEventListener("click", function () {

        modalRecusa.style.display = "none";

    });


/* FECHAR CLICANDO FORA */

modalRecusa.addEventListener("click", function (e) {

    if (e.target === modalRecusa) {

        modalRecusa.style.display = "none";

    }

});


/* CONFIRMAR */

document
    .querySelector(".confirmar-recusa-mod")
    .addEventListener("click", function (e) {

        e.preventDefault();

        if (!linhaSelecionada) {
            return;
        }

        let status = linhaSelecionada.querySelector(".status-mod");

        let textarea = document.querySelector(
            ".caixa-recusa-mod textarea"
        );

        let checkSelecionado = document.querySelectorAll(
            ".motivos-mod input:checked"
        );


        // precisa escolher algo
        if (
            checkSelecionado.length === 0 &&
            textarea.value.trim() === ""
        ) {

            alert(
                "Selecione um motivo ou escreva uma observação"
            );

            return;
        }


        // muda status
        status.textContent = "Recusado";

        status.classList.remove(
            "pendente-mod",
            "aprovado-mod"
        );

        status.classList.add(
            "recusado-mod"
        );


        // limpa checkbox
        document
            .querySelectorAll(".motivos-mod input")
            .forEach(item => {

                item.checked = false;

            });


        // limpa textarea
        textarea.value = "";


        // fecha modal
        modalRecusa.style.display = "none";

    });

/* APROVAR PUBLICAÇÃO */

document.querySelectorAll(".aprovar-mod")
    .forEach(botao => {

        botao.addEventListener("click", function () {

            let linha = this.closest(".linha-mod");

            let status = linha.querySelector(".status-mod");

            // muda texto
            status.textContent = "Aprovado";

            // remove outras classes
            status.classList.remove(
                "pendente-mod",
                "recusado-mod"
            );

            // adiciona aprovado
            status.classList.add(
                "aprovado-mod"
            );

        });

    });

/* MODAL VISUALIZAR */

const modalPublicacao =
    document.getElementById(
        "modalPublicacao"
    );


document
    .querySelectorAll(
        ".visualizar-mod"
    )

    .forEach(botao => {

        botao.addEventListener(
            "click",

            function (e) {

                e.preventDefault();

                modalPublicacao.style.display =
                    "flex";

            });

    });


document
    .getElementById(
        "fecharPublicacao"
    )

    .addEventListener(
        "click",

        () => {

            modalPublicacao.style.display =
                "none";

        });


modalPublicacao
    .addEventListener(
        "click",

        function (e) {

            if (
                e.target === modalPublicacao
            ) {

                modalPublicacao.style.display =
                    "none";

            }

        });

/* MODAL FORMULÁRIO */

const modalFormulario =
    document.getElementById("modalFormulario");


function abrirModalFormulario() {

    modalFormulario.style.display = "flex";

}


function fecharModalFormulario() {

    modalFormulario.style.display = "none";

}


/* FECHAR CLICANDO FORA */

modalFormulario.addEventListener("click", function (e) {

    if (e.target === modalFormulario) {

        modalFormulario.style.display = "none";

    }

});
