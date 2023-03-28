<html>
    <?php require("verify_login.php")?>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="view-audit_style.css">
        <title>Access for All</title>
    </head>
<form method="POST">
    <div class="va-grid">
        <div class="field-box">
            <header>Please choose an Audit</header>
            <?php
            // Get list of audits with completion status for the current user
            $sql = 'SELECT ar.AnswerID, ar.Date, 
                    CASE WHEN COUNT(a.Answer) < COUNT(q.Question) THEN "No" ELSE "Yes" END AS Completed
                    FROM Audit_Response ar
                    LEFT JOIN Answers a ON ar.AnswerID = a.AnswerID
                    LEFT JOIN Questions q ON a.QuestionID = q.QuestionID
                    WHERE ar.CustomerID = :CID
                    GROUP BY ar.AnswerID, ar.Date';

            $stmt = $db->prepare($sql);
            $stmt->bindParam(":CID", $_SESSION['businessID']);
            $stmt->execute();

            // Loop through each audit and display as a button in the form
            while ($row = $stmt->fetchObject()) {
                $answerID = $row->AnswerID;
                $date = $row->Date;
                $completed = $row->Completed === 'Yes';

                // Display audit as a button in the form
                if (!$completed) {
                    echo "<button type='submit' name='view-audit' value='$answerID' class='incomplete'>$date &#128276;</button>";
                } else {
                    echo "<button type='submit' name='view-audit' value='$answerID'>$date</button>";
                }
            }
            ?>
        </div>
        <div class="qna-box">
            <?php
            if (isset($_POST['view-audit'])) {
                $answerid = $_POST['view-audit'];
                $sql = "SELECT Questions.Question, Answers.Answer, Questions.Action_Point 
                        FROM Answers 
                        INNER JOIN Questions ON Answers.QuestionID = Questions.QuestionID 
                        WHERE Answers.AnswerID = :AID";
                $stmt = $db -> prepare($sql);
                $stmt->bindParam(":AID", $answerid);
                $stmt->execute();
            ?>
            <table>
                <tr>
                    <th>Question</th>
                    <th>Answer</th>
                    <th>Action Point</th>
                </tr>
                <?php while($row=$stmt->fetchObject()){?>
                
                <tr> 
                    <td><?php echo $row->Question?></td>
                    <td class="answer"><?php echo $row->Answer?></td>
                    <td><?php if (strtolower($row->Answer) == "no"){echo $row->Action_Point;}else{echo "N/A";}?></td>
                    <?php if (strtolower($row->Answer) == ""){$completed = "";}?>
                </tr>
                <?php } ?>
            </table>
            <?php if (!$completed) {
    echo "<button type='button' value='" . $answerID . "' class='btn btn-primary'>
    <a href='complete_audit.php?answerID=" . $answerID . "&customerID=" . $_SESSION['businessID'] . "'>Complete Audit</a>
</button>";} ?>
            <?php } ?>
        </div>
    </div>
</form>
<html>
