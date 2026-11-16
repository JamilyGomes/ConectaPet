<?php
$titulo = 'Favoritos';
include './../../components/head/head.php';
?>

<body>

    <?php include './../../components/nav/navBar.php'; ?>

    <section class="favoritos-container">

        <div class="topo-favoritos">
            <div class="filtros-favoritos">
                <div class="box-pesquisa">
                    <textarea
                        class="input-pesquisa-fav"
                        placeholder="Pesquisar pet..."></textarea>
                    <button class="btn-pesquisa-fav">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>


                <div class="fav-dd">
                    <div class="fav-dd-selected">
                        Selecione um tipo
                    </div>


                    <div class="fav-dd-menu">
                        <div class="fav-dd-option" data-value="Gatos">
                            Gatos
                        </div>

                        <div class="fav-dd-option" data-value="Cachorro">
                            Cachorro
                        </div>

                        <div class="fav-dd-option" data-value="Aves">
                            Aves
                        </div>

                        <div class="fav-dd-option" data-value="Outros">
                            Outros
                        </div>

                    </div>

                    <input type="hidden" name="tipoAnimal">

                </div>
            </div>
        </div>


        <div class="favoritos-cards" id="lista-favoritos">

        </div>
    </section>

    <script src="./../../assets/js/user/favoritos.js" defer></script>
    
</body>