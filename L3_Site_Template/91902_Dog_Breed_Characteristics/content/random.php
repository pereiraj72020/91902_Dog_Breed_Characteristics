<h2>Random Breednnames</h2>

<?php

$find_sql = "SELECT * FROM breedname ON (`breedname`.`BreedNameID`)
 ORDER BY RAND() LIMIT 10
";

$find_query = mysqli_query($dbconnect, $find_sql);
$find_rs = mysqli_fetch_assoc($find_query);

// Loop through results and dislay them...

do { ?>

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

