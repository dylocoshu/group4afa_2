<?php 
session_start();
if(!empty($_SESSION["businessID"])){
    $db = new SQLite3('/xampp/Data/EverybodyWelcomeDB.db');
    $sql = "SELECT Type FROM Business_Owner WHERE BusinessID = :id";
    $stmt = $db->prepare($sql);
    
    //Bind value.
    $stmt->bindValue(':id', $_SESSION["businessID"]);
    $result = $stmt->execute();
    $publisher = $result->fetchArray();

    if($publisher[0] === "Admin"){
        require("admin_NavBar.php");
    }
    else{
        require("user_NavBar.php");
    }
}
else{
    require("NavBar.php");
}
?>