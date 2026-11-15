<?php
$titulo = 'Experiência';
include './../../components/head/head.php';
?>

<body>

    <?php include './../../components/nav/navBar.php'; ?>

    <?php ob_start(); ?>

    <div class="progress-steps">
        <span class="active">1</span>
        <span class="active">2</span>
        <span class="active">3</span>
        <span>4</span>
        <span>5</span>
    </div>

    <h2>Sobre experiência com animais</h2>

    <form class="form-cadastro" id="formExperiencia">

        <!-- TEVE ANIMAIS -->
        <p>Você já teve animais antes?</p>

        <div class="campo">
            <div class="dropdown">
                <div class="dropdown-selected">Selecione uma opção</div>

                <div class="dropdown-options">
                    <div class="option">Sim</div>
                    <div class="option">Não</div>
                </div>

                <input type="hidden" name="teve_animais" required>
            </div>
        </div>

        <!-- POSSUI ANIMAIS -->
        <p>Atualmente possui outros animais?</p>

        <div class="campo">
            <div class="dropdown" id="dropdownAnimais">
                <div class="dropdown-selected">Selecione uma opção</div>

                <div class="dropdown-options">
                    <div class="option">Sim</div>
                    <div class="option">Não</div>
                </div>

                <input type="hidden" name="possui_animais" required>
            </div>
        </div>

        <!-- CAMPO DINÂMICO -->
        <div id="campo-animais" class="campo-extra" style="display:none;">
            <label>Espécies e quantidade</label>
            <input type="text" name="descricao_animais" placeholder="Ex: 2 gatos e 1 cachorro">
        </div>

        <!-- VACINAÇÃO -->
        <p>Se possui animais, eles são vacinados e castrados?</p>

        <div class="campo">
            <div class="dropdown">
                <div class="dropdown-selected">Selecione uma opção</div>

                <div class="dropdown-options">
                    <div class="option">Todos vacinados e castrados </div>
                    <div class="option">Alguns vacinados/castrados</div>
                    <div class="option">Nenhum</div>
                    <div class="option">Não se aplica</div>
                </div>

                <input type="hidden" name="vacinados" required>
            </div>
        </div>

        <!-- BOTÕES -->
        <div class="botoes-modal">
            <button type="button" class="btn-voltar">
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

    <script src="./../../assets/js/adocao.js" defer></script>
</body>