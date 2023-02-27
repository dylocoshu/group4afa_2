<html>
<?php require("verify_login.php");?>
<?php
    $db = new SQLite3('/xampp/Data/test.db');
    $sql = "SELECT Type FROM Business_Owner WHERE BusinessID = :id";
    $stmt = $db->prepare($sql);
    
    //Bind value.
    $stmt->bindValue(':id', $_SESSION["businessID"]);
    $result = $stmt->execute();
    $publisher = $result->fetchArray();










?>






<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="homepage_style.css">
        <title>Everybody Welcome</title>
    </head>









</html>