
<!DOCTYPE html>
<html>
<head>
    <title>7th Objective</title>
</head>
<body>
    
<table border="2" align="center">
            <thead  ><tr>
        <th scope="col">Feautures</th>
        <th scope="col">Huawei P30
            Lite</th>
        <th scope="col">SamsuYng
            Galaxy 21
            Ultra</th>
        <th scope="col">Apple iPhone
            15 plus</th>
        <th scope="col">Xiaomi Redmi
            Note 12</th></tr>
</thead>
<tbody><tr>
    <th scope="row">Storage</th>
    <td>128GB</td>
    <td>512GB</td>
    <td>1TB</td>
    <td>128GB</td>
</tr><tr>
    <th scope="row">Dispaly</th>
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
    <th scope="row">iOs</th>
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
</body>
</html><?php
session_start();
$dsn = "mysql:dbname=tpsmartphone; host=127.0.0.1;";
try {
    $c = new PDO($dsn, "root", "");
    $c->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    printf("erreur de connexion à la base de donnée", $ex->getMessage());
    exit();
}
echo '<form method="POST">';
echo '<label for="feature">Feature:</label>
<input type="text" id="feature" name="feature" /><br><br>';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $feature =  $_POST['feature'];
    
}
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
if ($_SERVER["REQUEST_METHOD"] == "POST"){
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
}
echo ' <input type="submit" value="Submit" >';
    echo '</form>';




?>
