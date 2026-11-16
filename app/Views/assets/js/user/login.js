
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

    // realizar login 
    const botaoEntrar = document.querySelector(".bt-entrar");

    if (botaoEntrar) {
        botaoEntrar.addEventListener("click", () => {

            localStorage.setItem("login", "true");

            window.location.href = "./home.php";

        });
    }

});
