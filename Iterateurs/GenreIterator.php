<?php
use crudP08\MyPDO;

include("MyPDO.php");
include("connex.php");

/**
 * Itérateur pour parcourir des genres.
 */
class GenreIterator implements Iterator, Countable {

    /**
     * @var int $idGenre L'identifiant du genre courant.
     */
    protected int $idGenre = 1;

    /**
     * @var MyPDO $myPDO L'objet MyPDO pour interroger la base de données.
     */
    protected MyPDO $myPDO;

    /**
     * Construit un nouvel objet GenreIterator.
     */
    public function __construct()
    {
        $this->myPDO = new MyPDO('mysql',$_ENV['host'],$_ENV['user'],$_ENV['db'],$_ENV['password'], "P08_Genres");
    }

    /**
     * Retourne le nombre de genres dans la base de données.
     *
     * @return int Le nombre de genres dans la base de données.
     */
    public function count(): int {
        return $this->myPDO->count();
    }

    /**
     * Retourne le genre courant.
     *
     * @return mixed Le genre courant.
     */
    public function current()
    {
        return $this->myPDO->get("idGenre", $this->idGenre);
    }

    /**
     * Retourne la clé du genre courant.
     *
     * @return int La clé du genre courant.
     */
    public function key(): int {
        return $this->idGenre;
    }

    /**
     * Avance à la personne suivante.
     */
    public function next() {
        $this->idGenre = $this->idGenre+1;
    }

    /**
     * Remet l'itérateur à la première personne.
     */
    public function rewind (  ) {
        $this->idGenre = 1;
    }

    /**
     * Vérifie si le genre courant est valide.
     *
     * @return bool True si le genre courant est valide, sinon false.
     */
    public function valid (): bool {
        return $this->idGenre>0 && $this->idGenre<=$this->count();
    }
}