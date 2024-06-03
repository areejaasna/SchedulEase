<?php

include 'config.php';
if (isset($_POST['tobealloted']) && isset($_POST['dept']) && isset($_POST['toalloted']) && isset($_POST['sem'])) {
    $subject = $_POST['tobealloted'];
    $teacher = $_POST['toalloted'];
    $dept = $_POST['dept'];
    $sem = $_POST['sem'];

    //  $message = "nTry again.";
    // echo "<script type='text/javascript'>alert('$message');</script>";
} else {
    $message = "Field cannot be empty!";
    echo "<script type='text/javascript'>alert('$message');</script>";
    die();
}

// $q = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"), "UPDATE subjects SET isAlloted=1, allotedto='$teacher' WHERE subject_code='$subject'");

// if ($q) {
$flag=0;
$q1 = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),"SELECT * FROM teachers WHERE faculty_number='$teacher'");
 if($q1)
 {
     while ($row = mysqli_fetch_assoc($q1))
     { 
        $designation=$row['designation'];
        if($sem==0)
        {       
            $no_odd=$row['no_of_subject_odd'];
           
                if($designation == "Assistant Professor" || $designation == "Associate Professor")
                {
                    if($no_odd>=3) {
                    $message = "Cannot teach more than 3 subjects";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                    die();
                    }
                    else if($no_odd==2) {
                    $query = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"), "SELECT * FROM subjects WHERE allotedto='$teacher' and semester%2=1");
                    $practical=0;
                    while ($row = mysqli_fetch_assoc($query)) {
                        $subject_type = $row['subject_type'];
                        if($subject_type == "practical")
                            $practical++;
                    }
                    if($practical == 2)
                        $flag=1;
                    }
                }
                else if($designation != "Assistant Professor" && $designation != "Associate Professor")
                {
                    if($no_odd>=2) {
                        $message = "Cannot teach more than 2 subjects";
                        echo "<script type='text/javascript'>alert('$message');</script>";
                        die();
                    }
                    else if($no_odd==1) {
                    $query = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"), "SELECT * FROM subjects WHERE allotedto='$teacher' and semester%2=1");
                    $practical=0;
                    while ($row = mysqli_fetch_assoc($query)) {
                        $subject_type = $row['subject_type'];
                        if($subject_type == "practical")
                            $practical++;
                    }
                    if($practical == 1)
                        $flag=2;
                    }
                }
                //$no_odd++;
                $q = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"), "UPDATE subjects SET isAlloted=1, allotedto='$teacher' WHERE subject_code='$subject' and d_id='$dept'");
                $q2 = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),"UPDATE teachers SET no_of_subject_odd =  no_of_subject_odd + 1 WHERE faculty_number='$teacher'");
                if($flag == 1) {
                    $message = "Number of classes has exceeded 20";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                    die();
                }
                else if($flag == 2) {
                    $message = "Number of classes has exceeded 15";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                    die();
                }
        }
        else if($sem==1)
        {
            $no_even=$row['no_of_subject_even'];
           
                if($designation == "Assistant Professor" || $designation == "Associate Professor")
                {
                    if($no_even>=3) {
                    $message = "Cannot teach more than 3 subjects";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                    die();
                    }
                    else if($no_even==2) {
                    $query = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"), "SELECT * FROM subjects WHERE allotedto='$teacher' and semester%2=0");
                    $practical=0;
                    while ($row = mysqli_fetch_assoc($query)) {
                        $subject_type = $row['subject_type'];
                        if($subject_type == "practical")
                            $practical++;
                    }
                    if($practical == 2)
                        $flag=1;
                    }
                }
                else if($designation != "Assistant Professor" && $designation != "Associate Professor")
                {
                    if($no_even>=2) {
                        $message = "Cannot teach more than 2 subjects";
                        echo "<script type='text/javascript'>alert('$message');</script>";
                        die();
                    }
                    else if($no_even==1) {
                    $query = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"), "SELECT * FROM subjects WHERE allotedto='$teacher' and semester%2=0");
                    $practical=0;
                    while ($row = mysqli_fetch_assoc($query)) {
                        $subject_type = $row['subject_type'];
                        if($subject_type == "practical")
                            $practical++;
                    }
                    if($practical == 1)
                        $flag=2;
                    }
                }
                //$no_odd++;
                $q = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"), "UPDATE subjects SET isAlloted=1, allotedto='$teacher' WHERE subject_code='$subject' and d_id='$dept'");
                $q2 = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),"UPDATE teachers SET no_of_subject_even =  no_of_subject_even + 1 WHERE faculty_number='$teacher'");
                if($flag == 1) {
                    $message = "Number of classes has exceeded 20";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                    die();
                }
                else if($flag == 2) {
                    $message = "Number of classes has exceeded 15";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                    die();
                }      
        }

    }
    header("Location:allotPrac.php");
 }  
 else {
    $message = "Username and/or Password incorrect.\\nTry again.";
    $message = $subject;
    echo "<script type='text/javascript'>alert('$message');</script>";
    // header("Location:index.html");

}

?>