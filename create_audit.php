

<?php 

$db = new SQLite3('/xampp/Data/test.db');


if(isset($_POST['add-question'])){
    $sql = "INSERT INTO Questions (Question, Venue_Type, Action_Point)
    VALUES (:Q, :VT, :AP)";
    $stmt = $db -> prepare($sql);
    $stmt->bindParam(":Q", $_POST['question']);
    $stmt->bindParam(":VT", $_POST['venue-type']);
    $stmt->bindParam(":AP", $_POST['action-point']);
    $result = $stmt->execute();
}
?>











<html>
    <?php require("verify_login.php")?>
    <?php 
    $db = new SQLite3('/xampp/Data/test.db')
    ?>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="create_audit_style.css">
        <title>Everybody Welcome</title>
    </head>
<form method = "POST">
    <div class = "cas-grid"> 
        <div class = "qna-box-grid">
            <div>
                <label class = qna-box-label> Select a Venue </label>
                <input class = qna-box-input name = "venue-type">
                <button class = qna-box-button type = "button" name="venue-button"> Venue Questions </button>
            </div>
</br>
            <div> 
                <label class = qna-box-label> Question: </label>
                <input class = qna-box-input name = "question">
            </div>
            </br>
            <div> 
                <label class = qna-box-label> Action Point: </label>
                <input class = qna-box-input name = "action-point">
            </div>
            <button class = qna-box-button type="submit" name="add-question"> Add Question </button>
            </br>
        </div>
    </div>
</form>
</html>