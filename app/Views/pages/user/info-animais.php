<?php

$titulo = 'Informações';

// Conexão com o banco de dados
require_once __DIR__ . '/../../../../config/conexao.php';

// Recebe o ID do animal pela URL
$id_animal = filter_input(INPUT_GET, 'id_animal', FILTER_VALIDATE_INT);

if (!$id_animal) {
    exit('Animal não informado.');
}

// Busca os dados do animal
$sql = "SELECT
            nome,
            foto,
            mensagem,
            telefone,
            email,
            localizacao
        FROM animais
        WHERE id_animal = :id_animal";

$consulta = $conexao->prepare($sql);
$consulta->execute([':id_animal' => $id_animal]);

$animal = $consulta->fetch(PDO::FETCH_ASSOC);

if (!$animal) {
    exit('Animal não encontrado.');
}

// Prepara as informações para o modal
$nome = $animal['nome'];

$imagem = !empty($animal['foto'])
    ? $animal['foto']
    : '../../assets/img/dog-card.png';

$descricao = !empty($animal['mensagem'])
    ? $animal['mensagem']
    : 'Nenhuma descrição disponível.';

$telefone = $animal['telefone'];
$email = $animal['email'];
$cidade = $animal['localizacao'];

?>

<?php include './../../components/head/head.php'; ?>

<body id="body-info-animais">

    <?php include './../../components/nav/navBar.php'; ?>

    <?php include './../../components/modal/modal-animais.php'; ?>

</body>

</html>