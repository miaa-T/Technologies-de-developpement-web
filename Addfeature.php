<?php
include("connexionBD.php");

echo '<form method="POST">';
echo '<label for="feature">Feature:</label>';
echo '<input type="text" id="feature" name="feature" /><br><br>';
$qtf="SELECT * FROM smartphone";

$features = [];

foreach($c->query($qtf) as $row) {
    $smartphoneId = $row["Id_smartphone"];
    echo '<label for="feature_'.$smartphoneId.'">'.$row["Name_smartphone"].'</label>';
    echo '<input type="text" id="feature_'.$smartphoneId.'" name="feature_'.$smartphoneId.'"><br><br>';

    if(isset($_POST['feature_'.$smartphoneId])) {
        $features[$smartphoneId] = $_POST['feature_'.$smartphoneId];
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['feature']) && $_POST['feature']!="") {
        $feature =  $_POST['feature'];
        
        $stmt = $c->prepare("INSERT INTO features (Name_Features) VALUES (?)");
        $stmt->bindParam(1, $feature);
        $stmt->execute();
        $feature_id = $c->lastInsertId();
        
        $sqlr = "SELECT COUNT(*) as total FROM smartphone";
        $result = $c->query($sqlr);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $smartphoneCount = $row['total'];
        
        $sqlr2 = "SELECT * FROM smartphone";
        $phones = $c->query($sqlr2);
        $ids = [];
        while ($row = $phones->fetch(PDO::FETCH_ASSOC)) {
            array_push($ids, $row["Id_smartphone"]);
        };
        
        for ($i = 0; $i < (int)$smartphoneCount; $i++) {
            $smartphoneId = $ids[$i];
            $valueSmartphoneFeatures = $features[$smartphoneId];
            
            $sqlInsert = "INSERT INTO smartphone_features (Value_Smartphone_Features, Id_smartphone, Id_Features) 
                VALUES (:valueSmartphoneFeatures, :smartphoneId, :idFeatures)";
            
            $stmt = $c->prepare($sqlInsert);
            $stmt->bindParam(':valueSmartphoneFeatures', $valueSmartphoneFeatures);
            $stmt->bindParam(':smartphoneId', $smartphoneId);
            $stmt->bindParam(':idFeatures', $feature_id); 
            $stmt->execute();
        }

        echo 'feature ajoutée avec succé';
    } 
}
echo ' <input type="submit" value="Submit" >';
echo '</form>';
?>
