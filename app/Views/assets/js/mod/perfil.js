
document.addEventListener("DOMContentLoaded", function () {

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

    const inputFoto = document.getElementById("inputFoto");
    const previewFoto = document.getElementById("previewFoto");

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

    modalEditar.addEventListener("click", function (e) {
        if (e.target === modalEditar) {
            modalEditar.style.display = "none";
        }
    });

    // MÁSCARA DO TELEFONE
    telefone.addEventListener("input", function () {
        let valor = this.value.replace(/\D/g, "").substring(0, 11);

        if (valor.length > 10) {
            valor = valor.replace(/^(\d{2})(\d{5})(\d{4})$/, "($1) $2-$3");
        } else if (valor.length > 6) {
            valor = valor.replace(/^(\d{2})(\d{4})(\d{0,4})$/, "($1) $2-$3");
        } else if (valor.length > 2) {
            valor = valor.replace(/^(\d{2})(\d+)$/, "($1) $2");
        } else if (valor.length > 0) {
            valor = "(" + valor;
        }

        this.value = valor;
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

    // VISUALIZAR E SALVAR FOTO
    inputFoto.addEventListener("change", async function () {

        const arquivo = this.files[0];

        if (!arquivo) return;

        if (!arquivo.type.startsWith("image/")) {
            alert("Selecione um arquivo de imagem.");
            this.value = "";
            return;
        }

        const dados = new FormData();
        dados.append("foto", arquivo);

        try {
            const resposta = await fetch("../../../../verificacoes/user/atualizar-perfil.php", {
                method: "POST",
                body: dados
            });

            const resultado = await resposta.json();

            if (!resposta.ok || !resultado.sucesso) {
                alert(resultado.erro || "Erro ao atualizar foto.");
                return;
            }

            const caminho = "../../../../" + resultado.usuario.foto;

            previewFoto.src = caminho + "?t=" + Date.now();

            alert("Foto de perfil atualizada!");

        } catch (erro) {
            console.error(erro);
            alert("Erro ao salvar a foto.");
        }
    });

    // SALVAR NO BANCO
    formEditarPerfil.addEventListener("submit", async function (e) {
        e.preventDefault();

        if (senha.value !== confirmarSenha.value) {
            alert("As senhas não coincidem.");
            return;
        }

        const dados = new FormData();

        dados.append("telefone", telefone.value);
        dados.append("email", email.value);
        dados.append("senha", senha.value);
        dados.append("confirmarSenha", confirmarSenha.value);

        if (inputFoto.files[0]) {
            console.log("Foto selecionada:", inputFoto.files[0]);
            console.log("Tamanho:", inputFoto.files[0].size);
            dados.append("foto", inputFoto.files[0]);
        } else {
            console.log("Nenhuma foto selecionada!");
        }

        try {
            const resposta = await fetch("../../../../verificacoes/user/atualizar-perfil.php", {
                method: "POST",
                body: dados
            });

            const resultado = await resposta.json();

            if (!resposta.ok || !resultado.sucesso) {
                alert(resultado.erro || "Erro ao atualizar perfil.");
                return;
            }

            perfilTelefone.textContent = resultado.usuario.telefone;
            perfilEmail.textContent = resultado.usuario.email;

            if (resultado.usuario.foto) {
                const caminho = "../../../../" + resultado.usuario.foto;
                previewFoto.src = caminho;
            }

            modalEditar.style.display = "none";

            alert(resultado.mensagem);
            location.reload();

        } catch (erro) {
            console.error(erro);
            alert("Erro ao comunicar com o servidor.");
        }
    });

});
