
// mascara cpf 

const cpf = document.getElementById("cpf");

if (cpf) {
    cpf.addEventListener("input", function () {
        let valor = this.value.replace(/\D/g, "").substring(0, 11);

        valor = valor.replace(/(\d{3})(\d)/, "$1.$2");
        valor = valor.replace(/(\d{3})(\d)/, "$1.$2");
        valor = valor.replace(/(\d{3})(\d{1,2})$/, "$1-$2");

        this.value = valor;
    });
}


// validacao nome 

const camposNome = [
    document.getElementById("nome"),
    document.getElementById("editNome")
];

camposNome.forEach(function (campo) {
    if (campo) {
        campo.addEventListener("input", function () {
            this.value = this.value.replace(/[^a-zA-ZÀ-ÿ\s]/g, "");
        });
    }
});


// mascara tel 

function mascaraTelefone(input) {
    if (!input) return;

    input.addEventListener("input", function () {
        let valor = this.value.replace(/\D/g, "").substring(0, 11);

        if (valor.length > 10) {
            valor = valor.replace(/^(\d{2})(\d{5})(\d{4})$/, "($1) $2-$3");
        } else if (valor.length > 6) {
            valor = valor.replace(/^(\d{2})(\d{4})(\d{0,4})$/, "($1) $2-$3");
        } else if (valor.length > 2) {
            valor = valor.replace(/^(\d{2})(\d{0,5})$/, "($1) $2");
        }

        this.value = valor;
    });
}

mascaraTelefone(document.getElementById("telefone"));
mascaraTelefone(document.getElementById("editTelefone"));


// modais e acoes pages 

document.addEventListener("DOMContentLoaded", function () {

    // Funções para abrir e fechar modais
    function abrir(modal) {
        if (modal) modal.style.display = "flex";
    }

    function fechar(modal) {
        if (modal) modal.style.display = "none";
    }

    function fecharFora(modal) {
        // Não fecha o modal ao clicar fora da janela.
    }

    // Elementos dos modais
    const modalCriar = document.getElementById("modalCriar");
    const modalEditar = document.getElementById("modalEditar");
    const modalMsg = document.getElementById("modalMensagem");
    const modalHist = document.getElementById("modalHistorico");


    //  modal criar 

    const abrirModal = document.getElementById("abrirModal");
    const fecharCriar = document.getElementById("fecharCriar");

    abrirModal?.addEventListener("click", function () {
        abrir(modalCriar);
    });

    fecharCriar?.addEventListener("click", function () {
        fechar(modalCriar);
    });

    const formCriar = document.getElementById("formCriar");

    formCriar?.addEventListener("submit", function (e) {
        const cpf = document.getElementById("cpf");
        const telefone = document.getElementById("telefone");

        if (cpf && cpf.value.length !== 14) {
            alert("Informe um CPF válido.");
            e.preventDefault();
            return;
        }

        if (telefone && telefone.value.length < 14) {
            alert("Informe um telefone válido.");
            e.preventDefault();
            return;
        }
    });


    // modal editar 

    document.querySelectorAll(".btn-acao.editar").forEach(function (botao) {
        botao.addEventListener("click", function () {
            const id = this.dataset.id;
            const nome = this.dataset.nome;
            const email = this.dataset.email;
            const telefone = this.dataset.telefone;

            document.getElementById("editId").value = id;
            document.getElementById("editNome").value = nome;
            document.getElementById("editEmail").value = email;
            document.getElementById("editTelefone").value = telefone;
            document.getElementById("nomeEditar").textContent = nome;

            abrir(modalEditar);
        });
    });

    const fecharEditar = document.getElementById("fecharEditar");

    fecharEditar?.addEventListener("click", function () {
        fechar(modalEditar);
    });


    // modal msg 
    document.querySelectorAll(".btn-acao.mensagem").forEach(function (botao) {
        botao.addEventListener("click", function () {
            const nome = this.dataset.nome;

            document.getElementById("nomeUsuario").textContent = nome;
            abrir(modalMsg);

            document.getElementById("mensagemTexto").value = "";
        });
    });

    const fecharMensagem = document.getElementById("fecharMensagem");

    fecharMensagem?.addEventListener("click", function () {
        fechar(modalMsg);
    });

    const formMensagem = document.getElementById("formMensagem");

    formMensagem?.addEventListener("submit", function (e) {
        e.preventDefault();

        const mensagem = document.getElementById("mensagemTexto").value.trim();

        if (mensagem === "") {
            alert("Digite uma mensagem antes de enviar.");
            return;
        }

        alert("Mensagem enviada com sucesso!");
        fechar(modalMsg);
    });


    // modal historico 

    const fecharHistorico = document.getElementById("fecharHistorico");

    fecharHistorico?.addEventListener("click", function () {
        fechar(modalHist);
    });

    document.querySelectorAll(".btn-acao.historico").forEach(function (botao) {
        botao.addEventListener("click", function () {
            const id = this.dataset.id;
            const nome = this.dataset.nome;

            document.getElementById("nomeHistorico").textContent = nome;

            abrir(modalHist);

            const historico = [
                {
                    acao: "Criação",
                    descricao: "Conta criada no sistema",
                    data: "15/01/2025"
                },
                {
                    acao: "Edição",
                    descricao: "Dados da conta atualizados",
                    data: "20/01/2025"
                }
            ];

            const conteudo = document.getElementById("conteudoHistorico");
            conteudo.innerHTML = "";

            historico.forEach(function (item) {
                const linha = document.createElement("div");
                linha.classList.add("linha");

                linha.innerHTML = `
                    <strong>${item.acao}</strong>
                    <p>${item.descricao}</p>
                    <small>${item.data}</small>
                `;

                conteudo.appendChild(linha);
            });
        });
    });


    // suspender e reativar conta 

    document.querySelectorAll(".btn-acao.suspender").forEach(function (botao) {
        botao.addEventListener("click", function () {
            const linha = this.closest(".linha");
            const status = linha.querySelector(".status");
            const icone = this.querySelector("i");

            if (status.classList.contains("ativo")) {
                status.classList.remove("ativo");
                status.classList.add("suspenso");
                status.textContent = "Suspenso";

                icone.classList.remove("fa-lock");
                icone.classList.add("fa-lock-open");

            } else {
                status.classList.remove("suspenso");
                status.classList.add("ativo");
                status.textContent = "Ativo";

                icone.classList.remove("fa-lock-open");
                icone.classList.add("fa-lock");
            }
        });
    });


    // fechar modais clicando fora 

    [modalCriar, modalEditar, modalMsg, modalHist].forEach(fecharFora);

});
