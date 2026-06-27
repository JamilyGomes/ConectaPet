<?php
$titulo = 'Home';
?>
<?php
include './../../components/head/head.php';
?>

<body>
    <!-- navbar -->
    <?php
    include './../../components/nav/navBar.php';
    ?>


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


    <?php
    include './acessibilidade.php';
    ?>
    <?php include './../../components/footer/footer.php'; ?>

    <script>
        document.querySelectorAll(".fav").forEach(fav => {

            fav.addEventListener("click", () => {

                const card = fav.closest(".card-home");
                const nome = card.querySelector("h3").textContent;


                let favoritos = JSON.parse(
                    localStorage.getItem("favoritos")
                ) || [];


                if (favoritos.includes(nome)) {

                    favoritos = favoritos.filter(
                        item => item !== nome
                    );

                    fav.classList.remove("active");


                } else {

                    favoritos.push(nome);

                    fav.classList.add("active");

                }


                localStorage.setItem(
                    "favoritos",
                    JSON.stringify(favoritos)
                );

            });

        });
    </script>
</body>

</html>