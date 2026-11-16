document.addEventListener("DOMContentLoaded", function () {

    // CAMPO NOME: permite somente letras e espaços
    const nome = document.getElementById("nome");

    nome.addEventListener("input", function () {
        this.value = this.value.replace(/[^a-zA-ZÀ-ÿ\s]/g, "");
    });


    // CAMPO TELEFONE: aplica máscara
    const telefone = document.getElementById("telefone");

    telefone.addEventListener("input", function () {

        let valor = this.value.replace(/\D/g, "");

        if (valor.length > 11) {
            valor = valor.substring(0, 11);
        }

        if (valor.length > 10) {
            valor = valor.replace(
                /^(\d{2})(\d{5})(\d{4}).*/,
                "($1) $2-$3"
            );
        } else if (valor.length > 6) {
            valor = valor.replace(
                /^(\d{2})(\d{4,5})(\d{0,4}).*/,
                "($1) $2-$3"
            );
        } else if (valor.length > 2) {
            valor = valor.replace(
                /^(\d{2})(\d+)/,
                "($1) $2"
            );
        } else if (valor.length > 0) {
            valor = valor.replace(
                /^(\d+)/,
                "($1"
            );
        }

        this.value = valor;
    });


    // VALIDAÇÃO DOS CAMPOS OBRIGATÓRIOS
    document
        .querySelector(".form-cadastro")
        .addEventListener("submit", function (e) {

            let valido = true;

            document.querySelectorAll(".erro").forEach(el => {
                el.classList.remove("erro");
            });

            const campos = this.querySelectorAll("[required]");

            campos.forEach(campo => {

                if (
                    !campo.value ||
                    (
                        campo.type !== "file" &&
                        campo.value.trim() === ""
                    )
                ) {

                    if (campo.type === "hidden") {

                        campo
                            .closest(".dropdown")
                            .classList.add("erro");

                    } else {

                        campo.classList.add("erro");
                    }

                    valido = false;
                }

            });

            if (!valido) {
                e.preventDefault();

                alert("Preencha todos os campos obrigatórios!");
            }

        });

});