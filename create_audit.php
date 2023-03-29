
<?php require('includes/config.php'); ?>
<?php 
$amount = 0;
#$db = new SQLite3('/xampp/Data/test.db');


if(isset($_POST['add-question'])){
    $no = "No";
    $sql = "INSERT INTO Questions (Question, Venue_Type, Action_Point, Premium)
    VALUES (:Q, :VT, :AP, :P)";
    $stmt = $db -> prepare($sql);
    $stmt->bindParam(":Q", $_POST['question']);
    $stmt->bindParam(":VT", $_POST['venue-type']);
    $stmt->bindParam(":AP", $_POST['action-point']);
    if(isset($_POST['premium_check'])){
        $stmt->bindParam(":P", $_POST['premium_check']);
    }
    else{
        $stmt->bindParam(":P", $no);
    }
    $result = $stmt->execute();
}

if (isset($_POST['venue-type'])){
    $venue=$_POST['venue-type'];
    $sql = "SELECT Question, Action_Point, QuestionID, Premium FROM Questions WHERE Venue_Type = :venue";
    $stmt = $db -> prepare($sql);
    $stmt->bindParam(":venue", $venue);
    if(isset($_POST['venue-type'])){
        $_SESSION['venue-type'] = $_POST['venue-type'];
    }
    $result = $stmt->execute();
    $rows_array = [];
    $amount = 0;


    while ($row=$stmt->fetchObject())
    {
    $amount += 1;
    $rows_array[]=$row;
    }
}

if(isset($_POST['delete'])){
    $sql = "DELETE from Questions WHERE QuestionID = :id";
    $stmt = $db -> prepare($sql);
    if(isset($_POST['venue-type'])){
        $_SESSION['venue-type'] = $_POST['venue-type'];
    }
    $stmt->bindParam(":id", $_POST['delete']);
    $result = $stmt->execute();
}


      
?>

<html>
    <?php require("verify_login.php")?>
    <?php 
    #$db = new SQLite3('/xampp/Data/test.db')
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
                    <td><input value = "<?php echo isset($_SESSION['venue-type']) ? $_SESSION['venue-type'] : '' ?>" type = "search" name ="venue-type" placeholder="Search"> </td>
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
                    <td> <label> Premium Question: </label> </td>
                    <td>  <label><input type="checkbox" name=<?php echo "premium_check"?> value="Yes"> Yes</label> </td>
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
                            <th>Premium Question</th>
                            <th>Options</th>
                            
                        </tr>
                        <?php for($x = 0  ; $x < $amount; $x+=1){;?>
                                    <tr>
                                        <td><strong><?php echo $rows_array[$x]->Question?></strong></td>
                                        <td><strong><?php echo $rows_array[$x]->Action_Point;?></strong></td>
                                        <td><strong><?php echo $rows_array[$x]->Premium;?></strong></td>
                                        <?php if($rows_array[$x]->Action_Point){ ?><td> <button type="submit" name="delete" value= <?php echo $rows_array[$x]->QuestionID ?>> Delete </button></td><?php } ?>
                                      
                                    </tr>
                                    <?php }?>
                        </table>   

                        
                                </div>
                        </form>
                               
</html>