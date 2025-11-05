<div class="container mt-3 p-3 bg-white rounded shadow">
  <h3>Liste des Cours</h3>

  <table class="table table-hover align-middle">
    <thead>
      <tr>
        <th>ID</th>
        <th>Date & heure</th>
        <th>Durée</th>
        <th>Candidat</th>
        <th>Moniteur</th>
        <th>Véhicule</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
    <?php if (!empty($lesCours)): ?>
      <?php foreach ($lesCours as $c): ?>
        <tr>
          <td><?= $c['idcours'] ?></td>
          <td><?= $c['dateheure'] ?></td>
          <td><?= $c['duree'] ?> min</td>
          <td><?= $c['candidat'] ?></td>
          <td><?= $c['moniteur'] ?></td>
          <td><?= $c['modele'] ?></td>
          <td>
            <a class="btn btn-sm btn-warning"
               href="index.php?page=4&action=edit&idcours=<?= $c['idcours'] ?>">✏️</a>
            <a class="btn btn-sm btn-danger"
               onclick="return confirm('Supprimer ce cours ?');"
               href="index.php?page=4&action=sup&idcours=<?= $c['idcours'] ?>">🗑️</a>
          </td>
        </tr>
      <?php endforeach; ?>
    <?php else: ?>
      <tr><td colspan="7" class="text-center text-muted">Aucun cours pour le moment.</td></tr>
    <?php endif; ?>
    </tbody>
  </table>
</div>
