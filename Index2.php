<?php require("verify_login.php");?>

<!DOCTYPE html>
<?php
     $query = isset($_GET['query']) ? $_GET['query'] : null;
    
    if($query){
        $location = "";
        $searchValue = $query;
        $features_array= [];
        if(!empty($_POST['features'])) {    
            foreach($_POST['features'] as $value){
                array_push($features_array, $value);
            }
        }
        $features_string= implode(",",$features_array);
    }
    $sql_stmnt = "SELECT Business_Name, Venue_Type, Business_Description, Access_Features, Location, Postcode, BusinessID FROM Business_Owner 
    WHERE Business_Name IS NOT NULL";
    if(!empty($location)){
        $sql_stmnt.= " AND Location = '$location'";
    }
    if(!empty($searchValue)){
        $sql_stmnt.= " AND LOWER(Business_Description) LIKE LOWER('%$searchValue%') ";
    }
    if(!empty($features_string)){
        $sql_stmnt.= " AND Access_Features LIKE '$features_string'";
    }
    $stmt = $db->prepare($sql_stmnt);
    
     $stmt->execute();
    
    



    ?>

<?php


#$db = new SQLite3('/xampp/Data/test.db');
if(isset($_POST['submit'])){
    $location = $_POST['locationDropdown'];
    $searchValue = $_POST['searchValue'];
    $features_array= [];
    if(!empty($_POST['features'])) {    
        foreach($_POST['features'] as $value){
            array_push($features_array, $value);
        }
    }
    $features_string= implode(",",$features_array);
}
$sql_stmnt = "SELECT Business_Name, Venue_Type, Business_Description, Access_Features, Location, Postcode, BusinessID, Link FROM Business_Owner 
WHERE Business_Name IS NOT NULL";
if(!empty($location)){
    $sql_stmnt.= " AND Location = '$location'";
}
if(!empty($searchValue)){
    $sql_stmnt.= " AND LOWER(Business_Description) LIKE LOWER('%$searchValue%') ";
}
if(!empty($features_string)){
    $sql_stmnt.= " AND Access_Features LIKE '$features_string'";
}
$stmt = $db->prepare($sql_stmnt);

 $stmt->execute();

#'



?>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="homepage_style.css">
        <title>Everybody Welcome</title>
    </head>
<main>
    <div class = "homepage-grid">
        <div class = "homepage-search">
        <form method = "POST">
        <body>  
            <b>Location :  </b>
            <select name="locationDropdown" id="locationDropdown">
                <option value="">Any</option>  
                <option value="Sheffield" <?php if(!empty($location)){if(strpos($location, "Sheffield") !== FALSE){?> selected = "true" <?php }}?>>Sheffield</option>
                <option value="Derby" <?php if(!empty($location)){if(strpos($location, "Derby") !== FALSE){?> selected = "true" <?php }}?>>Derby</option>  
                <option value="London" <?php if(!empty($location)){if(strpos($location, "London") !== FALSE){?> selected = "true" <?php }}?>>London</option>  
            </select>
            <input type="search" name="searchValue" placeholder="Search" value=<?php if(isset($_POST['submit'])){echo $searchValue;}?>>
            <button class="w-20 btn btn-primary" style="align: center; float:left;" type="submit" name="submit" value="submitLocation">Search</button>  

        </body>
    </div>
        <body>
            <?php //if ($amount != 0){?>
                <div class = "homepage-table">
                    <table style="width: 100%; text-align: center;">
                        <tr class="tableHead">
                            <th>Business Name</th>
                            <th>Venue</th>
                            <th>Access Features</th>
                            <th>Location</th>
                            <th>Postcode</th>
                        </tr>
                        <?php while ($row=$stmt->fetchObject()){?>
                                    <tr>
                                        <td><a href="<?php if(strstr($row->Link, "https://")){ echo $row->Link; }else{echo "https://".$row->Link;};?>"><strong><?php echo $row->Business_Name?></strong></a></td>
                                        <td><strong><?php echo $row->Venue_Type;?></strong></td>
                                        <td><strong><a href="view_access_features.php?id=<?php echo $row->BusinessID;?>">View Access Features</a></strong></td>
                                        <td><strong><?php echo $row->Location;?></strong></td>
                                        <td><strong><?php echo $row->Postcode;?></strong></td>
                                    </tr>
                                    <?php }?>
                        </table>
                                </div>
                                <?php //}?>
        </body>
        <div class = "homepage-access-features">
            <header><b> Filter by Access Features </b></header>
                <?php 
                $af_sql = "SELECT DISTINCT Access_Feature FROM Questions";
                $stmt = $db->prepare($af_sql);
                $stmt->execute();
                $rows_array_af = [];
                $amount_af = 0;
                while ($row_af=$stmt->fetchObject())
                {
                $amount_af += 1;
                $rows_array_vt[]=$row_af;
                }
                ?>
                <?php for($x=0;$x < $amount_af; $x++){?>
                    <?php if($rows_array_vt[$x]->Access_Feature != ""){?>
                        <input type="checkbox" id="vehicle<?php echo $x?>" name='features[]' value="<?php echo $rows_array_vt[$x]->Access_Feature ?>" <?php if(!empty($features_string)){if(strpos($features_string, $rows_array_vt[$x]->Access_Feature) !== FALSE){?> checked <?php }}?>>
                        <label for="vehicle<?php echo $x?>"> <?php echo $rows_array_vt[$x]->Access_Feature ?></label><br>
                    <?php }?>
                <?php } ?>
        </div>
                                </form>
    </div>

                        </main>
                        <?php require("Footer.php");?>
                        </html>

