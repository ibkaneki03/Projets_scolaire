<h3>Gestion des Candidats</h3>

<?php
// INSERT
if (isset($_POST['Valider'])) {
    $t = [
        ':nom'     => $_POST['nom'],
        ':prenom'  => $_POST['prenom'],
        ':email'   => $_POST['email'],
        ':tel'     => $_POST['tel'],
        ':adresse' => $_POST['adresse']
    ];
    $unControleur->insertCandidat($t);
}

// UPDATE
if (isset($_POST['Modifier'])) {
    $t = [
        ':idcandidat' => $_POST['idcandidat'],
        ':nom'        => $_POST['nom'],
        ':prenom'     => $_POST['prenom'],
        ':email'      => $_POST['email'],
        ':tel'        => $_POST['tel'],
        ':adresse'    => $_POST['adresse']
    ];
    $unControleur->updateCandidat($t);
}

// DELETE / EDIT
if (isset($_GET['action']) && isset($_GET['idcandidat'])) {
    $action = $_GET['action'];
    $idcandidat = $_GET['idcandidat'];
    switch ($action) {
        case "sup":
            $unControleur->deleteCandidat($idcandidat);
            break;
        case "edit":
            $leCandidat = $unControleur->selectWhere("candidat", "idcandidat", $idcandidat);
            break;
    }
}

// FILTRE
if (isset($_GET['filtre']) && $_GET['filtre'] != "") {
    $mot = $_GET['filtre'];
    $lesCandidats = $unControleur->selectAllCandidatsFiltre($mot);
} else {
    $lesCandidats = $unControleur->selectAllCandidats();
}

require_once("vue/vue_insert_candidat.php");
?>

<!-- Barre de recherche -->
<form method="get" class="d-flex mb-3">
    <input type="hidden" name="page" value="1">
    <input type="text" name="filtre" placeholder="Rechercher un candidat..."
           class="form-control me-2" value="<?= $_GET['filtre'] ?? '' ?>">
    <button type="submit" class="btn btn-outline-primary">🔍</button>
</form>

<?php require_once("vue/vue_select_candidats.php"); ?>