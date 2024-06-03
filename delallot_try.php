<?php
include 'config.php';
if (isset($_GET['scode']) && isset($_GET['fno']) && isset($_GET['did'])) {
    $scode = $_GET['scode'];
    $fno = $_GET['fno'];
    $did = $_GET['did'];

    // First, retrieve the semester of the subject
    $q1 = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),
        "SELECT * FROM subjects WHERE subject_code = '$scode' and d_id = '$did'");
    $row = mysqli_fetch_assoc($q1);
    $sem = $row['semester'];

    echo $sem;

    // Update the corresponding teacher's subject count based on the semester
    if ($sem == 1 || $sem == 3 || $sem == 5) {
        $q2 = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),
            "UPDATE teachers SET no_of_subject_odd = no_of_subject_odd - 1 WHERE faculty_number='$fno'");
    } elseif ($sem == 2 || $sem == 4 || $sem == 6) {
        $q2 = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),
            "UPDATE teachers SET no_of_subject_even = no_of_subject_even - 1 WHERE faculty_number='$fno'");
    }

    // Finally, update the subject record to reflect that it is no longer allotted
    $q3 = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),
        "UPDATE subjects SET isAlloted = '0', allotedto = '' WHERE subject_code = '$scode' and d_id = '$did'");

    if ($q2 && $q3) {
        header("Location: allotSub.php");
    } else {
        echo 'Error1';
    }
} else {
    echo 'Error2';
}

?>