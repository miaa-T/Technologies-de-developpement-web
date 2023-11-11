
<!DOCTYPE html>
<html>
<head>
    <title>7th Objective</title>
    <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<style>
        body {
            background-color: beige;
            font-family: Arial, sans-serif;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: skyblue;
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
            font-size: 14px; /* Adjust the font size as per your requirement */
        }

        input[type="text"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            width: 100%;
            background-color: beige;
            color: #333;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #f5f5f5;
        }

        /* Add some spacing between the forms */
        form + form {
            margin-top: 20px;
        }
      
        #updateForm {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    
    </style>
</head>
<body><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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

 

</script>
<?php

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
    echo '<td><a href="modifier_feature.php?feature_id=' . $feature['Id_Features'] . '"><button>Modifier</button></a></td>';

    echo '<td><button onclick="deleteFeature(' . $feature['Id_Features'] . ')">Supprimer</button></td>';
    echo '</tr>';
}
echo '<tr>';
echo '<td></td>';
foreach ($smartphones as $smartphone) {
    echo '<td><a href="modifier_phone.php?phone_id=' . $smartphone['Id_smartphone'] . '"><button>Modifier</button></a></td>';
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
</body>
</html><?php
include("Addfeature.php");
include("AddSmartphone.php");

?>