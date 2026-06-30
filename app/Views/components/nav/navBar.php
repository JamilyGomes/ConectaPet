<?php
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
            <li id="menu-login">
                <a href="./../../pages/user/login.php">
                    Login
                </a>
            </li>

            <!-- aparece com login -->
            <li id="menu-publicar" style="display:none;">
                <a href="./../../pages/user/doacao1.php">
                    Publicar
                </a>
            </li>

        </ul>


        <ul class="navbar-social">

            <!-- perfil só aparece logado -->
            <li id="menu-perfil" style="display:none;">
                <a href="./../../pages/user/perfil_usuario.php">
                    <img src="../../assets/img/user.png" class="nav-icon">
                </a>
            </li>

            <!-- sair só aparece logado -->
            <li id="menu-sair" style="display:none;">
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

            const logado = localStorage.getItem("login");

            const loginMenu = document.getElementById("menu-login");
            const publicarMenu = document.getElementById("menu-publicar");

            const perfil = document.getElementById("menu-perfil");
            const sair = document.getElementById("menu-sair");

            const modal = document.getElementById("modalLoginAviso");
            const fechar = document.getElementById("fecharModalLogin");



            /* se estiver logado */

            if (logado === "true") {

                loginMenu.style.display = "none";

                publicarMenu.style.display = "block";

                perfil.style.display = "block";

                sair.style.display = "block";
            }



            /* bloquear favoritos e contato */

            const linksProtegidos =
                document.querySelectorAll(".link-protegido");


            linksProtegidos.forEach(link => {

                link.addEventListener("click", function(e) {

                    const logado = localStorage.getItem("login");

                    if (logado !== "true") {

                        e.preventDefault();

                        modal.style.display = "flex";
                    }

                });

            });

            fechar.addEventListener("click", function() {

                modal.style.display = "none";

            });

        });



        function logout() {

            localStorage.removeItem("login");

            window.location.href = "./home.php";

        }

        document.addEventListener("DOMContentLoaded", () => {

            const modal = document.getElementById("modalLoginAviso");

            document.addEventListener("click", function(e) {

                // botão "Entendi"
                if (e.target && e.target.id === "fecharModalLogin") {
                    modal.style.display = "none";
                }

                // clicar fora do box (opcional)
                if (e.target === modal) {
                    modal.style.display = "none";
                }

            });

        });
    </script>



</body>