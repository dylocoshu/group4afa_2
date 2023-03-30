<html>
<?php require("verify_login.php");?>
<?php
//gets recent answerid audit
    #$db = new SQLite3('/xampp/Data/test.db');
    $sql = "SELECT AnswerID FROM Audit_Response WHERE CustomerID = :id ORDER BY Date DESC";
    $stmt = $db->prepare($sql);
    
    //Bind value.
    $stmt->bindValue(':id', $_GET["id"]);
    $result = $stmt->execute();
    $rows_array = [];
    $amount = 0;


    while ($row=$stmt->fetchObject())
    {
        $amount += 1;
        $rows_array[]=$row;
    }
    if($amount != 0){
        $answerID = $rows_array[0]->AnswerID;
    // gets questions with answers 'yes' to display access features
        $sql = "SELECT QuestionID FROM Answers WHERE AnswerID = :id AND Answer = 'Yes' ";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $answerID);
        $result = $stmt->execute();
        $rows_array = [];
        $q_amount = 0;


        while ($row=$stmt->fetchObject())
        {
            $q_amount += 1;
            $rows_array_q[]=$row;
        }

    //gets access features from question id

    ?>
    <?php $af_amount = 0; ?>
    <?php for($x = 0; $x < $q_amount; $x++){
        
        
        $sql = "SELECT  Access_Feature FROM Questions WHERE QuestionID = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $rows_array_q[$x]->QuestionID);
        $result = $stmt->execute();
        $rows_array = [];
        


        while ($row=$stmt->fetchObject())
        {
            $af_amount += 1;
            $rows_array_af[]=$row;
        }
        ?>
        <?php }?>
        <?php }?>


<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="homepage_style.css">
        <title>Everybody Welcome</title>
</head>
<?php if($amount != 0) {?>

<table>
  <thead>
    <tr align = "center">
      <th>Accessibility</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    <?php for($x = 0; $x < $af_amount; $x++){ ?>
    <tr align = "center">
        <td><strong> <?php echo $rows_array_af[$x]->Access_Feature ?></strong> </td>
        <td><?php echo '&#x2714;'?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>

<?php } ?>
</html>