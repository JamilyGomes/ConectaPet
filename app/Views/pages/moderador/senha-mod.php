<?php
$titulo = 'Recuperar senha';
include './../../components/head/head.php';
?>

<body>

    <?php
    ob_start();
    ?>

    <h2>Recuperar senha Moderador</h2>

    <form class="form-cadastro" action="./verificacao-mod.php">

        <div class="campo">
            <label>Nome Completo</label>
            <input type="text" id="nome" placeholder="Digite seu nome" required>
        </div>

        <div class="campo">
            <label>Telefone</label>

            <input
                type="text"
                name="telefone"
                id="telefone"
                placeholder="Ex: (67) 99999-9999"
                maxlength="15"
                required>
        </div>

        <div class="campo">
            <label>E-mail</label>
            <input type="email" placeholder="Digite seu email" required>
        </div>

        <div class="botoes-modal">
            <button type="button" class="btn-voltar" onclick="window.location.href='login-mod.php'">
                Voltar
            </button>
    
            <button type="submit" class="btn-concluir">
                Continuar 🐾
            </button>
        </div>
    </form>

    <?php
    $modalConteudo = ob_get_clean();
    include './../../components/modal/modal.php';
    ?>

    <script>
        const nome = document.getElementById("nome");

        nome.addEventListener("input", function() {

            // remove tudo que NÃO for letra ou espaço
            this.value = this.value.replace(/[^a-zA-ZÀ-ÿ\s]/g, "");

        });
    </script>

    <script>
        const telefone = document.getElementById("telefone");

        telefone.addEventListener("input", function() {

            // remove tudo que não for número
            let valor = this.value.replace(/\D/g, "");

            // aplica máscara
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