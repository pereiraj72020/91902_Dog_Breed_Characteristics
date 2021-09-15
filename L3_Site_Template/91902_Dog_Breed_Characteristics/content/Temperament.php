<?php

if(!isset($_REQUEST['temperament_ID']))
{
    header('Location: index.php');
}

$temperament_to_find = $_REQUEST['temperament_ID'];

    // get subject heading...
    $sub_sql = "SELECT * FROM `temperament` WHERE `Temperament_ID` = 
    $temperament_to_find";
    $sub_query = mysqli_query($dbconnect, $sub_sql);
    $sub_rs = mysqli_fetch_assoc($sub_query);

?>

<h2>Subject Results (<?php echo $sub_rs['Temperament']?>)</h2>

<?php

// get quotes
$find_sql = "SELECT * FROM breedname
JOIN temperament ON (`breedname`.`BreedNameID`=`Temperament`.`Temperament_ID`)
WHERE `Temperament 1_ID` = $temperament_to_find 
OR `Temperament 2_ID` = $temperament_to_find 
OR `Temperament 3_ID` = $temperament_to_find
OR `Temperament 4_ID` = $temperament_to_find
OR `Temperament 5_ID` = $temperament_to_find
OR `Temperament 6_ID` = $temperament_to_find
";

$find_query = mysqli_query($dbconnect, $find_sql);
$find_rs = mysqli_fetch_assoc($find_query);

// Loop through results and dislay them...
do { 

    $temperament = preg_replace('/[^A-Za-z0-9.?,\s\'\-\-]/', ' ', $find_rs['temperament']);
    
    // get author name
    include("get_author.php");

    ?>

<div class="results">

    
<?php
    include("show_results.php");
    include("show_subjects.php");
    ?>
    
</div>
<br />

<?php }

while($find_rs = mysqli_fetch_assoc($find_query))

?>

