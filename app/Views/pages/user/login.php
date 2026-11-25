<?php
session_start();

$titulo = 'Login';

include './../../components/head/head.php';
?>

<body>
    <!-- navbar -->
    <?php
    include './../../components/nav/navBar.php';
    ?>

    <section id="login-form">

        <!-- lado esquerdo  -->
        <div id="esquerda">
            <p>Olá, Usuário! 🐾</p>
            <p>Bem-vindo ao <strong>Conecta Pet</strong>.</p>
            <p>Ajude animais encontrarem um novo lar. </p>

            <img src="./../../assets/img/grupo_cacho.png" alt="" id="lado_esquedo">

        </div>

        <!-- lado direito  -->
        <div class="direita">
            <h1>Login</h1>

            <?php if (isset($_SESSION['erro_login'])): ?>

                <div class="mensagem-erro">
                    <?= htmlspecialchars($_SESSION['erro_login']) ?>
                </div>

                <?php unset($_SESSION['erro_login']); ?>

            <?php endif; ?>

            <form method="POST" action="/ConectaPet/verificacoes/user/verificar-login.php">

                <label for="email">E-mail</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Digite seu email"
                    required>

                <label for="senha">Senha</label>

                <div class="campo-senha">
                    <input
                        type="password"
                        id="senha"
                        name="senha"
                        placeholder="Digite sua senha"
                        required>

                    <span class="material-icons olho">
                        visibility
                    </span>
                </div>

                <div class="botoes">

                    <a href="./cadastro.php">
                        <button type="button" class="bt-cadastro">
                            Cadastrar-se
                        </button>
                    </a>

                    <button type="submit" class="bt-entrar">
                        Entrar 🐾
                    </button>

                </div>

            </form>

            <a class="esqueceu" href="./recuperar-senha.php">Esqueceu a senha?</a>
        </div>
    </section>

    <script src="./../../assets/js/user/login.js" defer></script>
</body>