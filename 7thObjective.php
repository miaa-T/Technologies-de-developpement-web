
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
    <!-- Insérez ici le code HTML pour l'interface de l'administrateur pour ajouter un smartphone ou une caractéristique -->
    <form method="post">
        <label for="feature">Feature:</label><br>
        <input type="text" id="feature" name="feature"><br><br>
        <label for="huawei">Huawei:</label><br>
        <input type="text" id="huawei" name="huawei"><br><br>
        <label for="samsung">Samsung:</label><br>
        <input type="text" id="samsung" name="samsung"><br><br>
        <label for="apple">Apple:</label><br>
        <input type="text" id="apple" name="apple"><br><br>
        <label for="xiaomi">Xiaomi:</label><br>
        <input type="text" id="xiaomi" name="xiaomi"><br><br>
        <input type="submit" value="Add Smartphone">
    </form>
</body>
</html>
<?php
session_start();
$dsn="mysql:dbname=tpsmartphone; host=127.0.0.1;";
try{
$c=new PDO($dsn,"root","");
}
catch(PDOException $ex){
printf("erreur de connexion à la base de donnée", $ex->getMessage());
exit();
}
// Vérifier si le formulaire d'ajout de smartphone a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assurez-vous de valider et d'échapper les données appropriées pour éviter les attaques par injection SQL
    $feature = $_POST['feature'];
    $huawei = $_POST['huawei'];
    $samsung = $_POST['samsung'];
    $apple = $_POST['apple'];
    $xiaomi = $_POST['xiaomi'];

    // Préparer et exécuter la requête d'insertion
    $stmt = $conn->prepare("INSERT INTO smartphones (feature, huawei, samsung, apple, xiaomi) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $feature, $huawei, $samsung, $apple, $xiaomi);
    $stmt->execute();

    // Rediriger l'administrateur vers la même page pour afficher les mises à jour
    header('Location: 7thObjective.php');
    exit;
}

// Fermer la connexion à la base de données
$conn->close();
?>



