<?php


class MetierConduit  {

    /**
     * gestion statique des accès SGBD
     * @var PDO
     */
    private static $_pdo;

    /**
     * gestion statique de la requête préparée de selection
     * @var PDOStatement
     */
    private static $_pdos_select;

    /**
     * gestion statique de la requête préparée de mise à jour
     *  @var PDOStatement
     */
    private static $_pdos_update;

    /**
     * gestion statique de la requête préparée de d'insertion
     * @var PDOStatement
     */
    private static $_pdos_insert;

    /**
     * gestion statique de la requête préparée de suppression
     * @var PDOStatement
     */
    private static $_pdos_delete;

    /**
     * PreparedStatement associé à un SELECT, calcule le nombre d'enregistrement de la table
     * @var PDOStatement;
     */
    private static $_pdos_count;

    /**
     * PreparedStatement associé à un SELECT, récupère tous les enregistrements
     * @var PDOStatement;
     */
    private static $_pdos_selectAll;


    protected $Skipper_id;
    protected $Bateau_id;
    protected $Nouveau = TRUE;


    /**
     * Initialisation de la connexion et mémorisation de l'instance PDO
     */
    public static function initPDO() {
        self::$_pdo = new PDO("mysql:host=localhost;dbname=lerbi","root","");
        // pour récupérer aussi les exceptions provenant de PDOStatement
        self::$_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * préparation de la requête SELECT * FROM livre
     * instantiation de self::$_pdos_selectAll
     */
    public static function initPDOS_selectAll() {
        self::$_pdos_selectAll = self::$_pdo->prepare('SELECT * FROM Conduit');
    }


    /**
     * @return array
     */
    public static function getAll(): array {
        try {
            if (!isset(self::$_pdo))
                self::initPDO();
            if (!isset(self::$_pdos_selectAll))
                self::initPDOS_selectAll();
            self::$_pdos_selectAll->execute();
            // résultat du fetch dans une instance de LivreMetier
            $lesLivres = self::$_pdos_selectAll->fetchAll(PDO::FETCH_CLASS,'MetierConduit');
            return $lesLivres;
        }
        catch (PDOException $e) {
            print($e);
        }
    }


    /**
     * méthode statique instanciant MetierConduit::$_pdo_select
     */
    public static function initPDOS_select() {
        self::$_pdos_select = self::$_pdo->prepare(
            'SELECT * FROM Conduit WHERE Skipper_id = :numeroSkip AND Bateau_id = :numeroBat '
        );
    }

    /**
     * méthode statique instanciant MetierConduit::$_pdo_update
     */
    public static function initPDOS_update() {
        self::$_pdos_update =  self::$_pdo->prepare('UPDATE Conduit SET Skipper_id=:numeroSkip, Bateau_id=:numeroBat WHERE Skipper_id=:numeroSkip AND Bateau_id=:numeroBat ');
    }

    /**
     * méthode statique instanciant MetierConduit::$_pdo_insert
     */
    public static function initPDOS_insert() {
        self::$_pdos_insert = self::$_pdo->prepare('INSERT INTO Conduit VALUES(:numeroSkip,:numeroBat)');
    }

    /**
     * méthode statique instanciant MetierConduit::$_pdo_delete
     */
    public static function initPDOS_delete() {
        self::$_pdos_delete = self::$_pdo->prepare('DELETE FROM Conduit WHERE Skipper_id=:numeroSkip AND Bateau_id=:numeroBat');
    }

    /**
     * préparation de la requête SELECT COUNT(*) FROM Conduit
     * instantiation de self::$_pdos_count
     */
    public static function initPDOS_count() {
        if (!isset(self::$_pdo))
            self::initPDO();
        self::$_pdos_count = self::$_pdo->prepare('SELECT COUNT(*) FROM Conduit');
    }


    /**
     * @return mixed
     */
    public function getSkipperId()
    {
        return $this->Skipper_id;
    }

    /**
     * @return mixed
     */
    public function getBateauId()
    {
        return $this->Bateau_id;
    }

    /**
     * @param mixed $Skipper_id
     */
    public function setSkipperId($Skipper_id): void
    {
        $this->Skipper_id = $Skipper_id;
    }

    /**
     * @param mixed $Bateau_id
     */
    public function setBateauId($Bateau_id): void
    {
        $this->Bateau_id = $Bateau_id;
    }

    /**
     * @return bool
     */
    public function getNouveau()
    {
        return $this->Nouveau;
    }

    public function setNouveau(bool $b) : void{
        $this->Nouveau = $b;
    }

    /**
     * @param $Skipper_id
     * @param $Bateau_id
     * @return MetierConduit
     * @throws Exception
     */
    public static function initMetierConduit($Skipper_id, $Bateau_id) : MetierConduit {
        try {
            if (!isset(self::$_pdo))
                self::initPDO();
            if (!isset(self::$_pdos_select))
                self::initPDOS_select();
            self::$_pdos_select->bindValue(':numeroSkip',$Skipper_id);
            self::$_pdos_select->bindValue(':numeroBat',$Bateau_id);
            self::$_pdos_select->execute();
            // résultat du fetch dans une instance de MetierConduit
            $lm = self::$_pdos_select->fetchObject('MetierConduit');
            if (isset($lm) && ! empty($lm))
                $lm->setNouveau(FALSE);
            if (empty($lm))
                throw new Exception("$Skipper_id, $Bateau_id inexistant dans la table Conduit.\n");
            return $lm;
        }
        catch (PDOException $e) {
            print($e);
        }
    }


    public function save() : void {
        if (!isset(self::$_pdo))
            self::initPDO();
        if ($this->Nouveau) {
            if (!isset(self::$_pdos_insert)) {
                self::initPDOS_insert();
            }
            self::$_pdos_insert->bindParam(':numeroSkip', $this->Skipper_id);
            self::$_pdos_insert->bindParam(':numeroBat', $this->Bateau_id);
            self::$_pdos_insert->execute();
            $this->setNouveau(FALSE);
        }
        else {
            if (!isset(self::$_pdos_update))
                self::initPDOS_update();
            self::$_pdos_update->bindParam(':numeroSkip', $this->Skipper_id);
            self::$_pdos_update->bindParam(':numeroBat', $this->Bateau_id);
            self::$_pdos_update->execute();
        }
    }

    /**
     * suppression d'un objet métier
     */
    public function delete() :void {
        if (!isset(self::$_pdo))
            self::initPDO();
        if (!$this->Nouveau) {
            if (!isset(self::$_pdos_delete)) {
                self::initPDOS_delete();
            }
            self::$_pdos_delete->bindParam(':numeroSkip', $this->Skipper_id);
            self::$_pdos_delete->bindParam(':numeroBat', $this->Bateau_id);
            self::$_pdos_delete->execute();
        }
        $this->setNouveau(TRUE);
    }

    /**
     * nombre d'objets metier disponible dans la table
     */
    public static function getNbConduit() : int {
        if (!isset(self::$_pdos_count)) {
            self::initPDOS_count();
        }
        self::$_pdos_count->execute();
        $resu = self::$_pdos_count->fetch();
        return $resu[0];
    }

    /**
     * affichage élémentaire
     */
    public function __toString() : string {
        $ch = "<table border='1'><tr><th>Skippeur_id</th><th>Bateau_id</th></tr><tr>";
        $ch.= "<td>".$this->Skipper_id."</td>";
        $ch.= "<td>".$this->Bateau_id."</td>";
        $ch.= "</tr></table>";
        return $ch;
    }


}