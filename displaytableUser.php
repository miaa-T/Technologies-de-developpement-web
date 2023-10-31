<?php
session_start();
include("connexionBD.php");

// Fetch all features
$stmt = $c->prepare("SELECT * FROM features");
$stmt->execute();
$features = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $features[] = $row;
}


echo '<table border="2" align="center">';
echo '<thead><tr><th scope="col">Features</th>';

$sql = $c->prepare("SELECT * FROM smartphone");
$sql->execute();
$smartphones = [];
while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
    echo '<th scope="col">' . $row['Name_smartphone'] . '</th>';
    $smartphones[] = $row;
}
echo '</tr></thead><tbody>';

foreach ($features as $feature) {
    echo '<tr><th scope="row">' . $feature['Name_Features'] . '</th>';
    foreach ($smartphones as $smartphone) {
        $sql2 = $c->prepare("SELECT smartphone_features.Value_Smartphone_Features FROM `smartphone_features` WHERE smartphone_features.Id_Features=:idFeature AND smartphone_features.Id_Smartphone=:idSmartphone");
        $sql2->bindParam(':idFeature', $feature["Id_Features"]);
        $sql2->bindParam(':idSmartphone', $smartphone["Id_smartphone"]);
        $sql2->execute();
        if ($value = $sql2->fetch(PDO::FETCH_ASSOC)) {
            echo "<td>" . $value["Value_Smartphone_Features"] . "</td>";
        } else {
            echo "<td></td>";
        }
    }

}

echo '</tbody></table>';
?>

