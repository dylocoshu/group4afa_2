<?php 
session_start();
if (isset($_POST["submit"])){
    $_SESSION["first-name"] = $_POST["first-name"];
    $_SESSION['last-name'] = $_POST["last-name"];
    $_SESSION['email'] = $_POST["email"];
    $_SESSION['business-name'] = $_POST["business-name"];
    $_SESSION['venue-type'] = $_POST["venue-type"];
    $_SESSION['location'] = $_POST["location"];
    $_SESSION['postcode'] = $_POST["postcode"];
    header("Location: register_desc.php");
}
?>



<html>
    <?php require("NavBar.php");
    ?>
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
                    <label for="first-name">First Name</label>
                    <input id="first-name" name = "first-name"></br>
                    <label for="last-name">Last Name</label>
                    <input id = "last-name" name = "last-name"></br>
                    <label for="email">Email Address</label>
                    <input id = "email" name = "email"></br>
                    <label for="business-name">Business Name</label>
                    <input id = "business-name" name = "business-name"></br>
                    <label for="venue-type">Venue Type</label>
                    <input id = "venue-type" name = "venue-type"></br>
                    <label for="location">Location</label>
                    <input id = "location" name = "location"></br>
                    <label for="postcode">Postcode</label>
                    <input id = "postcode" name = "postcode"></br>
</div>
<div class = "row-submit" > 
    <button class="w-20 btn btn-lg btn-primary" style="align: center" type="submit" name="submit" value="submitLocation">Next Page</button> 
</div>
</form>
            </div>
            <div class="bottom-filler"></div>
</div>
</main>
</html>