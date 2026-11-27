
document.addEventListener("DOMContentLoaded", () => {

    const telefone = document.getElementById("telefone");
    const editEmail = document.getElementById("editEmail");
    const perfilTelefone = document.getElementById("perfilTelefone");
    const perfilEmail = document.getElementById("perfilEmail");

    const fotoPerfil = document.getElementById("fotoPerfil");
    const previewFoto = document.getElementById("previewFoto");
    const inputFoto = document.getElementById("inputFoto");

    const modalEditar = document.getElementById("modalEditar");
    const abrirEditar = document.getElementById("abrirEditar");
    const fecharEditar = document.getElementById("fecharEditar");
    const form = document.getElementById("formEditarPerfil");

    // Mostrar e ocultar senha
    document.querySelectorAll(".olho").forEach(icone => {
        icone.addEventListener("click", () => {
            const input = document.getElementById(icone.dataset.senha);

            if (!input) return;

            input.type = input.type === "password" ? "text" : "password";
            icone.textContent = input.type === "password"
                ? "visibility"
                : "visibility_off";
        });
    });

    // Máscara de telefone
    if (telefone) {
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
    }

    // Abas
    document.querySelectorAll(".aba").forEach(botao => {
        botao.addEventListener("click", () => {
            document.querySelectorAll(".painel").forEach(p => p.classList.remove("ativo"));
            document.querySelectorAll(".aba").forEach(a => a.classList.remove("ativa"));

            document.getElementById(botao.dataset.aba)?.classList.add("ativo");
            botao.classList.add("ativa");
        });
    });

    // Modal
    if (abrirEditar) {
        abrirEditar.addEventListener("click", () => {
            modalEditar.style.display = "flex";
            telefone.value = perfilTelefone.textContent.trim();
            editEmail.value = perfilEmail.textContent.trim();
            previewFoto.src = fotoPerfil.src;
        });
    }

    if (fecharEditar) {
        fecharEditar.addEventListener("click", () => {
            modalEditar.style.display = "none";
        });
    }

    modalEditar?.addEventListener("click", e => {
        if (e.target === modalEditar) {
            modalEditar.style.display = "none";
        }
    });

    // Selecionar foto
    document.getElementById("abrirInputFoto")?.addEventListener("click", () => {
        inputFoto.click();
    });

    inputFoto?.addEventListener("change", function () {
        const arquivo = this.files[0];

        if (!arquivo) return;

        if (!arquivo.type.startsWith("image/")) {
            alert("Selecione uma imagem.");
            this.value = "";
            return;
        }

        previewFoto.src = URL.createObjectURL(arquivo);
    });

    // Salvar no banco
    form?.addEventListener("submit", async e => {
        e.preventDefault();

        const senha = document.getElementById("editSenha").value;
        const confirmar = document.getElementById("editConfirmar").value;

        if (senha || confirmar) {
            if (!senha || !confirmar) {
                alert("Preencha os dois campos de senha.");
                return;
            }

            if (senha !== confirmar) {
                alert("As senhas não coincidem.");
                return;
            }
        }

        const dados = new FormData();

        dados.append("telefone", telefone.value);
        dados.append("email", editEmail.value);
        dados.append("senha", senha);
        dados.append("confirmarSenha", confirmar);

        if (inputFoto.files[0]) {
            dados.append("foto", inputFoto.files[0]);
        }

        try {
            const resposta = await fetch("../../../../verificacoes/user/atualizar-perfil.php", {
                method: "POST",
                body: dados
            });

            const resultado = await resposta.json();

            if (!resposta.ok || !resultado.sucesso) {
                alert(resultado.erro || "Não foi possível atualizar o perfil.");
                return;
            }

            perfilTelefone.textContent = resultado.usuario.telefone;
            perfilEmail.textContent = resultado.usuario.email;

            if (resultado.usuario.foto) {
                const caminho = "../../../../" + resultado.usuario.foto;
                fotoPerfil.src = caminho;
                previewFoto.src = caminho;
            }

            form.reset();
            modalEditar.style.display = "none";

            alert(resultado.mensagem);
            location.reload();

        } catch (erro) {
            console.error(erro);
            alert("Erro ao comunicar com o servidor.");
        }
    });

});
