<?php
$titulo = 'Comportamento do Animal';
include './../../components/head/head.php';
?>

<body>

    <?php
    include './../../components/nav/navBar.php';
    ?>

    <?php
    ob_start();
    ?>

    <div class="progress-steps">
        <span class="active">1</span>
        <span class="active">2</span>
        <span>3</span>
        <span>4</span>
        <span>5</span>
    </div>

    <h2>Comportamento do Animal</h2>

    <form class="form-animal">

        <!-- PERGUNTA 1 -->
        <div class="campo">
            <label class="form-cadastro">Como o animal interage com pessoas?</label>

            <div class="dropdown">
                <div class="dropdown-selected">Selecione um tipo</div>

                <div class="dropdown-options">
                    <div class="option">Sociável e amigável</div>
                    <div class="option">Tímido, mas se adapta</div>
                    <div class="option">Medroso ou agressivo</div>
                    <div class="option">Outro</div>
                </div>

                <!-- valor enviado -->
                <input type="hidden" name="interacao_pessoas" required>
            </div>
            <input type="text" placeholder="Ex: Raivoso" name="detalhes_interacao" style="display:none;" class="outroAssunto">
        </div>


        <!-- PERGUNTA 2 -->

        <div class="campo">
            <label class="form-cadastro">O animal convive bem com outros animais?</label>

            <div class="dropdown">
                <div class="dropdown-selected">Selecione um tipo</div>

                <div class="dropdown-options">
                    <div class="option">Sim, com todos</div>
                    <div class="option">Não testado/Desconhecido</div>
                    <div class="option">Não</div>
                    <div class="option">Sim, apenas com algumas espécies</div>
                </div>

                <!-- valor enviado -->
                <input type="hidden" name="convivencia_animais" required>
            </div>
        </div>
        <input type="text" placeholder="Ex: Coelho" name="especies_convivencia" style="display:none;" class="outroAssunto">

        <!-- PERGUNTA 3 -->

        <div class="campo">
            <label class="form-cadastro">O animal convive bem com crianças?</label>

            <div class="dropdown">
                <div class="dropdown-selected">Selecione um tipo</div>

                <div class="dropdown-options">
                    <div class="option">Sim, com todos</div>
                    <div class="option">Não</div>
                    <div class="option">Não testado/Desconhecido</div>
                </div>

                <!-- valor enviado -->
                <input type="hidden" name="convivencia_criancas" required>
            </div>
        </div>

        <!-- PERGUNTA 4 -->

        <div class="campo">
            <label class="form-cadastro">O animal está acostumado a que tipo de ambiente? </label>

            <div class="dropdown">
                <div class="dropdown-selected">Selecione um tipo</div>

                <div class="dropdown-options">
                    <div class="option">Casa com quintal</div>
                    <div class="option">Apartamento</div>
                    <div class="option">Chácara/Sítio</div>
                </div>

                <!-- valor enviado -->
                <input type="hidden" name="ambiente" required>
            </div>
        </div>

        <!-- PERGUNTA 5 -->

        <div class="campo">
            <label class="form-cadastro">O animal tem algum problema de saúde ou necessita de cuidados especiais?</label>

            <div class="dropdown">
                <div class="dropdown-selected">Selecione um tipo</div>

                <div class="dropdown-options">
                    <div class="option">Não, está saudável</div>
                    <div class="option">Sim, possui problema de saúde</div>
                    <div class="option">Sim, necessita de cuidados especiais</div>
                    <div class="option">Desconhecido</div>
                </div>

                <!-- valor enviado -->
                <input type="hidden" name="cuidados_especiais" required>
            </div>
            <input
                type="text"
                name="detalhes_saude"
                placeholder="Descreva o problema de saúde ou os cuidados necessários"
                style="display:none;"
                class="outroAssunto">
        </div>

        <div class="botoes">
            <button type="button" class="btn-voltar" onclick="window.location.href='./doacao1.php'">
                Voltar
            </button>

            <button type="submit" class="btn-concluir">Continuar 🐾</button>
        </div>

    </form>

    <?php
    $modalConteudo = ob_get_clean();
    include './../../components/modal/modal.php';
    ?>

    <script src="./../../assets/js/user/doacao.js" defer></script>


</body>