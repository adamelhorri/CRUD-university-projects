<?php
use crudP08\MyPDO;

include("MyPDO.php");
include("connex.php");

/**
 * Itérateur pour parcourir des prix.
 */
class SaisonIterator implements Iterator, Countable {

    /**
     * @var int $idSaison L'identifiant de la saison courante.
     */
    protected int $idSaison = 1;

    /**
     * @var MyPDO $myPDO L'objet MyPDO pour interroger la base de données.
     */
    protected MyPDO $myPDO;

    /**
     * Construit un nouvel objet SaisonIterator.
     */
    public function __construct()
    {
        $this->myPDO = new MyPDO('mysql', $_ENV['host'], $_ENV['user'], $_ENV['db'], $_ENV['password'], "P08_Saisons");
    }

    /**
     * Retourne le nombre de saisons dans la base de données.
     *
     * @return int Le nombre de saisons dans la base de données.
     */
    public function count(): int {
        return $this->myPDO->count();
    }

    /**
     * Retourne la saison courante.
     *
     * @return mixed La saison courante.
     */
    public function current()
    {
        return $this->myPDO->get("idSaison", $this->idSaison);
    }

    /**
     * Retourne la clé de la saison courante.
     *
     * @return int La clé de la saison courante.
     */
    public function key(): int {
        return $this->idSaison;
    }

    /**
     * Avance à la saison suivante.
     */
    public function next() {
        $this->idSaison = $this->idSaison + 1;
    }

    /**
     * Remet l'itérateur à la première saison.
     */
    public function rewind() {
        $this->idSaison = 1;
    }

    /**
     * Vérifie si la saison courante est valide.
     *
     * @return bool True si la saison courante est valide, sinon false.
     */
    public function valid(): bool {
        return $this->idSaison > 0 && $this->idSaison <= $this->count();
    }
}