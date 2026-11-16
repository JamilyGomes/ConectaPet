
document.addEventListener("DOMContentLoaded", () => {

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

        fav.addEventListener("click", () => {

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

        });

    });

});
