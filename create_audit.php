

<?php 
$amount = 0;
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

if (isset($_POST['venue-type'])){
    $venue=$_POST['venue-type'];
    $sql = "SELECT Question, Action_Point, QuestionID FROM Questions WHERE Venue_Type = :venue";
    $stmt = $db -> prepare($sql);
    $stmt->bindParam(":venue", $venue);
    $result = $stmt->execute();
    $rows_array = [];
    $amount = 0;


    while ($row=$result->fetchArray())
    {
    $amount += 1;
    $rows_array[]=$row;
    }
}

if(isset($_POST['delete'])){
    echo $_POST['delete'];
    $sql = "DELETE from Questions WHERE QuestionID = :id";
    $stmt = $db -> prepare($sql);
    $stmt->bindParam(":id", $_POST['delete']);
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
            <table style="width: 100%; text-align: center;">
                <tr>
                    <td> <label > Select a Venue </label></td>
                    <td><input type = "search" name ="venue-type" placeholder="Search"> </td>
                    <td><button type = "submit" name="venue-button"> Venue Questions </button> </td>
                    
                </tr>
                <tr>
                    <td> <label > Question: </label></td>
                    <td> <input  name = "question"></td>
                </tr>
                <tr> 
                    <td> <label> Action Point: </label> </td>
                    <td> <input name = "action-point"></td>
                </tr>
                <tr>
                    <td> <button class = qna-box-button type="submit" name="add-question"> Add Question </button></td>
                </tr>
            </table>
        </div>
    </div>
</form>
<form method="POST">
                <div class = "homepage-table">
                    <table style="width: 100%; text-align: center;">
                        <tr class="tableHead">
                            <th>Question</th>
                            <th>Action Point</th>
                            <th></th>
                            
                        </tr>
                        <?php for($x = 0  ; $x < $amount; $x+=1){;?>
                                    <tr>
                                        <td><strong><?php echo $rows_array[$x][0]?></strong></td>
                                        <td><strong><?php echo $rows_array[$x][1];?></strong></td>
                                        <?php if($rows_array[$x][1]){ ?><td> <button type="submit" name="delete" value= <?php echo $rows_array[$x][2] ?>> Delete </button></td><?php } ?>
                                      
                                    </tr>
                                    <?php }?>
                        </table>   

                        
                                </div>
                        </form>
                               
</html>