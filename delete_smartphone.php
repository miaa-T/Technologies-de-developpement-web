<?php
session_start();
include("connexionBD.php");

if (isset($_POST['id'])) {
    $phoneID = $_POST['id'];

    // Delete from Smartphone_Features table
    $deleteSmartphoneFeatures = $c->prepare("DELETE FROM `Smartphone_Features` WHERE Id_Smartphone=:phoneID");
    $deleteSmartphoneFeatures->bindParam(':phoneID', $phoneID);
    $deleteSmartphoneFeatures->execute();

    // Delete from Features table
    $deletePhone = $c->prepare("DELETE FROM `smartphone` WHERE Id_smartphone=:phoneID");
    $deletePhone->bindParam(':phoneID', $phoneID);
    $deletePhone->execute();

    echo "suppression avec succes";
} else {
    echo "echec";
}
?>
