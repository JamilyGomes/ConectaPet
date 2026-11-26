
document.addEventListener("DOMContentLoaded", () => {

    console.log("Quantidade de favoritos:", document.querySelectorAll(".fav").length);

    // buscar btn fav 

    const botoesFavoritos = document.querySelectorAll(".fav");

    // buscarfav salvos 

    function obterFavoritos() {
        try {
            return JSON.parse(localStorage.getItem("favoritos")) || [];
        } catch {
            return [];
        }
    }

    // atualizar oscoracoes ao atualizar a home 

    let favoritos = obterFavoritos();

    botoesFavoritos.forEach(fav => {

        const card = fav.closest(".card-home");

        if (!card) return;

        const nome = card.querySelector("h3")?.textContent.trim();

        if (nome && favoritos.includes(nome)) {
            fav.classList.add("active");
        } else {
            fav.classList.remove("active");
        }

    });

    // add ou remover fav 

    botoesFavoritos.forEach(fav => {

        fav.addEventListener("click", (event) => {
            console.log("Clique no favorito detectado!");
            event.preventDefault();
            event.stopPropagation();

            const card = fav.closest(".card-home");

            if (!card) return;

            const titulo = card.querySelector("h3");

            if (!titulo) return;

            const nome = titulo.textContent.trim();

            favoritos = obterFavoritos();

            if (favoritos.includes(nome)) {

                // Remove dos favoritos
                favoritos = favoritos.filter(item => item !== nome);

                fav.classList.remove("active");

            } else {

                // Adiciona aos favoritos
                favoritos.push(nome);

                fav.classList.add("active");

            }

            localStorage.setItem(
                "favoritos",
                JSON.stringify(favoritos)
            );

            console.log("Favoritos salvos:", localStorage.getItem("favoritos"));

        });

    });

});
