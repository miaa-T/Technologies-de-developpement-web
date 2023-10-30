<?php
$dsn = "mysql:dbname=tpsmartphone; host=127.0.0.1;";
try {
    $c = new PDO($dsn, "root", "");
    $c->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    printf("erreur de connexion à la base de donnée", $ex->getMessage());
    exit();
}
?>