<?php
 class Modele {
    private $pdo;

    public function __construct() {
        $server= "localhost";
         $bdd= "autoecole";
          $user="root"; 
           $mdp="";
        try {
            $this->pdo = new PDO("mysql:host=".$server.";dbname=".$bdd.";charset=utf8", $user, $mdp);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exp) {
            echo "<p style='color:red'>Erreur de connexion à la BDD : " . $exp->getMessage() . "</p>";
        }
    }

    // === CANDIDATS ===
    public function selectAllCandidats() {
        $r = $this->pdo->prepare("SELECT * FROM candidat;");
        $r->execute();
        return $r->fetchAll();
    }

    public function insertCandidat($t) {
        $sql = "INSERT INTO candidat VALUES (NULL,:nom,:prenom,:email,:tel,:adresse);";
        $r = $this->pdo->prepare($sql);
        $r->execute($t);
    }
    public function updateCandidat($t) {
        $sql = "UPDATE candidat
                SET nom=:nom, prenom=:prenom, email=:email, tel=:tel, adresse=:adresse
                WHERE idcandidat=:idcandidat;";
        $r = $this->pdo->prepare($sql);
        $r->execute($t);
    }

    public function deleteCandidat($id) {
        $r = $this->pdo->prepare("DELETE FROM candidat WHERE idcandidat=:id;");
        $r->execute([':id' => $id]);
    }

    // === MONITEURS ===
        public function selectAllMoniteurs() {
        $r = $this->pdo->prepare("SELECT * FROM moniteur;");
        $r->execute();
        return $r->fetchAll();
    }
    public function insertMoniteur($t) {
        $sql = "INSERT INTO moniteur VALUES (NULL,:nom,:prenom,:email,:tel,:adresse);";
        $r = $this->pdo->prepare($sql);
        $r->execute($t);
    }
    public function updateMoniteur($t) {
        $sql = "UPDATE moniteur
                SET nom=:nom, prenom=:prenom, email=:email, tel=:tel, adresse=:adresse
                WHERE idmoniteur=:idmoniteur;";
        $r = $this->pdo->prepare($sql);
        $r->execute($t);
    }

    public function deleteMoniteur($id) {
        $r = $this->pdo->prepare("DELETE FROM moniteur WHERE idmoniteur=:id;");
        $r->execute([':id' => $id]);
    }


    // === VEHICULES ===
    public function selectAllVehicules() {
        $r = $this->pdo->prepare("SELECT * FROM vehicule;");
        $r->execute();
        return $r->fetchAll();
    }

    public function insertVehicule($t) {
        $sql = "INSERT INTO vehicule VALUES (NULL,:marque,:modele,:annee,:categorie,:immatriculation);";
        $r = $this->pdo->prepare($sql);
        $r->execute($t);
    }
    public function updateVehicule($t) {
        $sql = "UPDATE vehicule
                SET marque=:marque, modele=:modele, annee=:annee, categorie=:categorie, immatriculation=:immatriculation
                WHERE idvehicule=:idvehicule;";
        $r = $this->pdo->prepare($sql);
        $r->execute($t);
    }

    public function deleteVehicule($id) {
        $r = $this->pdo->prepare("DELETE FROM vehicule WHERE idvehicule=:id;");
        $r->execute([':id' => $id]);
    }


    // === COURS ===
    public function selectAllCours() {
        $sql = "SELECT c.idcours, c.dateheure, c.duree, ca.nom AS candidat, mo.nom AS moniteur, v.modele
                FROM cours c
                JOIN candidat ca ON c.idcandidat = ca.idcandidat
                JOIN moniteur mo ON c.idmoniteur = mo.idmoniteur
                JOIN vehicule v ON c.idvehicule = v.idvehicule;";
        $r = $this->pdo->prepare($sql);
        $r->execute();
        return $r->fetchAll();
    }

    public function insertCours($t) {
        $sql = "INSERT INTO cours VALUES (NULL,:dateheure,:duree,:idcandidat,:idmoniteur,:idvehicule);";
        $r = $this->pdo->prepare($sql);
        $r->execute($t);
    }

    public function updateCours($t) {
        $sql = "UPDATE cours 
                SET dateheure=:dateheure, duree=:duree, idcandidat=:idcandidat, idmoniteur=:idmoniteur, idvehicule=:idvehicule
                WHERE idcours=:idcours;";
        $r = $this->pdo->prepare($sql);
        $r->execute($t);
    }

    public function deleteCours($id) {
        $r = $this->pdo->prepare("DELETE FROM cours WHERE idcours=:id;");
        $r->execute([':id' => $id]);
    }


        // === UTILISATEUR ===
    public function verifConnexion($email, $mdp) {
        $sql = "SELECT * FROM utilisateur WHERE email = :email AND mdp = SHA2(:mdp, 256)";
        $r = $this->pdo->prepare($sql);
        $r->execute([
            ':email' => $email,
            ':mdp'   => $mdp
        ]);
        return $r->fetch();
    }

    /* ---- CANDIDATS : filtre ---- */
public function selectAllCandidatsFiltre($mot) {
    $sql = "SELECT * FROM candidat
            WHERE nom LIKE :mot OR prenom LIKE :mot
               OR email LIKE :mot OR tel LIKE :mot
               OR adresse LIKE :mot";
    $r = $this->pdo->prepare($sql);
    $r->execute([":mot" => "%$mot%"]);
    return $r->fetchAll();
}

/* ---- MONITEURS : filtre ---- */
public function selectAllMoniteursFiltre($mot) {
    $sql = "SELECT * FROM moniteur
            WHERE nom LIKE :mot OR prenom LIKE :mot
               OR email LIKE :mot OR tel LIKE :mot
               OR adresse LIKE :mot";
    $r = $this->pdo->prepare($sql);
    $r->execute([":mot" => "%$mot%"]);
    return $r->fetchAll();
}

/* ---- VEHICULES : filtre ---- */
public function selectAllVehiculesFiltre($mot) {
    $sql = "SELECT * FROM vehicule
            WHERE marque LIKE :mot OR modele LIKE :mot
               OR categorie LIKE :mot OR immatriculation LIKE :mot";
    $r = $this->pdo->prepare($sql);
    $r->execute([":mot" => "%$mot%"]);
    return $r->fetchAll();
}

/* ---- COURS : filtre (avec jointures) ---- */
public function selectAllCoursFiltre($mot) {
    $sql = "SELECT c.idcours, c.dateheure, c.duree,
                   ca.nom AS candidat, mo.nom AS moniteur, v.modele
            FROM cours c
              JOIN candidat ca ON c.idcandidat = ca.idcandidat
              JOIN moniteur mo ON c.idmoniteur = mo.idmoniteur
              JOIN vehicule v  ON c.idvehicule = v.idvehicule
            WHERE ca.nom LIKE :mot
               OR mo.nom LIKE :mot
               OR v.modele LIKE :mot
               OR v.marque LIKE :mot";
    $r = $this->pdo->prepare($sql);
    $r->execute([":mot" => "%$mot%"]);
    return $r->fetchAll();
}

/* ---- selectWhere utilisé pour le mode 'edit' ---- */
public function selectWhere($table, $colonne, $valeur) {
    // Whitelist simple pour éviter l’injection via noms dynamiques
    $autorise = [
        "candidat"  => "idcandidat",
        "moniteur"  => "idmoniteur",
        "vehicule"  => "idvehicule",
        "cours"     => "idcours",
        "utilisateur" => "idutilisateur"
    ];
    if (!isset($autorise[$table]) || $autorise[$table] !== $colonne) {
        throw new Exception("Table/colonne non autorisée.");
    }
    $sql = "SELECT * FROM $table WHERE $colonne = :val LIMIT 1;";
    $r = $this->pdo->prepare($sql);
    $r->execute([":val" => $valeur]);
    return $r->fetch();
}

}
?>  