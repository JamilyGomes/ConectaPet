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


    <script>
        const lista = document.querySelector("#lista-favoritos");
        let favoritos = JSON.parse(
            localStorage.getItem("favoritos")
        ) || [];

        favoritos.forEach(nome => {
            lista.innerHTML += `

<div class="card-favorito" data-tipo="Cachorro">

<img src="./../../assets/img/dog-card.png">

<div class="card-info">

<h3>${nome}</h3>

<p>Favoritado</p>

<span>Campo Grande - MS</span>


<div class="acoes">


<button
    class="btn-ver"
    onclick="window.location.href='../../pages/user/info-animais.php'">
    Ver Perfil
</button>



<button 
class="btn-remover"
onclick="removerFavorito('${nome}')">

Remover

</button>

</div>

</div>

</div>

`;


        });


        function removerFavorito(nome) {
            let favoritos =
                JSON.parse(localStorage.getItem("favoritos")) || [];
            favoritos = favoritos.filter(
                item => item !== nome
            );
            localStorage.setItem(
                "favoritos",
                JSON.stringify(favoritos)
            );
            location.reload();
        }



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

                const tipoSelecionado = option.dataset.value;
                document.querySelectorAll(".card-favorito")
                    .forEach(card => {


                        if (card.dataset.tipo === tipoSelecionado) {
                            card.style.display = "";

                        } else {
                            card.style.display = "none";
                        }

                    });
            });
        });


        document.addEventListener("click", (e) => {
            if (!favDd.contains(e.target)) {
                favMenu.classList.remove("active");
            }

        });


        const pesquisaFav = document.querySelector(".input-pesquisa-fav");
        pesquisaFav.addEventListener("keyup", () => {

            const texto =
                pesquisaFav.value.toLowerCase().trim();

            document.querySelectorAll(".card-favorito")
                .forEach(card => {

                    const nome =
                        card.querySelector("h3")
                        .textContent
                        .toLowerCase();


                    card.style.display =
                        nome.includes(texto) ?
                        "" :
                        "none";
                });
        });
    </script>
    <?php
    include './acessibilidade.php';
    ?>
</body>