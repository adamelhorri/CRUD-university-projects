<?php
require_once "Entite/EntiteBateau.php";
require_once "Entite/EntiteConduit.php";
require_once "Entite/EntiteCourse.php";
require_once "Entite/EntiteResultat.php";
require_once "Entite/EntiteSkippeur.php";
require_once "Metier/MetierConduit.php";
require_once "Metier/MetierResultat.php";
class MyPDO{
    /**
     * @var PDO
     */
    private $pdo;
    /**
     * @var PDOStatement
     */
    private $pdos_selectAll;
    /**
     * @var PDOStatement
     */
    private $pdos_select;
    /**
     * @var PDOStatement
     */
    private $pdos_update;
    /**
     * @var PDOStatement
     */
    private $pdos_insert;
    /**
     * @var PDOStatement
     */
    private $pdos_delete;
    /**
     * @var PDOStatement
     */
    private $pdos_count;
    /**
     * @var string
     */
    private $nomTable;

    /**
     * MyPDO constructor.
     * @param $host
     * @param $db
     * @param $user
     * @param $passeword
     * @param $nomTable
     */
    public function __construct( $host, $db, $user ,$passeword){
        try {
            $this->pdo = new PDO("mysql:host=".$host.";dbname=".$db, $user, $passeword );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch (PDOException $e){
            echo "Connexion failed: " . $e->getMessage();
        }
    }

    /**
     * @param string $nomTable
     */
    public function setNomTable(string $nomTable): void
    {
        $this->nomTable = $nomTable;
    }


    /**
     * préparation de la requête SELECT * FROM $nomTable
     * instantiation de $this->pdos_selectAll
     */
    public function initPDOS_selectAll(){
        $this->pdos_selectAll = $this->pdo->prepare('SELECT * FROM ' . $this->nomTable);
    }

    public function getAll(): array{
        if (!isset($this->pdos_selectAll)){
            $this->initPDOS_selectAll();
        }

        $this->getPdosSelectAll()->execute();
        return $this->getPdosSelectAll()->fetchAll(PDO::FETCH_CLASS,
            "\EntitesTransat\Entite".ucfirst($this->getNomTable()) );
    }


    /**
     * préparation de la requête SELECT * FROM $this->nomTable WHERE $nomColId = :id
     * instantiation de $this->pdos_select
     * @param string $nomColID
     */
    public function initPDOS_select(string $nomColID = "id") : void {
        $requette = "Select * From ".$this->getNomTable()." where $nomColID = :$nomColID";
        $this->pdos_select = $this->pdo->prepare($requette);
    }

    public function get($key, $val){
        if (!isset($this->pdos_select)){
            $this->initPDOS_select($key);
        }
        $this->initPDOS_select($key);
        $this->getPdosSelect()->bindValue(":".$key,$val);
        $this->getPdosSelect()->execute();
        return $this->getPdosSelect()->fetchObject("\EntitesTransat\Entite".ucfirst($this->getNomTable()));

    }


    /**
     * @param string $nomColId
     * @param array $colNames
     */
    public function initPDOS_update(string $nomColId, array $colNames): void {
        $query = "UPDATE ".$this->nomTable." SET ";
        foreach ($colNames as $colName) {
            $query .= $colName."=:".$colName.", ";
        }
        $query = substr($query,0, strlen($query)-2);
        $query .= " WHERE ".$nomColId."=:".$nomColId;
        $this->pdos_update =  $this->pdo->prepare($query);
    }

    /**
     * @param string $id
     * @param array $assoc
     */
    public function update(string $id, array $assoc): void {
        switch ($this->nomTable){
            case "Resultat":
                $leResultat = MetierResultat::initMetierResultat($assoc['Skipper_id'], $assoc['Course_id']);
                $leResultat->setDuoId($assoc['Duo_id']);
                $leResultat->setClassement($assoc['Classement']);
                $leResultat->setTempsCourse($assoc['TempsCourse']);
                $leResultat->save();
                break;
            default:
                if (! isset($this->pdos_update))
                    $this->initPDOS_update($id, array_keys($assoc));
                foreach ($assoc as $key => $value) {
                    $this->getPdosUpdate()->bindValue(":".$key, $value);
                }
                $this->getPdosUpdate()->execute();
                break;
        }

    }


    /**
     * @param array
     */
    public function initPDOS_insert(array $colNames): void {
        $query = "INSERT INTO ".$this->nomTable." VALUES(";
        foreach ($colNames as $colName) {
            $query .= ":".$colName.", ";
        }
        $query = substr($query,0, strlen($query)-2);
        $query .= ')';
        $this->pdos_insert = $this->pdo->prepare($query);
    }

    /**
     * @param array $assoc
     */
    public function insert(array $assoc): void {
        switch ($this->nomTable){
            case "Conduit":
                $skipper_id = $assoc['Skipper_id'];
                $bateau_id = $assoc['Bateau_id'];
                $metierConduit = new MetierConduit();
                $metierConduit->setSkipperId($skipper_id);
                $metierConduit->setBateauId($bateau_id);
                $metierConduit->setNouveau(TRUE);
                $metierConduit->save();
                break;
            case "Resultat" :
                $metierResultat = new MetierResultat();
                $metierResultat->setSkipperId($assoc['Skipper_id']);
                $metierResultat->setCourseId($assoc['Course_id']);
                $metierResultat->setDuoId($assoc['Duo_id']);
                $metierResultat->setClassement($assoc['Classement']);
                $metierResultat->setTempsCourse($assoc['TempsCourse']);
                $metierResultat->setNouveau(TRUE);
                $metierResultat->save();
                break;
            default:
                if (! isset($this->pdos_insert))
                    $this->initPDOS_insert(array_keys($assoc));
                foreach ($assoc as $key => $value) {
                    $this->getPdosInsert()->bindValue(":".$key, $value);
                }
                $this->getPdosInsert()->execute();
                break;
        }

    }

    /**
     * @param string
     */
    public function initPDOS_delete(string $nomColId = "id"): void {
        $this->pdos_delete = $this->pdo->prepare("DELETE FROM ". $this->nomTable
            ." WHERE $nomColId=:".$nomColId);
    }

    /**
     * @param array $assoc
     */
    public function delete(array $assoc) {
        switch ($this->nomTable){
            case "Conduit":
                $skipper_id = $assoc['Skippeur_id'];
                $bateau_id = $assoc['Bateau_id'];
                $metierConduit = MetierConduit::initMetierConduit($skipper_id,$bateau_id);
                $metierConduit->delete();
                break;
            case "Resultat":
                $metierResultat = MetierResultat::initMetierResultat($assoc['Skipper_id'],$assoc['Course_id'] );
                $metierResultat->delete();
                break;
            default :
                if (! isset($this->pdos_delete))
                    $this->initPDOS_delete(array_keys($assoc)[0]);
                foreach ($assoc as $key => $value) {
                    $this->getPdosDelete()->bindValue(":".$key, $value);
                }
                $this->getPdosDelete()->execute();
                break;
        }

    }

    /**
     * préparation de la requête SELECT COUNT(*) FROM livre
     * instantiation de self::$_pdos_count
     */
    public function initPDOS_count() {
        $this->pdos_count = $this->pdo->prepare('SELECT COUNT(*) FROM '.$this->nomTable);
    }

    public function getnbEntite() : int{
        if (!isset($this->pdos_count)){
             $this->initPDOS_count();
        }
        $this->pdos_count->execute();
        $res = $this->pdos_count->fetch();
        return $res[0];
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
    public function getPdosSelectAll(): PDOStatement
    {
        return $this->pdos_selectAll;
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
    public function getPdosSelect(): PDOStatement
    {
        return $this->pdos_select;
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
     * @return PDO
     */
    public function getPdo(): PDO
    {
        return $this->pdo;
    }
    /**
     * @return string
     */
    public function getNomTable(): string
    {
        return $this->nomTable;
    }
}