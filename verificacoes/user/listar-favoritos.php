<?php

session_start();

header('Content-Type: application/json; charset=utf-8');

if (!isset($_SESSION['id_usuario'])) {
    http_response_code(401);
    echo json_encode(['erro' => 'Faça login para visualizar seus favoritos.']);
    exit;
}

require_once __DIR__ . '/../../config/conexao.php';

$sql = "
    SELECT
        a.id_animal,
        a.nome,
        a.foto,
        a.localizacao,
        a.tipo_animal
    FROM favoritos f
    INNER JOIN animais a
        ON a.id_animal = f.id_animal
    WHERE f.id_usuario = :id_usuario
    AND a.status = 'Aprovado'
    ORDER BY a.nome
";

$consulta = $conexao->prepare($sql);

$consulta->execute([
    ':id_usuario' => $_SESSION['id_usuario']
]);

$favoritos = $consulta->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($favoritos);