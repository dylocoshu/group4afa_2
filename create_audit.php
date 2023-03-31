
<?php 
$amount = 0;
#$db = new SQLite3('/xampp/Data/test.db');


if(isset($_POST['add-question'])){
    $no = "No";
    $sql = "INSERT INTO Questions (Question, Venue_Type, Action_Point,Access_Feature,Premium)
    VALUES (:Q, :VT, :AP, :AF, :P)";
    $stmt = $db -> prepare($sql);
    $stmt->bindParam(":Q", $_POST['question']);
    $stmt->bindParam(":VT", $_POST['venue-type']);
    $stmt->bindParam(":AP", $_POST['action-point']);
    $stmt->bindParam(":AF", $_POST['access-feature']);
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
    $sql = "SELECT Question, Action_Point, QuestionID, Premium, Access_Feature   FROM Questions WHERE Venue_Type = :venue";
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

if(isset($_POST['Update'])){
    Header("Location: update_questions.php?id=".$_POST["Update"]);
}

      
?>
 <?php require("verify_login.php")?>
<html>
   
    <?php 
    #$db = new SQLite3('/xampp/Data/test.db')
    ?>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="create_audit_style.css">
        <title>Everybody Welcome</title>
        <style>
            .wrap {
                position: relative;
                align-items: center;
                text-align: center;
                background-color: red;
                left: 0%;
                
            }
            .wrap table{
                position: absolute;
                left: 15%;
            }
        </style>
    </head>
<form method = "POST">
    <section>
    <div class = "cas-grid"> 
        <div class = "qna-box-grid">
            <table style="width: 100%; text-align: center;">
                <tr>
                    <td> <label > Question: </label></td>
                    <td> <textarea rows = "4" cols = "30" name = "question"> </textarea></td>
                </tr>
                <tr> 
                    <td> <label> Action Point: </label> </td>
                    <td> <textarea rows = "4" cols = "30" name = "action-point"> </textarea></td>
                </tr>
                <tr> 
                    <td> <label> Access Feature: </label> </td>
                    <td> <input list="access-feature" name="access-feature"name = "access-feature"></td>
                    <datalist id="access-feature">
                        <?php 
                        $sql_af = "SELECT DISTINCT Access_Feature from Questions";
                        $stmt_af = $db -> prepare($sql_af);
                        $result = $stmt_af->execute();
                                            
                    
                        while ($row=$stmt_af->fetchObject())
                        {
                        ?>
                            <option value="<?php echo $row->Access_Feature ?>">
                        <?php } ?>
                    </datalist>
                </tr>
                <tr> 
                    <td> <label> Premium Question: </label> </td>
                    <td>  <label><input type="checkbox" name=<?php echo "premium_check"?> value="Yes"> Yes</label> </td>
                </tr>
                <tr>
                    <?php                         
                    $vt_sql = "SELECT DISTINCT Venue_Type FROM Questions 
                    UNION SELECT DISTINCT Venue_Type FROM Business_Owner ";
                    $stmt = $db->prepare($vt_sql);
                    $stmt->execute();
                    $rows_array_vt = [];
                    $amount_vt = 0;
                    while ($row_vt=$stmt->fetchObject())
                    {
                    $amount_vt += 1;
                    $rows_array_vt[]=$row_vt;
                    }?>
                    <td> <label > Select a Venue </label></td>
                    <td><select id = "Venue_Type" name ="venue-type">
                    <?php for   ($x=0;$x < $amount_vt; $x++ ) { ?>
                        <option value="<?php echo $rows_array_vt[$x]->Venue_Type?>"> <?php echo $rows_array_vt[$x]->Venue_Type?> </option>
                    <?php } ?>
                    </select> </td>
                    <td><button type = "submit" name="venue-button"> Venue Questions </button> </td>
                    
                </tr>
                <tr>
                    <td> <button class = qna-box-button type="submit" name="add-question"> Add Question </button></td>
                </tr>
            </table>
        </div>
    </div>
                    </section>
</form>
<form method="POST">
    <section>
    <div class = wrap>
                <div class = "homepage-table">
                    <table style="width: 70%; text-align: center;">
                        <tr class="tableHead">
                            <th>Question</th>
                            <th>Action Point</th>
                            <th>Premium Question</th>
                            <th>Access Feature</th>
                            <th>Options</th>
                            
                        </tr>
                        <?php for($x = 0  ; $x < $amount; $x+=1){;?>
                                    <tr>
                                        <td><strong><?php echo $rows_array[$x]->Question?></strong></td>
                                        <td><strong><?php echo $rows_array[$x]->Action_Point;?></strong></td>
                                        <td><strong><?php echo $rows_array[$x]->Premium;?></strong></td>
                                        <td><strong><?php echo $rows_array[$x]->Access_Feature;?></strong></td>
                                        <td> <button type="submit" name="delete" value= <?php echo $rows_array[$x]->QuestionID ?>> Delete </button>
                                        <button type="submit" name="Update" value= <?php echo $rows_array[$x]->QuestionID ?>> Update </button>
                                        </td>
                                      
                                    </tr>
                                    <?php }?>
                        </table>   

                        
                                </div>
                        </div>
                        </section>
                        </form>
                               
</html>