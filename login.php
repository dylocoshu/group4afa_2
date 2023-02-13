<?php

$db = new SQLite3('/xampp/Data/EverybodyWelcomeDB.db');
$DBH = new PDO("sqlite:/xampp/Data/EverybodyWelcomeDB.db");

if(isset($_POST['submit'])){

   

   
     //Retrieve the user account information for the given username.
     $username = $_POST['username'];
     $sql = "SELECT * FROM Business_Owner WHERE Username = :username";
     $stmt = $DBH->prepare($sql);
     
     //Bind value.
     $stmt->bindValue(':username', $username);
     
     //Execute.
     $stmt->execute();
     
     //Fetch row.
     $user = $stmt->fetch(PDO::FETCH_ASSOC);
     
     //If $row is FALSE.
     if($user === false){
        echo '<script>alert("invalid username or password")</script>';
     }
  
   
   
   
   

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>

  

</head>
<body>

<section class="form-container">

   <form action="" method="post">
      <h3>welcome back!</h3>
      <input type="username" name="username" required maxlength="50" placeholder="enter your username" class="box">
      <input type="password" name="pass" required maxlength="20" placeholder="enter your password" class="box">
      <p>don't have an account? <a href="register.html">register new</a></p>
      <input type="submit" value="login now" name="submit" class="btn">
   </form>

</section>

<!-- login section ends -->













</body>
</html>