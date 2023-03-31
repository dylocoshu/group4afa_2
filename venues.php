<?php require("verify_login.php");?>

<!DOCTYPE html>
<?php
     $query = isset($_GET['query']) ? $_GET['query'] : null;
    
    if($query){
        $location = $query;
        $searchValue = "";
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
        $sql_stmnt.= " AND LOWER(Business_Description) LIKE LOWER('%$searchValue%') 
        AND LOWER(Venue_Type) LIKE LOWER('%$searchValue%') ";
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
    $sql_stmnt.= " AND LOWER(Business_Description) LIKE LOWER('%$searchValue%') AND LOWER(Venue_Type) LIKE LOWER('%$searchValue%')";
}
if(!empty($features_string)){
    $sql_stmnt.= " AND Access_Features LIKE '$features_string' ";
}
$stmt = $db->prepare($sql_stmnt);

 $stmt->execute();

#'



?>
<head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="test_style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;1,400&display=swap" rel="stylesheet">
        
    <title>Everybody Welcome</title>

    
</head>


<main>
<form method = "POST">
    <div class= "main-container">
        <div class = "container-2">
            <div class = "filter-area">
                <div class="fitler-header">
                    <h2>Filter Search</h2>
                </div>
                <div class="search-bar-container">
                    <div class="sb-left">
                        <select name="locationDropdown" id="locationDropdown">
                        <option value="">Any</option>  
                <option value="Sheffield" <?php if(!empty($location)){if(strpos($location, "Sheffield") !== FALSE){?> selected = "true" <?php }}?>>Sheffield</option>
                <option value="Derby" <?php if(!empty($location)){if(strpos($location, "Derby") !== FALSE){?> selected = "true" <?php }}?>>Derby</option>  
                <option value="London" <?php if(!empty($location)){if(strpos($location, "London") !== FALSE){?> selected = "true" <?php }}?>>London</option>  
                        </select>
                    </div>
                    <div class="sb-fill">
                        <input name="searchValue" placeholder="Search" value=<?php if(isset($_POST['submit'])){echo $searchValue;}?> >
                    </div>
                    <div class="sb-fill">
                        <button class = "search-btn" type="submit" name="submit">Search</button>
                    </div>
                </div>
                <div class="filter-features">
                <?php 
                $af_sql = "SELECT DISTINCT Access_Feature FROM Questions UNION SELECT DISTINCT Access_Features FROM Business_Owner";
                $stmt_af = $db->prepare($af_sql);
                $stmt_af->execute();
                $rows_array_af = [];
                $amount_af = 0;
                while ($row_af=$stmt_af->fetchObject())
                {
                $amount_af += 1;
                $rows_array_vt[]=$row_af;
                }
                ?>
                <?php for($x=0;$x < $amount_af; $x++){?>
                    <?php if($rows_array_vt[$x]->Access_Feature != ""){?>
                        <input type="checkbox" id="vehicle<?php echo $x?>" name='features[]' value="<?php echo $rows_array_vt[$x]->Access_Feature ?>" <?php if(!empty($features_string)){if(strpos($features_string, $rows_array_vt[$x]->Access_Feature) !== FALSE){?> checked <?php }}?>>
                        <b><label for="vehicle<?php echo $x?>"> <?php echo $rows_array_vt[$x]->Access_Feature ?></label></b><br>
                    <?php }?>
                <?php } ?>
                </div>
            </div>


            <div class = "content-area">
            <?php while ($row=$stmt->fetchObject()){?>
                <?php 
                $venue_img = "";
                $venue_alt = "";
                if($row->Venue_Type == "Cinema"){
                    $venue_img = 'images/cinema.jpg';
                }
                elseif($row->Venue_Type == "Restaraunt"){
                    $venue_img = 'images/restaraunt.jpg';
                    $venue_alt = 'Image of a nice restaraunt.';
                }elseif($row->Venue_Type == "Museum"){
                    $venue_img = 'images/museum.png';
                    $venue_alt = 'Image of a museum.';
                }else{
                    $venue_img = 'images/park.jpg';
                    $venue_alt = 'Image of a park.';
                }?>  
                <div class="card">
                    <div class="card-header">
                    <a href="<?php if(strstr($row->Link, "https://")){ echo $row->Link; }else{echo "https://".$row->Link;};?>"><h2 class="card-title"><?php echo $row->Business_Name ?></h2></a>
                    </div>
                    <img src = '<?php echo $venue_img ?>' alt = <?php echo $venue_alt ?> >   
                    <div class = "card-b-i">
                        <div class="card-body">
                            <p>
                                <?php echo $row->Business_Description ?>
                            </p>
                        </div>
                    </div>
                        <div class="card-af">
                            <small><b><?php echo $row->Access_Features ?></b></small>
                        
                    </div>
                    </img>
                     </a>
                  </div>
                  <?php }?>
                  
            </div>
        </div>
    </div>
            </form>
</main>

</html>