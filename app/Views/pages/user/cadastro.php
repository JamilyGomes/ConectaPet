<?php
$titulo = 'Cadastro';
include './../../components/head/head.php';
?>

<body>

    <?php
    include './../../components/nav/navBar.php';
    ?>

    <?php
    ob_start();
    ?>

    <h2>Dados Pessoais</h2>

    <form class="form-cadastro" action="./cadastro2.php">
        <div class="campo">
            <label>Nome Completo</label>
            <input type="text" id="nome" placeholder="Digite seu nome" required>
        </div>

        <div class="campo">
            <label>CPF</label>
            <input type="text" id="cpf" placeholder="Digite seu CPF" maxlength="14" required>
        </div>

        <div class="campo">
            <label>Telefone</label>

            <input
                type="text"
                name="telefone"
                id="telefone"
                placeholder="Ex: (67) 99999-9999"
                maxlength="15"
                required>
        </div>

        <div class="campo">
            <label>E-mail</label>
            <input type="email" placeholder="Digite seu email" required>
        </div>

        <label for="senha">Senha</label>

        <div class="senha-group">

            <div class="campo-senha">

                <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
                <span class="material-icons olho">
                    visibility
                </span>

            </div>
        </div>

        <label for="senha">Confirmar Senha</label>

        <div class="senha-group">

            <div class="campo-senha">

                <input type="password" id="confirmarSenha" name="confirmarSenha" placeholder="Confirme sua senha" required>
                <span class="material-icons olho">
                    visibility
                </span>

            </div>
        </div>


        <div class="upload-area">
            <label class="upload-foto">
                <input type="file" name="foto">
            </label>

            <p>
                Selecione uma imagem para foto de perfil
            </p>

        </div>
        <div class="botoes-modal">
            <button type="button" class="btn-voltar" onclick="window.location.href='login.php'">
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

    <script src="./../../assets/js/cadastro-user.js" defer></script>

</body>