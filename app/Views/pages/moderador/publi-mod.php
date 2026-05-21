<?php
$titulo = 'Publicações';
include './../../components/head/head.php';
?>

<body>

    <?php include './../../components/nav/nav-mod/side-mod.php'; ?>
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

    <script>
        const modalRecusa = document.getElementById("modalRecusa");

        let linhaSelecionada = null;


        /* ABRIR MODAL */

        document.querySelectorAll(".recusar-mod")
            .forEach(botao => {

                botao.addEventListener("click", function() {

                    // guarda a linha clicada
                    linhaSelecionada = this.closest(".linha-mod");

                    // abre modal
                    modalRecusa.style.display = "flex";

                });

            });


        /* FECHAR BOTÃO */

        document
            .getElementById("fecharRecusa")
            .addEventListener("click", function() {

                modalRecusa.style.display = "none";

            });


        /* FECHAR CLICANDO FORA */

        modalRecusa.addEventListener("click", function(e) {

            if (e.target === modalRecusa) {

                modalRecusa.style.display = "none";

            }

        });


        /* CONFIRMAR */

        document
            .querySelector(".confirmar-recusa-mod")
            .addEventListener("click", function(e) {

                e.preventDefault();

                if (!linhaSelecionada) {
                    return;
                }

                let status = linhaSelecionada.querySelector(".status-mod");

                let textarea = document.querySelector(
                    ".caixa-recusa-mod textarea"
                );

                let checkSelecionado = document.querySelectorAll(
                    ".motivos-mod input:checked"
                );


                // precisa escolher algo
                if (
                    checkSelecionado.length === 0 &&
                    textarea.value.trim() === ""
                ) {

                    alert(
                        "Selecione um motivo ou escreva uma observação"
                    );

                    return;
                }


                // muda status
                status.textContent = "Recusado";

                status.classList.remove(
                    "pendente-mod",
                    "aprovado-mod"
                );

                status.classList.add(
                    "recusado-mod"
                );


                // limpa checkbox
                document
                    .querySelectorAll(".motivos-mod input")
                    .forEach(item => {

                        item.checked = false;

                    });


                // limpa textarea
                textarea.value = "";


                // fecha modal
                modalRecusa.style.display = "none";

            });

        /* APROVAR PUBLICAÇÃO */

        document.querySelectorAll(".aprovar-mod")
            .forEach(botao => {

                botao.addEventListener("click", function() {

                    let linha = this.closest(".linha-mod");

                    let status = linha.querySelector(".status-mod");

                    // muda texto
                    status.textContent = "Aprovado";

                    // remove outras classes
                    status.classList.remove(
                        "pendente-mod",
                        "recusado-mod"
                    );

                    // adiciona aprovado
                    status.classList.add(
                        "aprovado-mod"
                    );

                });

            });

        /* MODAL VISUALIZAR */

        const modalPublicacao =
            document.getElementById(
                "modalPublicacao"
            );


        document
            .querySelectorAll(
                ".visualizar-mod"
            )

            .forEach(botao => {

                botao.addEventListener(
                    "click",

                    function(e) {

                        e.preventDefault();

                        modalPublicacao.style.display =
                            "flex";

                    });

            });


        document
            .getElementById(
                "fecharPublicacao"
            )

            .addEventListener(
                "click",

                () => {

                    modalPublicacao.style.display =
                        "none";

                });


        modalPublicacao
            .addEventListener(
                "click",

                function(e) {

                    if (
                        e.target === modalPublicacao
                    ) {

                        modalPublicacao.style.display =
                            "none";

                    }

                });
    </script>


</body>