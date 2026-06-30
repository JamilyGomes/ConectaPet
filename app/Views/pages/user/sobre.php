<?php
$titulo = 'Sobre Nós';
include './../../components/head/head.php';
?>

<link rel="stylesheet" href="./sobre.css">

<body>

    <?php include './../../components/nav/navBar.php'; ?>

    <section class="sobre-hero">

        <div class="sobre-wave"></div>

        <div class="sobre-hero-conteudo">

            <div class="sobre-logo">
                <img src="../../assets/img/logo.png">
            </div>
            <h1>Conecta Pet</h1>

            <p>
                Uma plataforma criada para conectar animais que precisam
                de cuidado com pessoas dispostas a oferecer amor,
                adoção responsável e uma nova oportunidade.
            </p>

        </div>

    </section>


    <section class="sobre-cards">

        <div class="sobre-card-info">
            <h3>Missão</h3>
            <p>
                Aproximar animais abandonados de famílias responsáveis,
                facilitando adoções seguras.
            </p>
        </div>

        <div class="sobre-card-info">
            <h3>Visão</h3>
            <p>
                Construir um futuro onde todo animal tenha um lar,
                proteção e qualidade de vida.
            </p>
        </div>

        <div class="sobre-card-info">
            <h3>Valores</h3>
            <p>
                Respeito, cuidado, empatia e compromisso com a causa animal.
            </p>
        </div>

    </section>


    <section class="sobre-historia">

        <h2>Por que criamos o Conecta Pet?</h2>

        <p>
            Muitos animais ainda vivem em situação de abandono e diversas ONGs
            enfrentam dificuldades para divulgar adoções e arrecadar ajuda.
            O Conecta Pet surgiu para aproximar essas instituições das pessoas,
            criando uma ponte entre solidariedade e cuidado animal.
        </p>

    </section>


    <section class="sobre-timeline">

        <h2>Nossa Jornada</h2>

        <div class="sobre-linha">

            <div class="sobre-etapa">
                <div class="sobre-circulo">01</div>
                <p>Ideia do projeto</p>
            </div>

            <div class="sobre-etapa">
                <div class="sobre-circulo">02</div>
                <p>Planejamento</p>
            </div>

            <div class="sobre-etapa">
                <div class="sobre-circulo">03</div>
                <p>Desenvolvimento</p>
            </div>

            <div class="sobre-etapa">
                <div class="sobre-circulo">04</div>
                <p>Ajudar mais animais</p>
            </div>

        </div>

    </section>

    <?php include './../../components/footer/footer.php'; ?>


</body>