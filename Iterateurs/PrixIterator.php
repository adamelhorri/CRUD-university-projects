<?php
use crudP08\MyPDO;

include("MyPDO.php");
include("connex.php");

/**
Itérateur pour parcourir des prix.
 */
class PrixIterator implements Iterator, Countable {

    /**

    @var int $idPrix L'identifiant du prix courant.
     */
    protected int $idPrix = 1;
    /**

    @var MyPDO $myPDO L'objet MyPDO pour interroger la base de données.
     */
    protected MyPDO $myPDO;
    /**

    Construit un nouvel objet PrixIterator.
     */
    public function __construct()
    {
        $this->myPDO = new MyPDO('mysql', $_ENV['host'], $_ENV['user'], $_ENV['db'], $_ENV['password'], "P08_Prix");
    }
    /**

    Retourne le nombre de prix dans la base de données.
    @return int Le nombre de prix dans la base de données.
     */
    public function count(): int {
        return $this->myPDO->count();
    }
    /**

    Retourne le prix courant.
    @return mixed Le prix courant.
     */
    public function current()
    {
        return $this->myPDO->get("idPrix", $this->idPrix);
    }
    /**

    Retourne la clé du prix courant.
    @return int La clé du prix courant.
     */
    public function key(): int {
        return $this->idPrix;
    }
    /**

    Avance à la prix suivante.
     */
    public function next() {
        $this->idPrix = $this->idPrix + 1;
    }
    /**

    Remet l'itérateur à la première prix.
     */
    public function rewind() {
        $this->idPrix = 1;
    }
    /**

    Vérifie si le prix courant est valide.
    @return bool True si le prix courant est valide, sinon false.
     */
    public function valid(): bool {
        return $this->idPrix > 0 && $this->idPrix <= $this->count();
    }
}