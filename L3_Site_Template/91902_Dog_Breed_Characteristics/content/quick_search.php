<?php

$quick_find = mysqli_real_escape_string($dbconnect, $_POST['quick_search']);

// Find subject ID...
$temperament_sql = "SELECT * FROM `temperament` WHERE `Temperament` LIKE '%$quick_find%'";
$temperament_query = mysqli_query($dbconnect, $temperament_sql);
$temperament_rs = mysqli_fetch_assoc($temperament_query);

$temperament_count = mysqli_num_rows($temperament_query);
if ($temperament_count > 0) {
    $temperament_ID = $temperament_rs['Temperament_ID'];
}

else 
{
    // If this is not set query below breaks!
    // If it is set to zero, any quote which has less than three subjects will be displayed
    $temperament_ID = "-1";
}


$find_sql = "SELECT * FROM breedname
ON (`author`.`Author_ID`)
WHERE `Last` LIKE '%$quick_find%'
OR `First` LIKE '%$quick_find%'
OR `Quote` LIKE '%$quick_find%'
OR `Subject1_ID` = $subject_ID
OR `Subject2_ID` = $subject_ID
OR `Subject3_ID` = $subject_ID

";
$find_query = mysqli_query($dbconnect, $find_sql);
$find_rs = mysqli_fetch_assoc($find_query);
$count = mysqli_num_rows($find_query);

// Loop through results and dislay them...

// show results if they exist
if ($count > 0) {
    
    ?>
<h2>Quick Search Results (Search Term: <?php echo $quick_find ?>)</h2>

<?php

do { ?>

<div class="results">

    
<?php
    include("show_results.php");
    include("show_subjects.php");
    ?>
    
</div>
<br />

<?php }

while($find_rs = mysqli_fetch_assoc($find_query));
    
}   // end if results exist

else {
    // no results - display error
    ?>

<h2>Oops!</h2>

    <div class="error">
        Sorry - there are no quotes that match the search term <i><b><?php echo $quick_find ?></b></i>.  Please try again.    
    </div>

<p>&nbsp;</p>

<?php
}

?>

