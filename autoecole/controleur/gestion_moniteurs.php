<h3>Gestion des Moniteurs</h3>

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
    $unControleur->insertMoniteur($t);
}

// UPDATE
if (isset($_POST['Modifier'])) {
    $t = [
        ':idmoniteur' => $_POST['idmoniteur'],
        ':nom'        => $_POST['nom'],
        ':prenom'     => $_POST['prenom'],
        ':email'      => $_POST['email'],
        ':tel'        => $_POST['tel'],
        ':adresse'    => $_POST['adresse']
    ];
    $unControleur->updateMoniteur($t);
}

// DELETE / EDIT
if (isset($_GET['action']) && isset($_GET['idmoniteur'])) {
    $action = $_GET['action'];
    $idmoniteur = $_GET['idmoniteur'];
    switch ($action) {
        case 'sup':
            $unControleur->deleteMoniteur($idmoniteur);
            break;
        case 'edit':
            $leMoniteur = $unControleur->selectWhere("moniteur", "idmoniteur", $idmoniteur);
            break;
    }
}

// FILTRE
if (isset($_GET['filtre']) && $_GET['filtre'] != "") {
    $mot = $_GET['filtre'];
    $lesMoniteurs = $unControleur->selectAllMoniteursFiltre($mot);
} else {
    $lesMoniteurs = $unControleur->selectAllMoniteurs();
}

require_once("vue/vue_insert_moniteur.php");
?>

<!-- Barre de recherche -->
<form method="get" class="d-flex mb-3">
    <input type="hidden" name="page" value="2">
    <input type="text" name="filtre" placeholder="Rechercher un moniteur..."
           class="form-control me-2" value="<?= $_GET['filtre'] ?? '' ?>">
    <button type="submit" class="btn btn-outline-primary">🔍</button>
</form>

<?php require_once("vue/vue_select_moniteurs.php"); ?>