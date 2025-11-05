<?php
    class Modele{
        private $unPdo;                
        public function __construct (){
            $url='mysql:host=localhost;dbname=scolarite_iris_2026_2A';
            $user="root";
            $mdp="";
            try{
                $this->unPdo =  new PDO($url,$user,$mdp); 
            }
            catch(PDOException $exp){
                echo "<br> Erreur d'execution a url:".$url;
                echo "<br> Erreur:".$exp->getMessage();
            }
        }
        /*******************Gestion des classes****************************/
        public function insert_classe($tab){
            $requete = "insert into classe values(null,:nom,:salle,:diplome)";
            $donnees = array("nom"=>$tab['nom'],
                             "salle"=>$tab['salle'],
                             "diplome"=>$tab['diplome']);
            $exec = $this->unPdo->prepare($requete);
            $exec->execute($donnees);
        }
        public function selectALL_classes(){
            $requete = "select * from classe;";
            $exec = $this->unPdo->prepare($requete);
            $exec->execute();
            return $exec->fetchAll(); //retourner toutes les classes
        }
        public function delete_classe($idclasse){
            $requete = "delete from classe where idclasse=:idclasse";
            $donnees = array(":idclasse"=>$idclasse);
            $exec = $this->unPdo->prepare($requete);
            $exec->execute($donnees);   
        }
        public function update_classe($tab){
            $requete = "update classe set nom=:nom, salle=:salle, diplome=:diplome where idclasse=:idclasse";
            $donnees = array(":nom"=>$tab['nom'],
                             ":salle"=>$tab['salle'],
                             ":diplome"=>$tab['diplome'],
                             ":idclasse"=>$tab['idclasse']);
            $exec = $this->unPdo->prepare($requete);
            $exec->execute($donnees);
        }
        public function selectWhere_classe($idclasse){
            //récupère une classe identifiée par $idclasse.
            $requete = "select * from classe where idclasse=:idclasse";
            $donnees = array(":idclasse"=>$idclasse);
            $exec = $this->unPdo->prepare($requete);
            $exec->execute($donnees);
            return $exec->fetch(); //une seule classe trouvée
        }
        /*******************Gestion des étudiants ****************************/
        
        /*******************Gestion des professeurs ***************************/
        public function insert_professeur($tab){
            $requete = "insert into professeur values(null,:nom,:prenom,:email,:diplome)";
            $donnees = array(":nom"=>$tab['nom'],
                             ":prenom"=>$tab['prenom'],
                             ":email"=>$tab['email'],
                             ":diplome"=>$tab['diplome']);
            $exec = $this->unPdo->prepare($requete);
            $exec->execute($donnees);
        }
        public function selectALL_professeurs(){    
            $requete = "select * from professeur;";
            $exec = $this->unPdo->prepare($requete);
            $exec->execute();
            return $exec->fetchAll(); //retourner tous les professeurs
        }
        /*******************Gestion des matièress****************************/
    }
?>    