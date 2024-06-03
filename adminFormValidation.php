<?php
session_start();
?>

<?php

include 'config.php';
if (isset($_POST['aname']) && isset($_POST['password'])) {
    $aid = $_POST['aname'];
    $password = $_POST['password'];
} else {
    die();
}
$q = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"), "SELECT name FROM user WHERE Binary name = '$aid' and password = '$password' ");
if (mysqli_num_rows($q) == 1) {
    // echo 'welcome admin';

    $data=mysqli_fetch_array($q);
    $name =$data['name'];
   
    $_SESSION['name']=$name;  //$_SESSION['aname']=$aid;  ??
    header("Location:dashboard.php");

} else {

    $_SESSION['status']= 'Username / Password is Invalid';
    header("Location:test.php"); 
    
    
}

?>