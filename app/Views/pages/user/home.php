<?php

session_start();

if (!isset($_SESSION['id_usuario'])) {
    header('Location: /ConectaPet/app/Views/pages/user/login.php');
    exit;
}

$titulo = 'Home Usuario';

include './../../components/head/head.php';

?>

<body>
    <!-- navbar -->
    <?php
    include './../../components/nav/navBar.php';
    ?>

    <!-- conteúdo principal -->
    <main>

        <!-- header -->
        <?php
        include './../../components/header_home/header_home.php';
        ?>

        <section class="cards-container">
            <div class="cards">
                <?php
                for ($i = 0; $i < 17; $i++) {
                    include './../../components/card_home/card_home.php';
                }
                ?>
            </div>

            <div class="pagination">
                <span class="dot active"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>
        </section>

    </main>


    <script src="./../../assets/js/user/home.js" defer></script>

    <?php include './../../components/footer/footer.php'; ?>

    <script src="./../../assets/js/user/home.js" defer></script>
</body>

</html>