<?php

session_start();

header('Content-Type: application/json');

if (
    !isset($_SESSION['id_usuario']) ||
    !in_array($_SESSION['tipo_usuario'] ?? '', ['adm', 'mod'])
) {
    http_response_code(403);
    echo json_encode(['erro' => 'Acesso não autorizado.']);
    exit;
}

require_once __DIR__ . '/../../config/conexao.php';

$dados = json_decode(file_get_contents('php://input'), true);

$id_animal = filter_var(
    $dados['id_animal'] ?? null,
    FILTER_VALIDATE_INT
);

$status = $dados['status'] ?? '';

$motivos = $dados['motivos'] ?? [];
$observacao = trim($dados['observacao'] ?? '');

if (
    !$id_animal ||
    !in_array($status, ['Aprovado', 'Recusado'])
) {
    http_response_code(400);
    echo json_encode(['erro' => 'Dados inválidos.']);
    exit;
}

if (!is_array($motivos)) {
    $motivos = [];
}

$motivos = array_filter($motivos, 'is_string');
$motivoTexto = implode(', ', $motivos);

if (
    $status === 'Recusado' &&
    $motivoTexto === '' &&
    $observacao === ''
) {
    http_response_code(400);
    echo json_encode(['erro' => 'Informe o motivo da recusa.']);
    exit;
}

try {

    $verifica = $conexao->prepare(
        "SELECT id_animal FROM animais WHERE id_animal = :id_animal"
    );

    $verifica->execute([
        ':id_animal' => $id_animal
    ]);

    if (!$verifica->fetchColumn()) {
        http_response_code(404);
        echo json_encode(['erro' => 'Publicação não encontrada.']);
        exit;
    }

    if ($status === 'Recusado') {

        $sql = "
            UPDATE animais
            SET
                status = :status,
                motivo_recusa = :motivo,
                observacao_recusa = :observacao
            WHERE id_animal = :id_animal
        ";

        $consulta = $conexao->prepare($sql);

        $consulta->execute([
            ':status' => $status,
            ':motivo' => $motivoTexto,
            ':observacao' => $observacao,
            ':id_animal' => $id_animal
        ]);

    } else {

        $sql = "
            UPDATE animais
            SET
                status = :status,
                motivo_recusa = NULL,
                observacao_recusa = NULL
            WHERE id_animal = :id_animal
        ";

        $consulta = $conexao->prepare($sql);

        $consulta->execute([
            ':status' => $status,
            ':id_animal' => $id_animal
        ]);
    }

    echo json_encode([
        'sucesso' => true,
        'mensagem' => 'Status atualizado.'
    ]);

} catch (PDOException $erro) {

    http_response_code(500);

    echo json_encode([
        'erro' => 'Erro ao atualizar publicação.'
    ]);
}