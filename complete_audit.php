
<?php 
require("verify_login.php"); 
$answerID = $_GET['answerID'];
$customerID = $_GET['customerID'];

// $result = $db->query("SELECT QuestionID FROM Answers WHERE AnswerID = $answerID");
// $amount = $result->rowCount(); // count the number of rows returned
// echo $amount;









?>
<html>

	<?php 
	
    
    // Open database connection
    #$db = new SQLite3('/xampp/Data/test.db');
    
    // Get list of questions for the given answer ID
    

$result = $db->query("SELECT Questions.Question, Answers.Answer, Questions.QuestionID 
FROM Answers 
INNER JOIN Questions ON Answers.QuestionID = Questions.QuestionID 
WHERE Answers.AnswerID = $answerID");
	
	
	
	?>




	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="create_audit_style.css">
		<title>Questionnaire</title>
		<style>
			body {
				font-family: Arial, sans-serif;
				background-color: #f7f7f7;
			}
			form {
				margin: 20px auto;
				padding: 20px;
				background-color: #fff;
				box-shadow: 0 0 10px rgba(0,0,0,0.2);
				max-width: 600px;
				border-radius: 10px;
			}
			h1 {
				text-align: center;
				color: #444;
				margin-bottom: 20px;
			}
			p {
				font-weight: bold;
				margin-bottom: 10px;
			}
			label {
				display: block;
				margin-bottom: 10px;
			}
			input[type="checkbox"] {
				margin-right: 10px;
			}
			input[type="submit"] {
				background-color: #4CAF50;
				color: #fff;
				padding: 10px 20px;
				border: none;
				border-radius: 3px;
				cursor: pointer;
			}
			input[type="submit"]:hover {
				background-color: #3e8e41;
			}
			textarea {
				width: 100%;
				padding: 10px;
				box-sizing: border-box;
				margin-top: 5px;
				border: 1px solid #ccc;
				border-radius: 3px;
				resize: vertical;
			}
		</style>
	 
	<form method="POST">
    <table>
    <thead>
        <tr>
            <th>Question</th>
            <th>Answer</th>  
        </tr>
    </thead>
    <tbody>
        <?php 
        $amount = 0;
		$qid_array = [];
        while ($row = $result->fetchObject()) {
            $questionID = $row->QuestionID;
			$qid_array[] = $questionID;
            $question = $row->Question;
            $answer = $row->Answer;
            $amount += 1;
			
        ?>
        <tr>
            <td><?php echo $question; ?></td>
            <td>
                <label><input type="radio" name="answer_<?php echo $questionID; ?>" value="Yes" <?php if ($answer == 'Yes') { echo 'checked'; } ?>> Yes</label>
                <label><input type="radio" name="answer_<?php echo $questionID; ?>" value="No" <?php if ($answer == 'No') { echo 'checked'; } ?>> No</label>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<button type="submit" name="submit-button">Submit</button>
</form>
<?php if(isset($_POST['submit-button'])){
    
	
    
    

    for($x = 0; $x < $amount; $x++){
        
		$y = $qid_array[$x];
		
        $answer = $_POST["answer_$y"];
        

        
		$sql = "UPDATE Answers SET Answer = :A WHERE AnswerID = :AID AND QuestionID = :QID";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":AID",$answerID );
        $stmt->bindParam(":A", $answer);
        $stmt->bindParam(":QID", $y);
        $result = $stmt->execute();
    }

    $current_date = date("d-m-y");
$sql = "UPDATE Audit_Response SET Date = :Date WHERE AnswerID = :AID AND CustomerID = :CID";
$stmt = $db->prepare($sql);
$stmt->bindParam(":AID", $answer_id);
$stmt->bindParam(":CID", $_SESSION['businessID']);
$stmt->bindParam(":Date", $current_date);
$result = $stmt->execute();
header('Location:view_audit.php');

}?>
</html>
