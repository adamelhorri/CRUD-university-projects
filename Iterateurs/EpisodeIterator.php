<?php
use crudP08\MyPDO;

include("MyPDO.php");
include("connex.php");

/**
 * Itérateur pour parcourir des épisodes.
 */
class EpisodeIterator implements Iterator, Countable {

    /**
     * @var int $idEpisode L'identifiant de l'épisode courant.
     */
    protected int $idEpisode = 1;

    /**
     * @var MyPDO $myPDO L'objet MyPDO pour interroger la base de données.
     */
    protected MyPDO $myPDO;

    /**
     * Construit un nouvel objet EpisodeIterator.
     */
    public function __construct()
    {
        $this->myPDO = new MyPDO('mysql', $_ENV['host'], $_ENV['user'], $_ENV['db'], $_ENV['password'], "P08_Episodes");
    }

    /**
     * Retourne le nombre d'épisodes dans la base de données.
     *
     * @return int Le nombre d'épisodes dans la base de données.
     */
    public function count(): int {
        return $this->myPDO->count();
    }

    /**
     * Retourne l'épisode courant.
     *
     * @return mixed L'épisode courant.
     */
    public function current()
    {
        return $this->myPDO->get("idEpisode", $this->idEpisode);
    }

    /**
     * Retourne la clé de l'épisode courant.
     *
     * @return int La clé de l'épisode courant.
     */
    public function key(): int {
        return $this->idEpisode;
    }

    /**
     * Avance à l'épisode suivant.
     */
    public function next() {
        $this->idEpisode = $this->idEpisode + 1;
    }

    /**
     * Remet l'itérateur au premier épisode.
     */
    public function rewind() {
        $this->idEpisode = 1;
    }

    /**
     * Vérifie si l'épisode courant est valide.
     *
     * @return bool True si l'épisode courant est valide, sinon false.
     */
    public function valid(): bool {
        return $this->idEpisode > 0 && $this->idEpisode <= $this->count();
    }
}