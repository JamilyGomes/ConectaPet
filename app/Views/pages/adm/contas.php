<?php
$titulo = 'Conta';
include './../../components/head/head2.php';
?>

<body>

    <?php include './../../components/nav/nav_adm/sideBar.php'; ?>


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

    <script src="./../../assets/js/adm/contas.js" defer></script>
</body>

</html>