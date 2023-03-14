<?php
namespace crudP08\Iterateurs;

use crudP08\MyPDO;
use \Iterator;
use \Countable;

require_once("MyPDO.php");
require_once("connex.php");

/**
 * Itérateur pour parcourir des personnes.
 */
class IterateurP08_Personnes implements Iterator, Countable
{

  /**
   * @var int L'identifiant de la personne courante.
   */
  protected int $idPersonne = 1;

  /**
   * @var MyPDO L'objet PDO pour interroger la base de données.
   */
  protected MyPDO $myPDO;

  /**
   * Construit un nouvel objet PersonneIterator.
   */
  public function __construct()
  {
    $this->myPDO = new MyPDO('mysql', $_ENV['host'], $_ENV['db'], $_ENV['user'], $_ENV['password'], "P08_Personnes");
  }

  /**
   * Retourne le nombre de personnes dans la base de données.
   *
   * @return int Le nombre de personnes dans la base de données.
   */
  public function count(): int
  {
    return $this->myPDO->count();
  }

  /**
   * Retourne la personne courante.
   *
   * @return mixed La personne courante.
   */
  public function current()
  {
    return $this->myPDO->get("idPersonne", $this->idPersonne);
  }

  /**
   * Retourne la clé de la personne courante.
   *
   * @return int La clé de la personne courante.
   */
  public function key(): int
  {
    return $this->idPersonne;
  }

  /**
   * Avance à la personne suivante.
   */
  public function next()
  {
    $this->idPersonne = $this->idPersonne + 1;
  }

  /**
   * Remet l'itérateur à la première personne.
   */
  public function rewind()
  {
    $this->idPersonne = 1;
  }

  /**
   * Vérifie si la personne courante est valide.
   *
   * @return bool True si la personne courante est valide, sinon false.
   */
  public function valid(): bool
  {
    return $this->idPersonne > 0 && $this->idPersonne <= $this->count();
  }
}