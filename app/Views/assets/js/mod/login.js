document.addEventListener("DOMContentLoaded", function () {

    // MOSTRAR E OCULTAR SENHA
    window.toggleSenha = function () {

        const senha = document.getElementById("senha");
        const icone = document.querySelector(".olho");

        if (senha.type === "password") {
            senha.type = "text";
            icone.textContent = "visibility_off";
        } else {
            senha.type = "password";
            icone.textContent = "visibility";
        }

    };

    // FUNÇÃO LOGIN
    window.login = function () {
        localStorage.setItem('login', 'true');
        window.location.href = "./home.php";
    };

    // VALIDAR LOGIN
    window.validarLogin = function () {

        const email = document.getElementById("email").value.trim();
        const senha = document.getElementById("senha").value.trim();

        if (email === "" || senha === "") {
            alert("Preencha email e senha!");
            return false;
        }

        localStorage.setItem('login', 'true');
        window.location.href = "./home-mod.php";

        return false;
    };

});