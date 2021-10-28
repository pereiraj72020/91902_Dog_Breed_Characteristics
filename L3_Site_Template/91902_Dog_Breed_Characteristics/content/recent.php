<h2>Recent Additions</h2>

<?php

$find_sql = "SELECT * FROM breedname
ON (`breedname`.`BreedNameID`)ORDER BY 
`breedname`.`BreedNameID` DESC LIMIT 10
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

