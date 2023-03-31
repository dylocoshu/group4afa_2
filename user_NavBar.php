<!doctype html>
<html lang="en">
  <head>
  <style>
      nav{
        box-shadow: 0 2px 2px -2px rgba(0,0,0,5);
      }
      a{
        transition: all .2s ease-in-out; 
      }
      a:hover{   
         background-color: rgb(241, 236, 236);
         border-radius: 10px;
      }
    </style>
    <title>Everybody Welcome</title>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    
	
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
  
  </head>

<body class = "bgcolor">
	<nav>
		<div class = "nav-text-effects"> <img src = 'images/logowhite.png'  alt="Everybody Welcome" width = 149 height = 65 > <a href="About.php" > About Us </a>  
    <a href="Index.php"> Venues </a> <a href="answer_audit.php"> Enter an Audit </a>  <a href="view_audit.php"> View Audits </a></div> <a href="toggle_premium.php"> Premium </a></div>
		<div class = "nav-text-effects">
      <a target="_blank" href="qrcode.php?id=<?php echo $_SESSION["businessID"];?>" > QR Code </a>
      <a href="account_update.php" > Account Settings </a>
      <a href="logout.php" > Logout </a>
  </div>
	</nav>
</body>



