<?php
if (!empty($_POST['semester_type'])) {
    $semester_type = $_POST['semester_type'];

    if ($semester_type == 'even') {
        // Generate timetable for even semester
        include 'algo_even.php';
    } elseif ($semester_type == 'odd') {
        // Generate timetable for odd semester
        include 'algo_odd.php';
    }
} else {
    // Handle error if no semester type is selected   
    echo "<script type='text/javascript'>alert('Please select a semester type');</script>";
    echo '<script>window.location.href = "generatetimetable.php";</script>';
}
?>
