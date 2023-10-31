<?php
session_start();
include("connexionBD.php");

if (isset($_POST['id'])) {
    $phoneID = $_POST['id'];

    $stmt = $c->prepare("SELECT * FROM smartphone WHERE Id_smartphone = :phoneID");
    $stmt->bindParam(':phoneID', $phoneID);
    $stmt->execute();
    $feature = $stmt->fetch(PDO::FETCH_ASSOC);

    echo '<form  method="POST">';
    echo '<label>' . $feature['Name_smartphone'] . ':</label>';

    $sql = $c->prepare("SELECT * FROM features");
    $sql->execute();
    while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        echo '<label>' . $row['Name_Features'] . ':</label>';
        $sql2 = $c->prepare("SELECT Value_Smartphone_Features FROM `smartphone_features` WHERE Id_Smartphone=:idSmartphone AND Id_Features=:idfeature");
        $sql2->bindParam(':idSmartphone', $phoneID);
        $sql2->bindParam(':idfeature', $row['Id_Features']);
        $sql2->execute();
        $value = $sql2->fetch(PDO::FETCH_ASSOC);
        $val = $value["Value_Smartphone_Features"];

        echo '<input type="text">'.$val.'</br>';
    }

    echo '<input type="submit" value="Save">';
    echo '</form>';
}
?>

