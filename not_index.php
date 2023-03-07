

<!DOCTYPE html>

<html>
  
<head>
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
<body>
	<h1>Questionnaire</h1>
	<form action="submit.php" method="post">
		<p>Videos available on website?</p>
		<label><input type="checkbox" name="response_1" value="yes"> Yes</label>
		<label><input type="checkbox" name="response_1" value="no"> No</label>
		<h3>Notes:</h3>
		<textarea name="notes_1"></textarea>

		<p>Audio description of video available?</p>
		<label><input type="checkbox" name="response_2" value="yes"> Yes</label>
		<label><input type="checkbox" name="response_2" value="no"> No</label>
		<h3>Notes:</h3>
		<textarea name="notes_2"></textarea>

		<p>Link to on-line Accessibility Guide?<p>
		<label><input type="checkbox" name="response_3" value="yes"> Yes</label>
		<label><input type="checkbox" name="response_3" value="no"> No</label>
		<h3>Notes:</h3>
		<textarea name="notes_3"></textarea>

		<p>Sensory Story available?</p>
		<label><input type="checkbox" name="response_4" value="yes"> Yes</label>
		<label><input type="checkbox" name="response_4" value="no"> No</label>
		<h3>Notes:</h3>
		<textarea name="notes_4"></textarea>

		<p>Wi-Fi Code displayed?</p>
		<label><input type="checkbox" name="response_5" value="yes"> Yes</label>
		<label><input type="checkbox" name="response_5" value="no"> No</label>
		<h3>Notes:</h3>
		<textarea name="notes_5"></textarea>

    <input type="submit" value="Submit"><form action="submit.php" method="post">
	</form>
</body>

</html>
	

