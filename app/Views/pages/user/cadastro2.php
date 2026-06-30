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

        <div class="confirmacao-box">

            <h2>Cadastro realizado com sucesso! 🐾</h2>

            <p>
                Sua conta no Conecta Pet foi criada com sucesso! Agora você já pode acessar a plataforma utilizando o e-mail e a senha informados durante o cadastro.
            </p>

            <p>
                Retorne à tela de login, informe seus dados de acesso e aproveite todos os recursos do Conecta Pet para conhecer pets disponíveis para adoção, acompanhar informações e fazer parte da nossa comunidade.
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


        <?php
        include './acessibilidade.php';
        ?>
</body>