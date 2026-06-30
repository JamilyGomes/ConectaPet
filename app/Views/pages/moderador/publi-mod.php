<?php
$titulo = 'Publicações';
include './../../components/head/head2.php';
?>

<body>

    <?php include './../../components/nav/nav-mod/side-mod.php'; ?>
    <?php
    include './../../components/ace/acss.php';
    ?>
    <div class="main-content">

        <?php

        $tituloTabela = "Publicações";

        $publicacoes = [

            [
                'titulo' => 'Theo para adoção',
                'autor' => 'Julia',
                'data' => '31 out 2025',
                'status' => 'Pendente'
            ],

            [
                'titulo' => 'Mel para adoção',
                'autor' => 'Carlos',
                'data' => '01 nov 2025',
                'status' => 'Pendente'
            ],

            [
                'titulo' => 'Rex para adoção',
                'autor' => 'Amanda',
                'data' => '02 nov 2025',
                'status' => 'Pendente'
            ]

        ];

        include './../../components/mod-component/tab-publicacoes.php';

        ?>

    </div>

    <!-- MODAL RECUSAR PUBLICAÇÃO -->

    <div class="modal-recusa-mod" id="modalRecusa">

        <div class="caixa-recusa-mod">

            <h3>
                ⚠ Confirmar suspensão da publicação?
            </h3>

            <p>
                Escolha um ou mais motivos abaixo e,
                se necessário, escreva uma observação adicional.
            </p>

            <div class="motivos-mod">

                <label>
                    <input type="checkbox">
                    Informação falsa
                </label>

                <label>
                    <input type="checkbox">
                    Imagem inapropriada
                </label>

                <label>
                    <input type="checkbox">
                    Animal já adotado
                </label>

                <label>
                    <input type="checkbox">
                    Violação das regras de doação
                </label>

                <label>
                    <input type="checkbox">
                    Outro motivo
                </label>

            </div>

            <textarea
                placeholder="Observação adicional..."></textarea>

            <div class="botoes-recusa-mod">

                <button
                    class="cancelar-recusa-mod"
                    id="fecharRecusa">

                    Cancelar

                </button>

                <button type="button" class="confirmar-recusa-mod">
                    Confirmar suspensão
                </button>
            </div>

        </div>

    </div>

    <!-- MODAL VISUALIZAR PUBLICAÇÃO -->

    <div class="modal-publicacao-mod" id="modalPublicacao">

        <div class="caixa-publicacao-mod">

            <div class="header-publicacao-mod">

                <h2>Detalhes da publicação</h2>

                <button id="fecharPublicacao">
                    <i class="fas fa-times"></i>
                </button>

            </div>


            <!-- FOTOS -->

            <fieldset class="box-mod">

                <legend>Fotos do animal</legend>

                <div class="fotos-animal-mod">

                    <img src="./../../assets/img/dog-card.png">

                    <img src="./../../assets/img/dog-card.png">

                    <img src="./../../assets/img/dog-card.png">

                </div>

            </fieldset>


            <!-- DESCRIÇÃO -->

            <fieldset class="box-mod">

                <legend>Informações do animal</legend>

                <div class="descricao-animal-mod">

                    <p>
                        Olá! Estou buscando um novo lar amoroso para o Theo, um cachorro de 1 ano cheio de energia e muito carinhoso. Ele é saudável, brincalhão e adora correr, brincar e receber atenção. Theo gosta muito de interagir com as pessoas e é um ótimo companheiro para o dia a dia.
                        <br><br>

                        Ele está acostumado a conviver com pessoas e se adapta bem a um ambiente com carinho e cuidado.
                        <br><br>

                        O motivo da doação é que, no momento, não estamos conseguindo oferecer o tempo e a atenção que ele merece.
                    </p>

                </div>

            </fieldset>


            <!-- PERFIL -->

            <fieldset class="box-mod">

                <legend>Informações do perfil</legend>

                <div class="perfil-mod">

                    <div class="perfil-foto-mod">

                        <img src="./../../assets/img/ju.jpg">

                    </div>

                    <div class="perfil-info-mod">

                        <p><strong>Nome:</strong> Julia Souza</p>

                        <p><strong>Email:</strong> julia@email.com</p>

                        <p><strong>Telefone:</strong> (63)99999-9999</p>

                        <p><strong>Cidade:</strong> Campo Grande - MS</p>

                    </div>

                </div>

            </fieldset>

        </div>
    </div>

    <div class="modal-formulario-mod" id="modalFormulario">

        <div class="caixa-formulario-mod">

            <div class="header-formulario-mod">

                <h2>Questionário da Publicação</h2>

                <button onclick="fecharModalFormulario()">
                    <i class="fas fa-times"></i>
                </button>

            </div>

            <!-- DADOS DO PET -->

            <div class="grupo-formulario-mod">

                <h3>🐶 Dados do Animal</h3>

                <p><strong>Nome:</strong> Theo</p>
                <p><strong>Raça:</strong> Vira-lata</p>
                <p><strong>Tipo:</strong> Cachorro</p>
                <p><strong>Gênero:</strong> Macho</p>
                <p><strong>Vacinação:</strong> Vacinas em dia</p>
                <p><strong>Peso:</strong> 11-23kg</p>
                <p><strong>Castrado:</strong> Sim</p>

            </div>


            <!-- COMPORTAMENTO -->

            <div class="grupo-formulario-mod">

                <h3>🐾 Comportamento</h3>

                <p><strong>Interação com pessoas:</strong> Sociável e amigável</p>

                <p><strong>Convive com outros animais:</strong> Sim, com todos</p>

                <p><strong>Convive com crianças:</strong> Sim</p>

                <p><strong>Ambiente:</strong> Casa com quintal</p>

                <p><strong>Problemas de saúde:</strong> Não, saudável</p>

            </div>


            <!-- HISTÓRICO -->

            <div class="grupo-formulario-mod">

                <h3>📜 Histórico</h3>

                <p><strong>Motivo da doação:</strong> Falta de tempo</p>

                <p><strong>Como adquiriu:</strong> Resgate da rua</p>

                <p><strong>Tempo com o animal:</strong> 1 a 3 anos</p>

            </div>


            <!-- COMPROMISSOS -->

            <div class="grupo-formulario-mod">

                <h3>🏥 Cuidados e Compromissos</h3>

                <p><strong>Itens fornecidos:</strong> Ração + Carteira vacinação</p>

                <p><strong>Levou ao veterinário:</strong> Sim</p>

                <p><strong>Aceita fornecer info adicional:</strong> Sim</p>

                <p><strong>Quer atualizações:</strong> Sim</p>

            </div>
        </div>
    </div>

    <script src="../../assets/js/publi.js"></script>
</body>