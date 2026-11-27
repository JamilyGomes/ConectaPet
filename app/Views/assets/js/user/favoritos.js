
document.addEventListener("DOMContentLoaded", async () => {

    const lista = document.querySelector("#lista-favoritos");
    const pesquisaFav = document.querySelector(".input-pesquisa-fav");

    const favDd = document.querySelector(".fav-dd");
    const favSelected = document.querySelector(".fav-dd-selected");
    const favMenu = document.querySelector(".fav-dd-menu");
    const favOptions = document.querySelectorAll(".fav-dd-option");
    const favHidden = document.querySelector(".fav-dd input");

    if (!lista) return;

    let favoritos = [];

    // Buscar favoritos no banco de dados
    async function carregarFavoritos() {

        try {

            const resposta = await fetch(
                "../../../../verificacoes/user/listar-favoritos.php"
            );

            const dados = await resposta.json();

            if (!resposta.ok) {
                throw new Error(dados.erro || "Erro ao buscar favoritos.");
            }

            favoritos = dados;

            mostrarFavoritos();

        } catch (erro) {

            console.error(erro);
            lista.textContent = "Não foi possível carregar seus favoritos.";

        }
    }

    // Mostrar favoritos
    function mostrarFavoritos() {

        lista.innerHTML = "";

        if (favoritos.length === 0) {
            lista.textContent = "Você ainda não possui animais favoritos.";
            return;
        }

        favoritos.forEach(animal => {

            const card = document.createElement("div");
            card.classList.add("card-favorito");

            card.dataset.tipo = animal.tipo_animal || "";

            const imagem = document.createElement("img");
            imagem.src = "/ConectaPet/" + animal.foto;
            imagem.alt = animal.nome;

            const info = document.createElement("div");
            info.classList.add("card-info");

            const titulo = document.createElement("h3");
            titulo.textContent = animal.nome;

            const descricao = document.createElement("p");
            descricao.textContent = "Favoritado";

            const localizacao = document.createElement("span");
            localizacao.textContent = animal.localizacao || "";

            const acoes = document.createElement("div");
            acoes.classList.add("acoes");

            const btnVer = document.createElement("button");
            btnVer.classList.add("btn-ver");
            btnVer.textContent = "Ver Perfil";

            btnVer.addEventListener("click", () => {
                window.location.href =
                    "../../pages/user/info-animais.php?id_animal=" + animal.id_animal;
            });

            const btnRemover = document.createElement("button");
            btnRemover.classList.add("btn-remover");
            btnRemover.textContent = "Remover";

            btnRemover.addEventListener("click", () => {
                removerFavorito(animal.id_animal);
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

    // Remover favorito do banco
    async function removerFavorito(idAnimal) {

        try {

            const resposta = await fetch(
                "../../../../verificacoes/user/gerenciar-favorito.php",
                {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        id_animal: idAnimal,
                        acao: "remover"
                    })
                }
            );

            const resultado = await resposta.json();

            if (!resposta.ok || !resultado.sucesso) {
                throw new Error(resultado.erro || "Não foi possível remover.");
            }

            favoritos = favoritos.filter(
                animal => Number(animal.id_animal) !== Number(idAnimal)
            );

            mostrarFavoritos();

        } catch (erro) {

            console.error(erro);
            alert(erro.message);

        }
    }

    // Filtro por tipo de animal
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

    // Pesquisa
    if (pesquisaFav) {
        pesquisaFav.addEventListener("input", aplicarFiltros);
    }

    // Aplicar filtros
    function aplicarFiltros() {

        const texto = pesquisaFav
            ? pesquisaFav.value.toLowerCase().trim()
            : "";

        const tipoSelecionado = favHidden
            ? favHidden.value
            : "";

        const cards = lista.querySelectorAll(".card-favorito");

        cards.forEach(card => {

            const nome = card.querySelector("h3").textContent.toLowerCase();
            const tipo = card.dataset.tipo;

            const correspondeNome = nome.includes(texto);

            const correspondeTipo =
                !tipoSelecionado || tipo === tipoSelecionado;

            card.style.display =
                correspondeNome && correspondeTipo ? "" : "none";

        });
    }

    // Iniciar
    await carregarFavoritos();

});
