// Mostrar ou ocultar senha
function toggleSenha() {
    const senha = document.getElementById("senha");
    const icone = document.querySelector(".olho");

    if (senha.type === "password") {
        senha.type = "text";
        icone.textContent = "visibility_off";
    } else {
        senha.type = "password";
        icone.textContent = "visibility";
    }
}

// Redirecionar para a página inicial
function login() {
    localStorage.setItem('login', 'true');
    window.location.href = "./home.php";
}

// Validar os campos de login
function validarLogin() {
    const email = document.getElementById("email").value.trim();
    const senha = document.getElementById("senha").value.trim();

    if (email === "" || senha === "") {
        alert("Preencha email e senha!");
        return false;
    }

    localStorage.setItem('login', 'true');
    window.location.href = "./home_adm.php";

    return false;
}