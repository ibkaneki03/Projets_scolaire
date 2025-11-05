<div class="container mt-4 p-4 bg-white rounded shadow">
  <h3><?= isset($leMoniteur) ? "Modifier un Moniteur" : "Ajouter un Moniteur" ?></h3>

  <form method="post">
    <div class="row">
      <div class="col-md-6 mb-3">
        <label>Nom :</label>
        <input type="text" name="nom" value="<?= $leMoniteur['nom'] ?? '' ?>" class="form-control" required>
      </div>
      <div class="col-md-6 mb-3">
        <label>Prénom :</label>
        <input type="text" name="prenom" value="<?= $leMoniteur['prenom'] ?? '' ?>" class="form-control" required>
      </div>
      <div class="col-md-6 mb-3">
        <label>Email :</label>
        <input type="email" name="email" value="<?= $leMoniteur['email'] ?? '' ?>" class="form-control" required>
      </div>
      <div class="col-md-6 mb-3">
        <label>Téléphone :</label>
        <input type="text" name="tel" value="<?= $leMoniteur['tel'] ?? '' ?>" class="form-control">
      </div>
      <div class="col-md-12 mb-3">
        <label>Adresse :</label>
        <input type="text" name="adresse" value="<?= $leMoniteur['adresse'] ?? '' ?>" class="form-control">
      </div>
    </div>

    <div class="text-end">
      <?php if (isset($leMoniteur)): ?>
        <input type="hidden" name="idmoniteur" value="<?= $leMoniteur['idmoniteur'] ?>">
        <button type="submit" name="Modifier" class="btn btn-warning">✏️ Modifier</button>
      <?php else: ?>
        <button type="submit" name="Valider" class="btn btn-primary">➕ Ajouter</button>
      <?php endif; ?>
    </div>
  </form>
</div>
