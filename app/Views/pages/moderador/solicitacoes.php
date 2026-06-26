<?php

$titulo = 'Solicitações';

include './../../components/head/head2.php';
?>

<body>

    <?php include './../../components/nav/nav-mod/side-mod.php'; ?>

    <main class="conteudo">

        <?php include __DIR__ . '/../../components/mod-component/modal-solicitacao.php'; ?>

        <?php include __DIR__ . '/../../components/mod-component/tabela-solicitacao.php'; ?>

    </main>

    <script src="../../assets/js/solicitacao-mod.js"></script>

</body>