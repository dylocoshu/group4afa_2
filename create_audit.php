
<html>
    <?php require("verify_login.php")?>
    <?php 
    $db = new SQLite3("xampp/Data/Everybody_Welcome_Copy.db")
    ?>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="create_audit_style.css">
        <title>Everybody Welcome</title>
    </head>

    <div class = "cas-grid"> 
        <div class = "cas-box">
            <div>
                <label for="venue-type"> Select a Venue </label>
                <input name = "venue-type">
                <button type = "button" name="venue-button"> Venue Questions </button>
            </div>
            <div> 
                <label for="question"> Question: </label>
                <input name = "question">
                <button type = "button" name="add-question"> Add Question </button>
            </div>
            </br>
        </div>
    </div>
</html>