<?php 
session_start();

$errors = array(); // initialize an empty array to store error messages

if (isset($_POST["submit"])){
    // check if input fields are empty
    if (empty($_POST["first-name"])) {
        $errors[] = "Please enter your first name.";
    } else {
        $_SESSION["first-name"] = $_POST["first-name"];
    }
    if (empty($_POST["last-name"])) {
        $errors[] = "Please enter your last name.";
    } else {
        $_SESSION['last-name'] = $_POST["last-name"];
    }
    if (empty($_POST["email"])) {
        $errors[] = "Please enter your email address.";
    } else {
        $_SESSION['email'] = $_POST["email"];
    }
    if (empty($_POST["business-name"])) {
        $errors[] = "Please enter your business name.";
    } else {
        $_SESSION['business-name'] = $_POST["business-name"];
    }
    if (empty($_POST["venue-type"])) {
        $errors[] = "Please enter your venue type.";
    } else {
        $_SESSION['venue-type'] = $_POST["venue-type"];
    }
    if (empty($_POST["location"])) {
        $errors[] = "Please enter your location.";
    } else {
        $_SESSION['location'] = $_POST["location"];
    }
    if (empty($_POST["postcode"])) {
        $errors[] = "Please enter your postcode.";
    } else {
        $_SESSION['postcode'] = $_POST["postcode"];
    }
    
    // if there are no errors, redirect to the next page
    if (empty($errors)) {
        header("Location: register_desc.php");
        exit();
    }
}
?>

<html>
    <?php require("NavBar.php"); ?>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="register_style.css">
        <title>Access for All</title>
    </head>
    <main>
  <form method="POST">
    <div class="register-grid">
      <div class="top-filler"></div>
      <div class="create-an-account-box">
        <div class="cac-details">
          <div style="padding-bottom: 10px">
            <header align="center">Create an Account</header>
          </div>
          <label for="first-name">First Name</label>
          <input id="first-name" name="first-name" required></br>
          <label for="last-name">Last Name</label>
          <input id="last-name" name="last-name" required></br>
          <label for="email">Email Address</label>
          <input id="email" name="email" type="email" required></br>
          <label for="business-name">Business Name</label>
          <input id="business-name" name="business-name" required></br>
          <label for="venue-type">Venue Type</label>
          <input id="venue-type" name="venue-type" required></br>
          <label for="location">Location</label>
          <input id="location" name="location" required></br>
          <label for="postcode">Postcode</label>
          <input id="postcode" name="postcode" required></br>
        </div>
        <div class="row-submit">
          <button class="w-20 btn btn-lg btn-primary" style="align: center" type="submit" name="submit" value="submitLocation">Next Page</button>
        </div>
      </div>
      <div class="bottom-filler"></div>
    </div>
  </form>
</main>
