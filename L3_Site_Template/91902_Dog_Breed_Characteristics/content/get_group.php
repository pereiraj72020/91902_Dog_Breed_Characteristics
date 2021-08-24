    $sub_sql = "SELECT * FROM `group` WHERE `Group_ID` = $group";
    $sub_query = mysqli_query($dbconnect, $sub_sql);
    $sub_rs = mysqli_fetch_assoc($sub_query);