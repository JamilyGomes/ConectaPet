
document.addEventListener("DOMContentLoaded", function () {

    // TROCAR ABAS
    window.trocarAba = function (id, botao) {
        document.querySelectorAll('.painel').forEach(item => {
            item.classList.remove('ativo');
        });

        document.querySelectorAll('.aba').forEach(item => {
            item.classList.remove('ativa');
        });

        document.getElementById(id).classList.add('ativo');
        botao.classList.add('ativa');
    };

    // MÁSCARA DE TELEFONE
    const telefone = document.getElementById("telefone");

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
                valor = valor.replace(
                    /^(\d+)/,
                    "($1"
                );
            }

            this.value = valor;
        });
    }

    // MOSTRAR OU OCULTAR SENHA
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

    // MODAL DE EDIÇÃO
    const modalEditar = document.getElementById("modalEditar");

    function abrir(modal) {
        modal.style.display = "flex";

        if (fotoSalva && previewFoto) {
            previewFoto.src = fotoSalva;
        }
    }
    function fechar(modal) {
        modal.style.display = "none";
    }

    function fecharFora(modal) {
        modal.addEventListener("click", function (e) {
            if (e.target === modal) {
                fechar(modal);
            }
        });
    }

    // ELEMENTOS DO PERFIL

    // TROCAR FOTO DO PERFIL
    const previewFoto = document.getElementById("previewFoto");
    const inputFoto = document.getElementById("inputFoto");
    const editFoto = document.getElementById("editFoto");

    function trocarFoto(input) {
        const arquivo = input.files[0];

        if (arquivo) {
            if (!arquivo.type.startsWith("image/")) {
                alert("Selecione um arquivo de imagem.");
                return;
            }

            const leitor = new FileReader();

            leitor.onload = function (e) {
                previewFoto.src = e.target.result;
                localStorage.setItem("fotoAdm", e.target.result);
                alert("Foto atualizada com sucesso!");
            };

            leitor.readAsDataURL(arquivo);
        }
    }

    if (inputFoto) {
        inputFoto.addEventListener("change", function () {
            trocarFoto(this);
        });
    }

    if (editFoto) {
        editFoto.addEventListener("change", function () {
            trocarFoto(this);
        });
    }

    // CARREGAR FOTO SALVA
    const fotoSalva = localStorage.getItem("fotoAdm");

    if (fotoSalva && previewFoto) {
        previewFoto.src = fotoSalva;
    }

    const perfilNome = document.getElementById("perfilNome");
    const perfilEmail = document.getElementById("perfilEmail");
    const perfilEndereco = document.getElementById("perfilEndereco");
    const perfilTelefone = document.getElementById("perfilTelefone");

    const editNome = document.getElementById("editNome");
    const editEmail = document.getElementById("editEmail");
    const editEndereco = document.getElementById("editEndereco");
    const editTelefone = document.getElementById("telefone");

    // CARREGAR DADOS SALVOS
    const dadosSalvos = localStorage.getItem("perfilAdm");

    if (dadosSalvos) {
        const dados = JSON.parse(dadosSalvos);

        perfilNome.textContent = dados.nome;
        perfilEmail.textContent = dados.email;
        perfilEndereco.textContent = dados.endereco;
        perfilTelefone.textContent = dados.telefone;

        editNome.value = dados.nome;
        editEmail.value = dados.email;
        editEndereco.value = dados.endereco;
        editTelefone.value = dados.telefone;
    }

    // ABRIR MODAL
    document.getElementById("abrirEditar").addEventListener("click", function () {
        abrir(modalEditar);
    });

    // FECHAR MODAL
    document.getElementById("fecharEditar").addEventListener("click", function () {
        fechar(modalEditar);
    });

    fecharFora(modalEditar);

    // SALVAR ALTERAÇÕES
    document.getElementById("formEditarPerfil").addEventListener("submit", function (e) {
        e.preventDefault();

        const senha = document.getElementById("senha").value;
        const confirmar = document.getElementById("confirmarSenha").value;

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

        const dados = {
            nome: editNome.value,
            email: editEmail.value,
            endereco: editEndereco.value,
            telefone: editTelefone.value
        };

        // SALVAR NO NAVEGADOR
        localStorage.setItem("perfilAdm", JSON.stringify(dados));

        // ATUALIZAR INFORMAÇÕES NA TELA
        perfilNome.textContent = dados.nome;
        perfilEmail.textContent = dados.email;
        perfilEndereco.textContent = dados.endereco;
        perfilTelefone.textContent = dados.telefone;

        if (senha && confirmar) {
            alert("Dados do perfil atualizados! A senha ainda não foi alterada, pois precisa de integração com o servidor.");
        } else {
            alert("Dados atualizados com sucesso!");
        }

        // LIMPAR CAMPOS DE SENHA
        document.getElementById("senha").value = "";
        document.getElementById("confirmarSenha").value = "";

        fechar(modalEditar);
    });

});
