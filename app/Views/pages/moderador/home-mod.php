<?php
$titulo = 'Home Moderador';
include './../../components/head/head2.php';
?>

<body>
    <?php
    include './../../components/nav/nav-mod/side-mod.php';
    ?>

    <div class="main-content">
        <!-- seu conteúdo -->
        <div class="dashboard">

            <!-- CARDS TOPO -->
            <!-- HEADER DA PÁGINA -->
            <div class="header-home-mod">
                <div class="overlay-home-mod">
                    <h1>Home Moderador</h1>
                    <p>Painel de gerenciamento das publicações e solicitações.</p>
                </div>
            </div>
            <div class="cards_ADM">
                <div class="card roxo">
                    <span>1.500</span>
                    <p>Aprovados</p>
                </div>

                <div class="card azul">
                    <span>45</span>
                    <p>Publicações pendentes</p>
                </div>

                <div class="card vermelho">
                    <span>10</span>
                    <p>Recusados</p>
                </div>
            </div>

            <!-- CONTEÚDO -->
            <div class="conteudo">

                <!-- GRÁFICO -->
                <div class="grafico-box">
                    <h3>Solicitações de Adoção – Distribuição Semanal</h3>
                    <canvas id="graficoBarras"></canvas>
                </div>

                <!-- LADO DIREITO -->
                <div class="lado-direito">

                    <div class="grafico-circular">
                        <canvas id="graficoPizza"></canvas>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <script src="./../../assets/js/mod/home.js" defer></script>
    
</body>