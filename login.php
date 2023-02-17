<?php session_start() ?>
<?php
$db = new SQLite3('/xampp/Data/test.db');
$DBH = new PDO("sqlite:/xampp/Data/test.db");
if(isset($_POST['submit'])){
   //Retrieve the user account information for the given username.
   $username = $_POST['username'];
   $pass = $_POST['pass'];
   $sql = "SELECT BusinessID, Venue_Type FROM Business_Owner WHERE Username = :username AND Password = :password";
   $stmt = $DBH->prepare($sql);
   
   //Bind value.
   $stmt->bindValue(':username', $username);
   $stmt->bindValue(':password', $pass);
  
   
   //Execute.
   $stmt->execute();
   $publisher = $stmt->fetch(PDO::FETCH_ASSOC);
   
   if ($publisher) {
      $_SESSION["username"] = $username;
      $_SESSION["businessID"] = $publisher['BusinessID'];
     header("Location: homepage.php");
   } else {
      echo '<script>alert("invalid username or password")</script>';
   }
}
   
?>
<html lang="en">
<?php require("NavBar.php"); ?>


<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="style.css">
   <title>Login</title>
</head>
<body>   

<section class="form-container">

   <form action="" method="post">
      <h3>welcome back!</h3>
      <input type="username" name="username" required maxlength="50" placeholder="enter your username" class="box">
      <input type="password" name="pass" required maxlength="20" placeholder="enter your password" class="box">
      <p>don't have an account? <a href="register.php">register new</a></p>
      <input type="submit" value="login now" name="submit" class="btn">
   </form>

</section>

<!-- login section ends -->













</body>
</html>