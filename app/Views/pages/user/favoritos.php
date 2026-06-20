<?php
$titulo = 'Favoritos';
?>
<?php
include './../../components/head/head.php';
?>

<body>

    <!-- navbar -->
    <?php include './../../components/nav/navBar.php'; ?>

    <section class="favoritos-container">

        <div class="topo-favoritos">

            <div class="filtros-favoritos">

                <!-- pesquisa -->
                <div class="box-pesquisa">

                    <textarea class="input-pesquisa-fav" placeholder="Pesquisar pet..."></textarea>

                    <button class="btn-pesquisa-fav">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>

                </div>
                <!-- dropdown -->
                <div class="fav-dd">

                    <div class="fav-dd-selected">Selecione um tipo</div>

                    <div class="fav-dd-menu">

                        <div class="fav-dd-option" data-value="Gatos">Gatos</div>
                        <div class="fav-dd-option" data-value="Cachorro">Cachorro</div>
                        <div class="fav-dd-option" data-value="Aves">Aves</div>
                        <div class="fav-dd-option" data-value="Outros">Outros</div>

                    </div>

                    <input type="hidden" name="tipoAnimal">

                </div>

            </div>

        </div>

        <div class="favoritos-cards">

            <?php for ($i = 0; $i < 4; $i++) { ?>

                <div class="card-favorito">
                    <img src="./../../assets/img/gt.jpg" alt="Pet">

                    <div class="card-info">
                        <h3>Mel</h3>
                        <p>Fêmea • Filhote</p>
                        <span>Campo Grande - MS</span>

                        <div class="acoes">
                            <button class="btn-ver">Ver Perfil</button>
                            <button class="btn-remover">Remover</button>
                        </div>
                    </div>
                </div>
                <div class="card-favorito">
                    <img src="./../../assets/img/ha.jpg" alt="Pet">

                    <div class="card-info">
                        <h3>Theodor</h3>
                        <p>Macho • Filhote</p>
                        <span>Campo Grande - MS</span>

                        <div class="acoes">
                            <button class="btn-ver">Ver Perfil</button>
                            <button class="btn-remover">Remover</button>
                        </div>
                    </div>
                </div>

            <?php } ?>

        </div>

    </section>

    <script>
        const favDd = document.querySelector(".fav-dd");
        const favSelected = document.querySelector(".fav-dd-selected");
        const favMenu = document.querySelector(".fav-dd-menu");
        const favOptions = document.querySelectorAll(".fav-dd-option");
        const favHidden = document.querySelector(".fav-dd input");

        favSelected.addEventListener("click", () => {
            favMenu.classList.toggle("active");
        });

        favOptions.forEach(option => {
            option.addEventListener("click", () => {
                favSelected.textContent = option.textContent;
                favHidden.value = option.dataset.value;
                favMenu.classList.remove("active");
            });
        });

        document.addEventListener("click", (e) => {
            if (!favDd.contains(e.target)) {
                favMenu.classList.remove("active");
            }
        });
    </script>

</body>