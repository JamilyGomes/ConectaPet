<?php
$titulo = 'animais';

include './../../components/head/head2.php';
?>

<body>

    <?php include './../../components/nav/nav-mod/side-mod.php'; ?>

    <?php include './../../components/ace/acessibilidade.php'; ?>


    <div class="main-content">


        <div class="adm-animais-container">


            <!-- HEADER -->

            <div class="header-home-mod">

                <div class="overlay-home-mod">

                    <h1>Administrar Animais</h1>

                    <p>
                        Gerencie os animais cadastrados, atualize informações e acompanhe sua disponibilidade para adoção.
                    </p>

                </div>

            </div>

            <!-- CARDS -->


            <div class="adm-animal-cards">


                <div class="adm-card-animal card-grande">

                    <span>GRANDE PORTE</span>

                    <h2>2</h2>

                    <p>Animais de porte maior</p>

                </div>

                <div class="adm-card-animal card-medio">

                    <span>MÉDIO PORTE</span>

                    <h2>3</h2>

                    <p>Animais de porte médio</p>

                </div>

                <div class="adm-card-animal card-pequeno">

                    <span>PEQUENO PORTE</span>

                    <h2>3</h2>

                    <p>Animais de porte menor</p>

                </div>


            </div>

            <div class="adm-animal-total">

                8 animais cadastrados

            </div>

            <!-- TABELA -->

            <div class="adm-animal-tabela">

                <div class="adm-animal-head">

                    <span>ID</span>

                    <span>Animal</span>

                    <span>Data</span>

                    <span>Status</span>

                    <span>Ações</span>

                </div>

                <?php for ($i = 1; $i <= 5; $i++): ?>


                    <div class="adm-animal-linha">



                        <span class="adm-animal-id">

                            <?= $i ?>

                        </span>

                        <div class="adm-animal-info">
                            <img src="../../assets/img/dog-card.png">
                            <div>

                                <strong>Thor</strong>

                                <small>
                                    Labrador • Médio porte
                                </small>


                            </div>

                        </div>

                        <span>

                            10/10/2025

                        </span>

                        <span class="adm-status-animal">

                            Ativo

                        </span>

                        <div class="adm-animal-acoes">
                            <!-- VER -->

                            <button
                                class="btn-acao-mod visualizar-mod"
                                onclick="abrirModalAnimal()">

                                <i class="fas fa-eye"></i>

                            </button>

                            <!-- CADERNO -->


                            <button
                                class="btn-acao-mod"
                                onclick="abrirModalQuestionarioAnimal()">

                                <i class="fas fa-clipboard-list"></i>

                            </button>

                            <!-- ADOTADO -->


                            <button
                                class="btn-acao-mod aprovar-mod adotar-animal">

                                <i class="fas fa-paw"></i>

                            </button>





                        </div>



                    </div>


                <?php endfor; ?>



            </div>



        </div>

        <!-- PAGINAÇÃO -->


        <div class="solicitacao-pi-paginacao">


            <button>

                <i class="fas fa-chevron-left"></i>

            </button>


            <span class="ativo">1</span>

            <span>2</span>

            <span>3</span>

            <button>

                <i class="fas fa-chevron-right"></i>

            </button>


        </div>

    </div>


    <!-- MODAL VISUALIZAR ANIMAL -->

    <div class="modal-publicacao-mod" id="modalAnimal">


        <div class="caixa-publicacao-mod">


            <div class="header-publicacao-mod">

                <h2>Informações do Animal</h2>


                <button onclick="fecharModalAnimal()">

                    <i class="fas fa-times"></i>

                </button>

            </div>
            <fieldset class="box-mod">

                <legend>Informações da solicitação</legend>



                <div class="grupo-formulario-mod">


                    <p>
                        <strong>Data da solicitação:</strong>
                        10/10/2025
                    </p>



                    <p>
                        <strong>Data da última atualização:</strong>
                        16/10/2025
                    </p>
                    <p>
                        <strong>Status atual:</strong>

                        <span class="status-mod aprovado-mod">
                            Aprovado
                        </span>

                    </p>



                </div>


            </fieldset>

            <fieldset class="box-mod">

                <legend>Dados do animal</legend>


                <div class="perfil-info-mod">


                    <p>
                        <strong>Animal:</strong>
                        Thor
                    </p>


                    <p>
                        <strong>Raça:</strong>
                        Labrador
                    </p>


                    <p>
                        <strong>Porte:</strong>
                        Médio porte
                    </p>

                    <p>
                        <strong>Responsável:</strong>
                        Julia Souza
                    </p>

                </div>
            </fieldset>

        </div>

    </div>

    <!-- MODAL QUESTIONÁRIO -->

    <div class="modal-formulario-mod" id="modalQuestionarioAnimal">

        <div class="caixa-formulario-mod">

            <div class="header-formulario-mod">


                <h2>
                    Questionário do Animal
                </h2>

                <button onclick="fecharModalQuestionarioAnimal()">


                    <i class="fas fa-times"></i>


                </button>
            </div>

            <div class="grupo-formulario-mod">


                <h3>🐶 Dados do Animal</h3>



                <p>
                    <strong>Nome:</strong> Thor
                </p>


                <p>
                    <strong>Raça:</strong> Labrador
                </p>


                <p>
                    <strong>Tipo:</strong> Cachorro
                </p>


                <p>
                    <strong>Gênero:</strong> Macho
                </p>


                <p>
                    <strong>Vacinação:</strong> Vacinas em dia
                </p>


                <p>
                    <strong>Peso:</strong> 11-23kg
                </p>


                <p>
                    <strong>Castrado:</strong> Sim
                </p>

            </div>

            <div class="grupo-formulario-mod">
                <h3>🐾 Comportamento</h3>

                <p>

                    <strong>
                        Interação com pessoas:
                    </strong>

                    Sociável e amigável

                </p>

                <p>

                    <strong>
                        Convive com outros animais:
                    </strong>

                    Sim

                </p>
                <p>

                    <strong>
                        Convive com crianças:
                    </strong>

                    Sim

                </p>
                <p>

                    <strong>
                        Ambiente:
                    </strong>

                    Casa com quintal

                </p>
            </div>

            <div class="grupo-formulario-mod">
                <h3>📜 Histórico</h3>
                <p>

                    <strong>
                        Origem:
                    </strong>

                    Resgate

                </p>



                <p>

                    <strong>
                        Tempo com responsável:
                    </strong>

                    1 ano
                </p>
                <p>

                    <strong>
                        Motivo:
                    </strong>

                    Encontrado abandonado
                </p>

            </div>

            <div class="grupo-formulario-mod">
                <h3>🏥 Cuidados</h3>
                <p>

                    <strong>
                        Veterinário:
                    </strong>

                    Sim

                </p>
                <p>

                    <strong>
                        Problema de saúde:
                    </strong>

                    Não possui

                </p>

                <p>

                    <strong>
                        Observação:
                    </strong>

                    Animal saudável

                </p>
            </div>
        </div>
    </div>

    <script>
        function abrirModalAnimal() {


            document
                .getElementById("modalAnimal")
                .style.display = "flex";


        }

        function fecharModalAnimal() {


            document
                .getElementById("modalAnimal")
                .style.display = "none";


        }

        function abrirModalQuestionarioAnimal() {


            document
                .getElementById("modalQuestionarioAnimal")
                .style.display = "flex";


        }

        function fecharModalQuestionarioAnimal() {


            document
                .getElementById("modalQuestionarioAnimal")
                .style.display = "none";


        }
        // MARCAR ADOTADO

        document.querySelectorAll(".adotar-animal")
            .forEach(botao => {


                botao.addEventListener("click", function() {



                    let linha =
                        this.closest(".adm-animal-linha");



                    let status =
                        linha.querySelector(".adm-status-animal");



                    status.innerHTML = "Adotado";



                    status.classList.add("adotado");

                });

            });
    </script>

</body>

</html>