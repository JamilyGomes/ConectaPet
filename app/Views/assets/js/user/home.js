document.addEventListener("DOMContentLoaded", () => {

    const botoesFavoritos = document.querySelectorAll(".fav");

    botoesFavoritos.forEach(fav => {

        fav.addEventListener("click", async function(event) {

            event.preventDefault();
            event.stopPropagation();

            const card = fav.closest(".card-home");

            if (!card) return;

            const idAnimal = card.dataset.idAnimal;

            const acao = fav.classList.contains("active")
                ? "remover"
                : "adicionar";

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
                            acao: acao
                        })
                    }
                );

                const resultado = await resposta.json();

                if (!resposta.ok || !resultado.sucesso) {
                    alert(resultado.erro || "Não foi possível atualizar o favorito.");
                    return;
                }

                fav.classList.toggle("active");

            } catch (erro) {

                console.error(erro);
                alert("Erro ao comunicar com o servidor.");

            }

        });

    });

});