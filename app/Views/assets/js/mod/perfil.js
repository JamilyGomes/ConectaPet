
document.addEventListener("DOMContentLoaded", function () {

    // ELEMENTOS
    const modalEditar = document.getElementById("modalEditar");
    const abrirEditar = document.getElementById("abrirEditar");
    const fecharEditar = document.getElementById("fecharEditar");
    const formEditarPerfil = document.getElementById("formEditarPerfil");

    const telefone = document.getElementById("telefone");
    const email = document.getElementById("editEmail");
    const senha = document.getElementById("senha");
    const confirmarSenha = document.getElementById("confirmarSenha");

    const perfilTelefone = document.getElementById("perfilTelefone");
    const perfilEmail = document.getElementById("perfilEmail");
    const perfilSenha = document.getElementById("perfilSenha");

    const inputFoto = document.getElementById("inputFoto");
    const previewFoto = document.getElementById("previewFoto");

    let fotoSelecionada = null;

    // CARREGAR DADOS SALVOS
    const telefoneSalvo = localStorage.getItem("modTelefone");
    const emailSalvo = localStorage.getItem("modEmail");
    const fotoSalva = localStorage.getItem("modFoto");

    if (telefoneSalvo) {
        perfilTelefone.textContent = telefoneSalvo;
    }

    if (emailSalvo) {
        perfilEmail.textContent = emailSalvo;
    }

    if (fotoSalva) {
        previewFoto.src = fotoSalva;
    }

    // ABRIR MODAL
    abrirEditar.addEventListener("click", function () {

        modalEditar.style.display = "flex";

        telefone.value = perfilTelefone.textContent.trim();
        email.value = perfilEmail.textContent.trim();

    });

    // FECHAR MODAL
    fecharEditar.addEventListener("click", function () {
        modalEditar.style.display = "none";
    });

    // FECHAR CLICANDO FORA
    modalEditar.addEventListener("click", function (e) {

        if (e.target === modalEditar) {
            modalEditar.style.display = "none";
        }

    });

    // MÁSCARA DO TELEFONE
    telefone.addEventListener("input", function () {

        let valor = this.value.replace(/\D/g, "");

        if (valor.length > 11) {
            valor = valor.substring(0, 11);
        }

        if (valor.length > 10) {
            valor = valor.replace(
                /^(\d{2})(\d{5})(\d{4}).*/,
                "($1) $2-$3"
            );
        } else if (valor.length > 6) {
            valor = valor.replace(
                /^(\d{2})(\d{4,5})(\d{0,4}).*/,
                "($1) $2-$3"
            );
        } else if (valor.length > 2) {
            valor = valor.replace(
                /^(\d{2})(\d+)/,
                "($1) $2"
            );
        } else if (valor.length > 0) {
            valor = valor.replace(
                /^(\d+)/,
                "($1"
            );
        }

        this.value = valor;

    });

    // ESCOLHER E VISUALIZAR FOTO
    inputFoto.addEventListener("change", function () {

        const arquivo = this.files[0];

        if (!arquivo) {
            return;
        }

        if (!arquivo.type.startsWith("image/")) {
            alert("Selecione um arquivo de imagem.");
            this.value = "";
            return;
        }

        const leitor = new FileReader();

        leitor.onload = function (e) {
            fotoSelecionada = e.target.result;
            previewFoto.src = fotoSelecionada;
        };

        leitor.readAsDataURL(arquivo);

    });

    // MOSTRAR E OCULTAR SENHA
    window.toggleSenha = function (id, icone) {

        const input = document.getElementById(id);

        if (input.type === "password") {
            input.type = "text";
            icone.textContent = "visibility_off";
        } else {
            input.type = "password";
            icone.textContent = "visibility";
        }

    };

    // SALVAR ALTERAÇÕES
    formEditarPerfil.addEventListener("submit", function (e) {

        e.preventDefault();

        if (senha.value !== confirmarSenha.value) {
            alert("As senhas não coincidem.");
            return;
        }

        // ATUALIZAR TELEFONE E EMAIL
        perfilTelefone.textContent = telefone.value;
        perfilEmail.textContent = email.value;

        // GUARDAR NO NAVEGADOR
        localStorage.setItem("modTelefone", telefone.value);
        localStorage.setItem("modEmail", email.value);

        // GUARDAR FOTO, SE UMA NOVA FOI ESCOLHIDA
        if (fotoSelecionada) {
            localStorage.setItem("modFoto", fotoSelecionada);
        }

        perfilSenha.textContent = "******";

        alert("Dados atualizados com sucesso!");

        modalEditar.style.display = "none";

        formEditarPerfil.reset();

        fotoSelecionada = null;

    });

});
