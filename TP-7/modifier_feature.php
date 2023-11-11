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
    <?php
if (isset($_GET['feature_id'])) {
    $featureId = $_GET['feature_id'];
    include("connexionBD.php");

    

$stmt = $c->prepare("SELECT * FROM features WHERE  Id_Features = :featureId");
$stmt->bindParam(':featureId', $featureId);
$stmt->execute();
$featureData = $stmt->fetch();

// Fetch values from smartphone_features for the selected phone
$selectFeaturesQuery = "SELECT Id_Smartphone, Value_Smartphone_Features FROM smartphone_features WHERE Id_Features = :featureId";
$stmt = $c->prepare($selectFeaturesQuery);
$stmt->bindParam(':featureId', $featureId);
$stmt->execute();
$phoneData = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($featureData) {
    // Display a form with existing data for updating the phone
    echo '<form id="updateForm2" action="modifier_feature.php" method="post">';
    
    // Fill in the phone name
    echo '<label for="Name"> Feature name</label>';
    // echo $phoneData['Name_smartphone'];
    echo '<input type="text" name="Name" value="' . $featureData['Name_Features'] . '">';
    
    // Loop through features and populate the form fields
    foreach ($phoneData as $phone) {
        $phoneId = $phone['Id_Smartphone'];
        $featureValue = $phone['Value_Smartphone_Features'];

        // Retrieve the feature name based on the featureId
      
        $stmt = $c->prepare("SELECT Name_smartphone FROM smartphone WHERE Id_smartphone = :phoneId");
        $stmt->bindParam(':phoneId', $phoneId);
        $stmt->execute();
        $phoneName = $stmt->fetchColumn();

        if ($phoneName !== false) {
            echo '<label for="' . $phoneName . '">' . $phoneName . '</label>';
            echo '<input type="text" name="' . $phoneName . '" value="' . $featureValue . '">';
            echo '<br>';
        }
    }
    
    echo '<input type="hidden" name="feature_id" value="' . $featureId . '">';
    echo '<input id="inscrire" type="submit" title="Envoyer" value="submit feature changes">';
    echo '</form>';
} else {
    echo 'feature not found.';
}
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Retrieve the posted data
$featureId = $_POST['feature_id'];
$featureName = $_POST['Name'];

// Create an associative array to store feature values
$featureValues = array();

// Loop through the posted data to extract feature values
foreach ($_POST as $key => $value) {
    if ($key != 'feature_id' && $key != 'Name') {
        $phoneName = $key;
        $featureValue = $value;
        $featureValues[$phoneName] = $featureValue;
    }
}

// Database connection
include("connexionBD.php");
// Update the phone name in the smartphone table
$stmt = $c->prepare( "UPDATE features SET Name_Features = :featureName WHERE Id_Features = :featureId");
$stmt->bindParam(':featureName', $featureName);
$stmt->bindParam(':featureId', $featureId);

if ($stmt->execute()) {
    // Update feature values in smartphone_features
    foreach ($featureValues as $phoneName => $featureValue) {
        // Retrieve the feature ID based on the feature name
        $stmt = $c->prepare("SELECT Id_smartphone FROM smartphone WHERE Name_smartphone = :phoneName");
        $stmt->bindParam(':phoneName', $phoneName);
        $stmt->execute();
        $phoneId = $stmt->fetchColumn();

        if ($phoneId !== false) {
           
            // Update the feature value in smartphone_features
            $stmt = $c->prepare("UPDATE smartphone_features SET Value_Smartphone_Features = :featureValue WHERE Id_Smartphone = :phoneId AND Id_Features = :featureId");
            $stmt->bindParam(':featureValue', $featureValue);
            $stmt->bindParam(':phoneId', $phoneId);
            $stmt->bindParam(':featureId', $featureId);
            $stmt->execute();
        }
    }
    
    header('Location: ' . 'http://localhost:8080/TP1' . '/' . '7thObjective.php');
} else {
    echo "Failed to update feature.";
}
} else {
echo 'No feauture selected for updating.';
}
?>

