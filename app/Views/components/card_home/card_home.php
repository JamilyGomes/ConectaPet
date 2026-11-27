<div class="card-home" data-id-animal="<?= (int) $animal['id_animal'] ?>">

    <img
        class="animal-card-home"
        src="/ConectaPet/<?= htmlspecialchars($animal['foto'] ?? '') ?>"
        alt="<?= htmlspecialchars($animal['nome']) ?>">

    <span class="texto-card-home">
        <h3>
            <?= htmlspecialchars($animal['nome']) ?>
            <?php if (!empty($animal['idade_aproximada'])): ?>
                - <?= htmlspecialchars($animal['idade_aproximada']) ?>
            <?php endif; ?>
        </h3>
    </span>

    <span
        class="material-symbols-outlined fav <?= in_array($animal['id_animal'], $favoritosIds) ? 'active' : '' ?>">
        pets
    </span>

    <a
        href="../../pages/user/info-animais.php?id_animal=<?= (int) $animal['id_animal'] ?>"
        class="btn-ver-card">
        Ver perfil <span>→</span>
    </a>

</div>