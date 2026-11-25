<?php

session_start();
require_once __DIR__ . '/../../../../config/conexao.php';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /ConectaPet/app/Views/pages/user/cadastro.php');
    exit;
}

// Recebe os dados
$nome = trim($_POST['nome'] ?? '');
$cpf = preg_replace('/\D/', '', $_POST['cpf'] ?? '');
$telefone = trim($_POST['telefone'] ?? '');
$email = trim($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? '';
$confirmarSenha = $_POST['confirmarSenha'] ?? '';

// Guarda os dados para preencher novamente o formulário
$dadosFormulario = [
    'nome' => $nome,
    'cpf' => $cpf,
    'telefone' => $telefone,
    'email' => $email
];

// Função para voltar ao cadastro mantendo os dados
function voltarComErro($mensagem, $dados)
{
    $_SESSION['erro_cadastro'] = $mensagem;
    $_SESSION['dados_cadastro'] = $dados;

    header('Location: /ConectaPet/app/Views/pages/user/cadastro.php');
    exit;
}

// Verifica campos obrigatórios
if (
    empty($nome) ||
    empty($cpf) ||
    empty($telefone) ||
    empty($email) ||
    empty($senha) ||
    empty($confirmarSenha)
) {
    voltarComErro(
        'Preencha todos os campos obrigatórios.',
        $dadosFormulario
    );
}

//valida tel
$telefoneNumeros = preg_replace('/\D/', '', $telefone);

if (strlen($telefoneNumeros) !== 10 && strlen($telefoneNumeros) !== 11) {
    voltarComErro(
        'Telefone inválido. Digite o DDD e o número completo.',
        $dadosFormulario
    );
}

// Valida CPF
if (strlen($cpf) !== 11) {
    voltarComErro(
        'CPF inválido. Digite os 11 números corretamente.',
        $dadosFormulario
    );
}

// Valida e-mail
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    voltarComErro(
        'E-mail inválido. Digite um endereço válido.',
        $dadosFormulario
    );
}

// Valida a força da senha
if (strlen($senha) < 8) {
    voltarComErro(
        'A senha deve ter pelo menos 8 caracteres.',
        $dadosFormulario
    );
}

if (!preg_match('/[A-Z]/', $senha)) {
    voltarComErro(
        'A senha deve conter pelo menos uma letra maiúscula.',
        $dadosFormulario
    );
}

if (!preg_match('/[a-z]/', $senha)) {
    voltarComErro(
        'A senha deve conter pelo menos uma letra minúscula.',
        $dadosFormulario
    );
}

if (!preg_match('/[0-9]/', $senha)) {
    voltarComErro(
        'A senha deve conter pelo menos um número.',
        $dadosFormulario
    );
}

if (!preg_match('/[^a-zA-Z0-9]/', $senha)) {
    voltarComErro(
        'A senha deve conter pelo menos um caractere especial, como @, # ou !.',
        $dadosFormulario
    );
}

// Impede quatro ou mais caracteres iguais seguidos
if (preg_match('/(.)\1{3,}/', $senha)) {
    voltarComErro(
        'A senha não pode ter quatro ou mais caracteres iguais seguidos.',
        $dadosFormulario
    );
}

// Impede sequências de quatro letras ou números
$senhaMinuscula = strtolower($senha);
$sequenciaEncontrada = false;

for ($i = 0; $i < strlen($senhaMinuscula) - 3; $i++) {
    $trecho = substr($senhaMinuscula, $i, 4);

    if (
        preg_match('/^[0-9]{4}$/', $trecho) ||
        preg_match('/^[a-z]{4}$/', $trecho)
    ) {
        $ordens = array_map('ord', str_split($trecho));

        if (
            ($ordens[1] - $ordens[0] === 1 &&
                $ordens[2] - $ordens[1] === 1 &&
                $ordens[3] - $ordens[2] === 1) ||

            ($ordens[1] - $ordens[0] === -1 &&
                $ordens[2] - $ordens[1] === -1 &&
                $ordens[3] - $ordens[2] === -1)
        ) {
            $sequenciaEncontrada = true;
            break;
        }
    }
}

if ($sequenciaEncontrada) {
    voltarComErro(
        'A senha não pode conter sequências como 1234, 4321 ou abcd.',
        $dadosFormulario
    );
}

// Confere as senhas
if ($senha !== $confirmarSenha) {
    voltarComErro(
        'As senhas não coincidem. Verifique e tente novamente.',
        $dadosFormulario
    );
}

// Criptografa a senha
$senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

// Verifica se CPF ou e-mail já existem
$consulta = $conexao->prepare(
    "SELECT cpf, email FROM usuarios WHERE cpf = :cpf OR email = :email"
);

$consulta->execute([
    ':cpf' => $cpf,
    ':email' => $email
]);

$usuarioExistente = $consulta->fetch(PDO::FETCH_ASSOC);

if ($usuarioExistente) {

    if ($usuarioExistente['cpf'] === $cpf && $usuarioExistente['email'] === $email) {
        $mensagem = 'Este CPF e este e-mail já estão cadastrados.';
    } elseif ($usuarioExistente['cpf'] === $cpf) {
        $mensagem = 'Este CPF já está cadastrado.';
    } else {
        $mensagem = 'Este e-mail já está cadastrado.';
    }

    voltarComErro($mensagem, $dadosFormulario);
}

// Preparação da foto
$caminhoFoto = null;

if (isset($_FILES['foto']) && $_FILES['foto']['error'] !== UPLOAD_ERR_NO_FILE) {

    if ($_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
        die('Erro ao enviar a foto.');
    }

    // Limite de 2 MB
    if ($_FILES['foto']['size'] > 2 * 1024 * 1024) {
        die('A foto deve ter no máximo 2 MB.');
    }

    // Verifica o tipo real da imagem
    $tiposPermitidos = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/webp' => 'webp'
    ];

    $arquivoTemporario = $_FILES['foto']['tmp_name'];
    $tipoImagem = mime_content_type($arquivoTemporario);

    if (!isset($tiposPermitidos[$tipoImagem])) {
        die('Formato de imagem não permitido. Use JPG, PNG ou WEBP.');
    }

    // Gera um nome único
    $nomeArquivo = bin2hex(random_bytes(16)) . '.' . $tiposPermitidos[$tipoImagem];

    // Caminho da pasta
    $pastaDestino = __DIR__ . '/../../../../uploads/perfil/';

    if (!is_dir($pastaDestino)) {
        mkdir($pastaDestino, 0755, true);
    }

    $destino = $pastaDestino . $nomeArquivo;

    if (!move_uploaded_file($arquivoTemporario, $destino)) {
        die('Não foi possível salvar a foto.');
    }

    $caminhoFoto = 'uploads/perfil/' . $nomeArquivo;
}

// Insere o usuário
try {

    $sql = "INSERT INTO usuarios
            (nome, cpf, telefone, email, senha, foto_perfil)
            VALUES
            (:nome, :cpf, :telefone, :email, :senha, :foto_perfil)";

    $inserir = $conexao->prepare($sql);

    $inserir->execute([
        ':nome' => $nome,
        ':cpf' => $cpf,
        ':telefone' => $telefone,
        ':email' => $email,
        ':senha' => $senhaCriptografada,
        ':foto_perfil' => $caminhoFoto
    ]);

    header('Location: cadastro2.php');
    exit;
} catch (PDOException $erro) {

    // Remove a foto caso o cadastro falhe
    if ($caminhoFoto !== null && isset($destino) && file_exists($destino)) {
        unlink($destino);
    }

    die('Erro ao realizar cadastro: ' . $erro->getMessage());
}
