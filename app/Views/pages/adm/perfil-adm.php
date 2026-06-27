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
                    <p>Painel de gerenciamento das publicações e solicitações.</p>
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

                    <img src="./../../assets/img/adm-foto.jpg"
                        class="foto-adm"
                        alt="">

                    <div class="dados">

                        <p>
                            <strong>Nome:</strong>
                            <?= $usuario['nome'] ?>
                        </p>

                        <p>
                            <strong>Email:</strong>
                            <?= $usuario['email'] ?>
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
                            <?= $usuario['endereco'] ?>
                        </p>

                        <p>
                            <strong>Telefone:</strong>
                            <?= $usuario['telefone'] ?>
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

                        <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
                        <span class="material-icons olho" onclick="toggleSenha('senha', this)">
                            visibility
                        </span>

                    </div>
                </div>

                <label for="senha">Confirmar Senha</label>

                <div class="senha-group">

                    <div class="campo-senha">

                        <input type="password" id="confirmarSenha" name="confirmarSenha" placeholder="Confirme sua senha" required>
                        <span class="material-icons olho" onclick="toggleSenha('confirmarSenha', this)">
                            visibility
                        </span>

                    </div>
                </div>

                <!-- BOTÕES -->
                <div class="botoes-modal">

                    <button type="button"
                        class="btn-cancelar-perfil"
                        id="fecharEditar">
                        Cancelar
                    </button>

                    <button type="submit"
                        class="btn-salvar-perfil">
                        Salvar
                    </button>

                </div>

            </form>

        </div>

    </div>

    <script>
        function trocarAba(id, botao) {

            document.querySelectorAll('.painel').forEach(item => {
                item.classList.remove('ativo');
            });

            document.querySelectorAll('.aba').forEach(item => {
                item.classList.remove('ativa');
            });

            document.getElementById(id).classList.add('ativo');

            botao.classList.add('ativa');
        }
    </script>

    <script>
        const telefone = document.getElementById("telefone");

        telefone.addEventListener("input", function() {

            // remove tudo que não for número
            let valor = this.value.replace(/\D/g, "");

            // aplica máscara
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
    </script>

    <script>
        function toggleSenha(id, icone) {

            const input = document.getElementById(id);

            if (input.type === "password") {
                input.type = "text";
                icone.textContent = "visibility_off";
            } else {
                input.type = "password";
                icone.textContent = "visibility";
            }
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const modalEditar =
                document.getElementById("modalEditar");

            function abrir(modal) {
                modal.style.display = "flex";
            }

            function fechar(modal) {
                modal.style.display = "none";
            }

            function fecharFora(modal) {

                modal.addEventListener("click", function(e) {

                    if (e.target === modal) {
                        fechar(modal);
                    }

                });

            }

            /* abrir modal */
            document
                .getElementById("abrirEditar")
                .addEventListener("click", function() {

                    abrir(modalEditar);

                });

            /* fechar modal */
            document
                .getElementById("fecharEditar")
                .addEventListener("click", function() {

                    fechar(modalEditar);

                });

            fecharFora(modalEditar);

            /* salvar */
            document
                .getElementById("formEditarPerfil")
                .addEventListener("submit", function(e) {

                    e.preventDefault();

                    let senha =
                        document.getElementById("editSenha").value;

                    let confirmar =
                        document.getElementById("editConfirmar").value;

                    if (senha !== confirmar) {

                        alert("As senhas não coincidem.");

                        return;
                    }

                    alert("Dados atualizados com sucesso!");

                    fechar(modalEditar);

                });

        });
    </script>

</body>