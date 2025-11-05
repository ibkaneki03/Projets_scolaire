<!DOCTYPE html>
<?php
    require_once ("controleur/controleur.class.php");
    $unControleur = new Controleur();
?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scolarité</title>
</head>
<body>
    <center>
         <h1> Site de scolarié IRIS </h1>
         <a href="index.php?page=1"><img src="images/logo.png" width="100px" height="100px"></a>
         <a href="index.php?page=2"><img src="images/classes.png" width="100px" height="100px"></a>
         <a href="index.php?page=3"><img src="images/etudiants.png" width="100px" height="100px"></a>
         <a href="index.php?page=4"><img src="images/profs.png" width="100px" height="100px"></a>
         <a href="index.php?page=5"><img src="images/matieres.jpg" width="100px" height="100px"></a>
         <?php
            if (isset($_GET['page'])) $page = $_GET['page'];
            else $page = 1;

            switch($page){
                case 1: require_once ("controleur/home.php"); break;
                case 2: require_once ("controleur/gestion_classes.php"); break;
                case 3: require_once ("controleur/gestion_etudiants.php"); break;
                case 4: require_once ("controleur/gestion_profs.php"); break;
                case 5: require_once ("controleur/gestion_matieres.php"); break;
                default: require_once ("controleur/erreur.php"); break;
            }
        ?>    
    </center>
</body>
</html>