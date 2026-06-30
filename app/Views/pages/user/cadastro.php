<?php
$titulo = 'Cadastro';
include './../../components/head/head.php';
?>

<body>

    <?php
    include './../../components/nav/navBar.php';
    ?>

    <?php
    ob_start();
    ?>

    <h2>Dados Pessoais</h2>

    <form class="form-cadastro" action="./cadastro2.php">
        <div class="campo">
            <label>Nome Completo</label>
            <input type="text" id="nome" placeholder="Digite seu nome" required>
        </div>

        <div class="campo">
            <label>CPF</label>
            <input type="text" id="cpf" placeholder="Digite seu CPF" maxlength="14" required>
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

        <label for="senha">Senha</label>

        <div class="senha-group">

            <div class="campo-senha">

                <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
                <span class="material-icons olho" onclick="toggleSenha('senha', this)">
                    visibility
                </span>

            </div>
        </div>

        <label for="senha">Confirmar Senha</label>

        <div class="senha-group">

            <div class="campo-senha">

                <input type="password" id="confirmarSenha" name="confirmarSenha" placeholder="Confirme sua senha" required>
                <span class="material-icons olho" onclick="toggleSenha('confirmarSenha', this)">
                    visibility
                </span>

            </div>
        </div>


        <div class="upload-area">
            <label class="upload-foto">
                <input type="file" name="foto">
            </label>

            <p>
                Selecione uma imagem para foto de perfil
            </p>

        </div>
        <div class="botoes-modal">
            <button type="button" class="btn-voltar" onclick="window.location.href='login.php'">
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

    
    <?php
    include './acessibilidade.php';
    ?>

    <script>
        function toggleSenha(id, icone) {

            const input = document.getElementById(id);

            if (input.type === "password") {
                input.type = "text";
                icone.textContent = "visibility_off";
            } else {
                input.type = "password";
                icone.textContent = "visibility";
            }
        }
    </script>

    <script>
        const cpf = document.getElementById("cpf");

        cpf.addEventListener("input", function() {

            // deixa só números
            let valor = this.value.replace(/\D/g, "");

            // limita 11 dígitos
            valor = valor.substring(0, 11);

            // aplica máscara
            valor = valor.replace(/(\d{3})(\d)/, "$1.$2");
            valor = valor.replace(/(\d{3})(\d)/, "$1.$2");
            valor = valor.replace(/(\d{3})(\d{1,2})$/, "$1-$2");

            this.value = valor;
        });
    </script>

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
    </script>
</body>