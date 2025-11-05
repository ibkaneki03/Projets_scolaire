<h3>Gestion des Cours</h3>
<?php
// ===== INSERT =====
if (isset($_POST['Valider'])) {
    $t = [
        ':dateheure'  => $_POST['dateheure'],
        ':duree'      => $_POST['duree'],
        ':idcandidat' => $_POST['idcandidat'],
        ':idmoniteur' => $_POST['idmoniteur'],
        ':idvehicule' => $_POST['idvehicule']
    ];
    $unControleur->insertCours($t);
}

// ===== UPDATE =====
if (isset($_POST['Modifier'])) {
    $t = [
        ':idcours'    => $_POST['idcours'],
        ':dateheure'  => $_POST['dateheure'],
        ':duree'      => $_POST['duree'],
        ':idcandidat' => $_POST['idcandidat'],
        ':idmoniteur' => $_POST['idmoniteur'],
        ':idvehicule' => $_POST['idvehicule']
    ];
    $unControleur->updateCours($t);
}

// ===== DELETE / EDIT =====
if (isset($_GET['action']) && isset($_GET['idcours'])) {
    $action  = $_GET['action'];
    $idcours = $_GET['idcours'];
    switch ($action) {
        case 'sup':
            $unControleur->deleteCours($idcours);
            break;
        case 'edit':
            $leCours = $unControleur->selectWhere('cours', 'idcours', $idcours);
            break;
    }
}

// ===== LISTES POUR LE FORMULAIRE =====
$lesCandidats = $unControleur->selectAllCandidats();
$lesMoniteurs = $unControleur->selectAllMoniteurs();
$lesVehicules = $unControleur->selectAllVehicules();

// ===== LISTE DES COURS (FILTRÉE OU NON) =====
if (isset($_GET['filtre']) && $_GET['filtre'] != '') {
    $mot      = $_GET['filtre'];
    $lesCours = $unControleur->selectAllCoursFiltre($mot);
} else {
    $lesCours = $unControleur->selectAllCours();
}

// ===== FORMULAIRE =====
require_once('vue/vue_insert_cours.php');
?>

<!-- Barre de recherche des cours -->
<form method="get" class="d-flex mb-3">
  <input type="hidden" name="page" value="4">
  <input type="text" name="filtre" class="form-control me-2"
         placeholder="Rechercher un cours (nom, moniteur, véhicule...)"
         value="<?= $_GET['filtre'] ?? '' ?>">
  <button type="submit" class="btn btn-outline-primary">🔍</button>
</form>

<?php
// ===== TABLEAU =====
require_once('vue/vue_select_cours.php');
?>
