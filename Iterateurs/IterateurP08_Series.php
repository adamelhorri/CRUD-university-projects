<?php
namespace crudP08\Iterateurs;

use crudP08\MyPDO;
use \Iterator;
use \Countable;

require_once("MyPDO.php");
require_once("connex.php");
/**
 * Itérateur pour parcourir des séries.
 */
class IterateurP08_Series implements Iterator, Countable
{

  /**
   * @var int L'identifiant de la série courante.
   */
  protected int $idSerie = 1;

  /**
   * @var MyPDO L'objet PDO pour interroger la base de données.
   */
  protected MyPDO $myPDO;

  /**
   * Construit un nouvel objet SerieIterator.
   */
  public function __construct()
  {
    $this->myPDO = new MyPDO('mysql', $_ENV['host'], $_ENV['db'], $_ENV['user'], $_ENV['password'], "P08_Series");
  }

  /**
   * Retourne le nombre de séries dans la base de données.
   *
   * @return int Le nombre de séries dans la base de données.
   */
  public function count(): int
  {
    return $this->myPDO->count();
  }

  /**
   * Retourne la série courante.
   *
   * @return mixed La série courante.
   */
  public function current()
  {
    return $this->myPDO->get("idSerie", $this->idSerie);
  }

  /**
   * Retourne la clé de la série courante.
   *
   * @return int La clé de la série courante.
   */
  public function key(): int
  {
    return $this->idSerie;
  }

  /**
   * Avance à la série suivante.
   */
  public function next()
  {
    $this->idSerie = $this->idSerie + 1;
  }

  /**
   * Remet l'itérateur à la première série.
   */
  public function rewind()
  {
    $this->idSerie = 1;
  }

  /**
   * Vérifie si la série courante est valide.
   *
   * @return bool True si la série courante est valide, sinon false.
   */
  public function valid(): bool
  {
    return $this->idSerie > 0 && $this->idSerie <= $this->count();
  }
}