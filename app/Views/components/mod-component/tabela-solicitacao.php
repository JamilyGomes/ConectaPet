<div class="solicitacao-pi-container">

    <div class="solicitacao-pi-header">

        <h2>Solicitações de Adoção</h2>

        <select class="solicitacao-pi-filtro">
            <option>Todos</option>
            <option>Pendente</option>
            <option>Aprovado</option>
            <option>Recusado</option>
        </select>

    </div>

    <div class="solicitacao-pi-tabela">

        <div class="solicitacao-pi-tabela-head">

            <span>Adotante</span>
            <span>Animal</span>
            <span>Data</span>
            <span>Status</span>
            <span>Ações</span>

        </div>

        <?php for ($i = 1; $i <= 5; $i++): ?>

            <div class="solicitacao-pi-linha">

                <div class="solicitacao-pi-usuario">

                    <img src="../assets/img/user.png">

                    <div>
                        <strong>Carlos Silva</strong>
                        <small>carlos@email.com</small>
                    </div>

                </div>

                <span>Thor</span>

                <span>08/06/2026</span>

                <span class="solicitacao-pi-status pendente">
                    Pendente
                </span>

                <div class="solicitacao-pi-acoes">

                    <button onclick="abrirModalAdocao()">
                        <i class="fas fa-eye"></i>
                    </button>

                    <button>
                        <i class="fas fa-check"></i>
                    </button>

                    <button>
                        <i class="fas fa-times"></i>
                    </button>

                </div>

            </div>

        <?php endfor; ?>

    </div>

    <div class="solicitacao-pi-paginacao">

        <button>
            <i class="fas fa-chevron-left"></i>
        </button>

        <span class="ativo">1</span>
        <span>2</span>
        <span>3</span>

        <button>
            <i class="fas fa-chevron-right"></i>
        </button>

    </div>

</div>