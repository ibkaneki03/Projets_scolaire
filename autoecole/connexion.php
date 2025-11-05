<?php
session_start();
require_once("controleur/controleur.class.php");
$unControleur = new Controleur();

$message = "";

if (isset($_POST['SeConnecter'])) {
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    $unUser = $unControleur->verifConnexion($email, $mdp);

    if ($unUser != null) {
        $_SESSION['email'] = $unUser['email'];
        $_SESSION['nom'] = $unUser['nom'];
        $_SESSION['idutilisateur'] = $unUser['idutilisateur'];
        header("Location: index.php");
        exit;
    } else {
        $message = "<div class='alert alert-danger'>Email ou mot de passe incorrect</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Connexion - Auto-École</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="./css/style.css?v=<?php echo time(); ?>">
</head>
<body class="d-flex align-items-center justify-content-center" style="min-height: 100vh; background: linear-gradient(135deg,#2196f3,#64b5f6);">

<div class="card shadow-lg p-4" style="width: 360px; border-radius: 16px;">
  <h3 class="text-center text-primary mb-3">🔐 Connexion</h3>
  <?php echo $message; ?>
  <form method="post">
    <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
    <input type="password" name="mdp" class="form-control mb-3" placeholder="Mot de passe" required>
    <button type="submit" name="SeConnecter" class="btn btn-primary w-100">Se connecter</button>
  </form>
</div>

</body>
</html>