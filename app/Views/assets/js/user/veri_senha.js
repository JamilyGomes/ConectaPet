document.addEventListener("DOMContentLoaded", function () {

    // MOSTRAR E OCULTAR SENHA
    function toggleSenha(id, icone) {

        const input = document.getElementById(id);

        if (input.type === "password") {
            input.type = "text";
            icone.textContent = "visibility_off";
        } else {
            input.type = "password";
            icone.textContent = "visibility";
        }
    }

    // Disponibiliza a função para os onclick do HTML
    window.toggleSenha = toggleSenha;


    // VALIDAR SE AS SENHAS SÃO IGUAIS
    const formulario = document.querySelector(".form-cadastro");

    formulario.addEventListener("submit", function (e) {

        const senha = document.getElementById("senha").value;
        const confirmarSenha = document.getElementById("confirmarSenha").value;

        if (senha !== confirmarSenha) {
            e.preventDefault();
            alert("As senhas não coincidem!");
        }

    });

});