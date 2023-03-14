<?php
namespace crudP08\Iterateurs;

use crudP08\Entites\EntiteP08_Saisons;
use crudP08\MyPDO;
use \Iterator;
use \Countable;

require_once("MyPDO.php");
require_once("connex.php");

/**
 * Itérateur pour parcourir des prix.
 */
class IterateurP08_Saisons implements Iterator, Countable
{

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
    $this->myPDO = new MyPDO('mysql', $_ENV['host'], $_ENV['db'], $_ENV['user'], $_ENV['password'], "P08_Saisons");
  }

  /**
   * Retourne le nombre de saisons dans la base de données.
   *
   * @return int Le nombre de saisons dans la base de données.
   */
  public function count(): int
  {
    $this->myPDO->setIdTable("idSaison");
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
  public function key(): int
  {
    return $this->idSaison;
  }

  /**
   * Avance à la saison suivante.
   */
  public function next()
  {
    $this->idSaison = $this->idSaison + 1;
    if(!($this->current() instanceof EntiteP08_Saisons) && $this->valid())
      return $this->idSaison = $this->myPDO->getIdSuivant($this->idSaison);
  }

  /**
   * Remet l'itérateur à la première saison.
   */
  public function rewind()
  {
    $this->idSaison = 1;
  }

  /**
   * Vérifie si la saison courante est valide.
   *
   * @return bool True si la saison courante est valide, sinon false.
   */
  public function valid(): bool
  {
    return $this->idSaison > 0 && $this->idSaison <= $this->count();
  }

  /**
   * 
   * @return int
   */
  public function nbInstances(): int
  {
    return $this->myPDO->getNbInstances();
  }
}