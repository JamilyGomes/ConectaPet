<?php
$titulo = 'Senha';
include './../../components/head/head.php';
?>

<body>

    <?php
    include './../../components/nav/navBar.php';
    ?>

    <?php
    ob_start();
    ?>

    <h2>Digite sua nova senha</h2>

    <form class="form-cadastro" action="./senha-atualizada.php">
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

                <input type="password" id="confirmarSenha" name="confirmarSenha"
                    placeholder="Confirme sua senha" required>

                <span class="material-icons olho"
                    onclick="toggleSenha('confirmarSenha', this)">
                    visibility
                </span>

            </div>

        </div>

        <div class="botoes-modal">
            <button type="button" class="btn-voltar"
                onclick="window.location.href='codigo_veri.php'">
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
</body>