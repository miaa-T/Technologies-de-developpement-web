<?php
session_start();
include("connexionBD.php");

if (isset($_POST['id'])) {
    $featureId = $_POST['id'];

    
    $stmt = $c->prepare("SELECT * FROM features WHERE Id_Features = :featureId");
    $stmt->bindParam(':featureId', $featureId);
    $stmt->execute();
    $feature = $stmt->fetch(PDO::FETCH_ASSOC);

    
        echo '<form  method="POST">';
        echo '<label>' . $feature['Name_Features'] . ':</label>';

        $sql = $c->prepare("SELECT * FROM smartphone");
        $sql->execute();
        $smartphones = [];
        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            echo '<label>' . $row['Name_smartphone'] . ':</label>';
            global $c;
            $sql2 = $c->prepare("SELECT smartphone_features.Value_Smartphone_Features FROM `smartphone_features` WHERE smartphone_features.Id_Features=:idFeature AND smartphone_features.Id_Smartphone=:idSmartphone");
            $sql2->bindParam(':idFeature', $featureId);
            $sql2->bindParam(':idSmartphone', $smartphoneId);
            $sql2->execute();
            $value = $sql2->fetch(PDO::FETCH_ASSOC);
            $val= $value["Value_Smartphone_Features"] ;
        }
          
            echo '<input type="text" id="feature_'.$smartphoneId.'" name="feature_'.$smartphoneId.'"></br>';
}
        echo '<input type="submit" value="Save">';
        echo '</form>';
    

}
?>
