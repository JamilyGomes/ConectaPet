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
                require_once __DIR__ . '/../../../../config/conexao.php';

                $sql = "
                    SELECT
                        id_animal,
                        nome,
                        idade_aproximada,
                        foto
                    FROM animais
                    WHERE status = 'Aprovado'
                    ORDER BY data_cadastro DESC
                ";

                $consulta = $conexao->query($sql);
                $sqlFavoritos = "
                    SELECT id_animal
                    FROM favoritos
                    WHERE id_usuario = :id_usuario
                ";

                $consultaFavoritos = $conexao->prepare($sqlFavoritos);

                $consultaFavoritos->execute([
                    ':id_usuario' => $_SESSION['id_usuario']
                ]);

                $favoritosIds = $consultaFavoritos->fetchAll(PDO::FETCH_COLUMN);

                while ($animal = $consulta->fetch(PDO::FETCH_ASSOC)) {
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


</body>

</html>