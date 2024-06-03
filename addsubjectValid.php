<?php

include 'config.php';
if (!empty($_POST['SC']) && !empty($_POST['SN']) && !empty($_POST['ST']) && !empty($_POST['credit']) && !empty($_POST['sem']) && !empty($_POST['SD'])) {
    $scode = $_POST['SC'];
    $sname = $_POST['SN'];
    $stype = $_POST['ST'];
    $credit = $_POST['credit'];
    $sem = $_POST['sem'];
    $did = $_POST['SD'];
    //  $message = "nTry again.";
    // echo "<script type='text/javascript'>alert('$message');</script>";
} else if(empty($_POST['SC']) && empty($_POST['SN']) && empty($_POST['ST']) && empty($_POST['credit']) && empty($_POST['sem']) && empty($_POST['SD']))
{

     $message = "Input field/s cannot be empty!";
     echo "<script type='text/javascript'>alert('$message');</script>";
     die();
}


$q=mysqli_query(mysqli_connect("localhost", "root", "", "ttms"), "SELECT * FROM subjects");
while ($row = mysqli_fetch_assoc($q))
{
    if($row['subject_code'] == $scode && $row['d_id'] == $did)
    {
        $message = "Paper already exists!";
        echo "<script type='text/javascript'>alert('$message');</script>";
        die();
    }
}

$q1 = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"), "INSERT INTO subjects VALUES ('$scode','$sname','$stype','$credit','$sem','$did',0,'')");
if ($q1) {
    $message = "Subject added.";
    echo "<script type='text/javascript'>alert('$message');</script>";
    header("Location:addsubject.php");
} else {
    $message = "Username and/or Password incorrect.\\nTry again.";
    echo "<script type='text/javascript'>alert('$message');</script>";
    // header("Location:index.php");

}
?>

<?php
  
// Get the user id 
$user_id = $_REQUEST['SC'];
  
// Database connection
include 'config.php';
  
if ($user_id !== "") {
      
    // Get corresponding first name and 
    // last name for that user id    
    $query = mysqli_query($conn, "SELECT sname 
     FROM autofill_sub  WHERE subject_code='$user_id'");
  
    $row = mysqli_fetch_array($query);
  
    // Get the first name
    $sname = $row["sname"];
  
    
}
  
// Store it in a array
$result = array("$sname");
  
// Send in JSON encoded form
$myJSON = json_encode($result);
echo $myJSON;
?>