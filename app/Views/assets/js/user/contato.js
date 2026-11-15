document.addEventListener('DOMContentLoaded', function () {

// nome- permitir somente letras 
    const nome = document.getElementById("nome");

    if (nome) {
        nome.addEventListener("input", function () {

            // Permite letras, acentos e espaços
            this.value = this.value.replace(/[^A-Za-zÀ-ÿ\s]/g, "");

        });
    }


// dropdown assunto 
    const dropdown = document.querySelector(".dropdown");
    const selected = document.querySelector(".dropdown-selected");
    const options = document.querySelectorAll(".option");
    const outroInput = document.getElementById("outroAssunto");
    const hiddenInput = document.getElementById("assuntoSelecionado");

    if (dropdown && selected && hiddenInput) {

        // Abre e fecha o dropdown
        selected.addEventListener("click", () => {
            dropdown.classList.toggle("active");
        });

        // Seleciona o assunto
        options.forEach(option => {

            option.addEventListener("click", () => {

                selected.textContent = option.textContent;
                hiddenInput.value = option.textContent;

                dropdown.classList.remove("active");

                // Verifica se escolheu Outro
                if (option.textContent === "Outro") {

                    outroInput.style.display = "block";
                    outroInput.setAttribute("required", "required");

                } else {

                    outroInput.style.display = "none";
                    outroInput.removeAttribute("required");
                    outroInput.value = "";

                }

            });

        });

        // Fecha o dropdown ao clicar fora dele
        document.addEventListener("click", (e) => {

            if (!dropdown.contains(e.target)) {
                dropdown.classList.remove("active");
            }

        });

    }


// contador de caracteres da mensagem 
    const textarea = document.getElementById("mensagem");
    const contador = document.getElementById("contador");
    const limite = 500;

    if (textarea && contador) {

        textarea.addEventListener("input", () => {

            // Impede ultrapassar o limite
            if (textarea.value.length > limite) {
                textarea.value = textarea.value.substring(0, limite);
            }

            let tamanho = textarea.value.length;

            contador.textContent = `${tamanho} / ${limite} caracteres`;

        });

    }


// validacao formulario 
    const formulario = document.querySelector(".form-cadastro");

    if (formulario) {

        formulario.addEventListener("submit", function (e) {

            let valido = true;

            // Remove erros anteriores
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

                        campo.closest(".dropdown").classList.add("erro");

                    } else {

                        campo.classList.add("erro");

                    }

                    valido = false;

                }

            });

            // Impede o envio se houver campos vazios
            if (!valido) {

                e.preventDefault();

                alert("Preencha todos os campos obrigatórios!");

            }

        });

    }

});