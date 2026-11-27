
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

/* CONFIRMAR RECUSA */

document.querySelector(".confirmar-recusa-mod").addEventListener("click", async function (e) {

    e.preventDefault();

    if (!linhaSelecionada) return;

    const idAnimal = linhaSelecionada.dataset.idAnimal;
    const status = linhaSelecionada.querySelector(".status-mod");
    const textarea = document.querySelector(".caixa-recusa-mod textarea");

    const checkSelecionado = document.querySelectorAll(".motivos-mod input:checked");

    const motivos = Array.from(checkSelecionado).map(item => item.value);

    const observacao = textarea.value.trim();

    if (motivos.length === 0 && observacao === "") {
        alert("Selecione um motivo ou escreva uma observação.");
        return;
    }

    try {

        const resposta = await fetch(
            "../../../../verificacoes/mod/atualizar-publicacao.php",
            {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    id_animal: idAnimal,
                    status: "Recusado",
                    motivos: motivos,
                    observacao: observacao
                })
            }
        );

        const resultado = await resposta.json();

        if (!resposta.ok || !resultado.sucesso) {
            alert(resultado.erro || "Não foi possível recusar a publicação.");
            return;
        }

        status.textContent = "Recusado";

        status.classList.remove("pendente-mod", "aprovado-mod");
        status.classList.add("recusado-mod");

        document.querySelectorAll(".motivos-mod input").forEach(input => {
            input.checked = false;
        });

        textarea.value = "";

        modalRecusa.style.display = "none";

        alert("Publicação recusada com sucesso!");

    } catch (erro) {

        console.error(erro);
        alert("Erro ao comunicar com o servidor.");

    }

});

/* APROVAR PUBLICAÇÃO */

document.querySelectorAll(".aprovar-mod")
    .forEach(botao => {

        botao.addEventListener("click", async function () {

            const linha = this.closest(".linha-mod");

            const idAnimal = linha.dataset.idAnimal;

            try {

                const resposta = await fetch(
                    "../../../../verificacoes/mod/atualizar-publicacao.php",
                    {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            id_animal: idAnimal,
                            status: "Aprovado"
                        })
                    }
                );

                const resultado = await resposta.json();

                if (!resposta.ok || !resultado.sucesso) {
                    alert(resultado.erro || "Não foi possível aprovar a publicação.");
                    return;
                }

                const status = linha.querySelector(".status-mod");

                status.textContent = "Aprovado";

                status.classList.remove(
                    "pendente-mod",
                    "recusado-mod"
                );

                status.classList.add("aprovado-mod");

                alert("Publicação aprovada com sucesso!");

            } catch (erro) {

                console.error(erro);
                alert("Erro ao comunicar com o servidor.");

            }

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

window.abrirModalFormulario = abrirModalFormulario;
window.fecharModalFormulario = fecharModalFormulario;

/* FILTRAR PUBLICAÇÕES */

const filtroStatus = document.getElementById("filtroStatus");

filtroStatus.addEventListener("change", function () {

    const statusSelecionado = this.value;

    document.querySelectorAll(".publicacao-linha-mod").forEach(linha => {

        const status = linha.querySelector(".status-mod").textContent.trim();

        if (statusSelecionado === "todos" || status === statusSelecionado) {
            linha.style.display = "grid";
        } else {
            linha.style.display = "none";
        }

    });

});
