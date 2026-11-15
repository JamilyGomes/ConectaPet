<?php
$titulo = 'Residência';
include './../../components/head/head.php';
?>

<body>

    <?php include './../../components/nav/navBar.php'; ?>

    <?php ob_start(); ?>

    <div class="progress-steps">
        <span class="active">1</span>
        <span>2</span>
        <span>3</span>
        <span>4</span>
        <span>5</span>
    </div>

    <h2>Sobre a residência</h2>

    <form class="form-cadastro"
        id="formResidencia"
        action="./adocao2.php"
        method="POST">

        <!-- MORADIA -->
        <p>Você mora em casa, apartamento ou chácara/sítio?
        <div class="campo">

            <div class="dropdown">
                <div class="dropdown-selected">
                    Selecione um tipo
                </div>

                <div class="dropdown-options">
                    <div class="option">Casa</div>
                    <div class="option">Apartamento </div>
                    <div class="option">Chácara/Sítio</div>
                    <div class="option">Outro</div>
                </div>

                <input type="hidden"
                    name="tipoAnimal"
                    required>
            </div>
        </div>

        <input type="text"
            name="outro_tipo"
            placeholder="Ex: Fazenda"
            style="display:none;"
            class="outroAssunto">


        <!-- IMÓVEL -->
        <p>O imóvel é próprio, alugado ou cedido?</p>

        <div class="campo">
            <div class="dropdown">
                <div class="dropdown-selected">Selecione a situação do imóvel</div>

                <div class="dropdown-options">
                    <div class="option">Próprio</div>
                    <div class="option">Alugado</div>
                    <div class="option">Cedido</div>
                </div>

                <input type="hidden" name="imovel" required>
            </div>
        </div>

        <!-- ANIMAIS -->
        <p>Se alugado, o proprietário permite animais?</p>

        <div class="campo">
            <div class="dropdown">
                <div class="dropdown-selected">Selecione uma opção</div>

                <div class="dropdown-options">
                    <div class="option">Sim</div>
                    <div class="option">Não </div>
                    <div class="option">Não se aplica</div>
                </div>

                <input type="hidden" name="animais" required>
            </div>
        </div>

        <!-- CHECKBOX -->
        <p>A residência tem quintal, jardim, área externa ou telas nas janelas?</p>

        <div class="radio-group" id="checkboxGroup">

            <label class="opcao">
                <input class="input-questionario" type="checkbox" name="estrutura[]" value="Quintal">
                Quintal
            </label>

            <label class="opcao">
                <input class="input-questionario" type="checkbox" name="estrutura[]" value="Jardim">
                Jardim
            </label>

            <label class="opcao">
                <input class="input-questionario" type="checkbox" name="estrutura[]" value="Área externa">
                Área externa
            </label>

            <label class="opcao">
                <input class="input-questionario" type="checkbox" name="estrutura[]" value="Telas nas janelas">
                Telas nas janelas
            </label>

            <label class="opcao">
                <input class="input-questionario" type="checkbox" name="estrutura[]" value="Nenhum dos anteriores">
                Nenhum dos anteriores
            </label>

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

    <script src="./../../assets/js/user/adocao.js" defer></script>
</body>