<!DOCTYPE html>
<html>
<head>
    <title>7th Objective</title>
</head>
<body>
    
<table border="2" align="center">
    <thead>
        <tr>
            <th scope="col">Feautures</th>
            <th scope="col">Huawei P30 Lite</th>
            <th scope="col">Samsung Galaxy 21 Ultra</th>
            <th scope="col">Apple iPhone 15 plus</th>
            <th scope="col">Xiaomi Redmi Note 12</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">Storage</th>
            <td>128GB</td>
            <td>512GB</td>
            <td>1TB</td>
            <td>128GB</td>
        </tr>
        <tr>
            <th scope="row">Display</th>
            <td>6.67-inch</td>
            <td>6.70-inch</td>
            <td>6.80-inch</td>
            <td>6.15-inch</td>
        </tr>
        <tr>
            <th scope="row">RAM</th>
            <td>6GB</td>
            <td>6GB</td>
            <td>6GB</td>
            <td>6GB</td>
        </tr>
        <tr>
            <th scope="row">iOS</th>
            <td>Android</td>
            <td>iOS</td>
            <td colspan="2" align="center">Android</td>
        </tr>
        <tr>
            <th scope="row" >Removable battery</th>
            <td rowspan="2" align="center">No</td>
            <td colspan="3" align="center">No</td>
        </tr>
        <tr>
            <th scope="row">Wireless charging</th>
            <td colspan="2" align="center">Yes</td>
            <td>No</td>
        </tr>
    </tbody>
</table>    

<form method="post">
    <label for="feature">Feature:</label>
    <input type="text" id="feature" name="feature"><br><br>

    <?php
    foreach($c->query($qtf) as $row) {
        $smartphoneId = $row["Id_smartphone"];
        echo '<label for="feature_'.$smartphoneId.'">'.$row["Name_smartphone"].'</label>';
        echo '<input type="text" id="feature_'.$smartphoneId.'" name="feature_'.$smartphoneId.'"><br><br>';
    }
    ?>
    <input type="submit" value="Submit">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach($c->query($qtf) as $row) {
        $smartphoneId = $row["Id_smartphone"];
        if(isset($_POST['feature_'.$smartphoneId])) {
            $features[$smartphoneId] = $_POST['feature_'.$smartphoneId];
        }
    }

    $stmt = $c->prepare("INSERT INTO features (Name_Features) VALUES (?)");
    $stmt->bindParam(1, $feature);
    $stmt->execute();
    $feature_id = $c->lastInsertId();

    $sqlr = "SELECT COUNT(*) as total FROM smartphone";
    $result = $c->query($sqlr);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $smartphoneCount = $row['total'];

    $sqlSmartphones = "SELECT * FROM smartphone";
    $smartphoneResult = $c->query($sqlSmartphones);
    $features = [];

    while ($smartphone = $smartphoneResult->fetch(PDO::FETCH_ASSOC)) {
        $smartphoneId = $smartphone['Id_smartphone'];
        if (array_key_exists($smartphoneId, $features)) {
            $valueSmartphoneFeatures = $features[$smartphoneId];
            $idSmartphone = $smartphone['Id_smartphone'];
            $sqlInsert = "INSERT INTO smartphone_features (Value_Smartphone_Features, Id_smartphone, Id_Features) 
                VALUES (:valueSmartphoneFeatures, :idSmartphone, :idFeatures)";

            $stmt = $c->prepare($sqlInsert);
            $stmt->bindParam(':valueSmartphoneFeatures', $valueSmartphoneFeatures);
            $stmt->bindParam(':idSmartphone', $idSmartphone);
            $stmt->bindParam(':idFeatures', $feature_id); 
            $stmt->execute();
        }
    }
}
?>

</body>
</html>
