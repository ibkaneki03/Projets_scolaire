<?php
    require_once ("modele/modele.class.php");

    class Controleur {
        private $unModele ;

        public function __construct(){
            $this->unModele = new Modele();
        }
        /************Gestion des classes************************* */
        public function insert_classe ($tab){
            //partie sécurité

            //appel un modele pour l'insertion
            $this->unModele->insert_classe($tab);
        }
        public function selectAll_classes(){
            $lesClasses = $this->unModele->selectAll_classes();
            //je realise des controles

            //retournr a la vue les classes
        return $lesClasses;
        }

        public function delete_classe($idclasse){
            $this->unModele->delete_classe($idclasse);
        }
        public function update_classe($tab){
            $this->unModele->update_classe($tab);
        }
        public function selectWhere_classe($idclasse){
           $uneClasse = $this->unModele->selectWhere_classe($idclasse);
           return $uneClasse;
        }
        /************Gestion des professeurs************************* */
        public function insert_Professeur ($tab){
            //partie sécurité   

            //appel un modele pour l'insertion
            $this->unModele->insert_professeur($tab);
        }
        public function selectAll_professeurs(){
            $lesProfs = $this->unModele->selectAll_professeurs();
            //je realise des controles

            //retournr a la vue les Profs
        return $lesProfs;
        }    
    }

?>