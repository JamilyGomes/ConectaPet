
document.addEventListener("DOMContentLoaded", () => {

    // =====================================
    // 1. MOSTRAR E OCULTAR SENHA
    // =====================================

    document.querySelectorAll(".olho").forEach(icone => {

        icone.addEventListener("click", () => {

            const input = document.getElementById(icone.dataset.senha);

            if (!input) return;

            if (input.type === "password") {
                input.type = "text";
                icone.textContent = "visibility_off";
            } else {
                input.type = "password";
                icone.textContent = "visibility";
            }

        });

    });


    // =====================================
    // 2. ELEMENTOS DO PERFIL
    // =====================================

    const telefone = document.getElementById("telefone");
    const editEmail = document.getElementById("editEmail");

    const perfilTelefone = document.getElementById("perfilTelefone");
    const perfilEmail = document.getElementById("perfilEmail");

    const fotoPerfil = document.getElementById("fotoPerfil");
    const previewFoto = document.getElementById("previewFoto");

    // Recuperar dados salvos
    let dadosPerfil = JSON.parse(localStorage.getItem("dadosPerfil")) || {};

    if (dadosPerfil.telefone && telefone) {
        telefone.value = dadosPerfil.telefone;
        perfilTelefone.textContent = dadosPerfil.telefone;
    }

    if (dadosPerfil.email && editEmail) {
        editEmail.value = dadosPerfil.email;
        perfilEmail.textContent = dadosPerfil.email;
    }

    if (dadosPerfil.foto && fotoPerfil && previewFoto) {
        fotoPerfil.src = dadosPerfil.foto;
        previewFoto.src = dadosPerfil.foto;
    }


    // =====================================
    // 3. MÁSCARA DO TELEFONE
    // =====================================

    if (telefone) {

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
                valor = valor.replace(/^(\d+)/, "($1");
            }

            this.value = valor;

        });

    }


    // =====================================
    // 4. TROCAR ABAS
    // =====================================

    const botoesAbas = document.querySelectorAll(".aba");
    const paineis = document.querySelectorAll(".painel");

    botoesAbas.forEach(botao => {

        botao.addEventListener("click", () => {

            const idPainel = botao.dataset.aba;

            paineis.forEach(painel => {
                painel.classList.remove("ativo");
            });

            botoesAbas.forEach(aba => {
                aba.classList.remove("ativa");
            });

            const painelSelecionado = document.getElementById(idPainel);

            if (painelSelecionado) {
                painelSelecionado.classList.add("ativo");
                botao.classList.add("ativa");
            }

        });

    });


    // =====================================
    // 5. ABRIR E FECHAR MODAL
    // =====================================

    const modalEditar = document.getElementById("modalEditar");
    const abrirEditar = document.getElementById("abrirEditar");
    const fecharEditar = document.getElementById("fecharEditar");

    function abrirModal() {
        modalEditar.style.display = "flex";
    }

    function fecharModal() {
        modalEditar.style.display = "none";
    }

    if (abrirEditar && modalEditar) {
        abrirEditar.addEventListener("click", abrirModal);
    }

    if (fecharEditar && modalEditar) {
        fecharEditar.addEventListener("click", fecharModal);
    }

    if (modalEditar) {
        modalEditar.addEventListener("click", function (e) {
            if (e.target === modalEditar) {
                fecharModal();
            }
        });
    }


    // =====================================
    // 6. SELECIONAR E VISUALIZAR FOTO
    // =====================================

    const botaoFoto = document.getElementById("abrirInputFoto");
    const inputFoto = document.getElementById("inputFoto");

    if (botaoFoto && inputFoto) {
        botaoFoto.addEventListener("click", () => {
            inputFoto.click();
        });
    }

    if (inputFoto && previewFoto) {

        inputFoto.addEventListener("change", function () {

            const arquivo = this.files[0];

            if (arquivo) {

                const reader = new FileReader();

                reader.onload = function (e) {
                    previewFoto.src = e.target.result;
                };

                reader.readAsDataURL(arquivo);

            }

        });

    }


    // =====================================
    // 7. SALVAR ALTERAÇÕES
    // =====================================

    const formEditarPerfil = document.getElementById("formEditarPerfil");

    if (formEditarPerfil) {

        formEditarPerfil.addEventListener("submit", function (e) {

            e.preventDefault();

            const senha = document.getElementById("editSenha").value;
            const confirmar = document.getElementById("editConfirmar").value;

            if (senha || confirmar) {

                if (!senha || !confirmar) {
                    alert("Preencha os dois campos de senha.");
                    return;
                }

                if (senha !== confirmar) {
                    alert("As senhas não coincidem!");
                    return;
                }
            }

            // Atualizar informações do perfil
            perfilTelefone.textContent = telefone.value;
            perfilEmail.textContent = editEmail.value;

            // Guardar informações
            dadosPerfil.telefone = telefone.value;
            dadosPerfil.email = editEmail.value;

            // Guardar foto selecionada
            if (inputFoto.files[0] && previewFoto) {
                fotoPerfil.src = previewFoto.src;
                dadosPerfil.foto = previewFoto.src;
            }

            // Salvar no navegador
            localStorage.setItem("dadosPerfil", JSON.stringify(dadosPerfil));

            alert("Dados atualizados com sucesso!");

            fecharModal();

        });

    }

});
