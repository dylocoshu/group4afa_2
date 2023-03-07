

<html>
	<?php require("verify_login.php"); 
	$db = new SQLite3('/xampp/Data/test.db');
	?>

	<?php 
	$answer_id = rand(1,1500);
	$customer_id = rand(1,1500);
	if(isset($_POST['submit-button'])){
		$row_amount = 0;
		$questionidArray = [];
		$sql_stmnt = "SELECT QuestionID, Question FROM Questions WHERE Venue_Type =  :V OR Venue_Type = 'General' ORDER BY Venue_Type ASC";
		$stmt = $db->prepare($sql_stmnt);
		$stmt->bindParam(":V", $_POST["venue-type"]);
		$result = $stmt->execute();
		while ($row = $result->fetchArray())
		{
			$row_amount += 1;
			$questionidArray[] = $row[0] ;
		}
		for($x = 0; $x < $row_amount; $x++){
			$sql = "INSERT INTO Answers (AnswerID, QuestionID, Answer)
			VALUES (:AID, :QID, :A)";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":AID",$answer_id );
			$answer = isset($_POST["answer_$x"]) ? $_POST["answer_$x"] : null;
			$stmt->bindParam(":A", $answer);
			$stmt->bindParam(":QID", $questionidArray[$x]);
			$result = $stmt->execute();

		}


		$current_date = date("d-m-y");
		$sql = "INSERT INTO Audit_Response (AnswerID, CustomerID, Date)
		VALUES (:AID, :CID, :Date)";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(":AID",$answer_id );
		$stmt->bindParam(":CID", $_SESSION['businessID']);
		$stmt->bindParam(":Date", $current_date);
		$result = $stmt->execute();








		
	}
	
	
	
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
	</head> 
	<form method="POST">
		<div> 
			<label for="venue-type"> Enter a Venue </label>
			<input name = "venue-type" value="<?php echo isset($_POST['venue-type']) ? $_POST['venue-type'] : '' ?>" >
			<button type = "submit" name="audit-button"> Start Audit </button>
		</div>
		</br>
		<table>
			<tr>
				<th>Question</th>
				<th>Answer</th>  
			</tr>
			<?php 
	

			$amount = 0;
				if(isset($_POST["audit-button"])){
					$sql_stmnt = "SELECT QuestionID, Question FROM Questions WHERE Venue_Type =  :V OR Venue_Type = 'General' ORDER BY Venue_Type ASC";
					$stmt = $db->prepare($sql_stmnt);
					$stmt->bindParam(":V", $_POST["venue-type"]);
					$result = $stmt->execute();
					$rows_array = [];

					while ($row=$result->fetchArray())
					{
						$amount += 1;
						$rows_array[]=$row;
					}
				if($amount !== 0){ ?>
					<?php for($x = 0; $x < $amount; $x += 1) {?>
						<tr>
							<td><?php echo $rows_array[$x][1] ?></td>
							<td>
								<label><input type="radio" name=<?php echo "answer_$x"?> value="Yes"> Yes</label>
								<label><input type="radio" name=<?php echo "answer_$x"?> value="No"> No</label>   
							</td>
						</tr>
					<?php } ?>
				<?php } ?>
			<?php } ?>
		</table>
		<button type = "submit" name="submit-button"> Submit </button>
	</form>
</html>