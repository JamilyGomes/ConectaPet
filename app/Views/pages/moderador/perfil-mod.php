<?php
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header('Location: login.php');
    exit;
}

require_once __DIR__ . '/../../../../config/conexao.php';

$id_usuario = $_SESSION['id_usuario'];

// BUSCAR DADOS DO MODERADOR
$sqlUsuario = "
    SELECT nome, cpf, email, telefone, foto_perfil
    FROM usuarios
    WHERE id_usuario = :id_usuario
      AND tipo_usuario = 'mod'
";

$consultaUsuario = $conexao->prepare($sqlUsuario);
$consultaUsuario->execute([':id_usuario' => $id_usuario]);

$usuario = $consultaUsuario->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    exit('Moderador não encontrado.');
}

// FOTO DO PERFIL
$fotoPerfil = !empty($usuario['foto_perfil'])
    ? './../../../../' . $usuario['foto_perfil']
    : './../../assets/img/adm-foto.jpg';

// CONTAGEM DE PUBLICAÇÕES
$sqlPosts = "
    SELECT
        COUNT(*) AS total,
        COUNT(*) FILTER (WHERE status = 'Aprovado') AS aprovados,
        COUNT(*) FILTER (WHERE status = 'Recusado') AS rejeitados
    FROM animais
";

$consultaPosts = $conexao->query($sqlPosts);
$posts = $consultaPosts->fetch(PDO::FETCH_ASSOC);

$posts['tempo'] = '—';
?>


<?php
$titulo = "Perfil moderador";
include './../../components/head/head2.php';
?>

<body>
    <?php include './../../components/nav/nav-mod/side-mod.php'; ?>

    <div class="container">

        <main class="content">

            <div class="header-home-mod">
                <h1>Perfil Moderador</h1>
                <p>Consulte e atualize suas informações pessoais e configurações da conta.</p>

            </div>



            <!-- INFORMAÇÕES -->
            <section class="card perfil-box">

                <h3>Informações Pessoais</h3>

                <!-- BOTÃO EDITAR -->
                <button class="btn-editar-perfil" id="abrirEditar">
                    <i class="fa-solid fa-pen-to-square"></i>
                </button>

                <div class="perfil-info">

                    <div class="foto-perfil">

                        <img
                            src="<?= htmlspecialchars($fotoPerfil) ?>"
                            class="foto-adm"
                            id="previewFoto"
                            alt="Foto do administrador">

                        <label for="inputFoto" class="editar-foto">
                            <i class="fa-solid fa-camera"></i>
                        </label>

                        <input
                            type="file"
                            id="inputFoto"
                            accept="image/*"
                            hidden>

                    </div>

                    <div class="dados">

                        <div class="dados">

                            <p>
                                <strong>Nome:</strong>
                                <span id="perfilNome"><?= $usuario['nome'] ?></span>
                            </p>

                            <p>
                                <strong>Email:</strong>
                                <span id="perfilEmail"><?= $usuario['email'] ?></span>
                            </p>

                            <p>
                                <strong>CPF:</strong>
                                <span id="perfilCpf"><?= $usuario['cpf'] ?></span>
                            </p>

                            <p>
                                <strong>Senha:</strong>
                                <span id="perfilSenha">••••••••</span>
                            </p>

                            <p>
                                <strong>Endereço:</strong>
                                <span id="perfilEndereco">Não informado</span>
                            </p>

                            <p>
                                <strong>Telefone:</strong>
                                <span id="perfilTelefone"><?= $usuario['telefone'] ?></span>
                            </p>

                        </div>

                    </div>

            </section>

            <!-- POSTAGENS -->
            <section class="card-adm">

                <h3>Postagens</h3>

                <div class="cards-adm">

                    <div class="box azul">
                        <h4><?= $posts['total'] ?></h4>
                        <p>Total de publicações</p>
                    </div>

                    <div class="box rosa">
                        <h4><?= $posts['aprovados'] ?></h4>
                        <p>Publicações aprovadas</p>
                    </div>

                    <div class="box roxo">
                        <h4><?= $posts['rejeitados'] ?></h4>
                        <p>Publicações rejeitadas</p>
                    </div>

                    <div class="box verde">
                        <h4><?= $posts['tempo'] ?></h4>
                        <p>Tempo médio</p>
                    </div>

                </div>

            </section>

        </main>

    </div>

    <!-- MODAL EDITAR PERFIL -->
    <div class="modaladm" id="modalEditar">

        <div class="modal2">

            <h3>Editar Perfil</h3>

            <form id="formEditarPerfil">

                <label>Telefone</label>

                <input
                    type="text"
                    name="telefone"
                    id="telefone"
                    placeholder="Ex: (67) 99999-9999"
                    maxlength="15"
                    required>

                <label>E-mail</label>

                <input type="email"
                    id="editEmail"
                    value="exemplo@gmail.com"
                    required>

                <label for="senha">Senha</label>

                <div class="senha-group">

                    <div class="campo-senha">

                        <input type="password" id="senha" name="senha" placeholder="Digite sua senha">
                        <span class="material-icons olho" onclick="toggleSenha('senha', this)">
                            visibility
                        </span>

                    </div>
                </div>

                <label for="senha">Confirmar Senha</label>

                <div class="senha-group">

                    <div class="campo-senha">

                        <input type="password" id="confirmarSenha" name="confirmarSenha" placeholder="Confirme sua senha">
                        <span class="material-icons olho" onclick="toggleSenha('confirmarSenha', this)">
                            visibility
                        </span>

                    </div>
                </div>

                <!-- BOTÕES -->

                <div class="botoes-modal">

                    <button
                        type="button"
                        class="btn-voltar"
                        id="fecharEditar">
                        Cancelar
                    </button>

                    <button type="submit" class="btn-concluir">
                        Salvar 🐾
                    </button>

                </div>

            </form>
        </div>


    </div>

    </div>

    <script src="./../../assets/js/mod/perfil.js" defer></script>

</body>