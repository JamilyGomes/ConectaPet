<?php

session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    header('Location: login.php');
    exit;
}

$titulo = 'Cuidados e Compromissos';
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
        <span class="active">3</span>
        <span class="active">4</span>
        <span>5</span>
    </div>

    <h2>Cuidados e Compromissos</h2>

    <form class="form-animal" novalidate>

        <!-- PERGUNTA 1 -->
        <div class="campo">
            <label class="form-cadastro">
                Quais itens você pode fornecer com o animal? (Marque todas que se aplicam)
            </label>

            <div class="opcoes-checkbox">
                <label>
                    <input type="checkbox" name="itens[]" value="Ração">
                    <span>Ração</span>
                </label>

                <label>
                    <input type="checkbox" name="itens[]" value="Acessórios">
                    <span>Acessórios (ex.: coleira, gaiola, caixa de areia)</span>
                </label>

                <label>
                    <input type="checkbox" name="itens[]" value="Carteira de vacinação">
                    <span>Carteira de vacinação</span>
                </label>

                <label>
                    <input type="checkbox" name="itens[]" value="Nenhum">
                    <span>Nenhum</span>
                </label>
            </div>
        </div>

        <input type="text" placeholder="Especificar" style="display:none;" class="outroAssunto">

        <!-- PERGUNTA 2 -->

        <label class="form-cadastro">Você já levou o animal a um veterinário?</label>
        <div class="radio-group">
            <label><input type="radio" name="veterinario" value="Sim" required> Sim</label>
            <label><input type="radio" name="veterinario" value="Não" required> Não</label>
        </div>

        <!-- PERGUNTA 3-->

        <label class="form-cadastro">Você concorda em fornecer informações adicionais, se necessário, para facilitar a adoção?</label>
        <div class="radio-group">
            <label><input type="radio" name="infoAdicional" value="Sim" required> Sim</label>
            <label><input type="radio" name="infoAdicional" value="Não" required> Não</label>
        </div>

        <!-- PERGUNTA 4 -->
        <label class="form-cadastro">Você gostaria de receber atualizações sobre o animal após a adoção? </label>
        <div class="radio-group">
            <label><input type="radio" name="atualizacoes" value="Sim" required> Sim</label>
            <label><input type="radio" name="atualizacoes" value="Não" required> Não</label>
        </div>

        <div class="botoes">
            <button type="button" class="btn-voltar" onclick="window.location.href='./doacao3.php'">
                Voltar
            </button>
            <button type="submit" class="btn-concluir">Concluir 🐾</button>
        </div>
    </form>

    <?php
    $modalConteudo = ob_get_clean();
    include './../../components/modal/modal.php';
    ?>


    <script src="./../../assets/js/user/doacao.js" defer></script>

</body>