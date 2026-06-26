<?php
$titulo = 'Recuperar senha';
include './../../components/head/head.php';
?>

<body>

    <?php include './../../components/nav/navBar.php'; ?>

    <?php
    ob_start();
    ?>

    <h2>Recuperar senha</h2>

    <form class="form-cadastro">

        <label>Nome</label>
        <input type="text" name="nome" placeholder="Digite seu nome" required>

        <label>E-mail</label>
        <input type="email" name="email" placeholder="Digite seu E-mail" required>

        <label >Telefone</label>

        <input
            type="text"
            name="telefone"
            id="telefone"
            placeholder="Ex: (67) 99999-9999"
            maxlength="15"
            required>
    </form>

    <div class="botoes-modal">

        <a href="login.php">
            <button class="btn-voltar">Voltar</button>
        </a>

        <a href="./codigo_veri.php">
            <button h class="btn-concluir">
                Continuar 🐾
            </button>
        </a>


    </div>

    <?php
    $modalConteudo = ob_get_clean();
    include './../../components/modal/modal.php';
    ?>

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