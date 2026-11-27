document.addEventListener("DOMContentLoaded", function () {

    // ABRIR MODAL DE INFORMAÇÕES DO ANIMAL
    window.abrirModalAnimal = function (idAnimal) {
        document.getElementById("modalAnimal").style.display = "flex";

        console.log("Animal selecionado:", idAnimal);
    };

    // FECHAR MODAL DE INFORMAÇÕES DO ANIMAL
    window.fecharModalAnimal = function () {
        document.getElementById("modalAnimal").style.display = "none";
    };

    // ABRIR MODAL DO QUESTIONÁRIO
    window.abrirModalQuestionarioAnimal = function (idAnimal) {
        document.getElementById("modalQuestionarioAnimal").style.display = "flex";

        console.log("Questionário do animal:", idAnimal);
    };

    // FECHAR MODAL DO QUESTIONÁRIO
    window.fecharModalQuestionarioAnimal = function () {
        document.getElementById("modalQuestionarioAnimal").style.display = "none";
    };

    // MARCAR ANIMAL COMO ADOTADO OU APROVADO
    document.querySelectorAll(".adotar-animal").forEach(botao => {

        botao.addEventListener("click", async function () {

            const idAnimal = this.dataset.id;

            const linha = this.closest(".adm-animal-linha");
            const status = linha.querySelector(".adm-status-animal");

            try {

                const resposta = await fetch(
                    "./../../../../verificacoes/mod/atualizar-status-animal.php",
                    {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded"
                        },
                        body: "id_animal=" + encodeURIComponent(idAnimal)
                    }
                );

                const resultado = await resposta.json();

                if (!resposta.ok || !resultado.sucesso) {
                    alert(resultado.mensagem || "Não foi possível atualizar o status.");
                    return;
                }

                status.textContent = resultado.status;

                if (resultado.status === "Adotado") {
                    status.classList.add("adotado");
                } else {
                    status.classList.remove("adotado");
                }

                alert("Status atualizado com sucesso!");

            } catch (erro) {

                console.error(erro);
                alert("Erro ao comunicar com o servidor.");

            }

        });

    });

    });