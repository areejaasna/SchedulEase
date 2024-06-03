<?php
include 'config.php';

if(isset($_GET['deleteid']))
{
    $fno= $_GET['deleteid'];

    $q = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),
    "DELETE FROM teachers WHERE faculty_number = '$fno' ");

    // header("Location:addteacher.php");

    $drop = "DROP TABLE " . $fno;

    $q1 = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"), $drop);
    if ($q1) {

        header("Location:addteacher.php");

    } else {
    echo 'Error';
    }

}
?>





