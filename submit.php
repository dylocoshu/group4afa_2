<?php


$db = new SQLite3('EverbodyWelcomeDB.db');


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


$stmt = $db->prepare("INSERT INTO Questionnaires (response_1, notes_1, response_2, notes_2, response_3, notes_3, response_4, notes_4, response_5, notes_5) VALUES (:response_1, :notes_1, :response_2, :notes_2, :response_3, :notes_3, :response_4, :notes_4, :response_5, :notes_5)");


$stmt->bindValue(':response_1', $response_1);
$stmt->bindValue(':notes_1', $notes_1);
$stmt->bindValue(':response_2', $response_2);
$stmt->bindValue(':notes_2', $notes_2);
$stmt->bindValue(':response_3', $response_3);
$stmt->bindValue(':notes_3', $notes_3);
$stmt->bindValue(':response_4', $response_4);
$stmt->bindValue(':notes_4', $notes_4);
$stmt->bindValue(':response_5', $response_5);
$stmt->bindValue(':notes_5', $notes_5);


$result = $stmt->execute();


$db->close();


header('Location: questionnaire.php');

?>
