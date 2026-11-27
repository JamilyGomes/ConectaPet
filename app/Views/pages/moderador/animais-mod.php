<?php
$titulo = 'Animais';

// Conexão com o banco de dados
require_once __DIR__ . '/../../../../config/conexao.php';

// Busca os animais cadastrados
$sql = "SELECT
            a.id_animal,
            a.nome,
            a.raca,
            a.tipo_animal,
            a.porte,
            a.foto,
            a.data_cadastro,
            a.status,
            u.nome AS responsavel
        FROM animais a
        INNER JOIN usuarios u ON a.id_usuario = u.id_usuario
        ORDER BY a.id_animal DESC";

$consulta = $conexao->query($sql);
$animais = $consulta->fetchAll(PDO::FETCH_ASSOC);
$totalGrande = 0;
$totalMedio = 0;
$totalPequeno = 0;

foreach ($animais as $animal) {
    if ($animal['porte'] === 'Grande') {
        $totalGrande++;
    } elseif ($animal['porte'] === 'Médio') {
        $totalMedio++;
    } elseif ($animal['porte'] === 'Pequeno') {
        $totalPequeno++;
    }
}

$totalAnimais = count($animais);

// Cabeçalho
include './../../components/head/head2.php';
?>

<body>

    <?php include './../../components/nav/nav-mod/side-mod.php'; ?>

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

                    <h2><?= $totalGrande ?></h2>

                    <p>Animais de porte maior</p>

                </div>

                <div class="adm-card-animal card-medio">

                    <span>MÉDIO PORTE</span>

                    <h2><?= $totalMedio ?></h2>

                    <p>Animais de porte médio</p>

                </div>

                <div class="adm-card-animal card-pequeno">

                    <span>PEQUENO PORTE</span>

                    <h2><?= $totalPequeno ?></h2>

                    <p>Animais de porte menor</p>

                </div>


            </div>

            <div class="adm-animal-total">
                <?= $totalAnimais ?> animais cadastrados
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

                <?php foreach ($animais as $animal): ?>


                    <div class="adm-animal-linha">



                        <span class="adm-animal-id">
                            <?= $animal['id_animal'] ?>
                        </span>

                        <div class="adm-animal-info">

                            <img
                                src="<?= !empty($animal['foto']) ? htmlspecialchars($animal['foto']) : '../../assets/img/dog-card.png' ?>"
                                alt="<?= htmlspecialchars($animal['nome']) ?>">

                            <div>
                                <strong><?= htmlspecialchars($animal['nome']) ?></strong>

                                <small>
                                    <?= htmlspecialchars($animal['raca'] ?? 'Sem raça definida') ?>
                                    •
                                    <?= htmlspecialchars($animal['porte'] ?? 'Porte não informado') ?>
                                </small>
                            </div>

                        </div>

                        <span>
                            <?= date('d/m/Y', strtotime($animal['data_cadastro'])) ?>
                        </span>

                        <span class="adm-status-animal">
                            <?= htmlspecialchars($animal['status']) ?>
                        </span>

                        <div class="adm-animal-acoes">
                            <!-- VER -->

                            <button
                                class="btn-acao-mod visualizar-mod"
                                onclick="abrirModalAnimal(<?= (int) $animal['id_animal'] ?>)">

                                <i class="fas fa-eye"></i>

                            </button>

                            <!-- CADERNO -->


                            <button
                                class="btn-acao-mod"
                                onclick="abrirModalQuestionarioAnimal(<?= (int) $animal['id_animal'] ?>)">

                                <i class="fas fa-clipboard-list"></i>

                            </button>

                            <!-- ADOTADO -->


                            <button
                                class="btn-acao-mod aprovar-mod adotar-animal"
                                data-id="<?= (int) $animal['id_animal'] ?>">

                                <i class="fas fa-paw"></i>

                            </button>





                        </div>



                    </div>


                <?php endforeach; ?>



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

    <script src="./../../assets/js/mod/animais.js" defer></script>

</body>

</html>