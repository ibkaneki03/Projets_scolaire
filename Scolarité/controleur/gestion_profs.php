<h2> Gestion des professeurs </h2>
<?php
    require_once ("vue/vue_insert_professeur.php");

    if (isset($_POST['Valider'])){

        $unControleur->insert_Professeur($_POST);
        echo "<b> Insertion réussie du professeur";
    }

        //afficher toutes les classes
    $lesProfs = $unControleur->selectAll_professeurs();
    require_once ("vue/vue_select_professeurs.php");
?>