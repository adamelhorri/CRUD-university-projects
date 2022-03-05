<?php


class MetierResultat
{

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
     * PreparedStatement associé à un SELECT, calcule le nombre de livres de la table
     * @var PDOStatement;
     */
    private static $_pdos_count;

    /**
     * PreparedStatement associé à un SELECT, récupère tous les livres
     * @var PDOStatement;
     */
    private static $_pdos_selectAll;


    protected $Skipper_id;
    protected $Course_id;
    protected $Duo_id;
    protected $Classement;
    protected $TempsCourse;
    protected $Nouveau = TRUE;


    /**
     * Initialisation de la connexion et mémorisation de l'instance PDO dans LivreMetier::$_pdo
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
        self::$_pdos_selectAll = self::$_pdo->prepare('SELECT * FROM Resultat');
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
            $lesResultats = self::$_pdos_selectAll->fetchAll(PDO::FETCH_CLASS,'MetierResultat');
            return $lesResultats;
        }
        catch (PDOException $e) {
            print($e);
        }
    }


    /**
     * méthode statique instanciant LivreMetier::$_pdo_select
     */
    public static function initPDOS_select() {
        self::$_pdos_select = self::$_pdo->prepare(
            'SELECT * FROM Resultat WHERE Skipper_id = :numeroSkip AND Course_id = :numeroCourse '
        );
    }

    /**
     * méthode statique instanciant LivreMetier::$_pdo_update
     */
    public static function initPDOS_update() {
        self::$_pdos_update =  self::$_pdo->prepare('UPDATE Resultat SET Duo_id= :numeroDuo, Classement= :numeroClassement,TempsCourse = :tempCourse WHERE Skipper_id= :numeroSkip AND Course_id= :numeroCourse ');
    }

    /**
     * méthode statique instanciant LivreMetier::$_pdo_insert
     */
    public static function initPDOS_insert() {
        self::$_pdos_insert = self::$_pdo->prepare('INSERT INTO Resultat VALUES(:numeroSkip,:numeroCourse,:numeroDuo, :numeroClassement, :tempCourse )');
    }

    /**
     * méthode statique instanciant LivreMetier::$_pdo_delete
     */
    public static function initPDOS_delete() {
        self::$_pdos_delete = self::$_pdo->prepare('DELETE FROM Resultat WHERE Skipper_id=:numeroSkip AND Course_id=:numeroCourse');
    }

    /**
     * préparation de la requête SELECT COUNT(*) FROM livre
     * instantiation de self::$_pdos_count
     */
    public static function initPDOS_count() {
        if (!isset(self::$_pdo))
            self::initPDO();
        self::$_pdos_count = self::$_pdo->prepare('SELECT COUNT(*) FROM Resultat');
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
    public function getCourseId()
    {
        return $this->Course_id;
    }

    /**
     * @return mixed
     */
    public function getDuoId()
    {
        return $this->Duo_id;
    }

    /**
     * @return mixed
     */
    public function getClassement()
    {
        return $this->Classement;
    }

    /**
     * @return mixed
     */
    public function getTempsCourse()
    {
        return $this->TempsCourse;
    }

    /**
     * @param mixed $Skipper_id
     */
    public function setSkipperId($Skipper_id): void
    {
        $this->Skipper_id = $Skipper_id;
    }

    /**
     * @param mixed $TempsCourse
     */
    public function setTempsCourse($TempsCourse): void
    {
        $this->TempsCourse = $TempsCourse;
    }

    /**
     * @param mixed $Duo_id
     */
    public function setDuoId($Duo_id): void
    {
        $this->Duo_id = $Duo_id;
    }

    /**
     * @param mixed $Course_id
     */
    public function setCourseId($Course_id): void
    {
        $this->Course_id = $Course_id;
    }

    /**
     * @param mixed $Classement
     */
    public function setClassement($Classement): void
    {
        $this->Classement = $Classement;
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
     * @param $Course_id
     * @return MetierResultat
     * @throws Exception
     */
    public static function initMetierResultat($Skipper_id, $Course_id) : MetierResultat {
        try {
            if (!isset(self::$_pdo))
                self::initPDO();
            if (!isset(self::$_pdos_select))
                self::initPDOS_select();
            self::$_pdos_select->bindValue(':numeroSkip',$Skipper_id);
            self::$_pdos_select->bindValue(':numeroCourse',$Course_id);
            self::$_pdos_select->execute();
            // résultat du fetch dans une instance de MetierConduit
            $lm = self::$_pdos_select->fetchObject('MetierResultat');
            if (isset($lm) && ! empty($lm))
                $lm->setNouveau(FALSE);
            if (empty($lm))
                throw new Exception("Resultat $Skipper_id, $Course_id inexistant dans la table Resultat.\n");
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
            self::$_pdos_insert->bindParam(':numeroCourse', $this->Course_id);
            self::$_pdos_insert->bindParam(':numeroDuo', $this->Duo_id);
            self::$_pdos_insert->bindParam(':numeroClassement', $this->Classement);
            self::$_pdos_insert->bindParam(':tempCourse', $this->TempsCourse);
            self::$_pdos_insert->execute();
            $this->setNouveau(FALSE);
        }
        else {
            if (!isset(self::$_pdos_update))
                self::initPDOS_update();
            self::$_pdos_update->bindParam(':numeroSkip', $this->Skipper_id);
            self::$_pdos_update->bindParam(':numeroCourse', $this->Course_id);
            self::$_pdos_update->bindParam(':numeroDuo', $this->Duo_id);
            self::$_pdos_update->bindParam(':numeroClassement', $this->Classement);
            self::$_pdos_update->bindParam(':tempCourse', $this->TempsCourse);
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
            self::$_pdos_delete->bindParam(':numeroCourse', $this->Course_id);
            self::$_pdos_delete->execute();
        }
        $this->setNouveau(TRUE);
    }

    /**
     * nombre d'objets metier disponible dans la table
     */
    public static function getNbResultat() : int {
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
        $ch = "<table border='1'><tr><th>Skippeur_id</th><th>Course_id</th><th>Duo_id</th><th>Classement</th><th>TempsCourse</th></tr><tr>";
        $ch.= "<td>".$this->Skipper_id."</td>";
        $ch.= "<td>".$this->Course_id."</td>";
        $ch.= "<td>".$this->Duo_id."</td>";
        $ch.= "<td>".$this->Classement."</td>";
        $ch.= "<td>".$this->TempsCourse."</td>";
        $ch.= "</tr></table>";
        return $ch;
    }


}