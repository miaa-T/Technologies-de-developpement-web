<?php
echo '<form method="POST">';
echo '<label for="phone">Smartphone Name:</label>
<input type="text" id="phone" name="phone" /><br><br>';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone =  $_POST['phone'];
    
}
$qtf="SELECT * FROM features";

$features = []; // la listedea features pour le tel 

foreach($c->query($qtf) as $row) {
    $featureId = $row["Id_Features"];
    echo '<label for="feature_'.$featureId.'">'.$row["Name_Features"].'</label>';
    echo '<input type="text" id="feature_'.$featureId.'" name="feature_'.$featureId.'"><br><br>';
    
    if(isset($_POST['feature_'.$featureId])) {
        $features[$featureId] = $_POST['feature_'.$featureId];
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $stmt = $c->prepare("INSERT INTO smartphone (Name_smartphone) VALUES (?)");
    $stmt->bindParam(1, $phone);
    $stmt->execute();
    $phone_id = $c->lastInsertId();
    
    $sqlr = "SELECT COUNT(*) as total FROM features";
    $result = $c->query($sqlr);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $featuresCount = $row['total'];
    
    

    $sqlr2 = "SELECT * FROM features";
    $phones = $c->query($sqlr2);
    $ids = [];
    while ($row = $phones->fetch(PDO::FETCH_ASSOC)) {
        array_push($ids, $row["Id_Features"]);
        
    };
    
    for ($i = 0; $i < (int)$featuresCount; $i++) {
        
        $featureId = $ids[$i];
            $valueSmartphoneFeatures = $features[$featureId];
    
            $sqlInsert = "INSERT INTO smartphone_features (Value_Smartphone_Features, Id_smartphone, Id_Features) 
                VALUES (:valueSmartphoneFeatures, :smartphoneId, :idFeatures)";
    
            $stmt = $c->prepare($sqlInsert);
            $stmt->bindParam(':valueSmartphoneFeatures', $valueSmartphoneFeatures);
            $stmt->bindParam(':smartphoneId', $phone_id);
            $stmt->bindParam(':idFeatures', $featureId); 
    
            $stmt->execute();
        }
}
echo ' <input type="submit" value="Submit" >';
    echo '</form>';

    ?> 