<?php

$host = 'localhost';
$porta = '5432';
$banco = 'ConectaPet';
$usuario = 'postgres';
$senha = '0000';

try {
    $conexao = new PDO(
        "pgsql:host=$host;port=$porta;dbname=$banco",
        $usuario,
        $senha
    );

    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $erro) {
    die("Erro ao conectar ao banco de dados: " . $erro->getMessage());
}