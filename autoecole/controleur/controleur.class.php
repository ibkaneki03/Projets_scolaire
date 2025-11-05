<?php
require_once("modele/modele.class.php");

class Controleur {
    private $unModele;

    public function __construct() {
        $this->unModele = new Modele();
    }

    // --- Connexion utilisateur ---
    public function verifConnexion($email, $mdp) {
        return $this->unModele->verifConnexion($email, $mdp);
    }


    // --- Candidats ---
    public function selectAllCandidats() {
        return $this->unModele->selectAllCandidats();
    }
    public function selectAllCandidatsFiltre($mot) {
        return $this->unModele->selectAllCandidatsFiltre($mot);
    }

    public function insertCandidat($tab) {
        $this->unModele->insertCandidat($tab);
    }

    public function updateCandidat($tab) {
        $this->unModele->updateCandidat($tab);
    }

    public function deleteCandidat($id) {
        $this->unModele->deleteCandidat($id);
    }

    // --- Moniteurs ---
    public function selectAllMoniteurs() {
        return $this->unModele->selectAllMoniteurs();
    }

    public function selectAllMoniteursFiltre($mot) {
        return $this->unModele->selectAllMoniteursFiltre($mot);
    }

    public function insertMoniteur($tab) {
        $this->unModele->insertMoniteur($tab);
    }

    public function updateMoniteur($tab) {
        $this->unModele->updateMoniteur($tab);
    }

    public function deleteMoniteur($id) {
        $this->unModele->deleteMoniteur($id);
    }

    // --- Véhicules ---
    public function selectAllVehicules() {
        return $this->unModele->selectAllVehicules();
    }

    public function selectAllVehiculesFiltre($mot) {
        return $this->unModele->selectAllVehiculesFiltre($mot);
    }

    public function insertVehicule($tab) {
        $this->unModele->insertVehicule($tab);
    }

    public function updateVehicule($tab) {
        $this->unModele->updateVehicule($tab);
    }

    public function deleteVehicule($id) {
        $this->unModele->deleteVehicule($id);
    }

    // --- Cours ---
    public function selectAllCours() {
        return $this->unModele->selectAllCours();
    }

    public function selectAllCoursFiltre($mot) {
        return $this->unModele->selectAllCoursFiltre($mot);
    }

    public function insertCours($tab) {
        $this->unModele->insertCours($tab);
    }

    public function updateCours($tab) {
        $this->unModele->updateCours($tab);
    }

    public function deleteCours($id) {
        $this->unModele->deleteCours($id);
    }

    public function selectWhere($table, $colonne, $valeur) {
        return $this->unModele->selectWhere($table, $colonne, $valeur);
    }
}
?>
