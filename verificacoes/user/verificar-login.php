<?php

session_start();

require_once __DIR__ . '/../../config/conexao.php';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /ConectaPet/app/Views/pages/user/login.php');
    exit;
}

// Recebe os dados
$email = trim($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? '';

// Verifica se os campos foram preenchidos
if (empty($email) || empty($senha)) {
    $_SESSION['erro_login'] = 'Preencha todos os campos.';
    header('Location: /ConectaPet/app/Views/pages/user/login.php');
    exit;
}

try {

    // Busca o usuário pelo e-mail
    $sql = "SELECT id_usuario, nome, email, senha
            FROM usuarios
            WHERE email = :email";

    $consulta = $conexao->prepare($sql);

    $consulta->execute([
        ':email' => $email
    ]);

    $usuario = $consulta->fetch(PDO::FETCH_ASSOC);

    // Verifica se o usuário existe e se a senha está correta
    if ($usuario && password_verify($senha, $usuario['senha'])) {

        // Regenera o identificador da sessão
        session_regenerate_id(true);

        // Armazena os dados do usuário na sessão
        $_SESSION['id_usuario'] = $usuario['id_usuario'];
        $_SESSION['nome_usuario'] = $usuario['nome'];
        $_SESSION['email_usuario'] = $usuario['email'];

        header('Location: /ConectaPet/app/Views/pages/user/home.php');
        exit;

    } else {

        $_SESSION['erro_login'] = 'E-mail ou senha incorretos.';

        header('Location: /ConectaPet/app/Views/pages/user/login.php');
        exit;
    }

} catch (PDOException $erro) {

    die('Erro ao realizar login: ' . $erro->getMessage());

}