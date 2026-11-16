document.addEventListener("DOMContentLoaded", function () {

    // ABRIR MODAL DE INFORMAÇÕES DO ANIMAL
    window.abrirModalAnimal = function () {
        document.getElementById("modalAnimal").style.display = "flex";
    };

    // FECHAR MODAL DE INFORMAÇÕES DO ANIMAL
    window.fecharModalAnimal = function () {
        document.getElementById("modalAnimal").style.display = "none";
    };

    // ABRIR MODAL DO QUESTIONÁRIO
    window.abrirModalQuestionarioAnimal = function () {
        document.getElementById("modalQuestionarioAnimal").style.display = "flex";
    };

    // FECHAR MODAL DO QUESTIONÁRIO
    window.fecharModalQuestionarioAnimal = function () {
        document.getElementById("modalQuestionarioAnimal").style.display = "none";
    };

    // MARCAR ANIMAL COMO ADOTADO OU ATIVO
    document.querySelectorAll(".adotar-animal").forEach(botao => {

        botao.addEventListener("click", function () {

            let linha = this.closest(".adm-animal-linha");

            let status = linha.querySelector(".adm-status-animal");

            if (status.innerHTML.trim() === "Ativo") {

                status.innerHTML = "Adotado";
                status.classList.add("adotado");

            } else {

                status.innerHTML = "Ativo";
                status.classList.remove("adotado");

            }

        });

    });

});