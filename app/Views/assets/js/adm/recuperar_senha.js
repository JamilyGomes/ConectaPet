document.addEventListener("DOMContentLoaded", function () {

    // CAMPO NOME: PERMITIR APENAS LETRAS E ESPAÇOS
    const nome = document.getElementById("nome");

    if (nome) {
        nome.addEventListener("input", function () {
            this.value = this.value.replace(/[^a-zA-ZÀ-ÿ\s]/g, "");
        });
    }

    // MÁSCARA DE TELEFONE
    const telefone = document.getElementById("telefone");

    if (telefone) {
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
    }

    // VALIDAR CAMPOS OBRIGATÓRIOS
    const formulario = document.querySelector(".form-cadastro");

    if (formulario) {
        formulario.addEventListener("submit", function (e) {

            let valido = true;

            document.querySelectorAll(".erro").forEach(function (el) {
                el.classList.remove("erro");
            });

            const campos = this.querySelectorAll("[required]");

            campos.forEach(function (campo) {

                if (!campo.value || campo.value.trim() === "") {
                    campo.classList.add("erro");
                    valido = false;
                }

            });

            if (!valido) {
                e.preventDefault();
                alert("Preencha todos os campos obrigatórios!");
            }

        });
    }

});