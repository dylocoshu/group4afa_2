
<?php session_start(); ?>
<?php


#$db = new SQLite3('/xampp/Data/EverybodyWelcomeDB.db');


$response_1 = $_POST['response_1'];
$notes_1 = $_POST['notes_1'];
$response_2 = $_POST['response_2'];
$notes_2 = $_POST['notes_2'];
$response_3 = $_POST['response_3'];
$notes_3 = $_POST['notes_3'];
$response_4 = $_POST['response_4'];
$notes_4 = $_POST['notes_4'];
$response_5 = $_POST['response_5'];
$notes_5 = $_POST['notes_5'];

$AAID = rand(1,1500);
$BID = $_SESSION['businessID'];

$stmt = $db->prepare("INSERT INTO AuditAnswers (AuditAnswersID, BusinessID, NOTES1, NOTES2, NOTES3, NOTES4, NOTES5, A1, A2, A3, A4, A5) 
VALUES (:AAID, :BID, :notes_1, :notes_2, :notes_3, :notes_4, :notes_5, :a1, :a2, :a3, :a4, :a5)");

$stmt->bindValue(':AAID', $AAID); 
$stmt->bindValue(':BID', $BID); 
 
$stmt->bindValue(':a1', $response_1);   
$stmt->bindValue(':notes_1', $notes_1);
$stmt->bindValue(':a2', $response_2);
$stmt->bindValue(':notes_2', $notes_2);
$stmt->bindValue(':a3', $response_3);
$stmt->bindValue(':notes_3', $notes_3);
$stmt->bindValue(':a4', $response_4);
$stmt->bindValue(':notes_4', $notes_4);
$stmt->bindValue(':a5', $response_5);
$stmt->bindValue(':notes_5', $notes_5);
$result = $stmt->execute();


$db->close();


header('Location: homepage.php');

?>
