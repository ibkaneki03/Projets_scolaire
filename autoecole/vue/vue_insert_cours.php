<div class="container mt-4 p-4 bg-white rounded shadow">
  <h3><?= isset($leCours) ? "Modifier un cours" : "Planifier un cours" ?></h3>

  <form method="post" class="row g-3">
    <?php if (isset($leCours)): ?>
      <input type="hidden" name="idcours" value="<?= $leCours['idcours'] ?>">
    <?php endif; ?>

    <div class="col-md-6">
      <label class="form-label">Date et heure :</label>
      <input type="datetime-local" name="dateheure" class="form-control"
             value="<?= isset($leCours['dateheure']) ? date('Y-m-d\TH:i', strtotime($leCours['dateheure'])) : '' ?>"
             required>
    </div>

    <div class="col-md-6">
      <label class="form-label">Durée (minutes) :</label>
      <input type="number" name="duree" class="form-control" min="15" max="240"
             value="<?= $leCours['duree'] ?? '' ?>" required>
    </div>

    <div class="col-md-4">
      <label class="form-label">Candidat :</label>
      <select name="idcandidat" class="form-select" required>
        <option value="">-- Choisir un candidat --</option>
        <?php foreach ($lesCandidats as $c): ?>
          <option value="<?= $c['idcandidat'] ?>"
            <?= (isset($leCours['idcandidat']) && $leCours['idcandidat'] == $c['idcandidat']) ? 'selected' : '' ?>>
            <?= $c['nom'] ?> <?= $c['prenom'] ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="col-md-4">
      <label class="form-label">Moniteur :</label>
      <select name="idmoniteur" class="form-select" required>
        <option value="">-- Choisir un moniteur --</option>
        <?php foreach ($lesMoniteurs as $m): ?>
          <option value="<?= $m['idmoniteur'] ?>"
            <?= (isset($leCours['idmoniteur']) && $leCours['idmoniteur'] == $m['idmoniteur']) ? 'selected' : '' ?>>
            <?= $m['nom'] ?> <?= $m['prenom'] ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="col-md-4">
      <label class="form-label">Véhicule :</label>
      <select name="idvehicule" class="form-select" required>
        <option value="">-- Choisir un véhicule --</option>
        <?php foreach ($lesVehicules as $v): ?>
          <option value="<?= $v['idvehicule'] ?>"
            <?= (isset($leCours['idvehicule']) && $leCours['idvehicule'] == $v['idvehicule']) ? 'selected' : '' ?>>
            <?= $v['marque'] ?> <?= $v['modele'] ?> (<?= $v['immatriculation'] ?>)
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="col-12 text-end">
      <?php if (isset($leCours)): ?>
        <button type="submit" name="Modifier" class="btn btn-warning">✏️ Modifier</button>
        <a href="index.php?page=4" class="btn btn-secondary">Annuler</a>
      <?php else: ?>
        <button type="submit" name="Valider" class="btn btn-primary">➕ Ajouter</button>
      <?php endif; ?>
    </div>
  </form>
</div>
