<?php
session_start();
require("includes/config.php");
$sql = "UPDATE business_owner SET Premium = 'Yes' WHERE Username = :Username AND BusinessID = :bid";
$stmt = $db->prepare($sql);

//Bind value.
$stmt->bindValue(':bid', $_SESSION['businessID']);
$stmt->bindValue(':Username', $_SESSION['username']);
$result = $stmt->execute();



Header("Location: Index.php")
?>