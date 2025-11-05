<div class="container mt-4 p-4 bg-white rounded shadow">
    <h3>Liste des Véhicules</h3>

    <form method="get" class="d-flex mb-3">
        <input type="hidden" name="page" value="3">
        <input type="text" name="filtre" placeholder="Rechercher un véhicule..." 
               class="form-control me-2" value="<?= $_GET['filtre'] ?? '' ?>">
        <button type="submit" class="btn btn-outline-primary">🔍</button>
    </form>

    <table class="table table-hover table-bordered">
        <thead>
            <tr class="text-center">
                <th>ID</th>
                <th>Marque</th>
                <th>Modèle</th>
                <th>Année</th>
                <th>Catégorie</th>
                <th>Immatriculation</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($lesVehicules as $unVehicule): ?>
            <tr class="align-middle">
                <td><?= $unVehicule['idvehicule'] ?></td>
                <td><?= $unVehicule['marque'] ?></td>
                <td><?= $unVehicule['modele'] ?></td>
                <td><?= $unVehicule['annee'] ?></td>
                <td><?= $unVehicule['categorie'] ?></td>
                <td><?= $unVehicule['immatriculation'] ?></td>
                <td class="text-center">
                    <a href="index.php?page=3&action=edit&idvehicule=<?= $unVehicule['idvehicule'] ?>" class="btn btn-sm btn-warning">✏️</a>
                    <a href="index.php?page=3&action=sup&idvehicule=<?= $unVehicule['idvehicule'] ?>" class="btn btn-sm btn-danger">🗑️</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
