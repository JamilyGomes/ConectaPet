<?php

session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    http_response_code(401);
    exit('Usuário não autenticado.');
}

// Verifica se a foto foi enviada
if (!isset($_FILES['foto']) || $_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
    exit('Erro ao enviar a foto.');
}

// Limite de 5 MB
if ($_FILES['foto']['size'] > 5 * 1024 * 1024) {
    exit('A foto deve ter no máximo 5 MB.');
}

// Verifica o tipo real do arquivo
$tiposPermitidos = [
    'image/jpeg' => 'jpg',
    'image/png' => 'png',
    'image/webp' => 'webp'
];

$arquivoTemporario = $_FILES['foto']['tmp_name'];

$tipoArquivo = mime_content_type($arquivoTemporario);

if (!isset($tiposPermitidos[$tipoArquivo])) {
    exit('Formato de imagem não permitido.');
}

// Gera um nome aleatório
$extensao = $tiposPermitidos[$tipoArquivo];
$nomeArquivo = bin2hex(random_bytes(16)) . '.' . $extensao;

// Caminho da pasta
$pastaDestino = __DIR__ . '/../../uploads/animais/';

if (!is_dir($pastaDestino)) {
    exit('Pasta de destino não encontrada.');
}

$caminhoDestino = $pastaDestino . $nomeArquivo;

// Move a foto
if (!move_uploaded_file($arquivoTemporario, $caminhoDestino)) {
    exit('Não foi possível salvar a foto.');
}

// Guarda o caminho na sessão
$_SESSION['foto_doacao'] = 'uploads/animais/' . $nomeArquivo;

echo 'Foto recebida com sucesso.';