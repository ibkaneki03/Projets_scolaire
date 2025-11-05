<div class="container mt-4 p-4 bg-white rounded shadow">
  <h3><?= isset($leVehicule) ? "Modifier un Véhicule" : "Ajouter un Véhicule" ?></h3>

  <form method="post">
    <div class="row">
      <div class="col-md-4 mb-3">
        <label>Marque :</label>
        <input type="text" name="marque" value="<?= $leVehicule['marque'] ?? '' ?>" class="form-control" required>
      </div>
      <div class="col-md-4 mb-3">
        <label>Modèle :</label>
        <input type="text" name="modele" value="<?= $leVehicule['modele'] ?? '' ?>" class="form-control" required>
      </div>
      <div class="col-md-4 mb-3">
        <label>Année :</label>
        <input type="number" name="annee" value="<?= $leVehicule['annee'] ?? '' ?>" class="form-control" min="2000" max="2025">
      </div>
      <div class="col-md-6 mb-3">
        <label>Catégorie :</label>
        <input type="text" name="categorie" value="<?= $leVehicule['categorie'] ?? '' ?>" class="form-control">
      </div>
      <div class="col-md-6 mb-3">
        <label>Immatriculation :</label>
        <input type="text" name="immatriculation" value="<?= $leVehicule['immatriculation'] ?? '' ?>" class="form-control">
      </div>
    </div>

    <div class="text-end">
      <?php if (isset($leVehicule)): ?>
        <input type="hidden" name="idvehicule" value="<?= $leVehicule['idvehicule'] ?>">
        <button type="submit" name="Modifier" class="btn btn-warning">✏️ Modifier</button>
      <?php else: ?>
        <button type="submit" name="Valider" class="btn btn-primary">➕ Ajouter</button>
      <?php endif; ?>
    </div>
  </form>
</div>
