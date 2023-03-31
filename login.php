<?php
session_start();
include('includes/config.php');

$error = ''; // initialize error variable

if(isset($_POST['submit'])){
   $username = $_POST['username'];
   $pass = $_POST['pass'];

   try {
      $sql = "SELECT BusinessID, Venue_Type FROM Business_Owner WHERE Username = :username AND Password = :password";
      $stmt = $db->prepare($sql);

      $stmt->bindValue(':username', $username);
      $stmt->bindValue(':password', $pass);

      $stmt->execute();
      $publisher = $stmt->fetchObject();

      if ($publisher) {
         $_SESSION['username'] = $username;
         $_SESSION['businessID'] = $publisher->BusinessID;
         header('Location:home.php');
         exit();
      } else {
         $error = 'Invalid username or password.';
      }
   } catch (PDOException $e) {
      $error = 'Database error: ' . $e->getMessage();
   }
}

?>

<html lang="en">
<?php require("NavBar2.php"); ?>

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="login_style.css">
   <link rel="stylesheet" href="style.css">
   <title>Login </title>
</head>
<body>   

<div class="form">
<section class="form-container">

   <form action="" method="post">
      <br>
      <h1>Welcome Back!</h1>
      <br>
      
      <div class="error-message"><?php echo $error; ?></div> <!-- display error message here -->
      
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

</body>
</html>
