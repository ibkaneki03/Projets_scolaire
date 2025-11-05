<div class="container mt-4 p-4 bg-white rounded shadow">
    <h3>Liste des Moniteurs</h3>

    <form method="get" class="d-flex mb-3">
        <input type="hidden" name="page" value="2">
        <input type="text" name="filtre" placeholder="Rechercher un moniteur..." 
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
        <?php foreach ($lesMoniteurs as $unMoniteur): ?>
            <tr class="align-middle">
                <td><?= $unMoniteur['idmoniteur'] ?></td>
                <td><?= $unMoniteur['nom'] ?></td>
                <td><?= $unMoniteur['prenom'] ?></td>
                <td><?= $unMoniteur['email'] ?></td>
                <td><?= $unMoniteur['tel'] ?></td>
                <td><?= $unMoniteur['adresse'] ?></td>
                <td class="text-center">
                    <a href="index.php?page=2&action=edit&idmoniteur=<?= $unMoniteur['idmoniteur'] ?>" class="btn btn-sm btn-warning">✏️</a>
                    <a href="index.php?page=2&action=sup&idmoniteur=<?= $unMoniteur['idmoniteur'] ?>" class="btn btn-sm btn-danger">🗑️</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
