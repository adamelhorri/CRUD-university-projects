<?php
namespace crudP08;

require_once("Entites/AbstractEntite.php");
require_once("Entites/EntiteP08_Series.php");
require_once("Entites/EntiteP08_Personnes.php");
require_once("Entites/EntiteP08_Prix.php");
require_once("Entites/EntiteP08_Genres.php");
require_once("Entites/EntiteP08_Episodes.php");
require_once("Entites/EntiteP08_Saisons.php");
require_once("Entites/EntiteP08_Etre.php");
require_once("Entites/EntiteP08_Role.php");
require_once("Entites/EntiteP08_Remporter.php");
require_once("Entites/EntiteP08_Personnages.php");

use \PDO;
use \PDOStatement;
use \PDOException;
use crudP08\Entites\AbstractEntite;

class MyPDO
{
  /**
   * @var PDO
   */
  private PDO $pdo;
  /**
   * @var PDOStatement
   */
  private PDOStatement $pdos_selectAll;
  /**
   * @var PDOStatement
   */
  private PDOStatement $pdos_select;
  /**
   * @var PDOStatement
   */
  private PDOStatement $pdos_update;
  /**
   * @var PDOStatement
   */
  private PDOStatement $pdos_insert;
  /**
   * @var PDOStatement
   */
  private PDOStatement $pdos_delete;
  /**
   * @var PDOStatement
   */
  private PDOStatement $pdos_count;
  /**
   * @var PDOStatement
   */
  private PDOStatement $pdos_filter;
  /**
   * @var PDOStatement
   */
  private PDOStatement $pdos_next_int;
  /**
   * @var PDOStatement
   */
  private PDOStatement $pdos_fk;
  /**
   * @var PDOStatement
   */
  private PDOStatement $pdos_select_fk;
  /**
   * @var PDOStatement
   */
  private PDOStatement $pdos_nb_instances;
  /**
   * @var PDOStatement
   */
  private PDOStatement $pdos_id_suivant;
  /**
   * @var string
   */
  private string $nomTable;
  private string $idTable;


  /**
   * MyPDO constructor.
   * @param $sgbd
   * @param $host
   * @param $db
   * @param $user une partie
   * @param $password
   * @param $nomTable
   */
  public function __construct(string $sgbd, string $host, string $db, string $user, string $password, string $nomTable = '')
  {
    switch ($sgbd) {
      case 'mysql':
        $this->pdo = new PDO('mysql:host=' . $host . ';dbname=' . $db . ';charset=UTF8', $user, $password);
        break;
      case 'pgsql':
        $this->pdo = new PDO('pgsql:host=' . $host . ' dbname=' . $db . ' user=' . $user . ' password=' . $password);
        break;
      default:
        exit("Type de sgbd non correct : $sgbd fourni, 'mysql' ou 'pgsql' attendu");
    }

    // pour récupérer aussi les exceptions provenant de PDOStatement
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this->nomTable = $nomTable;

  }

  /**
   * préparation de la requête SELECT * FROM $nomTable
   * instantiation de $this->pdos_selectAll
   */
  private function initPDOS_selectAll()
  {
    $this->pdos_selectAll = $this->pdo->prepare('SELECT * FROM ' . $this->nomTable);
  }

  /**
   * Suppose une convention de nommage de la classe entité et de son namespace !!
   * @return array
   */
  public function getAll(): array
  {
    if (!isset($this->pdos_selectAll))
      $this->initPDOS_selectAll();
    $this->getPdosSelectAll()->execute();
    return $this->getPdosSelectAll()->fetchAll(PDO::FETCH_CLASS, 'crudP08\Entites\Entite' . ucfirst($this->getNomTable()));
  }

  /**
   * préparation de la requête SELECT * FROM $this->nomTable WHERE $nomColId = :id
   * instantiation de $this->pdos_select
   * @param string $nomColID
   */
  private function initPDOS_select(string $nomColID = 'id'): void
  {
    $requete = 'SELECT * FROM ' . $this->nomTable . " WHERE $nomColID = :$nomColID";
    $this->pdos_select = $this->pdo->prepare($requete);
  }

  /**
   * Suppose une convention de nommage de la classe entité et de son namespace !!
   * @param string $key le nom de la colonne associée à la clé primaire
   * @param $val
   * @return mixed
   */
  public function get(string $key, $val): ?AbstractEntite
  {
    if (!isset($this->pdos_select))
      $this->initPDOS_select($key);
    try {
      $this->getPdosSelect()->bindValue(':' . $key, $val);
      $this->getPdosSelect()->execute();
    } catch (PDOException $pdoe) {
      print $pdoe;
    }
    $entite = $this->getPdosSelect()->fetchObject('crudP08\Entites\Entite' . ucfirst($this->getNomTable()));
    return $entite ? $entite : null;
  }

  private function initPDOS_fk(string $colName): void
  {
    if ($colName == 'idSaison')
      $requete = "SELECT nomSerie, numSaison FROM P08_Saisons NATURAL JOIN P08_Series WHERE $colName = :$colName";
    else if ($colName == 'spinoff')
      $requete = "SELECT nomSerie FROM P08_Series WHERE idSerie = :$colName";
    else
      $requete = 'SELECT nom' . substr($colName, 2) . ' FROM P08_' . substr($colName, 2) . "s WHERE $colName = :$colName";
    $this->pdos_fk = $this->pdo->prepare($requete);
  }

  public function getFK(string $key, $val): string
  {
    if ($val == null)
      return '';
    if (!isset($this->pdos_fk))
      $this->initPDOS_fk($key);
    try {
      $this->getPdosFK()->bindValue(':' . $key, $val);
      $this->getPdosFK()->execute();
    } catch (PDOException $pdoe) {
      print $pdoe;
    }
    if ($key == 'idSaison') {
      $ligne = $this->getPdosFK()->fetch();
      return $ligne[0] . ' (Saison ' . $ligne[1] . ')';
    } else
      return $this->getPdosFK()->fetchColumn();
  }

  private function initPDOS_select_fk(string $colName): void
  {
    if ($colName == 'idSaison')
      $requete = 'SELECT idSaison, nomSerie, numSaison FROM P08_Saisons NATURAL JOIN P08_Series';
    else if ($colName == 'spinoff')
      $requete = 'SELECT idSerie, nomSerie FROM P08_Series';
    else
      $requete = 'SELECT ' . $colName . ', nom' . substr($colName, 2) . ' FROM P08_' . substr($colName, 2) . 's';
    $this->pdos_select_fk = $this->pdo->prepare($requete);
  }

  public function getSelectFK(string $key, $id = null): string
  {
    if (!isset($this->pdos_select_fk))
      $this->initPDOS_select_fk($key);
    try {
      $this->getPdosSelectFK()->execute();
    } catch (PDOException $pdoe) {
      print $pdoe;
    }
    $lignes = $this->getPdosSelectFK()->fetchAll();
    $ch = '<select name="' . $key . '">';
    if ($key == 'idSaison')
      foreach ($lignes as $ligne)
        $ch .= '<option value="' . $ligne[0] . '" ' . ($ligne[0] == $id ? 'selected' : '') . '>' . $ligne[1] . ' (Saison ' . $ligne[2] . ')</option>';
    else {
      if ($key = 'spinoff')
        $ch .= '<option value="" selected></option>';
      foreach ($lignes as $ligne)
        $ch .= '<option value="' . $ligne[0] . '" ' . ($ligne[0] == $id ? 'selected' : '') . '>' . $ligne[1] . '</option>';
    }
    $ch .= '</select>';
    return $ch;
  }

  private function initPDOS_next_int(string $nomColID = 'id'): void
  {
    $requete = 'SELECT MAX(' . $nomColID . ') FROM ' . $this->nomTable;
    $this->pdos_next_int = $this->pdo->prepare($requete);
  }

  public function getNextInt(string $nomColId = 'id'): int
  {
    if (!isset($this->pdos_next_int))
      $this->initPDOS_next_int($nomColId);
    try {
      $this->getPdosNextInt()->execute();
    } catch (PDOException $pdoe) {
      print $pdoe;
    }
    return $this->getPdosNextInt()->fetchColumn() + 1;
  }

  /**
   * @param string $nomColId
   * @param array $colNames
   */
  private function initPDOS_update(string $nomColId, array $colNames): void
  {
    $query = 'UPDATE ' . $this->nomTable . ' SET ';
    foreach ($colNames as $colName) {
      if ($colName != $nomColId)
        $query .= $colName . '=:' . $colName . ', ';
    }
    $query = substr($query, 0, strlen($query) - 2);
    $query .= ' WHERE ' . $nomColId . '=:' . $nomColId;
    $this->pdos_update = $this->pdo->prepare($query);
  }

  /**
   * @param string $id
   * @param array $assoc
   */
  public function update(array $assoc): void
  {
    // on suppose que la clé est fournie en premier
    $_SESSION['requete'] = implode(' ; ', $assoc);
    $_SESSION['requete'] .= ' ' . implode(' ; ', array_keys($assoc));
    $id = array_keys($assoc)[0];
    if (!isset($this->pdos_update))
      $this->initPDOS_update($id, array_keys($assoc));
    foreach ($assoc as $key => $value) {
      $this->getPdosUpdate()->bindValue(':' . $key, $value);
    }
    $this->getPdosUpdate()->execute();
  }

  /**
   * @param array
   */
  private function initPDOS_insert(array $colNames): void
  {
    $query = 'INSERT INTO ' . $this->nomTable . ' (';
    foreach ($colNames as $colName) {
      $query .= $colName . ', ';
    }
    $query = substr($query, 0, strlen($query) - 2);
    $query .= ') VALUES(';
    foreach ($colNames as $colName) {
      $query .= ':' . $colName . ', ';
    }
    $query = substr($query, 0, strlen($query) - 2);
    $query .= ')';
    $this->pdos_insert = $this->pdo->prepare($query);
  }

  /**
   * @param array $assoc
   */
  public function insert(array $assoc): void
  {
    if (!isset($this->pdos_insert))
      $this->initPDOS_insert(array_keys($assoc));
    foreach ($assoc as $key => $value) {
      if (is_numeric($value))
        $this->getPdosInsert()->bindValue(':' . $key, $value, PDO::PARAM_INT);
      else
        $this->getPdosInsert()->bindValue(':' . $key, $value);
    }
    $this->getPdosInsert()->execute();
  }

  /**
   * @param string
   */
  private function initPDOS_delete(string $nomColId = 'id'): void
  {
    $this->pdos_delete = $this->pdo->prepare('DELETE FROM ' . $this->nomTable . " WHERE $nomColId=:" . $nomColId);
  }

  /**
   * @param array $assoc
   */
  public function delete(array $assoc)
  {
    if (!isset($this->pdos_delete))
      $this->initPDOS_delete(array_keys($assoc)[0]);
    foreach ($assoc as $key => $value) {
      $this->getPdosDelete()->bindValue(':' . $key, $value);
    }
    $this->getPdosDelete()->execute();
  }

  /**
   * préparation de la requête SELECT Max(id) FROM Serie
   * instantiation de self::$_pdos_count
   */
  private function initPDOS_count()
  {
    $this->pdos_count = $this->pdo->prepare("SELECT MAX($this->idTable) FROM " . $this->nomTable);
  }

  /**
   * nombre d'objets metier disponible dans la table
   */
  public function count(): int
  {
    if (!isset($this->pdos_count))
      $this->initPDOS_count();
    $this->getPdosCount()->execute();
    return $this->getPdosCount()->fetch()[0];
  }

  /**
   * préparation de la requête SELECT Max(id) FROM Serie
   * instantiation de self::$_pdos_count
   */
  private function initPDOS_nb_instances()
  {
    $this->pdos_nb_instances = $this->pdo->prepare("SELECT COUNT(*) FROM " . $this->nomTable);
  }

  public function getNbInstances(): int
  {
    if (!isset($this->pdos_nb_instances))
      $this->initPDOS_nb_instances();
    $this->getPdosNbInstances()->execute();
    return $this->getPdosNbInstances()->fetch()[0];
  }

  private function initPDOS_id_suivant(int $id)
  {
    $this->pdos_id_suivant = $this->pdo->prepare("SELECT " . $this->idTable . " FROM " . $this->nomTable . " WHERE " . $this->idTable . " > " . $id . " ORDER BY " . $this->idTable . " limit 1");
  }

  public function getIdSuivant(int $id): int
  {
    $this->initPDOS_id_suivant($id);
    $this->getPdosIdSuivant()->execute();
    return $this->getPdosIdSuivant()->fetch()[0];
  }

  public function getPdo(): PDO
  {
    return $this->pdo;
  }

  /**
   * @return mixed
   */
  public function getPdosSelect(): PDOStatement
  {
    return $this->pdos_select;
  }


  /**
   * @return PDOStatement
   */
  public function getPdosSelectAll(): PDOStatement
  {
    return $this->pdos_selectAll;
  }

  /**
   * @return PDOStatement
   */
  public function getPdosUpdate(): PDOStatement
  {
    return $this->pdos_update;
  }

  /**
   * @return PDOStatement
   */
  public function getPdosInsert(): PDOStatement
  {
    return $this->pdos_insert;
  }

  /**
   * @return PDOStatement
   */
  public function getPdosDelete(): PDOStatement
  {
    return $this->pdos_delete;
  }

  /**
   * @return PDOStatement
   */
  public function getPdosCount(): PDOStatement
  {
    return $this->pdos_count;
  }

  /**
   * @return string
   */
  public function getNomTable(): string
  {
    return $this->nomTable;
  }

  /**
   * @param string $nomTable
   */
  public function setNomTable(string $nomTable): void
  {
    $this->nomTable = $nomTable;
  }
  
  /**
   * setNomTable
   *
   * @param string $nomTable
   * @return void
   */
  public function setIdTable(string $idTable): void
  {
    $this->idTable = $idTable;
  }

  /**
   * @return PDOStatement
   */
  public function getPdosFilter(): PDOStatement
  {
    return $this->pdos_filter;
  }

  /**
   * @return PDOStatement
   */
  public function getPdosNextInt(): PDOStatement
  {
    return $this->pdos_next_int;
  }

  /**
   * @return PDOStatement
   */
  public function getPdosFK(): PDOStatement
  {
    return $this->pdos_fk;
  }

  /**
   * @return PDOStatement
   */
  public function getPdosSelectFK(): PDOStatement
  {
    return $this->pdos_select_fk;
  }

  /**
   * @return PDOStatement
   */
  public function getPdosNbInstances(): PDOStatement
  {
    return $this->pdos_nb_instances;
  }

  /**
   * @return PDOStatement
   */
  public function getPdosIdSuivant(): PDOStatement
  {
    return $this->pdos_id_suivant;
  }
}