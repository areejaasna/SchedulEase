<?php
include 'config.php';

if(isset($_GET['deleteid']))
{
    $sno= $_GET['deleteid'];

    $q = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),
    "DELETE FROM subjects WHERE subject_code= '$sno' ");

    if ($q) {

        header("Location:addsubject.php");

    } else {
    echo 'Error';
    }

}
?>





