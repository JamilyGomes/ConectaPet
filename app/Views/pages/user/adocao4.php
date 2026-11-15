<?php
$titulo = 'Rotina';
include './../../components/head/head.php';
?>

<body>

    <?php include './../../components/nav/navBar.php'; ?>

    <?php ob_start(); ?>

    <div class="progress-steps">
        <span class="active">1</span>
        <span class="active">2</span>
        <span class="active">3</span>
        <span class="active">4</span>
        <span>5</span>
    </div>

    <h2>Rotina do adotante</h2>

    <form class="form-cadastro" id="formRotina">

        <!-- TEMPO SOZINHO -->
        <p>Quantas horas por dia o animal ficará sozinho?</p>

        <div class="campo">
            <div class="dropdown">
                <div class="dropdown-selected">Selecione o tempo</div>

                <div class="dropdown-options">
                    <div class="option">Menos de 4 horas</div>
                    <div class="option">4 a 8 horas</div>
                    <div class="option">Mais de 8 horas</div>
                </div>

                <input type="hidden" name="horas_sozinho" required>
            </div>
        </div>

        <!-- RESPONSÁVEL -->
        <p>Quem será o responsável pelos cuidados do animal?</p>

        <div class="campo">
            <div class="dropdown">
                <div class="dropdown-selected">Selecione uma opção</div>

                <div class="dropdown-options">
                    <div class="option">Eu</div>
                    <div class="option">Outro membro da família</div>
                </div>

                <input type="hidden" name="responsavel" required>
            </div>
        </div>

        <!-- CONDIÇÕES -->
        <p>Você tem condições financeiras para manter alimentação, vacinas e cuidados veterinários?</p>

        <div class="campo">
            <div class="dropdown">
                <div class="dropdown-selected">Selecione uma opção</div>

                <div class="dropdown-options">
                    <div class="option">Sim </div>
                    <div class="option">Não </div>
                </div>

                <input type="hidden" name="condicoes" required>
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