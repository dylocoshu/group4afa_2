<?php
#sd
<<<<<<< HEAD
// $dsn = 'mysql:host=localhost;dbname=a4adatabase';
// $user = 'root';
// $password = '';
=======
>>>>>>> eda8921663ea42ec52dcc3326c978afddcf1623a

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
<<<<<<< HEAD
$db ->exec("SET CHARACTER SET utf8");
=======

echo "connected";
>>>>>>> eda8921663ea42ec52dcc3326c978afddcf1623a
}
catch (PDOException $e) { 
echo 'Connection failed again: ' . $e->getMessage();
}
?>