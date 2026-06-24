<?php
$tituloTabela = $tituloTabela ?? 'Publicações';
$publicacoes = $publicacoes ?? [];
?>

<div class="admin-container-mod">

    <div class="header-home-mod">
        <div class="overlay-home-mod">
            <h1>Publicações</h1>
            <p>Painel de gerenciamento das publicações e solicitações.</p>
        </div>
    </div>
    <div class="topo-tabela-mod">

        <div class="filtro-mod">

            <select>
                <option>Status</option>
                <option>Pendente</option>
                <option>Aprovado</option>
                <option>Recusado</option>
            </select>

        </div>

    </div>

    <div class="tabela-mod">

        <div class="tabela-header-mod publicacao-header-mod">

            <span>Publicação</span>
            <span>Autor</span>
            <span>Data de envio</span>
            <span>Status</span>
            <span>Ações</span>

        </div>

        <?php foreach ($publicacoes as $p): ?>

            <div class="linha-mod publicacao-linha-mod">

                <span>"<?= $p['titulo'] ?>"</span>

                <span><?= $p['autor'] ?></span>

                <span><?= $p['data'] ?></span>

                <span class="status-mod pendente-mod">
                    <?= $p['status'] ?>
                </span>

                <div class="acoes-mod">

                    <button class="btn-acao-mod visualizar-mod">
                        <i class="fas fa-eye"></i>
                    </button>

                    <button class="btn-acao-mod aprovar-mod">
                        <i class="fas fa-check"></i>
                    </button>

                    <button class="btn-acao-mod recusar-mod">
                        <i class="fas fa-times"></i>
                    </button>

                </div>

            </div>

        <?php endforeach ?>

    </div>

</div>