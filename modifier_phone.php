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
if (isset($_GET['phone_id'])) {
    $phoneId = $_GET['phone_id'];
include("connexionBD.php");

$selectPhoneQuery = "SELECT * FROM smartphone WHERE Id_smartphone = :phoneId";
$stmt = $c->prepare($selectPhoneQuery);
$stmt->bindParam(':phoneId', $phoneId);
$stmt->execute();
$phoneData = $stmt->fetch();

// Fetch values from smartphone_features for the selected phone
$selectFeaturesQuery = "SELECT Id_Features, Value_Smartphone_Features FROM smartphone_features WHERE Id_Smartphone = :phoneId";
$stmt = $c->prepare($selectFeaturesQuery);
$stmt->bindParam(':phoneId', $phoneId);
$stmt->execute();
$featureData = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($phoneData) {
    // Display a form with existing data for updating the phone
    echo '<form id="updateForm" action="modifier_phone.php" method="post">';
    
    // Fill in the phone name
    echo '<label for="Name"> Phone name</label>';
    // echo $phoneData['Name_smartphone'];
    echo '<input type="text" name="Name" value="' . $phoneData['Name_smartphone'] . '">';
    
    // Loop through features and populate the form fields
    foreach ($featureData as $feature) {
        $featureId = $feature['Id_Features'];
        $featureValue = $feature['Value_Smartphone_Features'];

        // Retrieve the feature name based on the featureId
      
        $stmt = $c->prepare("SELECT Name_Features FROM features WHERE Id_Features = :featureId");
        $stmt->bindParam(':featureId', $featureId);
        $stmt->execute();
        $featureName = $stmt->fetchColumn();

        if ($featureName !== false) {
            echo '<label for="' . $featureName . '">' . $featureName . '</label>';
            echo '<input type="text" name="' . $featureName . '" value="' . $featureValue . '">';
            echo '<br>';
        }
    }
    
    echo '<input type="hidden" name="phone_id" value="' . $phoneId . '">';
    echo '<input id="inscrire" type="submit" title="Envoyer" value="submit phone changes">';
    echo '</form>';
} else {
    echo 'Phone not found.';
}
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Retrieve the posted data
$phoneId = $_POST['phone_id'];
$phoneName = $_POST['Name'];

// Create an associative array to store feature values
$featureValues = array();

// Loop through the posted data to extract feature values
foreach ($_POST as $key => $value) {
    if ($key != 'phone_id' && $key != 'Name') {
        $featureName = $key;
        $featureValue = $value;
        $featureValues[$featureName] = $featureValue;
    }
}

// Database connection
include("connexionBD.php");

// Update the phone name in the smartphone table
$stmt = $c->prepare( "UPDATE smartphone SET Name_smartphone = :phoneName WHERE Id_smartphone = :phoneId");
$stmt->bindParam(':phoneName', $phoneName);
$stmt->bindParam(':phoneId', $phoneId);

if ($stmt->execute()) {
    // Update feature values in smartphone_features
    foreach ($featureValues as $featureName => $featureValue) {
        // Retrieve the feature ID based on the feature name
        $stmt = $c->prepare("SELECT Id_Features FROM features WHERE Name_Features = :featureName");
        $stmt->bindParam(':featureName', $featureName);
        $stmt->execute();
        $featureId = $stmt->fetchColumn();

        if ($featureId !== false) {
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
    echo "Failed to update phone.";
}
} else {
echo 'No phone selected for updating.';
}
?>

