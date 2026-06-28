<?php
$titulo = 'Solicitação Enviada';
include './../../components/head/head.php';
?>

<body>

    <?php
    include './../../components/nav/navBar.php';
    ?>

    <?php
    ob_start();
    ?>

    <div class="confirmacao-box">

        <h2>Senha atualizada com sucesso! 🐾</h2>

        <p>
            Sua senha foi alterada com sucesso e sua conta já está pronta para ser acessada.
            Agora, basta retornar à tela de login e informar seu e-mail e a nova senha cadastrada para entrar no Conecta Pet com segurança.
        </p>

        <p>
            Caso tenha qualquer dificuldade para acessar sua conta, você poderá solicitar uma nova recuperação de senha a qualquer momento.
        </p>

        <p class="assinatura">
            Com carinho,<br>
            Equipe Conecta Pet
        </p>

        <div class="bt">
            <button
                type="button"
                class="bt_home"
                onclick="window.location.href='login.php'">
                Ir para o Login 🐾
            </button>
        </div>

    </div>

    <?php
    $modalConteudo = ob_get_clean();
    include './../../components/modal/modal.php';
    ?>

</body>