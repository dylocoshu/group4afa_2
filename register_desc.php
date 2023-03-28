
<?php session_start(); ?>
<?php 

if(isset($_POST['submit'])){
    #$db = new SQLite3('/xampp/Data/test.db');
    $b_id = 100;
    $uname = $_SESSION["first-name"];
    $pword = $_SESSION['last-name'];
    $bname = $_SESSION['business-name'];
    $bdesc = $_POST['business-desc'];
    $v_type = $_SESSION['venue-type'];
    $loc = $_SESSION['location'];
    $pcode = $_SESSION['postcode'];
    $email = $_SESSION['email'];
    $link = $_POST['link'];
    $sql = "INSERT INTO Business_Owner 
    (BusinessID, Username, Password, Business_Name,Venue_Type, Business_Description, Location, Email, Link, Postcode)
    VALUES (:b_id,:uname,:pword,:bname,:v_type,:b_desc,:loc,:email,:link, :pcode)";
    $stmt = $db -> prepare($sql);
    $stmt->bindParam(":b_id", $b_id);
    $stmt->bindParam(":uname", $uname);
    $stmt->bindParam(":pword", $pword);
    $stmt->bindParam(":bname", $bname);
    $stmt->bindParam(":v_type", $v_type);
    $stmt->bindParam(":b_desc", $bdesc);
    $stmt->bindParam(":loc", $loc);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":link", $link);
    $stmt->bindParam(":pcode", $pcode);
    $result = $stmt->execute();
    header("Location: homepage.php");
}

?>
<html>
    <style> 
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
<?php require("NavBar.php");?>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="style.css">
            <link rel="stylesheet" href="register_style.css">
            <title>Access for All</title>
        </head>
    <main>
        <form method = "POST">
        <div class = "register-grid">
            <div class="top-filler"></div>
            <div class="create-an-account-box">
                <div class = "cac-details">
                    <div style="padding-bottom: 10px"> <header align = "center">Create an Account</header> </div>
                    <label for="business-desc">Description of your Business</label>
                    <textarea style = "padding-bottom: 10px" name="business-desc"></textarea>
                    <label for="link">Link to your Website</label> </br>
                    <input size = "100" name="link">
</form>
</div>
    </br>
<div class = "row-submit" > 
    <button class="w-20 btn btn-lg btn-primary" style="align: center" type="submit" name="submit" value="submitDetails">Next Page</button> 
</div>
            </div>
            <div class="bottom-filler"></div>
</div>
</main>
</html>