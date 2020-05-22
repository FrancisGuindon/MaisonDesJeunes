<?php

class Usager
{
    private $idUsager;
    private $prenom;
    private $nom;
    private $motPasse;
    private $courriel;
    private $telephone;
    private $dateNaissance;
    private $statut;

    function __construct()
    {
        $args = func_get_args();
        $i = func_num_args();

        switch ($i) {
            case 1: // Pour acceder a un usager
                $this->setIdUsager($args[0]);
                break;
            case 2: // Constructeur courriel et mot de passe
                $this->setCourriel($args[0]);
                $this->setMotPasse($args[1]);
                break;
            case 8: // Constructeur complet avec ID spécifié
                $this->setIdUsager($args[8]);
            case 7: // Constructeur avec infos obligatoires et non-obligatoires
                $this->setPrenom($args[0]);
                $this->setNom($args[1]);
                $this->setMotPasse($args[2]);
                $this->setCourriel($args[3]);
                $this->setTelephone($args[4]);
                $this->setDateNaissance($args[5]);
                $this->setStatut($args[6]);
                break;
            case 6: // Pour UPDATE dans SQL
                $this->setPrenom($args[0]);
                $this->setNom($args[1]);
                $this->setCourriel($args[2]);
                $this->setTelephone($args[3]);
                $this->setDateNaissance($args[4]);
                $this->setStatut($args[5]);
        }
    }

    public function ajouterUsager($bd)
    {
        $mdp = password_hash($this->motPasse, PASSWORD_DEFAULT);
        $requete = $bd->prepare("INSERT INTO usager (prenom, nom, motPasse, courriel, telephone, dateNaissance, statut) VALUES (:prenom, :nom, :motPasse, :courriel, :telephone, :dateNaissance, :statut)");
        return $requete->execute(array('prenom' => $this->prenom, 'nom' => $this->nom, 'motPasse' => $mdp, 'courriel' => $this->courriel, 'telephone' => $this->telephone, 'dateNaissance' => $this->dateNaissance, 'statut' => $this->statut));
    }

    public function activerUser($bd)
    {
        $requete = $bd->prepare("UPDATE usager SET statut = 1 WHERE idUsager = :idUsager");
        $requete->execute(array('idUsager' => $this->idUsager));
    }

    public function updateUser($bd)
    {
        $requete = $bd->prepare("UPDATE usager SET prenom = :prenom, nom = :nom, courriel = :courriel, telephone = :telephone, dateNaissance = :dateNaissance, statut = :statut WHERE idUsager = :idUsager");
        $requete->execute(array('prenom' => $this->prenom, 'nom' => $this->nom, 'courriel' => $this->courriel, 'telephone' => $this->telephone, 'dateNaissance' => $this->dateNaissance, 'statut' => $this->statut, 'idUsager' => $this->idUsager));
    }



    // region Getters and Setters

    /**
     * @return mixed
     */
    public function getIdUsager()
    {
        return $this->idUsager;
    }

    /**
     * @param mixed $idUsager
     */
    public function setIdUsager($idUsager)
    {
        $this->idUsager = $idUsager;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getMotPasse()
    {
        return $this->motPasse;
    }

    /**
     * @param mixed $motPasse
     */
    public function setMotPasse($motPasse)
    {
        $this->motPasse = $motPasse;
    }

    /**
     * @return mixed
     */
    public function getCourriel()
    {
        return $this->courriel;
    }

    public function getCourrielBD($bd)
    {
        $requete = $bd->prepare("SELECT courriel FROM usager WHERE idUsager = :idUsager");
        $requete->execute(array('idUsager' => $this->idUsager));
        return $requete->fetchColumn();
    }

    /**
     * @param mixed $courriel
     */
    public function setCourriel($courriel)
    {
        $this->courriel = $courriel;
    }

    /**
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param mixed $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * @return mixed
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * @param mixed $dateNaissance
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;
    }

    /**
     * @return mixed
     */
    public function getDateInscription()
    {
        return $this->dateInscription;
    }

    /**
     * @param mixed $dateInscription
     */
    public function setDateInscription($dateInscription)
    {
        $this->dateInscription = $dateInscription;
    }

    /**
     * @return mixed
     */
    public function getStatut()
    {
        return $this->statut;
    }

    public function getStatutFromBD($bd)
    {
        $requete = $bd->prepare("SELECT statut FROM usager WHERE courriel = :courriel");
        $requete->execute(array('courriel' => $this->courriel));
        return $requete->fetchColumn();
    }

    /**
     * @param mixed $statut
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;
    }
    // endregion

}