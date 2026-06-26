<?php
$titulo = "Relatorio";
include './../../components/head/head2.php';
?>

<body>

    <?php include './../../components/nav/nav_adm/sideBar.php'; ?>

    <?php
    // futuramente você pode puxar esses dados do banco
    $acessos = "23.450K";
    $adocoes = 45;
    $animais = 35;
    $pendentes = 10;
    ?>

    <div class="relatorio-conteudo">


        <div class="header-home-mod">
            <div class="overlay-home-mod">
                <h1>Relatórios</h1>
                <p>Painel de gerenciamento das publicações e solicitações.</p>
            </div>
        </div>
        <div class="relatorio-cabecalho">

            <div>

                <select>
                    <option>PERÍODO</option>
                    <option>Hoje</option>
                    <option>Semana</option>
                    <option>Mês</option>
                </select>

            </div>

        </div>



        <div class="relatorio-grid">


            <!-- CARD ACESSOS -->
            <div class="relatorio-card">

                <h4>Quantidade de acessos ao site</h4>

                <h2><?= $acessos ?></h2>


                <div class="relatorio-dados-acesso">

                    <div>
                        Feminino
                        <strong>30%</strong>
                    </div>

                    <div>
                        Masculino
                        <strong>20%</strong>
                    </div>

                    <div>
                        Outros
                        <strong>50%</strong>
                    </div>


                </div>


            </div>

            <!-- CARD CIRCULO -->
            <div class="relatorio-card">

                <h4>Adoções</h4>


                <div class="relatorio-grafico-circulo">
                    100%
                </div>


                <ul class="relatorio-legenda">

                    <li>Adoções concluídas - <?= $adocoes ?>%</li>

                    <li>Animais disponíveis - <?= $animais ?>%</li>

                    <li>Publicações pendentes - <?= $pendentes ?>%</li>

                    <li>Acessos ao site - 15%</li>

                </ul>


            </div>

            <!-- PUBLICAÇÕES -->

            <div class="relatorio-card">


                <h4>Estatísticas de Publicações</h4>


                <div class="relatorio-grafico-barras">

                    <div class="bar" style="height: 30%"></div>
                    <div class="bar" style="height: 60%"></div>
                    <div class="bar" style="height: 45%"></div>
                    <div class="bar" style="height: 80%"></div>
                    <div class="bar" style="height: 55%"></div>
                    <div class="bar" style="height: 70%"></div>
                    <div class="bar" style="height: 40%"></div>

                </div>

                <div class="relatorio-dias">
                    <span>Dom</span>
                    <span>Seg</span>
                    <span>Ter</span>
                    <span>Qua</span>
                    <span>Qui</span>
                    <span>Sex</span>
                    <span>Sáb</span>
                </div>


                <p>
                    Publicações concluídas: 87
                </p>


            </div>
            <!-- USUARIOS -->

            <div class="relatorio-card">

                <h4>Interação dos usuários</h4>


                <p>Novos usuários cadastrados 56%</p>
                <div class="relatorio-linha">
                    <span style="width:56%"></span>
                </div>


                <p>Mensagens enviadas 40%</p>
                <div class="relatorio-linha">
                    <span style="width:40%"></span>
                </div>



                <p>Publicações rejeitadas 20%</p>
                <div class="relatorio-linha">
                    <span style="width:20%"></span>
                </div>



                <p>Adoções sucesso 72%</p>
                <div class="relatorio-linha">
                    <span style="width:72%"></span>
                </div>


            </div>

        </div>

        <button class="relatorio-btn-gerar" onclick="abrirModal()">
            Gerar relatório
        </button>


    </div>

    <div class="relatorio-modal" id="modalExport">
        <div class="relatorio-modal-box">

            <h2>Exportar relatório</h2>

            <p>
                Você está prestes a exportar os relatórios do sistema.
                Escolha o formato desejado para a exportação e confirme a ação.
            </p>

            <div class="relatorio-modal-opcoes">

                <label>
                    <input type="checkbox" id="csvCheck">
                    Exportar em CSV
                </label>

            </div>

            <div class="acoes-modal">

                <button class="btn-cancelar" onclick="fecharModal()">
                    Cancelar
                </button>

                <button class="btn-salvar" onclick="exportarRelatorio()">
                    Confirmar exportação
                </button>

            </div>
        </div>
    </div>

    <script>
        function abrirModal() {
            document.getElementById("modalExport").style.display = "flex";
        }

        function fecharModal() {
            document.getElementById("modalExport").style.display = "none";
        }

        function exportarRelatorio() {
            const csv = document.getElementById("csvCheck").checked;

            if (csv) {
                alert("Exportando relatório em CSV...");
                // aqui depois você liga no backend PHP
            } else {
                alert("Selecione um formato de exportação!");
            }

            fecharModal();
        }
    </script>

</body>