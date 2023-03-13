<?php

use crudP08\MyPDO;

include("MyPDO.php");
include("connex.php");

/**
 * Itérateur pour parcourir des personnages.
 */
class PersonnageIterator implements Iterator, Countable {

    /**
     * @var int $idPersonne L'identifiant du personnage courant.
     */
    protected int $idPersonne = 1;

    /**
     * @var MyPDO $myPDO L'objet MyPDO pour interroger la base de données.
     */
    protected MyPDO $myPDO;


    /**
     * Construit un nouvel objet PersonnageIterator.
     */
    public function __construct()
    {
        $this->myPDO = new MyPDO('mysql',$_ENV['host'],$_ENV['user'],$_ENV['db'],$_ENV['password'], "P08_Personnages");
    }
    /**
     * Retourne le nombre de personnages dans la base de données.
     *
     * @return int Le nombre de personnages dans la base de données.
     */
    public function count(): int {
        return $this->myPDO->count();
    }

    /**
     * Retourne le personnage courant.
     *
     * @return mixed le personnage courant.
     */
    public function current()
    {
        return $this->myPDO->get("idPersonne", $this->idPersonne);
    }

    /**
     * Retourne la clé du personnage courant.
     *
     * @return int La clé du personnage courant.
     */
    public function key(): int {
        return $this->idPersonne;
    }

    /**
     * Avance au personnage suivant.
     */
    public function next() {
        $this->idPersonne = $this->idPersonne + 1;
    }

    /**
     * Remet l'itérateur au premier personnage.
     */
    public function rewind() {
        $this->idPersonne = 1;
    }

    /**
     * Vérifie si le personnage courant est valide.
     *
     * @return bool True si le personnage courant est valide, sinon false.
     */
    public function valid(): bool {
        return $this->idPersonne > 0 && $this->idPersonne <= $this->count();
    }
}