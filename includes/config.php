<?php
#sd
// $dsn = 'mysql:host=a4a-server-group4.mysql.database.azure.com;dbname=a4a-database';
// $user = 'izqhdzlktw';
// $password = '315Y87ZNG4I53V17$';

$dsn = 'mysql:host=localhost;dbname=a4a-database';
$user = 'root';
$password = '';
try { 
$db = new PDO($dsn, $user, $password); 
$db ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
$db ->exec("SET CHARACTER SET utf8");
echo "connected";
}
catch (PDOException $e) { 
echo 'Connection failed again: ' . $e->getMessage();
}
?>