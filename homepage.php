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
if(isset($_POST['submit'])){
    $location = $_POST['locationDropdown'];
    $searchValue = $_POST['searchValue'];
}
?>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>Access for All</title>
    </head>
<main>
    <form method = "POST">
    <body>  
        Location :  
        <select name="locationDropdown" id="locationDropdown">
            <option value="">Any</option>  
            <option value="Sheffield">Sheffield</option>
            <option value="Derby">Derby</option>  
            <option value="London">London</option>  
        </select>
        <input type="text" name="searchValue" value=<?php if(isset($_POST['submit'])){;}?>>
        <button class="w-20 btn btn-lg btn-primary" style="align: center" type="submit" name="submit" value="submitLocation">Search</button>  
    </body>
    </form>
    <body>
        <?php if ($amount != 0){?>
            <table style="width: 100%; text-align: center; border: solid 2px black">
                <tr class="tableHead">
                    <th>Business Name</th>
                    <th>Venue</th>
                    <th>Description</th>
                    <th>Access Features</th>
                    <th>Location</th>
                 </tr>
            <?php if(empty($location)){ ?>
                <?php for($x = 0  ; $x < $amount; $x+=1){;?>
                    <?php if(!empty($searchValue)){; ?>
                        <?php if(strpos(strtolower($rows_array[$x][2]),strtolower($searchValue)) !== FALSE){ ?>
                            <tr>
                                <td><a href="https://www.cineworld.co.uk/cinemas/sheffield/031"><strong><?php echo $rows_array[$x][0]?></strong></a></td>
                                <td><strong><?php echo $rows_array[$x][1];?></strong></td>
                                <td><strong><?php echo $rows_array[$x][2];?></strong></td>
                                <td><strong><?php echo $rows_array[$x][3];?></strong></td>
                                <td><strong><?php echo $rows_array[$x][4];?></strong></td>
                            </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                                <td><a href="https://www.cineworld.co.uk/cinemas/sheffield/031"><strong><?php echo $rows_array[$x][0]?></strong></a></td>
                                <td><strong><?php echo $rows_array[$x][1];?></strong></td>
                                <td><strong><?php echo $rows_array[$x][2];?></strong></td>
                                <td><strong><?php echo $rows_array[$x][3];?></strong></td>
                                <td><strong><?php echo $rows_array[$x][4];?></strong></td>
                            </tr>
                <?php } ?>
            <?php } ?>
            <?php } else {?> 
                <?php for($x = 0  ; $x < $amount; $x+=1){;?>
                        <?php if(!empty($searchValue)){
                            if((strpos(strtolower($searchValue),strtolower($rows_array[$x][2])) !== FALSE) && ($location === $rows_array[$x][4])){?>
                            <tr>
                                <td><a href="https://www.cineworld.co.uk/cinemas/sheffield/031"><strong><?php echo $rows_array[$x][0]?></strong></a></td>
                                <td><strong><?php echo $rows_array[$x][1];?></strong></td>
                                <td><strong><?php echo $rows_array[$x][2];?></strong></td>
                                <td><strong><?php echo $rows_array[$x][3];?></strong></td>
                                <td><strong><?php echo $rows_array[$x][4];?></strong></td>
                            </tr>
                            <?php } ?>
                        <?php } else { if ($location=== $rows_array[$x][4]){ ?>
                            <tr>
                                <td><a href="https://www.cineworld.co.uk/cinemas/sheffield/031"><strong><?php echo $rows_array[$x][0]?></strong></a></td>
                                <td><strong><?php echo $rows_array[$x][1];?></strong></td>
                                <td><strong><?php echo $rows_array[$x][2];?></strong></td>
                                <td><strong><?php echo $rows_array[$x][3];?></strong></td>
                                <td><strong><?php echo $rows_array[$x][4];?></strong></td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
        <?php } ?>
                </table>
    </body>
    </main>
    <?php require("Footer.php");?>
</html>