<?php
$titulo = 'Contato';
include './../../components/head/head.php';
?>

<body>

    <?php include './../../components/nav/navBar.php'; ?>

    <?php
    ob_start();
    ?>

    <form class="form-cadastro" action="./agradecimento.php">

        <h2>Como podemos ajudar?</h2>

        <label>Qual o assunto?</label>
        <div class="campo">

            <div class="dropdown">

                <div class="dropdown-selected">
                    Selecione um assunto
                </div>

                <div class="dropdown-options">
                    <div class="option">Adoção</div>
                    <div class="option">Denúncia</div>
                    <div class="option">Dúvida</div>
                    <div class="option">Sugestão</div>
                    <div class="option">Outro</div>
                </div>

                <!-- obrigatório -->
                <input type="hidden" name="assunto" id="assuntoSelecionado" required>

            </div>
        </div>

        <!-- aparece apenas quando escolher Outro -->
        <input
            type="text"
            id="outroAssunto"
            name="outroAssunto"
            placeholder="Digite o assunto"
            style="display:none;"
            class="input-padrao">

        <label>Nome</label>
        <input
            type="text"
            name="nome"
            id="nome"
            placeholder="Digite seu nome"
            required>


        <label>Mensagem</label>
        <textarea
            id="mensagem"
            name="mensagem"
            placeholder="Digite a sua mensagem"
            maxlength="500"
            required></textarea>

        <small id="contador">0 / 500 caracteres</small>

        <div class="botoes-modal">



            <button
                type="button"
                class="btn-voltar"
                onclick="window.location.href='home.php'">
                Voltar
            </button>

            <button type="submit" class="btn-concluir">
                Enviar Mensagem 🐾
            </button>

        </div>

    </form>

    <?php
    $modalConteudo = ob_get_clean();
    include './../../components/modal/modal.php';
    ?>

    
    <?php
    include './acessibilidade.php';
    ?>

    <script>
        const nome = document.getElementById("nome");

        nome.addEventListener("input", function() {

            // permite letras + acentos + espaços
            this.value = this.value.replace(/[^A-Za-zÀ-ÿ\s]/g, "");

        });
    </script>
    <script>
        const dropdown = document.querySelector(".dropdown");
        const selected = document.querySelector(".dropdown-selected");
        const options = document.querySelectorAll(".option");
        const outroInput = document.getElementById("outroAssunto");
        const hiddenInput = document.getElementById("assuntoSelecionado");

        selected.addEventListener("click", () => {
            dropdown.classList.toggle("active");
        });

        options.forEach(option => {

            option.addEventListener("click", () => {

                selected.textContent = option.textContent;
                hiddenInput.value = option.textContent;

                dropdown.classList.remove("active");

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

        document.addEventListener("click", (e) => {

            if (!dropdown.contains(e.target)) {
                dropdown.classList.remove("active");
            }

        });


        // contador textarea

        const textarea = document.getElementById("mensagem");
        const contador = document.getElementById("contador");
        const limite = 500;

        textarea.addEventListener("input", () => {

            let tamanho = textarea.value.length;
            contador.textContent = `${tamanho} / ${limite} caracteres`;

            if (tamanho > limite) {
                textarea.value = textarea.value.substring(0, limite);
            }

        });



        // VALIDAÇÃO

        document
            .querySelector(".form-cadastro")
            .addEventListener("submit", function(e) {

                let valido = true;

                document
                    .querySelectorAll(".erro")
                    .forEach(el => {
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

                    alert(
                        "Preencha todos os campos obrigatórios!"
                    );
                }

            });
    </script>

</body>