<?php
$titulo = 'Meu Perfil';
include './../../components/head/head.php';
?>

<link rel="stylesheet" href="./perfil_usuario.css">

<body>

  <?php include './../../components/nav/navBar.php'; ?>

  <main class="perfil-page">

    <!-- CARD PERFIL -->
    <section class="perfil-card">

      <div class="perfil-titulo">
        <span>Informações Pessoais</span>
      </div>

      <button class="btn-editar" id="abrirEditar">
        <i class="fa-solid fa-pen-to-square"></i>
      </button>

      <div class="perfil-grid">

        <div class="perfil-foto">
          <img
            src="https://img.freepik.com/fotos-premium/garota-feliz-segura-seu-amado-animal-de-estimacao-um-gato-britanico-escoces-vermelho-no-colo-e-acaricia-seu-pelo_121837-9908.jpg?semt=ais_hybrid&w=740&q=80"
            alt="Foto do usuário"
            id="fotoPerfil">
        </div>

        <div class="perfil-dados">

          <div class="campo">
            <span class="label">Nome:</span>
            <span class="valor" id="perfilNome">Julia Rocha</span>
          </div>

          <div class="campo">
            <span class="label">Telefone:</span>
            <span class="valor" id="perfilTelefone">(67) 9999-9999</span>
          </div>

          <div class="campo">
            <span class="label">E-mail:</span>
            <span class="valor" id="perfilEmail">exemplo@gmail.com</span>
          </div>

        </div>

      </div>

    </section>


    <!-- MENU -->
    <section class="abas">

      <button class="aba ativa" data-aba="notificacoes">Notificações</button>

      <button class="aba" data-aba="adocao">Adoção</button>

      <button class="aba" data-aba="doacao">Doação</button>

    </section>


    <!-- CONTEÚDO -->
    <section class="conteudo-abas">

      <!-- NOTIFICAÇÕES -->
      <div class="painel ativo" id="notificacoes">

        <div class="lista-card">

          <div class="linha-item">
            <span class="tag aprovado">Aprovação</span>
            <p>É com grande alegria que informamos que seu pedido para adoção do animalzinho foi aprovado.</p>
          </div>

          <div class="linha-item">
            <span class="tag aprovado">Aprovação</span>
            <p>É com grande alegria que informamos que seu pedido para adoção do animalzinho foi aprovado.</p>
          </div>

          <div class="linha-item">
            <span class="tag aprovado">Aprovação</span>
            <p>É com grande alegria que informamos que seu pedido para adoção do animalzinho foi aprovado.</p>
          </div>

        </div>

      </div>


      <!-- ADOÇÃO -->
      <div class="painel" id="adocao">

        <div class="lista-card">

          <div class="linha-item">
            <span class="tag analise">Pedido</span>
            <p>Seu pedido de adoção está em análise no momento.</p>
          </div>

        </div>

      </div>


      <!-- DOAÇÃO -->
      <div class="painel" id="doacao">

        <div class="lista-card">

          <div class="linha-item">
            <span class="tag doacao">Doação</span>
            <p>Muito obrigado pela sua contribuição para nossos animais.</p>
          </div>

        </div>

      </div>

    </section>

  </main>

  <!-- MODAL EDITAR PERFIL -->
  <!-- MODAL EDITAR PERFIL -->
  <div class="modaluser" id="modalEditar">

    <div class="modal2">

      <h3>Editar Perfil</h3>

      <form id="formEditarPerfil">

        <label>Telefone</label>

        <input
          type="text"
          name="telefone"
          id="telefone"
          value="(67) 9999-9999"
          maxlength="15"
          required>

        <label>E-mail</label>
        <input type="email" id="editEmail" value="exemplo@gmail.com" required>

        <!-- NOVA SENHA -->
        <label>Nova Senha</label>
        <div class="campo-senha">
          <input type="password" id="editSenha" placeholder="Digite a nova senha">

          <span class="material-symbols-outlined olho" data-senha="editSenha">
            visibility
          </span>
        </div>

        <!-- CONFIRMAR SENHA -->
        <label>Confirmar Senha</label>
        <div class="campo-senha">
          <input type="password" id="editConfirmar" placeholder="Confirme a senha">

          <span class="material-symbols-outlined olho" data-senha="editConfirmar">
            visibility
          </span>
        </div>

        <div class="perfil-foto">

          <img id="previewFoto"
            src="https://img.freepik.com/fotos-premium/garota-feliz-segura-seu-amado-animal-de-estimacao-um-gato-britanico-escoces-vermelho-no-colo-e-acaricia-seu-pelo_121837-9908.jpg?semt=ais_hybrid&w=740&q=80"
            alt="Foto do usuário">

          <!-- botão editar foto -->
          <button type="button" class="btn-foto" id="abrirInputFoto">
            <i class="fa-solid fa-camera"></i>
          </button>

          <!-- input escondido -->
          <input type="file" id="inputFoto" accept="image/*" hidden>

        </div>

        <div class="botoes-modal">
          <button type="button" class="btn-voltar" id="fecharEditar">Cancelar</button>
          <button type="submit" class="btn-concluir">Salvar</button>
        </div>

      </form>

    </div>

  </div>

  <script src="./../../assets/js/user/perfil_usuario.js" defer></script>

</body>