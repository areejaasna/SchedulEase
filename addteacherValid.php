<?php

include 'config.php';

if (!empty($_POST['FN'])  && !empty($_POST['title']) && !empty($_POST['TN']) && !empty($_POST['AL']) && !empty($_POST['TD']) && !empty($_POST['DN']) && !empty($_POST['eid'] ) && !empty($_POST['PD'] )) {
    $name = $_POST['TN'];
    $title = $_POST['title'];
    $facno = $_POST['FN'];
    $alias = $_POST['AL'];
    $dept = $_POST['DN'];
    $desig=$_POST['TD'];
    $eid = $_POST['eid'];
    $pday = $_POST['PD'];
    //   $no_odd = $_POST['no_of_subject_odd'];
    //   $no_even = $_POST['no_of_subject_even'];
    //  $message = "nTry again.";
    // echo "<script type='text/javascript'>alert('$message');</script>";
} else if(empty($_POST['FN'])  || empty($_POST['title']) || empty($_POST['TN']) || empty($_POST['AL']) || empty($_POST['TD']) ||empty($_POST['DN']) || empty($_POST['eid'] ) || empty($_POST['PD'] ))
{

     $message = "Input field/s cannot be empty!";
     echo "<script type='text/javascript'>alert('$message');</script>";
     die();
}




$q1 = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"), "SELECT * FROM department where d_id='$dept'");
if (mysqli_num_rows($q1) == 1) {
} else {
    $message = "Department ID does not exists!";
    echo "<script type='text/javascript'>alert('$message');</script>";
    die();
}

$q2=mysqli_query(mysqli_connect("localhost", "root", "", "ttms"), "SELECT * FROM teachers");
while ($row = mysqli_fetch_assoc($q2))
{
    if($row['faculty_number'] == $facno)
    {
        $message = "Teacher already exists!";
        echo "<script type='text/javascript'>alert('$message');</script>";
        die();
    }
}

$q4=mysqli_query(mysqli_connect("localhost", "root", "", "ttms"), "SELECT * FROM teachers");
while ($row = mysqli_fetch_assoc($q4))
{
    if($row['alias'] == $alias)
    {
        $message = " This Alias is already exists!";
        echo "<script type='text/javascript'>alert('$message');</script>";
        die();
    }
}


if( $desig=='Teaching Fellow' || $desig=='State Aided College Teacher I' || $desig=='State Aided College Teacher II')
{
    $q3 = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"), "INSERT INTO teachers (faculty_number, name, alias, d_id, designation, email_id, no_of_subject_odd, no_of_subject_even, pday) VALUES ('$facno',CONCAT('$title', '$name'),'$alias','$dept',' $desig',' $eid','','',CONCAT('$pday', ', saturday'))");
}
else{
//insert
$q3 = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"), "INSERT INTO teachers (faculty_number, name, alias, d_id, designation, email_id, no_of_subject_odd, no_of_subject_even, pday)  VALUES ('$facno',CONCAT('$title', '$name'),'$alias','$dept',' $desig',' $eid','','','$pday')");
}
$sql = "CREATE TABLE " . $facno . " (
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
    $sql = "INSERT into " . $facno . "(`day`, `period1`, `period2`, `period3`, `period4`, `period5`, `period6`) VALUES
    ('monday', '-<br>-', '-<br>-', '-<br>-', '-<br>-', '-<br>-', '-<br>-'),
    ('tuesday', '-<br>-', '-<br>-', '-<br>-', '-<br>-', '-<br>-', '-<br>-'),
    ('wednesday', '-<br>-', '-<br>-', '-<br>-', '-<br>-', '-<br>-', '-<br>-'),
    ('thursday', '-<br>-', '-<br>-', '-<br>-', '-<br>-', '-<br>-', '-<br>-'),
    ('friday', '-<br>-', '-<br>-', '-<br>-', '-<br>-', '-<br>-', '-<br>-'),
    ('saturday', '-<br>-', '-<br>-', '-<br>-', '-<br>-', '-<br>-', '-<br>-');";
    mysqli_query(mysqli_connect("localhost", "root", "", "ttms"), $sql);
    
    
    if ($q3) {
        $message = "Teacher added.\\nTry again.";
        echo "<script type='text/javascript'>alert('$message');</script>";
        header("Location:addteacher.php");
    } else {
        $message = "Username and/or Password incorrect.\\nTry again.";
        echo "<script type='text/javascript'>alert('$message');</script>";
        // header("Location:index.php");
    
    }

?>



    

