<?php
session_start();
?>

<?php

include 'config.php';
if (isset($_POST['FN'])) {
    $fac = $_POST['FN'];
} else {
    die();
}

$q = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"), "SELECT name FROM teachers WHERE faculty_number = '$fac'");
if (mysqli_num_rows($q) == 1) {
    // $row = mysqli_fetch_assoc($q);
    $data=mysqli_fetch_array($q);
    // $tname =$data['name'];
   // $_SESSION['tname']=$tname;  
    $_SESSION['loggedin_name'] = $data['name'];
    $_SESSION['loggedin_id'] = $fac;
    header("Location:teachpage1.php");
} else {
    $_SESSION['status1']= 'ID is Invalid';
    header("Location:test.php"); 
}


?>