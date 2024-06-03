<?php

include 'config.php';

if (!empty($_POST['Did']) && !empty($_POST['deptname']) && !empty($_POST['title']) && !empty($_POST['hod'])) {
    $Did = $_POST['Did'];
    $deptname = $_POST['deptname'];
    $title = $_POST['title'];
    $hod = $_POST['hod'];
} else if(empty($_POST['Did']) || empty($_POST['deptname']) || empty($_POST['title']) || empty($_POST['hod']))
{

     $message = "Field cannot be empty!";
     echo "<script type='text/javascript'>alert('$message');</script>";
     die();
}


$q1=mysqli_query(mysqli_connect("localhost", "root", "", "ttms"), "SELECT * FROM department");
while ($row = mysqli_fetch_assoc($q1))
{
    if($row['d_id'] == $Did)
    {
        $message = "Department already exists!";
        echo "<script type='text/javascript'>alert('$message');</script>";
        die();
    }
}






//create
$q = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"), "INSERT INTO department VALUES ('$Did','$deptname',CONCAT('$title', '$hod'))");

    for($i=1;$i<=6;$i++)
    {
        $sql = "CREATE TABLE " . strtolower($Did) ."_semester".$i.  " (
            day VARCHAR(10) NOT NULL PRIMARY KEY, 
            period1 VARCHAR(30) DEFAULT NULL,
            period2 VARCHAR(30) DEFAULT NULL,
            period3 VARCHAR(30) DEFAULT NULL,
            period4 VARCHAR(30) DEFAULT NULL,
            period5 VARCHAR(30) DEFAULT NULL,
            period6 VARCHAR(30) DEFAULT NULL
            ) ENGINE=MyISAM DEFAULT CHARSET=latin1";
            mysqli_query(mysqli_connect("localhost", "root", "", "ttms"), $sql);
        
        
            
            //create
            $sql = "INSERT into " . strtolower($Did) ."_semester".$i. "(`day`, `period1`, `period2`, `period3`, `period4`, `period5`, `period6`) VALUES
            ('monday', '-', '-', '-', '-', '-', '-'),
            ('tuesday', '-', '-', '-', '-', '-', '-'),
            ('wednesday', '-', '-', '-', '-', '-', '-'),
            ('thursday', '-', '-', '-', '-', '-', '-'),
            ('friday', '-', '-', '-', '-', '-', '-'),
            ('saturday', '-', '-', '-', '-', '-', '-');";
            mysqli_query(mysqli_connect("localhost", "root", "", "ttms"), $sql);
            
    }


    
    
    if ($q) {
        $message = "Department added.\\nTry again.";
        echo "<script type='text/javascript'>alert('$message');</script>";
        header("Location:adddept.php");
    } else {
        $message = "Username and/or Password incorrect.\\nTry again.";
        echo "<script type='text/javascript'>alert('$message');</script>";
        // header("Location:index.php");
    
    }

?>



    

