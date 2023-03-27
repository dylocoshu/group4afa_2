<html>
    <?php require("verify_login.php")?>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="view-audit_style.css">
        <title>Access for All</title>
    </head>
<form method = "POST">
    <div class = "va-grid">
        <div class = "field-box">
            <header>Please choose an Audit</header>
            <?php 
            #$db = new SQLite3('/xampp/Data/test.db');
            $sql = "SELECT AnswerID, Date from Audit_Response WHERE CustomerID = :CID";
            $stmt = $db -> prepare($sql);
            $stmt->bindParam(":CID", $_SESSION['businessID']);
            $result = $stmt->execute();
            $amount=0;
            $rows_array = [];
            while($row=$stmt->fetchObject()){
                $amount += 1;
                $rows_array[] = $row;
            }
            ?>
            <?php for($x = 0;$x<$amount;$x++){?>
                <button type="submit" name="view-audit" value=<?php echo $rows_array[$x]->AnswerID ?>><?php echo ($x+1)." ".$rows_array[$x]->Date ?></button>
            <?php }?>
        </div>
        <div class = "qna-box">
        <?php 
            if(isset($_POST['view-audit'])){
                $answerid = $_POST['view-audit'];
                $sql = "SELECT Questions.Question, Answers.Answer, Questions.Action_Point from Answers 
                INNER JOIN Questions ON Answers.QuestionID = Questions.QuestionID 
                WHERE Answers.AnswerID = :AID";
                $stmt = $db -> prepare($sql);
                $stmt->bindParam(":AID", $answerid);
                $result = $stmt->execute();
                $amount=0;
                $rows_array = [];
                while($row=$stmt->fetchObject()){
                    $amount += 1;
                    $rows_array[] = $row;
                }
            }
            ?>
            <table>
            <?php if(isset($_POST['view-audit'])){ ?>
                <tr>
                    <th>Question</th>
                    <th>Answer</th>
                    <th>Action Point</th>
                </tr>
                <?php for($x=0;$x < $amount;$x+=1){?>
                <tr> 
                    <td> <?php echo $rows_array[$x]->Question?></td>
                    <td class = "answer"> <?php echo $rows_array[$x]->Answer?></td>
                    <td> <?php if(strtolower($rows_array[$x]->Answer) == "no"){echo $rows_array[$x]->Action_Point;}else{echo "N/A";}?></td>
                </tr>
                <?php } ?>
            <?php } ?>
            </table>
        </div>
    </div>
</form>
<html>