<?php
include("verify_login.php");
$sql = "SELECT Email, Business_Name, Venue_Type,Location,Link,Postcode, Business_Description FROM Business_Owner WHERE Username = :username AND BusinessID = :bid";
$stmt = $db->prepare($sql);

//Bind value
$stmt->bindValue(':username', $_SESSION['username']);
$stmt->bindValue(':bid', $_SESSION['businessID']);


//Execute
$stmt->execute();
$publisher = $stmt->fetchObject();


if (isset($_POST["submit"])){
    $details_arr = ["email","business-name","venue-type","location","postcode","business-desc","link"];
    $sql_arr = ["Email","Business_Name","Venue_Type","Location","Postcode","Business_Description","Link"];
    for($x = 0; $x < sizeof($details_arr); $x++){
        if(isset($_POST[$details_arr[$x]])){
            $sql_arr_idx = $sql_arr[$x];
            $sql = "UPDATE business_owner SET $sql_arr_idx = :sql_col WHERE Username = :username AND BusinessID = :bid   ";
            $stmt = $db->prepare($sql);

            //Bind value
            $stmt->bindValue(':username', $_SESSION['username']);
            $stmt->bindValue(':bid', $_SESSION['businessID']);
            $stmt->bindValue(':sql_col', $_POST[$details_arr[$x]]);

            //Execute
            $stmt->execute();
        }
    }
    Header("Location: view_audit.php");
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
                        <label for="email">Email Address</label>
                        <input id = "email" name = "email" value = "<?php echo $publisher->Email?>"></br>
                        <label for="business-name">Business Name</label>
                        <input id = "business-name" name = "business-name" value ="<?php echo $publisher->Business_Name?>"></br>
                        <label for="venue-type">Venue Type</label>
                        <input id = "venue-type" name = "venue-type" value = "<?php echo $publisher->Venue_Type?>"></br>
                        <label for="location">Location</label>
                        <input id = "location" name = "location" value = "<?php echo $publisher->Location?>"></br>
                        <label for="postcode">Postcode</label>
                        <input id = "postcode" name = "postcode" value = "<?php echo $publisher->Postcode?>"> </br> </br> </br>
                        <label for="business-desc">Description of your Business</label>
                        <textarea id = "business-desc" name="business-desc" rows = "4" cols = "50"><?php echo $publisher->Business_Description?></textarea></br>
                        <label for="link">Link to your Website</label> 
                        <input size = "100" id = "link" name="link" value = "<?php echo $publisher->Link?>"></input></br>
                    </div>
                    <div class = "row-submit"> 
                    <button class="w-20 btn btn-lg btn-primary" style="align: center" type="submit" name="submit" value="submitLocation">Update</button> 
                </div>
                </div>
            </div>
        </form>
    </main>





</html>
