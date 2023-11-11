<?php
session_start();
include("connexionBD.php");

if (isset($_POST['id'])) {
    $featureId = $_POST['id'];

    // Delete from Smartphone_Features table
    $deleteSmartphoneFeatures = $c->prepare("DELETE FROM `Smartphone_Features` WHERE Id_Features=:featureId");
    $deleteSmartphoneFeatures->bindParam(':featureId', $featureId);
    $deleteSmartphoneFeatures->execute();

    // Delete from Features table
    $deleteFeature = $c->prepare("DELETE FROM `Features` WHERE Id_Features=:featureId");
    $deleteFeature->bindParam(':featureId', $featureId);
    $deleteFeature->execute();

    echo "suppression avec succes";
} else {
    echo "echec";
}
?>