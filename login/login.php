<?php
session_start();
include('includes/config.php');
//i
if(isset($_POST['submit'])){
   //Retrieve the user account information for the given username.
   $username = $_POST['username'];
   $pass = $_POST['pass'];
   $sql = "SELECT BusinessID, Venue_Type FROM Business_Owner WHERE Username = :username AND Password = :password";
   $stmt = $db->prepare($sql);
   
   //Bind value
   $stmt->bindValue(':username', $username);
   $stmt->bindValue(':password', $pass);
  
   
   //Execute
   $stmt->execute();
   $publisher = $stmt->fetchObject();
   
   if ($publisher) {
      $_SESSION['username'] = $username;
      $_SESSION['businessID'] = $publisher->BusinessID;
      echo $_SESSION['businessID'];
   } else {
      echo '<script>alert("invalid username or password")</script>';
   }
}   
?>
<html lang="en">
<?php require("navbars/NavBar.php"); ?>


<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="styles/login_style.css">
   <link rel="stylesheet" href="styles/style.css">
   <title>Login </title>
</head>
<body>   

<div class="form">
<section class="form-container">

   <form action="" method="post">
      <br>
      <h1>Welcome Back!</h1>
      <br>
      
      
      <input class="input1" type="username" name="username" required maxlength="50" placeholder=" Username" class="box"><br>
      
      <input class="input1" type="password" name="pass" required maxlength="20" placeholder=" Password" class="box">
      <br>
      <input  type="submit" value="Login" name="submit" class="btn-primary1">
      <div class="message">

      
      <p>Don't have an account? <a href="register.php"><u>Register now</u></a></p>
      </div>
   </form>

</section>
</div>



<!-- login section ends -->













</body>
</html>