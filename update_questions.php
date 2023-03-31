<?php
include("verify_login.php");
$sql = "SELECT * FROM Questions WHERE QuestionID = :QID";
$stmt = $db->prepare($sql);

//Bind value
$stmt->bindValue(':QID', $_GET['id']);


//Execute
$stmt->execute();
$publisher = $stmt->fetchObject();


if (isset($_POST["submit"])){
    $details_arr = ["Question","Venue_Type","Action_Point","Premium", "Access_Feature"];
    $sql_arr = ["Question","Venue_Type","Action_Point","Premium", "Access_Feature"];
    for($x = 0; $x < sizeof($details_arr); $x++){
        if(isset($_POST[$details_arr[$x]])){
            $sql_arr_idx = $sql_arr[$x];
            $sql = "UPDATE Questions SET $sql_arr_idx = :sql_col WHERE QuestionID = :QID";
            $stmt = $db->prepare($sql);

            //Bind value
            $stmt->bindValue(':QID', $_GET['id']);
            $stmt->bindValue(':sql_col', $_POST[$details_arr[$x]]);

            //Execute
            $stmt->execute();
        }
    }
    header("Location: create_audit.php");
}



?>










<!DOCTYPE HTML>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="register_style.css">
        <title>Everybody Welcome</title>
    </head>
    <main>
        <form method = "POST">
            <div class = "register-grid">
                <div class="top-filler"></div>
                <div class="create-an-account-box">
                    <div class = "cac-details">
                        <div style="padding-bottom: 10px"> <header align = "center">Account Details</header> </div>
                        <label for="Question">Question </label>
                        <textarea id = "Question" name  = "Question" rows = "4" cols = "50" placeholder = "<?php echo $publisher->Question?>">  <?php echo $publisher->Question?></textarea></br>
                        <?php 
                        $vt_sql = "SELECT DISTINCT Venue_Type FROM Questions UNION SELECT DISTINCT Venue_Type FROM Business_Owner";
                        $stmt = $db->prepare($vt_sql);
                        $stmt->execute();
                        $rows_array = [];
                        $amount = 0;
                        while ($row=$stmt->fetchObject())
                        {
                        $amount += 1;
                        $rows_array[]=$row;
                        }
                        $unique_vt = $stmt->fetchObject();
                        ?>
                        <label for="Venue_Type">Venue Type</label>
                        <select id = "Venue_Type" name = "Venue_Type" value ="<?php echo $publisher->Venue_Type?>">
                        <?php for   ($x=0;$x < $amount; $x++ ) {?>
                            <option value="<?php echo $rows_array[$x]->Venue_Type?>"> <?php echo $rows_array[$x]->Venue_Type?> </option>
                        <?php }?>
                        </select></br>
                        <label for="Action_Point">Action Point</label>
                        <textarea id = "Action_Point" name = "Action_Point" rows = "4" cols = "50" placeholder = "<?php echo $publisher->Action_Point?>"> <?php echo $publisher->Action_Point?></textarea></br>
                        <label for="Access_Feature">Access Feature</label>
                        <input id = "Access_Feature" name = "Access_Feature" value = "<?php echo $publisher->Access_Feature?>"></br>
                        <label for="Premium">Premium</label>
                        <input type = "checkbox" id = "Premium" name = "Premium" value = "Yes" <?php if($publisher->Premium == "Yes") { ?> checked <?php } ?>></br>
                        <input type = "hidden" id = "Premium" name = "Premium" value = "No" <?php if($publisher->Premium == "Yes") { ?> checked <?php } ?>></br>
                    </div>
                    <div class = "row-submit"> 
                    <button class="w-20 btn btn-lg btn-primary" style="align: center" type="submit" name="submit" value="submitPremium">Update</button> 
                </div>
                </div>
            </div>
        </form>
    </main>





</html>
