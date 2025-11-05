<?php
session_start();
require_once("controleur/controleur.class.php");
$unControleur = new Controleur();

if (!isset($_SESSION['email'])) {
    header("Location: connexion.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <title>Auto-École</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css?v=<?php echo time(); ?>">
    <link rel="icon" type="image/png" href="./images/logo.jpg">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
      <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="index.php">
          <img src="images/logo.jpg" alt="Logo" width="40" height="40" class="me-2">
          <span>Auto-École</span>
        </a>
        <div class="navbar-nav">
          <a class="nav-link" href="index.php?page=1">Candidats</a>
          <a class="nav-link" href="index.php?page=2">Moniteurs</a>
          <a class="nav-link" href="index.php?page=3">Véhicules</a>
          <a class="nav-link" href="index.php?page=4">Cours</a>
          <a class="nav-link text-warning fw-semibold" href="deconnexion.php">Déconnexion</a>
        </div>
      </div>
    </nav>
  <main>
    <?php
    if (isset($_GET['page'])) {
      switch($_GET['page']){
        case 1: include("controleur/gestion_candidats.php"); break;
        case 2: include("controleur/gestion_moniteurs.php"); break;
        case 3: include("controleur/gestion_vehicules.php"); break;
        case 4: include("controleur/gestion_cours.php"); break;
        default: include("controleur/erreur.php");
      }
    } else {
      include("controleur/home.php");
    }
    ?>
  </main>

  <footer>
    &copy; <?php echo date("Y"); ?> - Auto-École — Projet BTS SIO
  </footer>
  </body>
</html>
