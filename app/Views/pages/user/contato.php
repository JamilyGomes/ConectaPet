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

    <script src="./../../assets/js/user/contato.js" defer></script>

</body>