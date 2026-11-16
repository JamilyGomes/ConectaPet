
document.addEventListener("DOMContentLoaded", () => {

// elementos da pag 

    const lista = document.querySelector("#lista-favoritos");
    const pesquisaFav = document.querySelector(".input-pesquisa-fav");

    const favDd = document.querySelector(".fav-dd");
    const favSelected = document.querySelector(".fav-dd-selected");
    const favMenu = document.querySelector(".fav-dd-menu");
    const favOptions = document.querySelectorAll(".fav-dd-option");
    const favHidden = document.querySelector(".fav-dd input");

    if (!lista) return;

// buscar fav no localStorage 

    let favoritos = [];

    try {
        favoritos = JSON.parse(localStorage.getItem("favoritos")) || [];
    } catch {
        favoritos = [];
    }

// mostrar os fav 

    function mostrarFavoritos() {

        lista.innerHTML = "";

        if (favoritos.length === 0) {
            lista.textContent = "Você ainda não possui animais favoritos.";
            return;
        }

        favoritos.forEach(nome => {

            const card = document.createElement("div");
            card.classList.add("card-favorito");

            // Atualmente os favoritos armazenam apenas o nome
            // Por isso, mantemos o tipo Cachorro como no código original
            card.dataset.tipo = "Cachorro";

            const imagem = document.createElement("img");
            imagem.src = "./../../assets/img/dog-card.png";
            imagem.alt = nome;

            const info = document.createElement("div");
            info.classList.add("card-info");

            const titulo = document.createElement("h3");
            titulo.textContent = nome;

            const descricao = document.createElement("p");
            descricao.textContent = "Favoritado";

            const localizacao = document.createElement("span");
            localizacao.textContent = "Campo Grande - MS";

            const acoes = document.createElement("div");
            acoes.classList.add("acoes");

            const btnVer = document.createElement("button");
            btnVer.classList.add("btn-ver");
            btnVer.textContent = "Ver Perfil";

            btnVer.addEventListener("click", () => {
                window.location.href = "../../pages/user/info-animais.php";
            });

            const btnRemover = document.createElement("button");
            btnRemover.classList.add("btn-remover");
            btnRemover.textContent = "Remover";

            btnRemover.addEventListener("click", () => {
                removerFavorito(nome);
            });

            acoes.appendChild(btnVer);
            acoes.appendChild(btnRemover);

            info.appendChild(titulo);
            info.appendChild(descricao);
            info.appendChild(localizacao);
            info.appendChild(acoes);

            card.appendChild(imagem);
            card.appendChild(info);

            lista.appendChild(card);
        });

        aplicarFiltros();
    }

// remover fav 

    function removerFavorito(nome) {

        favoritos = favoritos.filter(item => item !== nome);

        localStorage.setItem(
            "favoritos",
            JSON.stringify(favoritos)
        );

        mostrarFavoritos();
    }

// filtro por tipo de animal 

    if (favSelected && favMenu && favDd && favHidden) {

        favSelected.addEventListener("click", () => {
            favMenu.classList.toggle("active");
        });

        favOptions.forEach(option => {

            option.addEventListener("click", () => {

                favSelected.textContent = option.textContent.trim();
                favHidden.value = option.dataset.value;

                favMenu.classList.remove("active");

                aplicarFiltros();
            });
        });

        document.addEventListener("click", evento => {

            if (!favDd.contains(evento.target)) {
                favMenu.classList.remove("active");
            }

        });
    }

// pesquisar fav 

    if (pesquisaFav) {
        pesquisaFav.addEventListener("input", aplicarFiltros);
    }

// aplicar pesquisa e filtros juntos 

    function aplicarFiltros() {

        const texto = pesquisaFav
            ? pesquisaFav.value.toLowerCase().trim()
            : "";

        const tipoSelecionado = favHidden
            ? favHidden.value
            : "";

        const cards = lista.querySelectorAll(".card-favorito");

        cards.forEach(card => {

            const nome = card.querySelector("h3")
                .textContent.toLowerCase();

            const tipo = card.dataset.tipo;

            const correspondeNome = nome.includes(texto);

            const correspondeTipo =
                !tipoSelecionado || tipo === tipoSelecionado;

            card.style.display =
                correspondeNome && correspondeTipo ? "" : "none";

        });
    }


    mostrarFavoritos();

});
