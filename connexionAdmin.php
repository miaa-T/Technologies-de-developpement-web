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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === 'adminTDW' && $password === '123admin') { // Sans recuperation de la base de donnees
       
        header('Location: 7thObjective.php');
        exit;
    } else {
        echo "Nom d'utilisateur ou mot de passe incorrect! Veuillez Ressayer";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <form method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
