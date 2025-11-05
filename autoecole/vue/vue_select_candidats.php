<div class="container mt-4 p-4 bg-white rounded shadow">
    <h3>Liste des Candidats</h3>

    <!-- Barre de recherche -->
    <form method="get" class="d-flex mb-3">
        <input type="hidden" name="page" value="1">
        <input type="text" name="filtre" placeholder="Rechercher un candidat..." 
               class="form-control me-2" value="<?= $_GET['filtre'] ?? '' ?>">
        <button type="submit" class="btn btn-outline-primary">🔍</button>
    </form>

    <table class="table table-hover table-bordered">
        <thead>
            <tr class="text-center">
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Adresse</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($lesCandidats as $unCandidat): ?>
            <tr class="align-middle">
                <td><?= $unCandidat['idcandidat'] ?></td>
                <td><?= $unCandidat['nom'] ?></td>
                <td><?= $unCandidat['prenom'] ?></td>
                <td><?= $unCandidat['email'] ?></td>
                <td><?= $unCandidat['tel'] ?></td>
                <td><?= $unCandidat['adresse'] ?></td>
                <td class="text-center">
                    <a href="index.php?page=1&action=edit&idcandidat=<?= $unCandidat['idcandidat'] ?>" class="btn btn-sm btn-warning">✏️</a>
                    <a href="index.php?page=1&action=sup&idcandidat=<?= $unCandidat['idcandidat'] ?>" class="btn btn-sm btn-danger">🗑️</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
