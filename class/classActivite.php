<?php

class Activite
{
    private $idActivite;
    private $nom;
    private $nbPartMin;
    private $nbPartMax;
    private $endroit;
    private $description;
    private $lien;

    function __construct()
    {
        $args = func_get_args();
        $i = func_num_args();

        switch ($i) {
            case 1: // Pour acceder ou bien creer un evenement avec un nom
                $this->IDouNom($args);
                break;
            case 7: // Constructeur complet avec ID spécifié
                $this->setIdActivite($args[6]);
            case 6: // Constructeur avec infos obligatoires et non-obligatoires
                $this->setNom($args[0]);
                $this->setNbPartMin($args[1]);
                $this->setNbPartMax(args[2]);
                $this->setEndroit($args[3]);
                $this->setDescription($args[4]);
                $this->setLien($args[5]);
                break;
        }
    }

    // Savoir si le seul argument spécifié est un idActivite ou bien une NOUVELLE activité avec seulement le nom
    public function IDouNom($args)
    {
        $arg = $args[0];
        if (is_string($arg)) {
            $this->setNom($arg);
        } else if (is_int($arg)) {
            $this->setIdActivite($arg);
        }
    }

    function supprimerActivite($bd)
    {
        $requete = $bd->prepare("DELETE FROM activite WHERE idActivite=:idActivite");
        if ($requete->execute(array('idActivite' => $this->idActivite))) {
            return true;
        }
        return false;
    }

    // Non implémentée
    function modifierActivite()
    {
        return true;
    }

    // Non implémentée
    function ajouterActivite()
    {
        return true;
    }



    // region Getters and Setters

    /**
     * @return mixed
     */
    public function getIdActivite()
    {
        return $this->idActivite;
    }

    /**
     * @param mixed $idActivite
     */
    public function setIdActivite($idActivite)
    {
        $this->idActivite = $idActivite;
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
    public function getNbPartMin()
    {
        return $this->nbPartMin;
    }

    /**
     * @param mixed $nbPartMin
     */
    public function setNbPartMin($nbPartMin)
    {
        $this->nbPartMin = $nbPartMin;
    }

    /**
     * @return mixed
     */
    public function getNbPartMax()
    {
        return $this->nbPartMax;
    }

    /**
     * @param mixed $nbPartMax
     */
    public function setNbPartMax($nbPartMax)
    {
        $this->nbPartMax = $nbPartMax;
    }

    /**
     * @return mixed
     */
    public function getEndroit()
    {
        return $this->endroit;
    }

    /**
     * @param mixed $endroit
     */
    public function setEndroit($endroit)
    {
        $this->endroit = $endroit;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getLien()
    {
        return $this->lien;
    }

    /**
     * @param mixed $lien
     */
    public function setLien($lien)
    {
        $this->lien = $lien;
    }

    // endregion
}