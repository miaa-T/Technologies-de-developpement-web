<?php

require_once('GetTableController.php');

class GetTableModel {
    private $dbname = "tpsmartphone";
    private $host = "127.0.0.1";
    private $user = "root";
    private $pass = "";

    public function connect($dbname, $host, $user, $pass) {
        $dsn = "mysql:dbname=$dbname; host=$host;";
        try {
            $c = new PDO($dsn, $user, $pass);
            $c->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            printf("erreur de connexion à la base de donnée", $ex->getMessage());
            exit();
        }
        return $c;
    }

    public function disconnect(&$c) {
        $c = null;
    }

    public function request($c, $r) {
        $stmt = $c->prepare($r);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTableModel() {
        $c = $this->connect($this->dbname, $this->host, $this->user, $this->pass);
        $qtf = "SELECT s.Name_smartphone, f.Name_Features, sf.Value_Smartphone_Features 
                FROM Smartphone s 
                LEFT JOIN Smartphone_Features sf ON s.Id_smartphone = sf.Id_Smartphone 
                LEFT JOIN Features f ON sf.Id_Features = f.Id_Features;";
        $r = $this->request($c, $qtf);
        $this->disconnect($c);
        return $r;
    }
}
?>
