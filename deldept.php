<?php
include 'config.php';

if(isset($_GET['deleteid']))
{
    $dno= $_GET['deleteid'];

    $q = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),
    "SELECT * FROM teachers where d_id='$dno' ");
    if (mysqli_num_rows($q) == 1) {
        $message = "Department cannot be deleted as there are faculty and paper entities are related to this entity ";
        echo "<script type='text/javascript'>alert('$message');</script>";
        die();
    } 
    else {
        $q1 = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),
        "DELETE FROM department WHERE d_id = '$dno' ");

        for($i=1;$i<=6;$i++)
        {
             $drop = "DROP TABLE " .strtolower($dno)."_semester".$i;

            $q3 = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"), $drop); 
        }
        if ($q3) {

            header("Location:adddept.php");

        } else {
        echo 'Error';
        }
    }
   


  
}
?>





