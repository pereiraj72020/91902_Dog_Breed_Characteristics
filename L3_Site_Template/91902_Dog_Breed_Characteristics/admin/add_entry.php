<?php

$author_ID = $_SESSION['Add_Quote'];

// get country list from database
$all_countries_sql="SELECT * FROM `group` ORDER BY `group`.`Group` ASC ";
$all_countries = autocomplete_list($dbconnect, $all_countries_sql, 'Group');

// Get subject / topic list from database
$all_temperaments_sql = "SELECT * FROM `temperament` ORDER BY `temperament`.`Temperament` ASC ";
$all_temperaments = autocomplete_list($dbconnect, $all_temperaments_sql, 'Temperament');

// if author not known, initialise variables and set up error messages

if($author_ID=="unknown")
{
    $first = "";
    $middle = "";
    $last = "";
    $Altfirst = "";
    $Altlast = "";
    $group_1 = "";
    $group_2 = "";
    $temperament_1 = "";
    $temperament_2 = "";
    $temperament_3 = "";
    $temperament_4 = "";
    $temperament_5 = "";
    $temperament_6 = "";
    
    // Initialise country and occupation ID's
    $group_1_ID = $group_1_ID = $temperament_1_ID = $temperament_2_ID = $temperament_3_ID = $temperament_4_ID = $temperament_5_ID = $temperament_6_ID = 0;
        
    // set up error fields / visibility
    $first_error = $last_error = $Altfirst_error = $Altlast_error = $gender_error = $group_1_error = $temperament_1_error = "no-error";
    
    $first_field = $last_field = Altfirst_field = Altlast_field = "form-ok";
    $group_1_field = $temperament_1_field = "tag-ok";
        
}


// initialise form variables for quote
$quote = "Please type your quote here";
$notes = "";
$tag_1 = "";
$tag_2 = "";
$tag_3 = "";

// initialise tag ID's
$tag_1_ID = $tag_2_ID = $tag_3_ID = 0;

$has_errors = "no";

// set up error fields / visibility
$quote_error = $tag_1_error =  "no-error";
$quote_field = "form-ok";
$tag_1_field = "tag-ok";

// Code below excutes when the form is submitted...
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // if author is unknown, get values from author part of form
    if($author_ID=="unknown")
    {
    $first = mysqli_real_escape_string($dbconnect, $_POST['first']); 
    $middle = mysqli_real_escape_string($dbconnect, $_POST['middle']); 
    $last = mysqli_real_escape_string($dbconnect, $_POST['last']); 
    $Altfirst = mysqli_real_escape_string($dbconnect, $_POST['Altfirst']); 
    $Altlast = mysqli_real_escape_string($dbconnect, $_POST['Altlast']); 
        
    }
        
    $group_1 = mysqli_real_escape_string($dbconnect, $_POST['country1']);
    $group_2 = mysqli_real_escape_string($dbconnect, $_POST['country2']);
    $temperament_1 = mysqli_real_escape_string($dbconnect, $_POST['temperament1']);
    $temperament_2 = mysqli_real_escape_string($dbconnect, $_POST['temperament2']);
    $temperament_3 = mysqli_real_escape_string($dbconnect, $_POST['temperament3']);
    $temperament_4 = mysqli_real_escape_string($dbconnect, $_POST['temperament4']);
    $temperament_5 = mysqli_real_escape_string($dbconnect, $_POST['temperament5']);
    $temperament_6 = mysqli_real_escape_string($dbconnect, $_POST['temperament6']);
        
    }   // end of getting new author values
    
    if ($breedname_ID=="unknown")
    {
        if ($first == "") {
        $has_errors = "yes";
        $first_error = "error-text";
        $first_field = "form-error";
        }
        
        if ($last == "") {
        $has_errors = "yes";
        $last_error = "error-text";
        $last_field = "form-error";
        }
        
        if ($Altfirst == "") {
        $has_errors = "yes";
        $Altfirst_error = "error-text";
        $Altfirst_field = "form-error";
        }
        
        if ($Altlast == "") {
        $has_errors = "yes";
        $Altlast_error = "error-text";
        $Altlast_field = "form-error";
        }
        
        if ($group_1 == "") {
        $has_errors = "yes";
        $group_1_error = "error-text";
        $group_1_field = "tag-error";
        }
        
        if ($temperament_1 == "") {
        $has_errors = "yes";
        $temperament_1_error = "error-text";
        $temperament_1_field = "tag-error";
        }
        
        // get country and occupation IDs
        $groupID_1 = get_ID($dbconnect, 'group', 'Group_ID', 'Group', $group_1);
        $groupID_2 = get_ID($dbconnect, 'group', 'Group_ID', 'Group', $group_2);
        
        $temperamentID_1 = get_ID($dbconnect, 'temperament', 'Temperament_ID', 'Temperament', $temperament_1);
        $temperamentID_2 = get_ID($dbconnect, 'temperament', 'Temperament_ID', 'Temperament', $temperament_2);
        $temperamentID_3 = get_ID($dbconnect, 'temperament', 'Temperament_ID', 'Temperament', $temperament_3);
        $temperamentID_4= get_ID($dbconnect, 'temperament', 'Temperament_ID', 'Temperament', $temperament_4);
        $temperamentID_5 = get_ID($dbconnect, 'temperament', 'Temperament_ID', 'Temperament', $temperament_5);
        $temperamentID_6 = get_ID($dbconnect, 'temperament', 'Temperament_ID', 'Temperament', $temperament_6);
            
        // add author to database
        $add_author_sql = "INSERT INTO `breedname` (`BreedNameID`, `First`, `Middle`, `Last`, `Alt First`, `Alt Last`, `Group1_ID`, `Group2_ID`, `Temperament 1_ID`, `Temperament 2_ID`, `Temperament 3_ID`, `Temperament 4_ID`, `Temperament 5_ID`, `Temperament 6_ID`) VALUES (NULL, '$first', '$middle', '$last', '$Altfirst', '$Altlast', '$groupID_1', '$groupID_2', '$temperamentID_1',
        '$temperamentID_2',
        '$temperamentID_3',
        '$temperamentID_4',
        '$temperamentID_5',
        '$temperamentID_6');";
        $add_breedname_query = mysqli_query($dbconnect, $add_breedname_sql);
        
        // Get breedname ID
        $find_breedname_sql = "SELECT * FROM `breedname` WHERE `Last` = '$last'";
        $find_breedname_query = mysqli_query($dbconnect, $find_breedname_sql);
        $find_breedname_rs = mysqli_fetch_assoc($find_breedname_query);
        
        $new_breednameID = $find_breedname_rs['Breedname_ID'];
        echo "New Breedname ID:".$new_breednameID;
        
        $author_ID = $new_authorID;
        
        
    }   // end unknown breedname if
    
    // check quote name is not blank
    if ($quote == "Please type your quote here") {
        $has_errors = "yes";
        $quote_error = "error-text";
        $quote_field = "form-error";
        }
    
    // check that first subject has been filled in
    if ($tag_1 == "") {
        $has_errors = "yes";
        $tag_1_error = "error-text";
        $tag_1_field = "tag-error";
        }
    
    
    // Get subject ID's via get_ID function...
    $subjectID_1 = get_ID($dbconnect, 'subject', 'Subject_ID', 'Subject', $tag_1);
    $subjectID_2 = get_ID($dbconnect, 'subject', 'Subject_ID', 'Subject', $tag_2);
    $subjectID_3 = get_ID($dbconnect, 'subject', 'Subject_ID', 'Subject', $tag_3);
    
    
    // add entry to database
    $addentry_sql = "INSERT INTO `quotes` (`ID`, `Author_ID`, `Quote`, `Notes`, `Subject1_ID`, `Subject2_ID`, `Subject3_ID`) VALUES (NULL, '$author_ID', '$quote', '$notes', '$subjectID_1', '$subjectID_2', '$subjectID_3');";
    $addentry_query = mysqli_query($dbconnect, $addentry_sql); 
    
    // get quote ID for next page
    $get_quote_sql = "SELECT * FROM `quotes` WHERE `Quote` = '$quote'";
    $get_quote_query = mysqli_query($dbconnect, $get_quote_sql);
    $get_quote_rs = mysqli_fetch_assoc($get_quote_query);
    
    $quote_ID = $get_quote_rs['ID'];
    $_SESSION['Quote_Success']=$quote_ID;
    
    
    // Go to success page...
    header('Location: index.php?page=quote_success');
    
}   // end button pushed if

?>

<div class="add-quote-form">

<h1>Add Quote...</h1>

<?php

// if author id is unknow, get author details

?>

<form autocomplete="off" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]."?page=../admin/add_entry");?>" enctype="multipart/form-data">
    
    
    <?php
    
    if ($author_ID=="unknown")
    {
            
        ?>
    <!-- Get author details if not known -->
    <div class="<?php echo $first_error; ?>">
        Author's first name can't be blank
    </div>
    
    <input class="add-field <?php echo $first_field; ?>" type="text" name="first" value="<?php echo $first; ?>" placeholder="Author's First Name" />
            
    <br /><br />
    
    <input class="add-field <?php echo $middle_field; ?>" type="text" name="middle" value="<?php echo $middle; ?>" placeholder="Author's Middle Name (optional)" />
            
    <br /><br />
    
    <div class="<?php echo $last_error; ?>">
        Author's last name can't be blank
    </div>
    
    <input class="add-field <?php echo $yob_field; ?>" type="text" name="last" value="<?php echo $last; ?>" placeholder="Author's Last Name" />
            
    <br /><br />
    
    <select class="adv <?php echo $gender_field; ?>" name="gender">
        
        <?php 
        if($gender_code=="") {
        ?>
            
        <option value="" selected>Gender (Choose something)... </option>
        
        <?php
        }
        
        else {
            ?>
        <option value="<?php echo $gender_code;?>" selected><?php echo $gender; ?></option>
        
        <?php
        
        }
        ?>
        
        <option value="F">Female</option>
        <option value="M">Male</option>
        
    </select>
    
    <br /><br />
    
    <div class="<?php echo $yob_error; ?>">
        Author's Year of Birth can't be blank
    </div>
    
    <input class="add-field <?php echo $yob_field; ?>" type="text" name="yob" value="<?php echo $yob; ?>" placeholder="Author's year of birth" />
            
    <br /><br />
    
    <div class="autocomplete">
        <input id="country1" type="text" name="country1" placeholder="Country 1 (Start Typing)...">
    </div>
    
    <br/><br />
    
    <div class="autocomplete">
        <input id="country2" type="text" name="country2" placeholder="Country 2 (Start Typing)...">
    </div>
    
    <br/><br />
    
    <div class="autocomplete">
        <input id="occupation1" type="text" name="occupation1" placeholder="Occupation 1 (Required, Start Typing)...">
    </div>
    
    <br/><br />
    
    <div class="autocomplete">
        <input id="occupation2" type="text" name="occupation2" placeholder="Occupation 2 (Start Typing)...">
    </div>
    
    <br/><br />
    
    <?php
        
    } // end unknown author if / form
    
    ?>

    <!-- Quote text area -->
    <div class="<?php echo $quote_error; ?>">
        This field can't be blank
    </div>

    <textarea class="add-field <?php echo $quote_field?>" name="quote" rows="6"><?php echo $quote; ?></textarea>
    <br/><br />
    
    <input class="add-field <?php echo $notes; ?>" type="text" name="notes" value="<?php echo $notes; ?>" placeholder="Notes (optional) ..."/>
    
    <br/><br />
    
    <div class="<?php echo $tag_1_error ?>">
        Please enter at least one subject tag
    </div>
    <div class="autocomplete">
        <input class="<?php echo $tag_1_field; ?>" id="subject1" type="text" name="Subject_1" placeholder="Subject 1(Start Typing)...">
    </div>
    
    <br/><br />
    
    <div class="autocomplete">
        <input id="subject2" type="text" name="Subject_2" placeholder="Subject 2 (Start Typing, optional)...">
    </div>
    
    <br/><br />
    
    <div class="autocomplete">
        <input id="subject3" type="text" name="Subject_3" placeholder="Subject 3 (Start Typing, optional)...">
    </div>
    
    <br/><br />
    
        <!-- Submit Button -->
    <p>
        <input type="submit" value="Submit" />
    </p>
    
</form>
    
</div>      <!-- end add entry div -->


<!-- script to make autocomplete work -->
<script>

/* bunch of functions to make autocomplete work */
<?php include("autocomplete.php"); ?>
    
/* Arrays containing lists. */
var all_tags = <?php print("$all_subjects"); ?>;
autocomplete(document.getElementById("subject1"), all_tags);
autocomplete(document.getElementById("subject2"), all_tags);
autocomplete(document.getElementById("subject3"), all_tags);
    
var all_countries = <?php print("$all_countries"); ?>;
autocomplete(document.getElementById("country1"), all_countries);
autocomplete(document.getElementById("country2"), all_countries);

var all_occupations = <?php print("$all_occupations"); ?>;
autocomplete(document.getElementById("occupation1"), all_occupations);
autocomplete(document.getElementById("occupation2"), all_occupations);

</script>