
<?php

session_start();

require_once __DIR__ . '/../../config/conexao.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    http_response_code(401);
    exit('Usuário não autenticado.');
}

// Recebe os dados enviados pelo formulário
$dados = json_decode(file_get_contents('php://input'), true);

if (!$dados) {
    exit('Não foi possível receber os dados da doação.');
}

// Recupera a foto salva na primeira etapa
$foto = $_SESSION['foto_doacao'] ?? null;

if (!$foto) {
    exit('Foto do animal não encontrada. Volte à primeira etapa.');
}

try {

    $conexao->beginTransaction();

    // 1. Salva os dados principais do animal
    $sqlAnimal = "INSERT INTO animais (
        id_usuario,
        nome,
        raca,
        idade_aproximada,
        tipo_animal,
        outro_tipo,
        genero,
        vacinado,
        peso,
        castrado,
        email,
        telefone,
        localizacao,
        foto,
        mensagem
    ) VALUES (
        :id_usuario,
        :nome,
        :raca,
        :idade,
        :tipo_animal,
        :outro_tipo,
        :genero,
        :vacinado,
        :peso,
        :castrado,
        :email,
        :telefone,
        :localizacao,
        :foto,
        :mensagem
    ) RETURNING id_animal";

    $stmtAnimal = $conexao->prepare($sqlAnimal);

    $stmtAnimal->execute([
        ':id_usuario' => $_SESSION['id_usuario'],
        ':nome' => $dados['nome'],
        ':raca' => $dados['raca'] ?? null,
        ':idade' => $dados['idade'],
        ':tipo_animal' => $dados['tipoAnimal'],
        ':outro_tipo' => $dados['outro_tipo'] ?? null,
        ':genero' => $dados['genero'],
        ':vacinado' => $dados['vacinado'],
        ':peso' => $dados['peso'],
        ':castrado' => $dados['castrado'],
        ':email' => $dados['email'],
        ':telefone' => $dados['telefone'],
        ':localizacao' => $dados['localizacao'],
        ':foto' => $foto,
        ':mensagem' => $dados['mensagem'] ?? null
    ]);

    $idAnimal = $stmtAnimal->fetchColumn();

    // 2. Salva o comportamento do animal
    $sqlComportamento = "INSERT INTO comportamento_animais (
        id_animal,
        interacao_pessoas,
        detalhes_interacao,
        convivencia_animais,
        especies_convivencia,
        convivencia_criancas,
        ambiente,
        cuidados_especiais,
        detalhes_saude
    ) VALUES (
        :id_animal,
        :interacao_pessoas,
        :detalhes_interacao,
        :convivencia_animais,
        :especies_convivencia,
        :convivencia_criancas,
        :ambiente,
        :cuidados_especiais,
        :detalhes_saude
    )";

    $stmtComportamento = $conexao->prepare($sqlComportamento);

    $stmtComportamento->execute([
        ':id_animal' => $idAnimal,
        ':interacao_pessoas' => $dados['interacao_pessoas'] ?? null,
        ':detalhes_interacao' => $dados['detalhes_interacao'] ?? null,
        ':convivencia_animais' => $dados['convivencia_animais'] ?? null,
        ':especies_convivencia' => $dados['especies_convivencia'] ?? null,
        ':convivencia_criancas' => $dados['convivencia_criancas'] ?? null,
        ':ambiente' => $dados['ambiente'] ?? null,
        ':cuidados_especiais' => $dados['cuidados_especiais'] ?? null,
        ':detalhes_saude' => $dados['detalhes_saude'] ?? null
    ]);

    // 3. Salva o histórico da doação
    $sqlHistorico = "INSERT INTO historico_doacao (
        id_animal,
        motivo_doacao,
        detalhes_motivo,
        como_adquiriu,
        detalhes_aquisicao,
        tempo_com_animal
    ) VALUES (
        :id_animal,
        :motivo_doacao,
        :detalhes_motivo,
        :como_adquiriu,
        :detalhes_aquisicao,
        :tempo_com_animal
    )";

    $stmtHistorico = $conexao->prepare($sqlHistorico);

    $stmtHistorico->execute([
        ':id_animal' => $idAnimal,
        ':motivo_doacao' => $dados['motivo_doacao'] ?? null,
        ':detalhes_motivo' => $dados['detalhes_motivo'] ?? null,
        ':como_adquiriu' => $dados['como_adquiriu'] ?? null,
        ':detalhes_aquisicao' => $dados['detalhes_aquisicao'] ?? null,
        ':tempo_com_animal' => $dados['tempo_com_animal'] ?? null
    ]);

    // 4. Salva os itens e cuidados oferecidos
    $itens = $dados['itens[]'] ?? [];

    $sqlApoio = "INSERT INTO apoio_doacao (
        id_animal,
        itens,
        veterinario,
        info_adicional,
        atualizacoes
    ) VALUES (
        :id_animal,
        :itens,
        :veterinario,
        :info_adicional,
        :atualizacoes
    )";

    $stmtApoio = $conexao->prepare($sqlApoio);

    $stmtApoio->execute([
        ':id_animal' => $idAnimal,
        ':itens' => implode(', ', $itens),
        ':veterinario' => $dados['veterinario'] ?? null,
        ':info_adicional' => $dados['infoAdicional'] ?? null,
        ':atualizacoes' => $dados['atualizacoes'] ?? null
    ]);

    // Confirma as quatro gravações
    $conexao->commit();

    unset($_SESSION['foto_doacao']);

    echo 'sucesso';

} catch (Exception $erro) {

    if ($conexao->inTransaction()) {
        $conexao->rollBack();
    }

    http_response_code(500);
    exit('Erro ao salvar a doação: ' . $erro->getMessage());
}
