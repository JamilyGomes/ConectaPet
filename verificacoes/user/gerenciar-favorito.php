<?php

session_start();

header('Content-Type: application/json');

if (!isset($_SESSION['id_usuario'])) {
    http_response_code(401);
    echo json_encode(['erro' => 'Faça login para favoritar animais.']);
    exit;
}

require_once __DIR__ . '/../../config/conexao.php';

$dados = json_decode(file_get_contents('php://input'), true);

$id_animal = filter_var(
    $dados['id_animal'] ?? null,
    FILTER_VALIDATE_INT
);

$acao = $dados['acao'] ?? '';

if (!$id_animal || !in_array($acao, ['adicionar', 'remover'])) {
    http_response_code(400);
    echo json_encode(['erro' => 'Dados inválidos.']);
    exit;
}

$id_usuario = $_SESSION['id_usuario'];

try {

    if ($acao === 'adicionar') {

        $sql = "
            INSERT INTO favoritos (id_usuario, id_animal)
            VALUES (:id_usuario, :id_animal)
            ON CONFLICT (id_usuario, id_animal) DO NOTHING
        ";
    } else {

        $sql = "
            DELETE FROM favoritos
            WHERE id_usuario = :id_usuario
            AND id_animal = :id_animal
        ";
    }

    $consulta = $conexao->prepare($sql);

    $consulta->execute([
        ':id_usuario' => $id_usuario,
        ':id_animal' => $id_animal
    ]);

    echo json_encode(['sucesso' => true]);
} catch (PDOException $erro) {

    http_response_code(500);
    echo json_encode(['erro' => 'Erro ao atualizar favorito.']);
}
