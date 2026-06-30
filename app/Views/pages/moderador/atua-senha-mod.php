<?php
$titulo = 'Solicitação Enviada';
include './../../components/head/head.php';
?>

<body>


    <?php
    ob_start();
    ?>

    <?php
    include './../../components/ace/acessibilidade.php';
    ?>

    <div class="confirmacao-box">

        <h2>Senha atualizada com sucesso! 🐾</h2>

        <p>
            A senha da sua conta de moderador foi alterada com sucesso.
            Agora você já pode acessar o painel administrativo utilizando seu e-mail e a nova senha cadastrada.
        </p>

        <p>
            Retorne à tela de login, informe suas credenciais e continue gerenciando o Conecta Pet com segurança.
            Caso tenha dificuldades para acessar sua conta, você poderá solicitar uma nova recuperação de senha.
        </p>

        <p class="assinatura">
            Atenciosamente,<br>
            Equipe Conecta Pet
        </p>

        <div class="bt">
            <button
                type="button"
                class="bt_home"
                onclick="window.location.href='login-mod.php'">
                Ir para o Login 🐾
            </button>
        </div>

    </div>
    <?php
    $modalConteudo = ob_get_clean();
    include './../../components/modal/modal.php';
    ?>

</body>