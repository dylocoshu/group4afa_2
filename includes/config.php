<?php
#sd

// $dsn = 'mysql:host=afagroup4.mysql.database.azure.com;dbname=afadatabase';
// $user = 'admingroup4';
// $password = 'Passwordgroup41!';

//$dsn = 'mysql:host=localhost;dbname=test';
//$user = 'root';
//$password = '';
//try { 
//$db = new PDO($dsn, $user, $password); 
//$db ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
//$db ->exec("SET CHARACTER SET utf8");
//echo "connected";
//}
//catch (PDOException $e) { 
//echo 'Connection failed again: ' . $e->getMessage();
//}


try { 
$db = new PDO("sqlite:/xampp/Data/test.db");
$db ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

echo "connected";
}
catch (PDOException $e) { 
echo 'Connection failed again: ' . $e->getMessage();
}
?>