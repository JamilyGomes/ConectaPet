<?php

session_start();

require_once __DIR__ . '/../../../../config/conexao.php';

// Somente administradores podem acessar esta página
if (!isset($_SESSION['id_usuario']) || $_SESSION['tipo_usuario'] !== 'adm') {
    header('Location: /ConectaPet/app/Views/pages/user/login.php');
    exit;
}

$titulo = 'Conta';

// Verifica se o formulário de criação foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nome'])) {

    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $telefone = preg_replace('/\D/', '', $_POST['telefone'] ?? '');
    $cpf = preg_replace('/\D/', '', $_POST['cpf'] ?? '');
    $senha = $_POST['senha'] ?? '';
    $confirmarSenha = $_POST['confirmar_senha'] ?? '';

    if (
        empty($nome) ||
        empty($email) ||
        empty($telefone) ||
        empty($cpf) ||
        empty($senha) ||
        empty($confirmarSenha)
    ) {
        $_SESSION['mensagem_contas'] = 'Preencha todos os campos.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['mensagem_contas'] = 'Digite um e-mail válido.';
    } elseif (strlen($cpf) !== 11) {
        $_SESSION['mensagem_contas'] = 'CPF inválido.';
    } elseif (strlen($telefone) < 10 || strlen($telefone) > 11) {
        $_SESSION['mensagem_contas'] = 'Telefone inválido.';
    } elseif (strlen($senha) < 8) {
        $_SESSION['mensagem_contas'] = 'A senha deve ter pelo menos 8 caracteres.';
    } elseif ($senha !== $confirmarSenha) {
        $_SESSION['mensagem_contas'] = 'As senhas não coincidem.';
    } else {

        try {

            // Verifica se o e-mail ou CPF já estão cadastrados
            $consulta = $conexao->prepare(
                "SELECT id_usuario
                 FROM usuarios
                 WHERE email = :email OR cpf = :cpf"
            );

            $consulta->execute([
                ':email' => $email,
                ':cpf' => $cpf
            ]);

            if ($consulta->fetch(PDO::FETCH_ASSOC)) {

                $_SESSION['mensagem_contas'] = 'Este e-mail ou CPF já está cadastrado.';
            } else {

                // Protege a senha
                $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

                // Cadastra o moderador
                $sql = "INSERT INTO usuarios
                        (nome, cpf, telefone, email, senha, tipo_usuario, data_cadastro)
                        VALUES
                        (:nome, :cpf, :telefone, :email, :senha, 'mod', CURRENT_TIMESTAMP)";

                $inserir = $conexao->prepare($sql);

                $inserir->execute([
                    ':nome' => $nome,
                    ':cpf' => $cpf,
                    ':telefone' => $telefone,
                    ':email' => $email,
                    ':senha' => $senhaHash
                ]);

                $_SESSION['mensagem_contas'] = 'Moderador cadastrado com sucesso!';
            }
        } catch (PDOException $erro) {

            $_SESSION['mensagem_contas'] = 'Erro ao cadastrar moderador. Verifique os dados e tente novamente.';
        }
    }

    header('Location: /ConectaPet/app/Views/pages/adm/contas.php?tipo=moderadores');
    exit;
}

include './../../components/head/head2.php';

?>

<body>

    <?php include './../../components/nav/nav_adm/sideBar.php'; ?>

    <?php if (isset($_SESSION['mensagem_contas'])): ?>

        <p class="mensagem-contas">
            <?= htmlspecialchars($_SESSION['mensagem_contas']) ?>
        </p>

        <?php unset($_SESSION['mensagem_contas']); ?>

    <?php endif; ?>


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

        // Aceita somente os dois tipos de listagem
        $tipo = $_GET['tipo'] ?? 'usuarios';

        if ($tipo !== 'usuarios' && $tipo !== 'moderadores') {
            $tipo = 'usuarios';
        }

        $tituloTabela = ($tipo === 'moderadores') ? 'Moderadores' : 'Usuários';

        $tipoBanco = ($tipo === 'moderadores') ? 'mod' : 'user';

        if ($tipo === 'moderadores') {
            $acoes = [
                'suspender',
                'historico',
                'mensagem',
                'editar'
            ];
        } else {
            $acoes = [
                'suspender'
            ];
        }

        // Busca as contas cadastradas no banco
        $sql = "SELECT
            id_usuario AS id,
            nome,
            TO_CHAR(data_cadastro, 'DD/MM/YYYY') AS data,
            'Ativo' AS status,
            email,
            telefone
        FROM usuarios
        WHERE tipo_usuario = :tipo
        ORDER BY id_usuario DESC";

        $consulta = $conexao->prepare($sql);
        $consulta->execute([':tipo' => $tipoBanco]);

        $usuarios = $consulta->fetchAll(PDO::FETCH_ASSOC);

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

                <label>Senha</label>

                <input
                    type="password"
                    name="senha"
                    id="senha"
                    placeholder="Digite uma senha"
                    minlength="8"
                    required>

                <label>Confirmar senha</label>

                <input
                    type="password"
                    name="confirmar_senha"
                    id="confirmar_senha"
                    placeholder="Digite a senha novamente"
                    minlength="8"
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