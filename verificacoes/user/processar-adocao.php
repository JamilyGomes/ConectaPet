
<?php

session_start();

header('Content-Type: application/json; charset=utf-8');

// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    http_response_code(401);
    echo json_encode(['erro' => 'Usuário não está logado.']);
    exit;
}

// Conexão com o banco
require_once __DIR__ . '/../../config/conexao.php';

// Recebe os dados enviados pelo JavaScript
$dados = json_decode(file_get_contents('php://input'), true);

if (!$dados || !is_array($dados)) {
    http_response_code(400);
    echo json_encode(['erro' => 'Dados inválidos.']);
    exit;
}

$id_usuario = $_SESSION['id_usuario'];
$id_animal = filter_var($dados['id_animal'] ?? null, FILTER_VALIDATE_INT);

// Verifica o ID do animal
if (!$id_animal) {
    http_response_code(400);
    echo json_encode(['erro' => 'Animal não informado.']);
    exit;
}

// Verifica se o animal existe e não pertence ao próprio usuário
$verificar = $conexao->prepare(
    "SELECT id_animal FROM animais
     WHERE id_animal = :id_animal
     AND id_usuario <> :id_usuario"
);

$verificar->execute([
    ':id_animal' => $id_animal,
    ':id_usuario' => $id_usuario
]);

if (!$verificar->fetch()) {
    http_response_code(400);
    echo json_encode(['erro' => 'Animal não encontrado ou indisponível para esta solicitação.']);
    exit;
}

// Verifica o aceite do termo
$aceite = $dados['aceite'] ?? [];

if (!is_array($aceite) || !in_array('Sim', $aceite, true)) {
    http_response_code(400);
    echo json_encode(['erro' => 'É necessário aceitar o termo de responsabilidade.']);
    exit;
}

// Organiza a estrutura da residência
$estrutura = $dados['estrutura[]'] ?? [];

if (!is_array($estrutura)) {
    $estrutura = [];
}

$estrutura = implode(', ', $estrutura);

try {

    $conexao->beginTransaction();

    // 1. Questionário de residência
    $etapa = 'Questionário de residência';

    $sql = "INSERT INTO questionario_adocao
        (id_usuario, id_animal, tipo_residencia, outro_tipo,
         situacao_imovel, permite_animais, estrutura)
        VALUES
        (:usuario, :animal, :residencia, :outro,
         :imovel, :permite, :estrutura)
        RETURNING id_questionario";

    $stmt = $conexao->prepare($sql);

    $stmt->execute([
        ':usuario' => $id_usuario,
        ':animal' => $id_animal,
        ':residencia' => $dados['tipo_residencia'] ?? null,
        ':outro' => $dados['outro_tipo'] ?? null,
        ':imovel' => $dados['imovel'] ?? null,
        ':permite' => $dados['animais'] ?? null,
        ':estrutura' => $estrutura
    ]);

    $id_questionario = $stmt->fetchColumn();

    // 2. Conviventes
    $etapa = 'Conviventes';

    $sql = "INSERT INTO conviventes_adocao
        (id_questionario, quantidade_pessoas, criancas,
         numero_criancas, todos_concordam)
        VALUES (:questionario, :pessoas, :criancas, :numero, :concordam)";

    $stmt = $conexao->prepare($sql);

    $stmt->execute([
        ':questionario' => $id_questionario,
        ':pessoas' => $dados['pessoas'] ?? null,
        ':criancas' => $dados['criancas'] ?? null,
        ':numero' => !empty($dados['num_criancas'])
            ? $dados['num_criancas']
            : null,
        ':concordam' => $dados['concordam'] ?? null
    ]);

    // 3. Experiência com animais
    $etapa = 'Experiência com animais';

    $sql = "INSERT INTO experiencia_animais_adocao
        (id_questionario, teve_animais, possui_animais,
         descricao_animais, animais_vacinados)
        VALUES (:questionario, :teve, :possui, :descricao, :vacinados)";

    $stmt = $conexao->prepare($sql);

    $stmt->execute([
        ':questionario' => $id_questionario,
        ':teve' => $dados['teve_animais'] ?? null,
        ':possui' => $dados['possui_animais'] ?? null,
        ':descricao' => $dados['descricao_animais'] ?? null,
        ':vacinados' => $dados['vacinados'] ?? null
    ]);

    // 4. Rotina e cuidados
    $etapa = 'Rotina e cuidados';

    $sql = "INSERT INTO cuidados_adocao
        (id_questionario, horas_sozinho, responsavel, condicoes)
        VALUES (:questionario, :horas, :responsavel, :condicoes)";

    $stmt = $conexao->prepare($sql);

    $stmt->execute([
        ':questionario' => $id_questionario,
        ':horas' => $dados['horas_sozinho'] ?? null,
        ':responsavel' => $dados['responsavel'] ?? null,
        ':condicoes' => $dados['condicoes'] ?? null
    ]);

    // 5. Termo de responsabilidade
    $etapa = 'Termo de responsabilidade';

    $sql = "INSERT INTO termos_adocao
        (id_questionario, aceitou_termos, data_aceite)
        VALUES (:questionario, TRUE, CURRENT_TIMESTAMP)";

    $stmt = $conexao->prepare($sql);

    $stmt->execute([
        ':questionario' => $id_questionario
    ]);

    // 6. Registrar solicitação de adoção
    $sql = "INSERT INTO solicitacoes_adocao
        (id_usuario, id_animal, id_questionario, status)
        VALUES (:usuario, :animal, :questionario, 'Pendente')";

    $stmt = $conexao->prepare($sql);

    $stmt->execute([
        ':usuario' => $id_usuario,
        ':animal' => $id_animal,
        ':questionario' => $id_questionario
    ]);

    // Confirma todas as gravações
    $conexao->commit();

    echo json_encode([
        'sucesso' => true,
        'mensagem' => 'Solicitação registrada com sucesso!'
    ]);
} catch (PDOException $erro) {

    if ($conexao->inTransaction()) {
        $conexao->rollBack();
    }

    http_response_code(500);

    echo json_encode([
        'erro' => 'Não foi possível registrar a solicitação.',
        'etapa' => $etapa ?? 'Não identificada',
        'detalhes' => $erro->getMessage()
    ]);
}
