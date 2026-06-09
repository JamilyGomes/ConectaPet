<?php

$titulo = 'Home Moderador';

include './../../components/head/head.php';

?>

<body>

    <?php include './../../components/nav/nav-mod/side-mod.php'; ?>

    <main class="conteudo">

        <?php include __DIR__ . '/../../components/mod-component/modal-solicitacao.php'; ?>

        <?php include __DIR__ . '/../../components/mod-component/tabela-solicitacao.php'; ?>

    </main>

    <script src="../assets/js/solicitacoes.js"></script>

</body>