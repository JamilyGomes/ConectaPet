<?php
$titulo = 'Família';
include './../../components/head/head.php';
?>

<body>

    <?php include './../../components/nav/navBar.php'; ?>

    <?php ob_start(); ?>

    <div class="progress-steps">
        <span class="active">1</span>
        <span class="active">2</span>
        <span>3</span>
        <span>4</span>
        <span>5</span>
    </div>

    <h2>Sobre a família</h2>

    <form class="form-cadastro" id="formFamilia">

        <!-- PESSOAS -->
        <p>Quantas pessoas moram na casa?</p>

        <div class="campo">
            <div class="dropdown">
                <div class="dropdown-selected">Selecione a quantidade</div>

                <div class="dropdown-options">
                    <div class="option">1 pessoa</div>
                    <div class="option">2 pessoas</div>
                    <div class="option">3 pessoas</div>
                    <div class="option">4 ou mais pessoas</div>
                </div>

                <input type="hidden" name="pessoas" required>
            </div>
        </div>

        <!-- CRIANÇAS -->
        <p>Há crianças na residência?</p>

        <div class="campo">
            <div class="dropdown" id="dropdownCriancas">
                <div class="dropdown-selected">Selecione uma opção</div>

                <div class="dropdown-options">
                    <div class="option">Sim</div>
                    <div class="option">Não</div>
                </div>

                <input type="hidden" name="criancas" required>
            </div>
        </div>

        <!-- CAMPO DINÂMICO -->
        <div id="campo-criancas" class="campo-criancas" style="display:none;">
            <label>Número de crianças</label>
            <input type="number" name="num_criancas" min="1" placeholder="Ex: 2">
        </div>

        <!-- CONCORDAM -->
        <p>Todos os moradores concordam com a adoção?</p>

        <div class="campo">
            <div class="dropdown">
                <div class="dropdown-selected">Selecione uma opção</div>

                <div class="dropdown-options">
                    <div class="option">Sim </div>
                    <div class="option">Não </div>
                </div>

                <input type="hidden" name="concordam" required>
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

    <script src="./../../assets/js/user/adocao.js" defer></script>
</body>