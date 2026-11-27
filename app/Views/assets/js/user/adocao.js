// form adocao 5 etapas

document.addEventListener('DOMContentLoaded', function () {

    const CHAVE_ADOCAO = 'dadosFormularioAdocao';

    // identificar page atual 

    const formularios = {
        formResidencia: 'adocao2.php',
        formFamilia: 'adocao3.php',
        formExperiencia: 'adocao4.php',
        formRotina: 'adocao5.php',
        formTermo: 'solicitacao.php'
    };

    let formularioAtual = null;

    for (const id in formularios) {
        const formulario = document.getElementById(id);

        if (formulario) {
            formularioAtual = formulario;
            break;
        }
    }

    // Se não estiver em nenhuma das cinco pag, encerra
    if (!formularioAtual) {
        return;
    }


    // recuperar respostas salvas 

    function recuperarDados() {
        try {
            return JSON.parse(sessionStorage.getItem(CHAVE_ADOCAO)) || {};
        } catch (erro) {
            return {};
        }
    }


    // salvar respostas pag atual 

    function salvarDados() {

        const dados = recuperarDados();
        const respostas = {};

        Array.from(formularioAtual.elements).forEach(function (campo) {

            if (!campo.name || campo.disabled) {
                return;
            }

            if (campo.type === 'button' || campo.type === 'submit') {
                return;
            }

            // Checkbox
            if (campo.type === 'checkbox') {

                if (!respostas[campo.name]) {
                    respostas[campo.name] = [];
                }

                if (campo.checked) {
                    respostas[campo.name].push(campo.value);
                }

            } else {
                respostas[campo.name] = campo.value;
            }

        });

        // Atualiza somente as respostas da etapa atual
        Object.assign(dados, respostas);

        sessionStorage.setItem(CHAVE_ADOCAO, JSON.stringify(dados));
    }



    // restauras respostas ao voltar uma pag 

    function restaurarDados() {

        const dados = recuperarDados();

        Array.from(formularioAtual.elements).forEach(function (campo) {

            if (!campo.name || dados[campo.name] === undefined) {
                return;
            }

            // Checkbox
            if (campo.type === 'checkbox') {

                const valores = Array.isArray(dados[campo.name])
                    ? dados[campo.name]
                    : [];

                campo.checked = valores.includes(campo.value);

            } else {

                campo.value = dados[campo.name];

            }

        });

        // Atualiza o texto dos dropdowns
        formularioAtual.querySelectorAll('.dropdown').forEach(function (dropdown) {

            const campoOculto = dropdown.querySelector('input[type="hidden"]');
            const selecionado = dropdown.querySelector('.dropdown-selected');

            if (campoOculto && selecionado && campoOculto.value) {
                selecionado.textContent = campoOculto.value;
            }

        });

        atualizarCampoOutro();
        atualizarCampoCriancas();
        atualizarCampoAnimais();

    }


    // dropdows personalizados

    document.addEventListener('click', function (evento) {

        const selecionado = evento.target.closest('.dropdown-selected');

        const opcao = evento.target.closest('.option');

        // Clicou no botão do dropdown.
        if (selecionado && formularioAtual.contains(selecionado)) {

            const dropdown = selecionado.closest('.dropdown');

            // Fecha os outros dropdowns.
            formularioAtual.querySelectorAll('.dropdown').forEach(function (item) {

                if (item !== dropdown) {
                    item.classList.remove('active');
                }

            });

            dropdown.classList.toggle('active');

            return;
        }

        // Clicou em uma opção
        if (opcao && formularioAtual.contains(opcao)) {

            const dropdown = opcao.closest('.dropdown');

            if (!dropdown) {
                return;
            }

            const textoSelecionado = dropdown.querySelector('.dropdown-selected');
            const campoOculto = dropdown.querySelector('input[type="hidden"]');

            const valor = opcao.textContent.trim();

            if (textoSelecionado) {
                textoSelecionado.textContent = valor;
            }

            if (campoOculto) {
                campoOculto.value = valor;

                campoOculto.dispatchEvent(new Event('change', {
                    bubbles: true
                }));
            }

            dropdown.classList.remove('active');

            // Atualiza os campos que dependem da resposta
            atualizarCampoOutro();
            atualizarCampoCriancas();
            atualizarCampoAnimais();

            return;
        }

        // Clicou fora do dropdown
        if (!evento.target.closest('.dropdown')) {

            formularioAtual.querySelectorAll('.dropdown').forEach(function (dropdown) {
                dropdown.classList.remove('active');
            });

        }

    });


    // outro tipo de residencia 

    function atualizarCampoOutro() {

        const campoOutro = formularioAtual.querySelector('.outroAssunto');

        if (!campoOutro) {
            return;
        }

        const primeiroDropdown = formularioAtual.querySelector('.dropdown');

        const campoOculto = primeiroDropdown
            ? primeiroDropdown.querySelector('input[type="hidden"]')
            : null;

        const mostrar = campoOculto && campoOculto.value === 'Outro';

        campoOutro.style.display = mostrar ? 'block' : 'none';

        campoOutro.required = Boolean(mostrar);

        if (!mostrar) {
            campoOutro.value = '';
        }

    }


    // criancas 

    function atualizarCampoCriancas() {

        const campoContainer = document.getElementById('campo-criancas');

        if (!campoContainer) {
            return;
        }

        const dropdown = document.getElementById('dropdownCriancas');

        const campoOculto = dropdown
            ? dropdown.querySelector('input[type="hidden"]')
            : null;

        const campoNumero = campoContainer.querySelector('input[name="num_criancas"]');

        const mostrar = campoOculto && campoOculto.value === 'Sim';

        campoContainer.style.display = mostrar ? 'block' : 'none';

        if (campoNumero) {

            campoNumero.required = Boolean(mostrar);

            if (!mostrar) {
                campoNumero.value = '';
            }

        }

    }


    // outros animais 

    function atualizarCampoAnimais() {

        const campoContainer = document.getElementById('campo-animais');

        if (!campoContainer) {
            return;
        }

        const dropdown = document.getElementById('dropdownAnimais');

        const campoOculto = dropdown
            ? dropdown.querySelector('input[type="hidden"]')
            : null;

        const campoDescricao = campoContainer.querySelector('input[name="descricao_animais"]');

        const mostrar = campoOculto && campoOculto.value === 'Sim';

        campoContainer.style.display = mostrar ? 'block' : 'none';

        if (campoDescricao) {

            campoDescricao.required = Boolean(mostrar);

            if (!mostrar) {
                campoDescricao.value = '';
            }

        }

    }


    // checkbox - nenhum dos anteriores 

    const checkboxGroup = document.getElementById('checkboxGroup');

    if (checkboxGroup) {

        checkboxGroup.addEventListener('change', function (evento) {

            if (evento.target.type !== 'checkbox') {
                return;
            }

            const checkboxes = checkboxGroup.querySelectorAll('input[type="checkbox"]');

            const nenhum = Array.from(checkboxes).find(function (checkbox) {
                return checkbox.value === 'Nenhum dos anteriores';
            });

            if (!nenhum) {
                return;
            }

            // Se marcou "Nenhum", desmarca as outras opções
            if (evento.target === nenhum && nenhum.checked) {

                checkboxes.forEach(function (checkbox) {

                    if (checkbox !== nenhum) {
                        checkbox.checked = false;
                    }

                });

            }

            // Se marcou outra opção, desmarca "Nenhum"
            else if (evento.target !== nenhum && evento.target.checked) {

                nenhum.checked = false;

            }

        });

    }


    // validar os campos 

    function validarFormulario() {

        // Verifica os dropdowns obrigatórios
        const dropdowns = formularioAtual.querySelectorAll(
            '.dropdown input[type="hidden"][required]'
        );

        for (const campo of dropdowns) {

            if (!campo.value.trim()) {

                const dropdown = campo.closest('.dropdown');
                const selecionado = dropdown.querySelector('.dropdown-selected');

                alert('Por favor, selecione uma opção em todos os campos.');

                if (selecionado) {
                    selecionado.setAttribute('tabindex', '0');
                    selecionado.focus();
                }

                return false;
            }

        }


        // Verifica os campos obrigatórios visíveis
        const campos = formularioAtual.querySelectorAll(
            'input[required]:not([type="hidden"]), select[required], textarea[required]'
        );

        for (const campo of campos) {

            if (!campo.checkValidity()) {
                campo.reportValidity();
                return false;
            }

        }


        // Validação dos checkboxes da residência
        if (formularioAtual.id === 'formResidencia') {

            const checkboxes = formularioAtual.querySelectorAll(
                '#checkboxGroup input[type="checkbox"]'
            );

            const algumMarcado = Array.from(checkboxes).some(function (checkbox) {
                return checkbox.checked;
            });

            if (!algumMarcado) {

                alert('Selecione pelo menos uma opção sobre a estrutura da residência.');

                return false;
            }

        }


        // Validação do termo de responsabilidade
        if (formularioAtual.id === 'formTermo') {

            const aceite = document.getElementById('aceite');

            if (!aceite || !aceite.checked) {

                alert('Você precisa aceitar o termo de responsabilidade para continuar.');

                return false;
            }

        }

        return true;

    }


    // btn- voltar 

    const paginasAnteriores = {
        formResidencia: 'home.php',
        formFamilia: 'adocao1.php',
        formExperiencia: 'adocao2.php',
        formRotina: 'adocao3.php',
        formTermo: 'adocao4.php'
    };

    const botaoVoltar = formularioAtual.querySelector('.btn-voltar');

    if (botaoVoltar) {

        botaoVoltar.addEventListener('click', function (evento) {

            evento.preventDefault();

            salvarDados();

            const paginaAnterior = paginasAnteriores[formularioAtual.id];

            if (paginaAnterior) {

                const dados = recuperarDados();
                const idAnimal = dados.id_animal;

                if (idAnimal) {
                    window.location.href = './' + paginaAnterior + '?id_animal=' + encodeURIComponent(idAnimal);
                } else {
                    window.location.href = './' + paginaAnterior;
                }

            }

        });

    }



    // btn continuar/enviar solicitacao

    formularioAtual.addEventListener('submit', async function (evento) {

        evento.preventDefault();

        if (!validarFormulario()) {
            return;
        }

        // Salva as respostas antes de avançar.
        salvarDados();

        const proximaPagina = formularios[formularioAtual.id];

        if (!proximaPagina) {
            return;
        }

        const dados = recuperarDados();
        const idAnimal = dados.id_animal;

        if (!idAnimal) {
            alert('Não foi possível identificar o animal selecionado.');
            return;
        }

        // Nas quatro primeiras etapas, apenas avança.
        if (formularioAtual.id !== 'formTermo') {
            window.location.href = './' + proximaPagina + '?id_animal=' + encodeURIComponent(idAnimal);
            return;
        }

        // Na última etapa, envia todas as respostas ao PHP.
        try {

            const resposta = await fetch('../../../../verificacoes/user/processar-adocao.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(dados)
            });

            const resultado = await resposta.json();

            if (!resposta.ok || !resultado.sucesso) {
                alert(
                    (resultado.erro || 'Não foi possível enviar a solicitação.') +
                    '\n\nEtapa: ' + (resultado.etapa || 'Não identificada') +
                    '\n\nDetalhes: ' + (resultado.detalhes || 'Nenhum detalhe retornado.')
                );
                return;
            }

            sessionStorage.removeItem(CHAVE_ADOCAO);

            window.location.href = './' + proximaPagina;

        } catch (erro) {

            console.error('Erro ao enviar solicitação:', erro);
            alert('Ocorreu um erro ao enviar sua solicitação. Tente novamente.');

        }

    });


    // inicializacao 

    restaurarDados();

});