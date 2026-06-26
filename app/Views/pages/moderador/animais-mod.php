<?php
$titulo = 'animais';
?>
<?php
include './../../components/head/head2.php';
?>

<body>

    <?php
    include './../../components/nav/nav-mod/side-mod.php';
    ?>  
    <div class="main-content">


        <div class="adm-animais-container">

            <!-- HEADER -->

            <div class="header-home-mod">
                <div class="overlay-home-mod">
                    <h1>Administrar Animais</h1>
                    <p>Painel de gerenciamento das publicações e solicitações.</p>
                </div>
            </div>


            <!-- CARDS -->

            <!-- cards -->

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


            <!-- tabela -->

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

                        <span class="adm-animal-id"><?php echo $i ?></span>


                        <div class="adm-animal-info">

                            <img src="../../assets/img/dog-card.png">

                            <div>
                                <strong>Thor</strong>
                                <small>Labrador • Médio porte</small>
                            </div>

                        </div>


                        <span>10/10/2025</span>


                        <span class="adm-status-animal">
                            Ativo
                        </span>


                        <div class="adm-animal-acoes">

                            <!-- visualizar -->
                            <button>
                                <span class="material-icons">visibility</span>
                            </button>

                            <!-- editar -->
                            <button>
                                <span class="material-icons">edit</span>
                            </button>

                            <!-- histórico -->
                            <button>
                                <span class="material-icons">history</span>
                            </button>

                            <!-- excluir -->
                            <button>
                                <span class="material-icons">delete</span>
                            </button>

                        </div>

                    </div>

                <?php endfor; ?>

            </div>

        </div>

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

</body>