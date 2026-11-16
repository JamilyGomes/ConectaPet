<?php
$titulo = 'Login';
?>
<?php
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
            <form method="POST" action="">

                <label for="email">E-mail</label>
                <input type="email" name="email" placeholder="Digite seu email " required>

                <label for="senha">Senha</label>

                <div class="campo-senha">

                    <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
                    <span class="material-icons olho">
                        visibility
                    </span>

                </div>

            </form>
            <div class="botoes">
                <a href="./cadastro.php">
                    <button type="submit" class="bt-cadastro">
                        Cadastrar-se</button>
                </a>

                <button type="button" class="bt-entrar">
                    Entrar 🐾
                </button>
            </div>
            <a class="esqueceu" href="./recuperar-senha.php">Esqueceu a senha?</a>
        </div>
    </section>

    <script src="./../../assets/js/user/login.js" defer></script>
</body>