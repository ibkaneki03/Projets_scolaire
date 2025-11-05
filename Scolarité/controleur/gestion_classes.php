<h2> Gestion des classes </h2>
<?php

   

    $laClasse = null;
    if(isset($_GET['action']) and isset($_GET['idclasse'])){
        $action = $_GET['action'];
        $idclasse = $_GET['idclasse'];
        switch ($action){
            case 'edit':
                $laClasse = $unControleur->selectWhere_classe($idclasse);
                break;
            case 'sup':
                $unControleur->delete_classe($idclasse);
                break;
        }
    }   
    require_once ("vue/vue_insert_classe.php");

    if (isset($_POST['Valider'])){
        $unControleur->insert_classe($_POST);
        echo "<b> Insertion réussie de ";
    }
    //modification de la classe
    if (isset($_POST['Modifier'])){
        $unControleur->update_classe($_POST);
        header("Location: index.php?page=2");
    }

    //afficher toutes les classes
    $lesClasses = $unControleur->selectAll_classes();
    require_once ("vue/vue_select_classes.php");
?>