<?php
$titulo = 'Envio de codigo para recuperar senha';
include './../../components/head/head.php';
?>

<body>


    <?php
    ob_start();
    ?>

    <h2>Confirme seu acesso 🐾</h2>

    <form class="form-cadastro" action="./atua-senha-mod.php">

        <div class="confirmacao-box">
            <p>
                Você irá receber um código de verificação no e-mail usua*****@gmail.com
            </p>
        </div>

        <h4>Digite o código</h4>

        <div class="codigo-container">
            <div class="codigo">
                <input type="text" maxlength="1" required>
                <input type="text" maxlength="1" required>
                <input type="text" maxlength="1" required>
                <input type="text" maxlength="1" required>
                <input type="text" maxlength="1" required>
                <input type="text" maxlength="1" required>
            </div>
        </div>

        <div class="botoes">

            <button
                type="button"
                class="btn-voltar"
                onclick="window.location.href='senha-mod.php'">
                Voltar
            </button>

            <button type="submit" class="btn-concluir">
                Concluir 🐾
            </button>

        </div>

    </form>

    <a class="reenvio" href="">Reenviar código</a>

    <?php
    $modalConteudo = ob_get_clean();
    include './../../components/modal/modal.php';
    ?>

    <script src="./../../assets/js/mod/verificacao.js" defer></script>

</body>