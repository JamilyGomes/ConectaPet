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

    <script src="./../../assets/js/mod/senha.js" defer></script>

</body>