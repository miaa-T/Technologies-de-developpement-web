<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
        function deleteFeature(featureId) {
            if (confirm('etes vous sur de cette suppression?')) {
                $.post('delete_feature.php', {id: featureId});
            }
        }
        function deleteSmartphone(phoneID){
            if (confirm('etes vous sur de cette suppression?')) {
                $.post('delete_smartphone.php', {id: phoneID});
            }
        }
    function editFeature(featureId) {
        if (confirm('sure?')) {
            $.post('modifier_feature.php', {id: featureId}, function(data) {
                $('#formContainer').html(data);
            });
        }
    }
    function editSmartphone(phoneID) {
        if (confirm('sure?')) {
            $.post('modifier_phone.php', {id: phoneID});
        }
    }

</script>

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

// Fetch all smartphone features
echo '<table border="2" align="center">';
echo '<thead><tr><th scope="col">Features</th>';

// Fetch all smartphones
$sql = $c->prepare("SELECT * FROM smartphone");
$sql->execute();
$smartphones = [];
while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
    echo '<th scope="col">' . $row['Name_smartphone'] . '</th>';
    $smartphones[] = $row;
}
echo '</tr></thead><tbody>';

// Iterate through each feature
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
    echo '<td><button onclick="editFeature(' . $feature['Id_Features'] . ')">Modifier</button></td>';
    echo '<td><button onclick="deleteFeature(' . $feature['Id_Features'] . ')">Supprimer</button></td>';
    echo '</tr>';
}
echo '<tr>';
echo '<td></td>';
foreach ($smartphones as $smartphone) {
    echo '<td><button onclick="editSmartphone(' . $smartphone['Id_smartphone'] . ')">Modifier</button></td>';
}
echo '</tr>';

echo '<tr>';
echo '<td></td>';
foreach ($smartphones as $smartphone) {
    echo '<td><button onclick="deleteSmartphone(' . $smartphone['Id_smartphone'] . ')">Supprimer</button></td>';
}
echo '</tr>';
echo '</tbody></table>';

?>

