<?php
// $dsn = 'mysql:host=localhost;dbname=a4adatabase';
// $user = 'root';
// $password = '';

$dsn = 'mysql:host=afagroup4.mysql.database.azure.com;dbname=afadatabase';
$user = 'admingroup4';
$password = 'Passwordgroup41!';
try { 
$db = new PDO($dsn, $user, $password);

}
catch (PDOException $e) { 
echo 'Connection failed again: ' . $e->getMessage();
}
?>
