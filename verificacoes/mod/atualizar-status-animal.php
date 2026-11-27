<?php

session_start();

header('Content-Type: application/json; charset=utf-8');

// Verifica se o usuário é moderador ou administrador
if (
    !isset($_SESSION['id_usuario']) ||
    !in_array($_SESSION['tipo_usuario'], ['mod', 'adm'])
) {
    http_response_code(403);
    echo json_encode(['sucesso' => false, 'mensagem' => 'Acesso não autorizado.']);
    exit;
}

// Conexão com o banco de dados
require_once __DIR__ . '/../../config/conexao.php';

// Recebe o ID do animal
$id_animal = filter_input(INPUT_POST, 'id_animal', FILTER_VALIDATE_INT);

if (!$id_animal) {
    http_response_code(400);
    echo json_encode(['sucesso' => false, 'mensagem' => 'Animal inválido.']);
    exit;
}

try {
    // Busca o status atual
    $consulta = $conexao->prepare(
        "SELECT status FROM animais WHERE id_animal = :id"
    );

    $consulta->execute([':id' => $id_animal]);

    $animal = $consulta->fetch(PDO::FETCH_ASSOC);

    if (!$animal) {
        http_response_code(404);
        echo json_encode(['sucesso' => false, 'mensagem' => 'Animal não encontrado.']);
        exit;
    }

    // Alterna entre Adotado e Aprovado
    $novoStatus = ($animal['status'] === 'Adotado')
        ? 'Aprovado'
        : 'Adotado';

    $atualizar = $conexao->prepare(
        "UPDATE animais
         SET status = :status
         WHERE id_animal = :id"
    );

    $atualizar->execute([
        ':status' => $novoStatus,
        ':id' => $id_animal
    ]);

    echo json_encode([
        'sucesso' => true,
        'status' => $novoStatus
    ]);

} catch (PDOException $erro) {
    http_response_code(500);
    echo json_encode([
        'sucesso' => false,
        'mensagem' => 'Erro ao atualizar o status.'
    ]);
}