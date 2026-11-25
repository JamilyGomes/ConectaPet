<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$dadosCadastro = $_SESSION['dados_cadastro'] ?? [];
unset($_SESSION['dados_cadastro']);

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

    <?php if (!empty($_SESSION['erro_cadastro'])): ?>

        <div class="mensagem-erro">
            <?= htmlspecialchars($_SESSION['erro_cadastro']) ?>
        </div>

        <?php unset($_SESSION['erro_cadastro']); ?>

    <?php endif; ?>

    <h2>Dados Pessoais</h2>

    <form class="form-cadastro" action="/ConectaPet/verificacoes/user/processa-cadastro.php" method="POST" enctype="multipart/form-data">
        <div class="campo">
            <label>Nome Completo</label>
            <input type="text" id="nome" name="nome"
                placeholder="Digite seu nome"
                value="<?= htmlspecialchars($dadosCadastro['nome'] ?? '') ?>"
                required>
        </div>

        <div class="campo">
            <label>CPF</label>
            <input type="text" id="cpf" name="cpf"
                placeholder="Digite seu CPF"
                maxlength="14"
                value="<?= htmlspecialchars($dadosCadastro['cpf'] ?? '') ?>"
                required>
        </div>

        <div class="campo">
            <label>Telefone</label>

            <input type="text" name="telefone" id="telefone"
                placeholder="Ex: (67) 99999-9999"
                maxlength="15"
                value="<?= htmlspecialchars($dadosCadastro['telefone'] ?? '') ?>"
                required>
        </div>

        <div class="campo">
            <label>E-mail</label>

            <input type="email" name="email" id="email"
                placeholder="Digite seu email"
                value="<?= htmlspecialchars($dadosCadastro['email'] ?? '') ?>"
                required>
        </div>

        <label for="senha">Senha</label>

        <div class="senha-group">

            <div class="campo-senha">
                <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
                <span class="material-icons olho" data-target="senha">
                    visibility
                </span>
            </div>
        </div>

        <div class="requisitos-senha">
            <p>A senha deve conter:</p>
            <ul>
                <li>No mínimo 8 caracteres;</li>
                <li>Pelo menos uma letra maiúscula (A-Z);</li>
                <li>Pelo menos uma letra minúscula (a-z);</li>
                <li>Pelo menos um número (0-9);</li>
                <li>Pelo menos um caractere especial (@, #, !, etc.);</li>
                <li>Não pode conter quatro caracteres iguais seguidos;</li>
                <li>Não pode conter sequências como 1234 ou abcd.</li>
            </ul>
        </div>

        <label for="confirmarSenha">Confirmar Senha</label>

        <div class="senha-group">

            <div class="campo-senha">
                <input type="password" id="confirmarSenha" name="confirmarSenha" placeholder="Confirme sua senha" required>
                <span class="material-icons olho" data-target="confirmarSenha">
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

    <script src="./../../assets/js/user/cadastro-user.js" defer></script>

</body>