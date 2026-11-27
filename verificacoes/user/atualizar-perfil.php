
<?php
session_start();

header('Content-Type: application/json; charset=utf-8');

if (!isset($_SESSION['id_usuario'])) {
    http_response_code(401);
    echo json_encode(['erro' => 'Sessão expirada. Faça login novamente.']);
    exit;
}

require_once __DIR__ . '/../../config/conexao.php';

$id_usuario = $_SESSION['id_usuario'];

try {
    // Busca os dados atuais
    $consulta = $conexao->prepare("
        SELECT nome, email, telefone, senha, foto_perfil
        FROM usuarios
        WHERE id_usuario = :id
    ");

    $consulta->execute([':id' => $id_usuario]);
    $usuario = $consulta->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        throw new Exception('Usuário não encontrado.');
    }

    // Mantém os dados atuais caso não sejam enviados
    $nome = trim($_POST['nome'] ?? $usuario['nome']);
    $email = trim($_POST['email'] ?? $usuario['email']);
    $telefone = trim($_POST['telefone'] ?? $usuario['telefone']);

    if ($nome === '' || $email === '' || $telefone === '') {
        throw new Exception('Preencha nome, e-mail e telefone.');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Informe um e-mail válido.');
    }

    // Verifica se o e-mail já pertence a outra conta
    $verificar = $conexao->prepare("
        SELECT id_usuario
        FROM usuarios
        WHERE email = :email
        AND id_usuario <> :id
    ");

    $verificar->execute([
        ':email' => $email,
        ':id' => $id_usuario
    ]);

    if ($verificar->fetch()) {
        throw new Exception('Este e-mail já está sendo utilizado.');
    }

    // Mantém a senha atual se não houver nova senha
    $senha = $usuario['senha'];

    $novaSenha = $_POST['senha'] ?? '';
    $confirmarSenha = $_POST['confirmarSenha'] ?? '';

    if ($novaSenha !== '' || $confirmarSenha !== '') {
        if ($novaSenha === '' || $confirmarSenha === '') {
            throw new Exception('Preencha os dois campos de senha.');
        }

        if ($novaSenha !== $confirmarSenha) {
            throw new Exception('As senhas não coincidem.');
        }

        if (strlen($novaSenha) < 8) {
            throw new Exception('A senha precisa ter pelo menos 8 caracteres.');
        }

        $senha = password_hash($novaSenha, PASSWORD_DEFAULT);
    }

    // Mantém a foto atual caso nenhuma nova seja enviada
    $foto = $usuario['foto_perfil'];

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] !== UPLOAD_ERR_NO_FILE) {

        if ($_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
            throw new Exception('Não foi possível enviar a foto.');
        }

        if ($_FILES['foto']['size'] > 3 * 1024 * 1024) {
            throw new Exception('A foto deve ter no máximo 3 MB.');
        }

        $arquivoTemporario = $_FILES['foto']['tmp_name'];

        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $tipo = $finfo->file($arquivoTemporario);

        $extensoes = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/webp' => 'webp'
        ];

        if (!isset($extensoes[$tipo])) {
            throw new Exception('Use uma imagem JPG, PNG ou WEBP.');
        }

        $pasta = __DIR__ . '/../../uploads/perfil/';

        if (!is_dir($pasta)) {
            mkdir($pasta, 0775, true);
        }

        $nomeArquivo = bin2hex(random_bytes(16)) . '.' . $extensoes[$tipo];

        if (!move_uploaded_file($arquivoTemporario, $pasta . $nomeArquivo)) {
            throw new Exception('Não foi possível salvar a foto.');
        }

        $foto = 'uploads/perfil/' . $nomeArquivo;
    }

    // Atualiza os dados no banco
    $atualizar = $conexao->prepare("
        UPDATE usuarios
        SET nome = :nome,
            email = :email,
            telefone = :telefone,
            senha = :senha,
            foto_perfil = :foto
        WHERE id_usuario = :id
    ");

    $atualizar->execute([
        ':nome' => $nome,
        ':email' => $email,
        ':telefone' => $telefone,
        ':senha' => $senha,
        ':foto' => $foto,
        ':id' => $id_usuario
    ]);

    echo json_encode([
        'sucesso' => true,
        'mensagem' => 'Perfil atualizado com sucesso!',
        'usuario' => [
            'nome' => $nome,
            'email' => $email,
            'telefone' => $telefone,
            'foto' => $foto
        ]
    ]);

} catch (Throwable $erro) {
    http_response_code(400);

    echo json_encode([
        'sucesso' => false,
        'erro' => $erro->getMessage()
    ]);
}
