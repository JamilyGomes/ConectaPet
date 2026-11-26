
document.addEventListener("DOMContentLoaded", () => {

    // mostrar ou ocultar senha 
    const senha = document.getElementById("senha");
    const iconeOlho = document.querySelector(".olho");

    if (senha && iconeOlho) {
        iconeOlho.addEventListener("click", () => {

            if (senha.type === "password") {
                senha.type = "text";
                iconeOlho.textContent = "visibility_off";
            } else {
                senha.type = "password";
                iconeOlho.textContent = "visibility";
            }

        });
    }

});
