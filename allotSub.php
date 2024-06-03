<?php

// include('security.php');

?>

<?php
session_start();

if(empty($_SESSION['name']))
{
  header('Location:test.php');
}

if(!empty($_SESSION['name']))
{
  $username=$_SESSION['name'];
}

include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="modalstyle.css"> -->
    <!-- <link rel="stylesheet" href="style2.css"> -->
    <link rel="stylesheet" href="buttonstyle.css">

    <title>Document</title>

    <!-- open-sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

    

    <!-- CSS, modal 2 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- for nav-bar, alignment -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="css/jquery.dataTables.css" />

    <link rel="stylesheet" href="datatables/bootstrap.min.css">
    <link rel="stylesheet" href="datatables/jquery.dataTables.min.css">



</head>

<body>

<nav class="navbar navbar-expand-lg navbar-fixed-top"> 

<div class="collapse navbar-collapse" id="menu">
    <ul class="navbar-nav">
    <li class="nav-item ">
        <a class="nav-link" class="color-me" href="adddept.php">Department </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" class="color-me" href="addteacher.php">Teacher</a>
      </li>
      <li class="nav-item">
        <a class="nav-link"class="color-me"  href="addsubject.php">Paper</a>
      </li>
      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" class="color-me" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Allotment
        </a>
        <ul class="dropdown-menu">
                        <li>
                            <a href="allotSub.php">TUTORIAL PAPER</a>
                        </li>
                        <li>
                            <a href="allotPrac.php">PRACTICAL PAPER</a>
                        </li>
                        <li>
                            <a href="allotNa.php">OTHERS</a>
                        </li>
        </ul>
      <li class="nav-item">
        <a class="nav-link " class="color-me" href="generatetimetable.php">Generate Timetable</a>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <li><a href="dashboard.php" class="color-me" align="right">Dashboard</a></li>
         <li><a href="logout.php" class="color-me" align="right">Logout</a></li>
    </ul>
  </div>
</nav>
<!--NAVBAR SECTION END-->
<br>

<div align="center">
    <form action="allotValid.php" method="post" style="margin-top: 100px">

    <div style="margin-top: 5px">
            <select name="tobealloted" class="list-group-item">
                <?php
                include 'config.php';
                $q = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),
                    "SELECT * FROM subjects");
                $row_count = mysqli_num_rows($q);
                if ($row_count) {
                    $mystring = '
         <option selected disabled>Select Paper</option>';
                    while ($row = mysqli_fetch_assoc($q)) {
                        if ($row['isAlloted'] == 1 || $row['subject_type'] == "practical" || $row['subject_type'] == "na")
                            continue;
                        $mystring .= '<option value="' . $row['subject_code'] . '">' . $row['subject_name'] . '</option>';
                    }

                    echo $mystring;
                }
                ?>
            </select>
        </div>

        <div style="margin-top: 5px">
            <select name="dept" class="list-group-item">
                <?php
                include 'config.php';
                $q = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),
                    "SELECT * FROM department");
                $row_count = mysqli_num_rows($q);
                if ($row_count) {
                    $mystring = '
         <option selected disabled>Select Department</option>';
                    while ($row = mysqli_fetch_assoc($q)) {
                        $mystring .= '<option value="' . $row['d_id'] . '">' . $row['d_name'] . '</option>';
                    }

                    echo $mystring;
                }
                ?>
            </select>
        </div>

        <div>
            <select name="toalloted" class="list-group-item">
                <?php
                include 'config.php';

                $q = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),
                    "SELECT * FROM teachers ");
                $row_count = mysqli_num_rows($q);
                if ($row_count) {
                    $mystring = '
         <option selected disabled>Select Teacher</option>';
                    while ($row = mysqli_fetch_assoc($q)) {
                        $mystring .= '<option value="' . $row['faculty_number'] . '">' . $row['name'] . '</option>';
                    }

                    echo $mystring;
                }
                ?>
            </select>
        </div>
        <div>
            <select name="sem" class="list-group-item">
                        
                            <option selected disabled>Select Semester</option>
                            <option value="0">Odd</option>
                            <option value="1">Even</option>
                    
                       
            </select>
        </div>

        <div style="margin-top: 10px">
            <button type="submit" name="allot" class="btn btn-success btn-lg">Allot</button>
        </div>
    </form>
</div>




<br>
<br>
<br>

    <div align="center">
       <caption><strong>TUTORIAL PAPER ALLOTMENT</strong></caption>
    </div>
    <div class="container p-30">
        <div class="row">
            <div class="col-md-12 main-datatable">
                <div class="card_body">
                    <div class="row d-flex">
                        <div class="col-sm-4 createSegment"> 
                        <!-- <button type="button" id="teachermanual" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Add Teacher</button> -->
                        </div>
                        <div class="col-sm-8 add_flex">
                            <!-- <div class="form-group searchInput">
                                <label for="email">Search:</label>
                                <input type="search" class="form-control" id="filterbox" placeholder=" ">
                            </div> -->
                        </div> 
                    </div>
                    <div class="overflow-x">
                        <table style="width:100%;"  id="myTable" class="table cust-datatable dataTable no-footer">
                        <thead>
                              <tr>
                                    <th style="min-width:100px;">Department ID</th>
                                    <th style="min-width:50px;">Paper Code</th>
                                    <th style="min-width:200px;">Paper Name</th>
                                    <th style="min-width:100px;">Faculty No</th>
                                    <th style="min-width:100px;">Teacher Name</th>   
                                    <th style="min-width:90px;">Action</th>
                              </tr>
                        </thead>
        <tbody>
    <?php
    include 'config.php';
    $q = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),
        "SELECT * FROM subjects ");

    while ($row = mysqli_fetch_assoc($q)) {
        if ($row['isAlloted'] == 0 || $row['subject_type'] == 'practical' || $row['subject_type'] == 'na')
            continue;
        $teacher_id = $row['allotedto'];
        $t = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),
            "SELECT name FROM teachers WHERE faculty_number = '$teacher_id'");
        while($trow = mysqli_fetch_assoc($t)){
            
                     $scode=$row['subject_code'];
                     $sname=$row['subject_name'];
                     $fno=$row['allotedto'];
                     $fname=$trow['name'];
                     $did=$row['d_id'];        // <td>".$did."</td>

                     echo  " <tr>
                                 <td>".$did."</td>
                                 <td>".$scode."</td>
                                 <td>".$sname."</td>
                                 <td>".$fno."</td>
                                 <td>".$fname."</td>
                                 <td>
                                 <a class='btn btn-primary' role='button' href='delallot_try.php?scode=".$scode."&fno=".$fno."&did=".$did."'>Delete </a>   
                                 </td>
                            </tr>\n  ";
    }
    }
    
    //<a class='btn btn-primary' role='button' href='delallot.php?deleteid=".$scode."'>Delete </a>
    ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script src="js/jquery.dataTables.js"></script>

<script src="datatables/jquery-3.2.1.min.js"></script>
<script src="datatables/bootstrap.min.js"></script>
<script src="datatables/jquery.dataTables.min.js"></script>


<script>

$(document).ready(function() {
$('#myTable').dataTable({
    "bPaginate": true,
    "pageLength":10,
    "bLengthChange": false,
    "bFilter": true,
    "bInfo": false,
    "bAutoWidth": false });
});
</script>
</body>
</html>