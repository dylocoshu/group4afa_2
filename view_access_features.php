<html>
<?php require("verify_login.php");?>
<?php
//gets recent answerid audit
    $db = new SQLite3('/xampp/Data/test.db');
    $sql = "SELECT AnswerID FROM Audit_Response WHERE CustomerID = :id ORDER BY Date DESC";
    $stmt = $db->prepare($sql);
    
    //Bind value.
    $stmt->bindValue(':id', $_GET["id"]);
    $result = $stmt->execute();
    $rows_array = [];
    $amount = 0;


    while ($row=$result->fetchArray())
    {
        $amount += 1;
        $rows_array[]=$row;
    }
    $answerID = $rows_array[0][0];
// gets questions with answers 'yes' to display access features
    $sql = "SELECT QuestionID FROM Answers WHERE AnswerID = :id AND Answer = 'Yes' ";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':id', $answerID);
    $result = $stmt->execute();
    $rows_array = [];
    $q_amount = 0;


    while ($row=$result->fetchArray())
    {
        $q_amount += 1;
        $rows_array_af[]=$row;
    }

//gets access features from question id



?>


<?php for($x = 0; $x < $q_amount; $x++){?>
    <h1><?php echo $rows_array_af[$x][0] ?> </h1>
    <?php }?>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="homepage_style.css">
        <title>Everybody Welcome</title>
    </head>









</html>