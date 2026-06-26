<?php
$currentPage = basename($_SERVER['PHP_SELF']);
$totalNotificacoes = 3; // exemplo
?>

<div class="sidebar">

    <!-- LOGO -->
    <div class="sidebar-logo">
        <img src="./../../assets/img/logo.png" alt="Logo">
    </div>

    <!-- MENU -->
    <ul class="sidebar-menu">

        <li class="<?= $currentPage == 'home-mod.php' ? 'active' : '' ?>">
            <a href="./home-mod.php">
                <i class="fas fa-home"></i> Home
            </a>
        </li>

        <li class="<?= $currentPage == 'animais-mod.php' ? 'active' : '' ?>">
            <a href="./animais-mod.php">
                <i class="fas fa-paw"></i> Animais
            </a>
        </li>
        
        <li class="<?= $currentPage == 'solicitacoes.php' ? 'active' : '' ?>">
            <a href="./solicitacoes.php">
                <i class="fas fa-chart-bar"></i> Solicitações
            </a>
        </li>

        <li class="<?= $currentPage == 'publi-mod.php' ? 'active' : '' ?>">
            <a href="./publi-mod.php">
                <i class="fas fa-file-alt"></i> Publicações
            </a>
        </li>


        <!-- NOTIFICAÇÕES -->
        <li class="<?= $currentPage == 'not-mod.php' ? 'active' : '' ?>">
            <a href="./not-mod.php">
                <i class="fas fa-bell"></i> Notificações

                <?php if($totalNotificacoes > 0): ?>
                    <span class="badge"><?= $totalNotificacoes ?></span>
                <?php endif; ?>
            </a>
        </li>

        <li class="<?= $currentPage == 'perfil-mod.php' ? 'active' : '' ?>">
            <a href="./perfil-mod.php">
                <i class="fas fa-user"></i> Perfil
            </a>
        </li>

        <!-- sair -->
        <li class="logout">
            <a href="./logout.php">
                <i class="fas fa-sign-out-alt"></i> Sair
            </a>
        </li>

    </ul>

</div>