<?php
session_start();
include('includes/config.php');
if(!empty($_SESSION['businessID'])){
    $sql = "SELECT Type FROM Business_Owner WHERE BusinessID = :id";
    $stmt = $db->prepare($sql);
    
    //Bind value.
    $stmt->bindValue(':id', $_SESSION['businessID']);
    $result = $stmt->execute();
    $publisher = $stmt->fetchObject();

    if($publisher->Type === "Admin"){
        require("admin_NavBar.php");
    }
    else{
        require("user_NavBar.php");

    }
}
else{
    require("NavBar2.php");
}
?>