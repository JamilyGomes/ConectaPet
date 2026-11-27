
document.addEventListener("DOMContentLoaded", () => {
    const formulario = document.querySelector(".form-animal");

    if (!formulario) return;

    const pagina = window.location.pathname.match(/doacao([1-4])\.php/i);
    if (!pagina) return;

    const etapa = Number(pagina[1]);
    const chaveDados = "dadosDoacao";

    // Desativa a validação automática do navegador
    formulario.noValidate = true;

    // salvar e reuperar os dados das etapas

    function obterDados() {
        try {
            return JSON.parse(sessionStorage.getItem(chaveDados)) || {};
        } catch {
            return {};
        }
    }

    function salvarDados() {
        const dados = obterDados();

        formulario.querySelectorAll("[name]").forEach(campo => {
            const nome = campo.name;

            if (!nome || campo.type === "file") return;

            if (campo.type === "radio") {
                if (campo.checked) {
                    dados[nome] = campo.value;
                }
                return;
            }

            if (campo.type === "checkbox") {
                if (!Array.isArray(dados[nome])) {
                    dados[nome] = [];
                }

                if (campo.checked) {
                    if (!dados[nome].includes(campo.value)) {
                        dados[nome].push(campo.value);
                    }
                } else {
                    dados[nome] = dados[nome].filter(valor => valor !== campo.value);
                }
                return;
            }

            dados[nome] = campo.value;
        });

        sessionStorage.setItem(chaveDados, JSON.stringify(dados));
    }

    function recuperarDados() {
        const dados = obterDados();

        formulario.querySelectorAll("[name]").forEach(campo => {
            const nome = campo.name;

            if (!nome || campo.type === "file") return;

            if (campo.type === "radio") {
                campo.checked = dados[nome] === campo.value;
                return;
            }

            if (campo.type === "checkbox") {
                campo.checked = Array.isArray(dados[nome]) &&
                    dados[nome].includes(campo.value);
                return;
            }

            if (dados[nome] !== undefined) {
                campo.value = dados[nome];
            }
        });

        atualizarDropdowns();
        atualizarCamposExtras();
        atualizarContador();
    }

    // Salva os dados quando a pessoa avança ou volta
    window.addEventListener("beforeunload", salvarDados);

    // dropdowns 
    const dropdowns = formulario.querySelectorAll(".dropdown");

    dropdowns.forEach(dropdown => {
        const selecionado = dropdown.querySelector(".dropdown-selected");
        const opcoes = dropdown.querySelector(".dropdown-options");
        const campoOculto = dropdown.querySelector('input[type="hidden"]');

        if (!selecionado || !opcoes || !campoOculto) return;

        selecionado.addEventListener("click", () => {
            const estaAberto = opcoes.style.display === "block";

            // Fecha os outros dropdowns
            formulario.querySelectorAll(".dropdown-options").forEach(lista => {
                lista.style.display = "none";
            });

            opcoes.style.display = estaAberto ? "none" : "block";
        });

        opcoes.querySelectorAll(".option, .dropdown-option").forEach(opcao => {
            opcao.addEventListener("click", () => {
                const valor = opcao.textContent.trim();

                selecionado.textContent = valor;
                campoOculto.value = valor;
                opcoes.style.display = "none";

                atualizarCamposExtras();
                salvarDados();
            });
        });
    });

    // Fecha os dropdowns ao clicar fora deles
    document.addEventListener("click", evento => {
        if (!evento.target.closest(".dropdown")) {
            formulario.querySelectorAll(".dropdown-options").forEach(lista => {
                lista.style.display = "none";
            });
        }
    });

    function atualizarDropdowns() {
        dropdowns.forEach(dropdown => {
            const selecionado = dropdown.querySelector(".dropdown-selected");
            const campoOculto = dropdown.querySelector('input[type="hidden"]');

            if (selecionado && campoOculto && campoOculto.value) {
                selecionado.textContent = campoOculto.value;
            }
        });
    }

    // campos extras 
    function atualizarCamposExtras() {
        const camposExtras = formulario.querySelectorAll(".outroAssunto");

        camposExtras.forEach((campoExtra, indice) => {

            // Na página 2, o terceiro campo extra pertence
            // ao quinto dropdown (problemas de saúde)
            const dropdownIndice = (etapa === 2 && indice === 2)
                ? 4
                : indice;

            const dropdown = dropdowns[dropdownIndice];

            if (!dropdown) return;

            const campoOculto = dropdown.querySelector('input[type="hidden"]');

            if (!campoOculto) return;

            const valor = campoOculto.value.trim().toLowerCase();

            let mostrar = false;

            if (etapa === 1) {
                mostrar = valor === "outro";
            }

            if (etapa === 2) {

                // Interação com pessoas: Outro
                if (indice === 0) {
                    mostrar = valor === "outro";
                }

                // Convivência com animais: apenas algumas espécies
                if (indice === 1) {
                    mostrar = valor === "sim, apenas com algumas espécies";
                }

                // Saúde: problema de saúde ou cuidados especiais
                if (indice === 2) {
                    mostrar =
                        valor === "sim, possui problema de saúde" ||
                        valor === "sim, necessita de cuidados especiais";
                }
            }

            if (etapa === 3) {
                mostrar = valor === "outro";
            }

            campoExtra.style.display = mostrar ? "block" : "none";
            campoExtra.required = mostrar;

            if (!mostrar) {
                campoExtra.value = "";
                salvarDados();
            }
        });
    }

    // mascara tel 

    const telefone = formulario.querySelector("#telefone");

    if (telefone) {
        telefone.addEventListener("input", () => {
            let valor = telefone.value.replace(/\D/g, "").slice(0, 11);

            if (valor.length > 10) {
                valor = valor.replace(/^(\d{2})(\d{5})(\d{4}).*/, "($1) $2-$3");
            } else if (valor.length > 6) {
                valor = valor.replace(/^(\d{2})(\d{4})(\d{0,4}).*/, "($1) $2-$3");
            } else if (valor.length > 2) {
                valor = valor.replace(/^(\d{2})(\d{0,5})/, "($1) $2");
            }

            telefone.value = valor;
        });
    }

    // permitir apenas letra no nome 

    const nome = formulario.querySelector("#nome");

    if (nome) {
        nome.addEventListener("input", () => {
            nome.value = nome.value.replace(/[^A-Za-zÀ-ÿ\s]/g, "");
        });
    }

    // contador de caracteres da msg 

    const mensagem = formulario.querySelector("#mensagem");
    const contador = document.querySelector("#contador");

    function atualizarContador() {
        if (mensagem && contador) {
            contador.textContent = `${mensagem.value.length}/500`;
        }
    }

    if (mensagem) {
        mensagem.addEventListener("input", atualizarContador);
    }

    // validar nasc 

    const idade = formulario.querySelector("#idade");

    if (idade) {
        idade.addEventListener("change", () => {
            if (idade.value) {
                const dataEscolhida = new Date(idade.value + "T00:00:00");
                const hoje = new Date();

                hoje.setHours(0, 0, 0, 0);

                if (dataEscolhida > hoje) {
                    alert("A data não pode ser futura.");
                    idade.value = "";
                }
            }
        });
    }

    // checkbox 

    const checkboxesItens = formulario.querySelectorAll('input[name="itens[]"]');

    checkboxesItens.forEach(checkbox => {
        checkbox.addEventListener("change", () => {
            const nenhum = Array.from(checkboxesItens).find(item =>
                item.value.toLowerCase() === "nenhum"
            );

            if (nenhum && checkbox === nenhum && nenhum.checked) {
                checkboxesItens.forEach(item => {
                    if (item !== nenhum) item.checked = false;
                });
            } else if (nenhum && checkbox !== nenhum && checkbox.checked) {
                nenhum.checked = false;
            }

            salvarDados();
        });
    });

    // validar campos 

    function validarFormulario() {
        // Verifica campos obrigatórios visíveis
        const camposObrigatorios = formulario.querySelectorAll(
            "input[required], textarea[required], select[required]"
        );

        for (const campo of camposObrigatorios) {
            if (campo.type === "radio" || campo.type === "hidden" ||
                campo.type === "file") {
                continue;
            }

            if (campo.offsetParent === null) continue;

            if (!campo.value.trim()) {
                alert("Por favor, preencha todos os campos obrigatórios.");
                campo.focus();
                return false;
            }
        }

        // Verifica os dropdowns obrigatórios
        const camposOcultos = formulario.querySelectorAll(
            '.dropdown input[type="hidden"][required]'
        );

        for (const campo of camposOcultos) {
            if (!campo.value.trim()) {
                alert("Por favor, selecione uma opção em todos os campos.");
                campo.closest(".dropdown")
                    ?.querySelector(".dropdown-selected")
                    ?.focus();
                return false;
            }
        }

        // Verifica os grupos de radio
        const gruposRadio = new Set();

        formulario.querySelectorAll('input[type="radio"][required]').forEach(radio => {
            gruposRadio.add(radio.name);
        });

        for (const nomeGrupo of gruposRadio) {
            const selecionado = formulario.querySelector(
                `input[type="radio"][name="${nomeGrupo}"]:checked`
            );

            if (!selecionado) {
                alert("Por favor, selecione uma opção nos campos obrigatórios.");
                formulario.querySelector(
                    `input[type="radio"][name="${nomeGrupo}"]`
                )?.focus();
                return false;
            }
        }

        // Verifica a foto na etapa 1
        if (etapa === 1) {
            const foto = formulario.querySelector('input[type="file"][required]');

            if (foto && foto.files.length === 0) {
                alert("Por favor, selecione uma foto do animal.");
                foto.focus();
                return false;
            }
        }

        // Verifica se pelo menos um item foi selecionado na etapa 4
        if (etapa === 4) {
            const algumItemSelecionado = Array.from(checkboxesItens)
                .some(checkbox => checkbox.checked);

            if (!algumItemSelecionado) {
                alert("Selecione pelo menos uma opção sobre os itens que pode fornecer.");
                checkboxesItens[0]?.focus();
                return false;
            }
        }

        return true;
    }

    // Avançar para a próxima etapa

    formulario.addEventListener("submit", async evento => {
        evento.preventDefault();

        atualizarCamposExtras();

        if (!validarFormulario()) return;

        salvarDados();

        // Envia a foto na primeira etapa
        if (etapa === 1) {
            const foto = formulario.querySelector('input[name="foto"]');

            const dadosFoto = new FormData();
            dadosFoto.append("foto", foto.files[0]);

            try {
                const resposta = await fetch(
                    "../../../../verificacoes/user/receber-foto-doacao.php",
                    {
                        method: "POST",
                        body: dadosFoto
                    }
                );

                const resultado = await resposta.text();

                if (!resposta.ok) {
                    alert(resultado);
                    return;
                }

            } catch (erro) {
                alert("Não foi possível enviar a foto. Tente novamente.");
                return;
            }
        }

        // Avança para as próximas etapas
        if (etapa < 4) {
            window.location.href = `doacao${etapa + 1}.php`;
            return;
        }

        // Na última etapa, envia todos os dados para o PHP
        const dados = JSON.parse(sessionStorage.getItem(chaveDados));

        try {
            const resposta = await fetch(
                "../../../../verificacoes/user/processa-doacao.php",
                {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(dados)
                }
            );

            const resultado = await resposta.text();

            if (!resposta.ok || resultado.trim() !== "sucesso") {
                alert(resultado);
                return;
            }

            // Limpa os dados após salvar com sucesso
            sessionStorage.removeItem(chaveDados);

            window.location.href = "doacao5.php";

        } catch (erro) {
            alert("Não foi possível salvar a doação. Tente novamente.");
        }
    });

    // Iniciar página
    recuperarDados();
});