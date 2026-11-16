<?php
// Simulação de dados (depois você pode puxar do banco)
$usuario = [
    "nome" => "Rafael Oliveira",
    "email" => "exemplo@gmail.com",
    "cpf" => "987.***.***-22",
    "senha" => "******",
    "endereco" => "Rua dos Ipês, 145 - Monte Castelo",
    "telefone" => "(67) 91876542",
    "foto" => "img/user.jpg"
];

$posts = [
    "total" => 48,
    "aprovados" => 36,
    "rejeitados" => 12,
    "tempo" => "2h 36min"
];
?>

<?php
$titulo = "Perfil adm";
include './../../components/head/head2.php';
?>

<body>
    <?php include './../../components/nav/nav_adm/sideBar.php'; ?>

    <div class="container">

        <main class="content">

            <div class="header-home-mod">
                <div class="overlay-home-mod">
                    <h1>Perfil Administrador</h1>
                    <p>Consulte e atualize suas informações pessoais e configurações da conta.</p>
                </div>
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
                            src="./../../assets/img/adm-foto.jpg"
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

                        <p>
                            <strong>Nome:</strong>
                            <span id="perfilNome"><?= htmlspecialchars($usuario['nome']) ?></span>
                        </p>

                        <p>
                            <strong>Email:</strong>
                            <span id="perfilEmail"><?= htmlspecialchars($usuario['email']) ?></span>
                        </p>

                        <p>
                            <strong>CPF:</strong>
                            <?= $usuario['cpf'] ?>
                        </p>

                        <p>
                            <strong>Senha:</strong>
                            <?= $usuario['senha'] ?>
                        </p>

                        <p>
                            <strong>Endereço:</strong>
                            <span id="perfilEndereco"><?= htmlspecialchars($usuario['endereco']) ?></span>
                        </p>

                        <p>
                            <strong>Telefone:</strong>
                            <span id="perfilTelefone"><?= htmlspecialchars($usuario['telefone']) ?></span>
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

            <div class="editar-foto-modal">
                <label for="editFoto">Alterar foto do perfil</label>
                <input
                    type="file"
                    id="editFoto"
                    accept="image/*">
            </div>

            <form id="formEditarPerfil">

                <label>Nome</label>
                <input
                    type="text"
                    id="editNome"
                    value="<?= htmlspecialchars($usuario['nome']) ?>"
                    required>

                <label>Telefone</label>

                <input
                    type="text"
                    name="telefone"
                    id="telefone"
                    value="<?= htmlspecialchars($usuario['telefone']) ?>"
                    placeholder="Ex: (67) 99999-9999"
                    maxlength="15"
                    required>

                <label>E-mail</label>

                <input
                    type="email"
                    id="editEmail"
                    value="<?= htmlspecialchars($usuario['email']) ?>"
                    required>

                <label>Endereço</label>
                <input
                    type="text"
                    id="editEndereco"
                    value="<?= htmlspecialchars($usuario['endereco']) ?>"
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

    <script src="./../../assets/js/adm/perfil.js" defer></script>

</body>