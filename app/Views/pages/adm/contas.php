<?php
$titulo = 'Conta';
include './../../components/head/head2.php';
?>

<body>

    <?php include './../../components/nav/nav_adm/sideBar.php'; ?>

    <?php
    include './../../components/ace/acss.php';
    ?>

    <div class="main-content">

        <?php
        $tipo = $_GET['tipo'] ?? 'usuarios';
        ?>

        <div class="header-home-mod">
            <div class="overlay-home-mod">
                <h1>Administrar Contas</h1>
                <p>Gerencie as contas dos usuários, atualize informações e controle os acessos ao sistema.</p>
            </div>
        </div>

        <div class="topo-tabela">

            <div class="filtro">

                <a href="?tipo=usuarios">
                    <button class="<?= $tipo == 'usuarios' ? 'ativo' : '' ?>">
                        Usuário
                    </button>
                </a>

                <a href="?tipo=moderadores">
                    <button class="<?= $tipo == 'moderadores' ? 'ativo' : '' ?>">
                        Moderador
                    </button>
                </a>

            </div>

            <?php if ($tipo == 'moderadores'): ?>
                <button class="btn-criar" id="abrirModal">
                    Criar novo Moderador
                </button>
            <?php endif; ?>

        </div>

        <?php

        if ($tipo == 'moderadores') {

            $tituloTabela = "Moderadores";

            $usuarios = [
                [
                    "id" => 10,
                    "nome" => "Carlos",
                    "data" => "05/02",
                    "status" => "Ativo",
                    "email" => "carlos@email.com",
                    "telefone" => "(67)99999-9999"
                ],
                [
                    "id" => 11,
                    "nome" => "Ana",
                    "data" => "06/02",
                    "status" => "Ativo",
                    "email" => "ana@email.com",
                    "telefone" => "(67)98888-8888"
                ]
            ];

            $acoes = [
                'suspender',
                'historico',
                'mensagem',
                'editar'
            ];
        } else {

            $tituloTabela = "Usuários";

            $usuarios = [
                [
                    "id" => 1,
                    "nome" => "João",
                    "data" => "01/01",
                    "status" => "Ativo"
                ],
                [
                    "id" => 2,
                    "nome" => "Maria",
                    "data" => "02/02",
                    "status" => "Ativo"
                ]
            ];

            $acoes = [
                'suspender'
            ];
        }

        include './../../components/adm_component/tabela.php';

        ?>

    </div>

    <!-- ===========================
            MODAL CRIAR
    ============================ -->

    <div class="modaladm" id="modalCriar">

        <div class="modal2">

            <h3>Novo Moderador</h3>

            <form id="formCriar" action="?tipo=moderadores" method="POST">
                <label>Nome</label>

                <input
                    type="text"
                    name="nome"
                    id="nome"
                    placeholder="Digite seu nome"
                    required>

                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    id="email"
                    placeholder="Ex: joao@gmail.com"
                    required>

                <label>Telefone</label>

                <input
                    type="text"
                    name="telefone"
                    id="telefone"
                    placeholder="Ex: (67) 99999-9999"
                    maxlength="15"
                    required>

                <label>CPF</label>

                <input
                    type="text"
                    id="cpf"
                    name="cpf"
                    placeholder="Digite seu CPF"
                    maxlength="14"
                    required>

                <div class="botoes-modal">

                    <button
                        type="button"
                        class="btn-voltar"
                        id="fecharCriar">
                        Cancelar
                    </button>

                    <button
                        type="submit"
                        class="btn-concluir">
                        Cadastrar
                    </button>

                </div>

            </form>

        </div>

    </div>

    <!-- ===========================
        MODAL EDITAR
=========================== -->

    <div class="modaladm" id="modalEditar">

        <div class="modal2">

            <h3>Editando <span id="nomeEditar"></span></h3>

            <form id="formEditar" action="?tipo=moderadores" method="POST">

                <input
                    type="hidden"
                    id="editId">

                <div class="campo">

                    <label>Nome</label>

                    <input
                        type="text"
                        name="editNome"
                        id="editNome"
                        placeholder="Digite seu nome"
                        required>

                </div>

                <div class="campo">

                    <label>Email</label>

                    <input
                        type="email"
                        name="editEmail"
                        id="editEmail"
                        placeholder="Digite o e-mail"
                        required>

                </div>

                <div class="campo">

                    <label>Telefone</label>

                    <input
                        type="text"
                        name="editTelefone"
                        id="editTelefone"
                        placeholder="Ex: (67) 99999-9999"
                        maxlength="15"
                        required>

                </div>

                <div class="botoes-modal">

                    <button
                        type="button"
                        class="btn-voltar"
                        id="fecharEditar">
                        Cancelar
                    </button>

                    <button
                        type="submit"
                        class="btn-concluir">
                        Salvar
                    </button>

                </div>

            </form>

        </div>

    </div>

    <!-- MODAL MENSAGEM -->
    <div class="modaladm" id="modalMensagem">
        <div class="modal2">
            <h3>Mensagem para <span id="nomeUsuario"></span></h3>
            <form id="formMensagem">
                <textarea id="mensagemTexto" placeholder="Digite sua mensagem..." required></textarea>
                <div class="botoes-modal">
                    <button type="button" class="btn-voltar" id="fecharMensagem">Cancelar</button>
                    <button type="submit" class="btn-concluir">Enviar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL HISTORICO -->
    <div class="modaladm" id="modalHistorico">
        <div class="modal2">
            <h3>Histórico de <span id="nomeHistorico"></span></h3>

            <div class="tabela-historico">

                <div class="topo">
                    <span>Ação</span>
                    <span>Descrição</span>
                    <span>Data</span>
                </div>

                <div id="conteudoHistorico"></div>

            </div>

            <button class="btn-voltar" id="fecharHistorico">Fechar</button>
        </div>
    </div>

    <script>
        const cpf = document.getElementById("cpf");

        if (cpf) {
            cpf.addEventListener("input", function() {

                let valor = this.value.replace(/\D/g, "");
                valor = valor.substring(0, 11);

                valor = valor.replace(/(\d{3})(\d)/, "$1.$2");
                valor = valor.replace(/(\d{3})(\d)/, "$1.$2");
                valor = valor.replace(/(\d{3})(\d{1,2})$/, "$1-$2");

                this.value = valor;

            });
        }

        // ---------------- NOME ----------------

        ["nome", "editNome"].forEach(id => {

            const campo = document.getElementById(id);

            if (!campo) return;

            campo.addEventListener("input", function() {

                this.value = this.value.replace(/[^A-Za-zÀ-ÿ\s]/g, "");

            });

        });

        // ---------------- TELEFONE ----------------

        function mascaraTelefone(input) {

            input.addEventListener("input", function() {

                let valor = this.value.replace(/\D/g, "");

                valor = valor.substring(0, 11);

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

        const telefone = document.getElementById("telefone");
        const editTelefone = document.getElementById("editTelefone");

        if (telefone) mascaraTelefone(telefone);
        if (editTelefone) mascaraTelefone(editTelefone);
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            function abrir(modal) {
                modal.style.display = 'flex';
            }

            function fechar(modal) {
                modal.style.display = 'none';
            }

            function fecharFora(modal) {
                modal.addEventListener('click', function(e) {
                    if (e.target === modal) {
                        fechar(modal);
                    }
                });
            }

            const modalCriar = document.getElementById("modalCriar");
            const modalEditar = document.getElementById("modalEditar");
            const modalMsg = document.getElementById("modalMensagem");
            const modalHist = document.getElementById("modalHistorico");

            // CRIAR (CORRIGIDO)
            document.getElementById("abrirModal")?.addEventListener("click", () => abrir(modalCriar));
            document.getElementById("fecharCriar").onclick = () => fechar(modalCriar);

            // VALIDAÇÃO CPF E TELEFONE
            document.getElementById("formCriar").addEventListener("submit", function(e) {

                const cpf = document.getElementById("cpf").value.trim();
                const telefone = document.getElementById("telefone").value.trim();

                // CPF precisa ter 14 caracteres (000.000.000-00)
                if (cpf.length !== 14) {
                    alert("CPF inválido! Use o formato 000.000.000-00");
                    e.preventDefault();
                    return;
                }

                // Telefone precisa ter 14 ou 15 caracteres
                if (telefone.length < 14) {
                    alert("Telefone inválido! Use o formato (67) 99999-9999");
                    e.preventDefault();
                    return;
                }

            });

            // EDITAR
            document.querySelectorAll('.btn-acao.editar').forEach(botao => {

                botao.addEventListener('click', function() {

                    document.getElementById("editId").value = this.dataset.id;
                    document.getElementById("editNome").value = this.dataset.nome;
                    document.getElementById("editEmail").value = this.dataset.email;
                    document.getElementById("editTelefone").value = this.dataset.telefone;

                    document.getElementById("nomeEditar").textContent = this.dataset.nome;

                    abrir(modalEditar);

                });

            });
            document.getElementById("fecharEditar").onclick = () => fechar(modalEditar);
            document.getElementById("fecharHistorico").onclick = () => fechar(modalHist);

            // MENSAGEM (CORRETO)
            document.querySelectorAll('.btn-acao.mensagem').forEach(botao => {

                botao.addEventListener('click', function() {

                    const nome = this.dataset.nome;

                    // coloca nome no título
                    document.getElementById("nomeUsuario").textContent = nome;

                    // abre modal
                    abrir(modalMsg);

                    // limpa campo
                    document.getElementById("mensagemTexto").value = "";

                });

            });

            // botão fechar
            document.getElementById("fecharMensagem").onclick = () => fechar(modalMsg);

            // enviar mensagem
            document.getElementById("formMensagem").addEventListener("submit", function(e) {
                e.preventDefault();

                const msg = document.getElementById("mensagemTexto").value.trim();

                if (!msg) {
                    alert("Digite uma mensagem!");
                    return;
                }

                alert("Mensagem enviada com sucesso!");
                fechar(modalMsg);
            });

            // HISTORICO
            document.querySelectorAll('.btn-acao.historico').forEach(botao => {

                botao.addEventListener('click', function() {

                    const id = this.dataset.id;
                    const nome = this.dataset.nome;

                    const conteudo = document.getElementById("conteudoHistorico");
                    const nomeHistorico = document.getElementById("nomeHistorico");

                    // 👉 nome no título
                    nomeHistorico.textContent = nome;

                    // 👉 abre modal
                    abrir(modalHist);

                    // 🔥 dados simulados
                    let dados = [{
                            acao: "Criação",
                            desc: "Moderador criado",
                            data: "05/02 10:00"
                        },
                        {
                            acao: "Edição",
                            desc: "Alterou dados",
                            data: "06/02 14:30"
                        },

                    ];

                    conteudo.innerHTML = "";

                    dados.forEach(item => {
                        conteudo.innerHTML += `
                    <div class="linha">
                        <span>${item.acao}</span>
                        <span>${item.desc}</span>
                        <span>${item.data}</span>
                    </div>
                `;
                    });

                });

            });
            // SUSPENDER
            document.querySelectorAll('.btn-acao.suspender').forEach(botao => {
                botao.addEventListener('click', function() {
                    let linha = this.closest('.linha');
                    let status = linha.querySelector('.status');
                    let icone = this.querySelector('i');

                    if (status.classList.contains('ativo')) {
                        status.classList.replace('ativo', 'suspenso');
                        status.textContent = 'Suspenso';
                        icone.classList.replace('fa-lock', 'fa-lock-open');
                    } else {
                        status.classList.replace('suspenso', 'ativo');
                        status.textContent = 'Ativo';
                        icone.classList.replace('fa-lock-open', 'fa-lock');
                    }
                });
            });

            // FECHAR CLICANDO FORA (CORRIGIDO)
            [modalCriar, modalEditar, modalMsg, modalHist].forEach(fecharFora);

        });
    </script>

</body>

</html>