<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$logado = isset($_SESSION['id_usuario']);

$currentPage = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

?>

<body>

    <nav class="navbar">

        <div class="navbar-logo">
            <img src="./../../assets/img/logo.png" alt="Logo">
        </div>


        <ul class="navbar-menu">

            <li>
                <a href="./../../pages/user/home.php"
                    class="<?= $currentPage == 'home.php' ? 'active' : '' ?>">
                    Home
                </a>
            </li>

            <li>
                <a href="./../../pages/user/sobre.php"
                    class="<?= $currentPage == 'sobre.php' ? 'active' : '' ?>">
                    Sobre
                </a>
            </li>

            <!-- protegido -->
            <li>
                <a href="./../../pages/user/favoritos.php"
                    class="link-protegido <?= $currentPage == 'favoritos.php' ? 'active' : '' ?>">
                    Favoritos
                </a>
            </li>

            <!-- protegido -->
            <li>
                <a href="./../../pages/user/contato.php"
                    class="link-protegido <?= $currentPage == 'contato.php' ? 'active' : '' ?>">
                    Contato
                </a>
            </li>

            <!-- aparece sem login -->
            <li id="menu-login" style="<?= $logado ? 'display:none;' : '' ?>">
                <a href="./../../pages/user/login.php">
                    Login
                </a>
            </li>

            <!-- aparece com login -->
            <li id="menu-publicar" style="<?= $logado ? '' : 'display:none;' ?>">
                <a href="./../../pages/user/doacao1.php">
                    Publicar
                </a>
            </li>

        </ul>


        <ul class="navbar-social">

            <!-- perfil só aparece logado -->
            <li id="menu-perfil" style="<?= $logado ? '' : 'display:none;' ?>">
                <a href="./../../pages/user/perfil_usuario.php">
                    <img src="../../assets/img/user.png" class="nav-icon" alt="Meu perfil">
                </a>
            </li>

            <!-- sair só aparece logado -->
            <li id="menu-sair" style="<?= $logado ? '' : 'display:none;' ?>">
                <button class="btn-sair-nav" onclick="logout()">
                    Sair
                </button>
            </li>


        </ul>

    </nav>



    <!-- MODAL -->
    <div class="modal-login-aviso" id="modalLoginAviso">
        <div class="modal-login-box">
            <h3>Acesso restrito</h3>

            <p>
                Você precisa fazer login para acessar essa área.
            </p>

            <div class="modal-botoes">

                <button id="fecharModalLogin" class="btn-modal secundario">
                    Entendi
                </button>

                <a href="./../../pages/user/login.php" class="btn-modal primario">
                    Ir para login
                </a>

            </div>

        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {

            const modal = document.getElementById("modalLoginAviso");
            const fechar = document.getElementById("fecharModalLogin");

            <?php if (!$logado): ?>

                const linksProtegidos = document.querySelectorAll(".link-protegido");

                linksProtegidos.forEach(link => {

                    link.addEventListener("click", function(e) {

                        e.preventDefault();
                        modal.style.display = "flex";

                    });

                });

            <?php endif; ?>

            fechar.addEventListener("click", function() {
                modal.style.display = "none";
            });

            modal.addEventListener("click", function(e) {

                if (e.target === modal) {
                    modal.style.display = "none";
                }

            });

        });

        function logout() {
            window.location.href = "./../../../../verificacoes/user/logout.php";
        }
    </script>
    <?php include __DIR__ . '/../acessibilidade/acessibilidade.php'; ?>
</body>