<html>
<?php require("NavBar.php");?>


<?php
$db = new SQLite3('/xampp/Data/EverybodyWelcomeDB.db');
$stmt = $db->prepare('SELECT Business_Name, Venue_Type, Business_Description, Access_Features, Location FROM Business_Owner');
$result = $stmt->execute();
$rows_array = [];
$amount = 0;
while ($row=$result->fetchArray())
{
    $amount += 1;
    $rows_array[]=$row;
}
?>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>Access for All</title>
    </head>
    <body>
        <?php if ($amount != 0){ ?>
        <table style="width: 100%; text-align: center; border: solid 2px black">
        <tr class="tableHead">
            <th>Business Name</th>
            <th>Venue</th>
            <th>Description</th>
            <th>Access Features</th>
            <th>Location</th>
        </tr>
        <?php for($x = 0  ; $x < $amount; $x+=1){?>
        <tr>
            <td><a href="https://www.cineworld.co.uk/cinemas/sheffield/031"><strong><?php echo $rows_array[$x][0]?></strong></a></td>
            <td><strong><?php echo $rows_array[$x][1]?></strong></td>
            <td><strong><?php echo $rows_array[$x][2]?></strong></td>
            <td><strong><?php echo $rows_array[$x][3]?></strong></td>
            <td><strong><?php echo $rows_array[$x][4]?></strong></td>
        </tr>
        <?php } ?>
    <?php } ?> 
    </body>
    <?php require("Footer.php");?>
</html>