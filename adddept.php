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
    <!-- <link rel="stylesheet" href="style2.css"> -->
    <link rel="stylesheet" href="addteach.css">

    <title>Document</title>

    <!-- open-sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

    <!-- CSS, modal 2 -->
    <link href="bootM/bootstrap.min.css" rel="stylesheet"/>

    <!-- for nav-bar, alignment -->
    <link href="bootM/bootstrap(nav).min.css" rel="stylesheet"/>
    <script src="bootM/jquery.min.js"></script>


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
      <!-- <li class="nav-item">
        <a class="nav-link"class="color-me"  href="addclass.php">Add Classroom</a>
      </li> -->
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
      </li>
      <li class="nav-item">
        <a class="nav-link " class="color-me" href="generatetimetable.php">Generate Timetable</a>
      </li>
    </ul>
    <!-- <ul class="nav navbar-nav navbar-right">
         <li><a href="logout.php" class="color-me" align="right">Logout</a></li>
    </ul> -->
    <ul class="nav navbar-nav navbar-right">
         <li><a href="dashboard.php" class="color-me" align="right">Dashboard</a></li>
         <li><a href="test.php" class="color-me" align="right">Logout</a></li>
    </ul>
  </div>
</nav>
<!--NAVBAR SECTION END-->
<br>

<!-- <br>
<br> -->
<!-- Button trigger modal -->
<!-- <div align="center" style="margin-top:50px">
<button type="button" id="deptmanual" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#exampleModal">
  Add Department
</button>
</div> -->
<!-- Modal -->
<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
          <h4 class="modal-title">Add Department</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="adddeptValid.php" method="POST">
                    <div class="form-group">
                        <label for="Did">Department ID</label>
                        <input type="text" class="form-control" id="Did" name="Did" placeholder="Department ID" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="deptname">Department Name</label>
                        <input type="text" class="form-control" id="deptname" name="deptname"
                               placeholder="Depatment Name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="hod">Head of Department (HOD)</label>
                        <div class="form-group">
                        <label for="Title">Title</label>
                        <select class="form-control" id="title" name="title">
                            <option selected>Select</option>
                            <option value="Ms. ">Ms</option>
                            <option value="Sri. ">Sri</option>
                            <option value="Smt. ">Smt</option>
                            <option value="Dr. ">Dr</option>
                        </select>
                        </div>
                        <label for="Title">Name</label>
                        <input type="text" class="form-control" id="hod" name="hod" placeholder="Head of Department" required>
                    </div>
                
                    

                    <div align="right">
                        <button type="submit" class="btn btn-default" name="ADD1" value="ADD1">ADD</button>
                    </div>

                </form>
      </div>
    </div>
  </div>
</div>


<script>
        $(document).ready(function(){
          $("#deptmanual").click(function(){
            $("#myModal").modal();
          });
        });
</script>


<br>
<br>
<br>
<br>



<div class="container p-30">
        <div class="row">
            <div class="col-md-12 main-datatable">
                <div class="card_body">
                <div class="row d-flex">
                        <div class="col-sm-4 createSegment"> 
                        <button type="button" id="deptmanual" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#exampleModal">Add Department</button>
                        </div>
                        <div class="col-sm-8 add_flex">
                            <!-- <div class="form-group searchInput">
                                <label for="email">Search:</label>
                                <input type="search" class="form-control" id="filterbox" placeholder=" ">
                            </div> -->
                        </div> 
                    </div>
                    <div class="overflow-x">
                  <table style="width:100%;" id="filtertable" id=depttable id=myTable class="table cust-datatable dataTable no-footer">

                  <thead>
                              <tr>
                                    <th style="min-width:50px;">Department ID</th>
                                    <th style="min-width:150px;">Department Name</th>
                                    <th style="min-width:150px;">Head of Department (HOD)</th>
                                  
                                    <th style="min-width:100px;">Action</th>
                                   
                              </tr>
                        </thead>
  
        <tbody>
        <?php
        include 'config.php';
        $q = mysqli_query(mysqli_connect("localhost", "root", "", "ttms"),
            "SELECT * FROM department ORDER BY d_id ASC");
            if($q)
            {
                while ($row = mysqli_fetch_assoc($q))
                {
                    $d_id=$row['d_id'];
                    $d_name=$row['d_name'];
                    $hod=$row['hod'];
                    echo  " <tr><td>".$d_id."</td>
                    <td>".$d_name."</td>
                    <td>".$hod."</td>
                    <td>
                        <a class='btn btn-primary' role='button' href='deldept.php?deleteid=".$d_id."'>Delete </a>
                    </td>
               </tr>\n  ";
                }

            }

        ?>
        <!-- <button><a href='deldept.php?deleteid=".$d_id."'>Delete </a> </button> -->
        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script src="bootM/jquery-3.3.1.slim.min.js"></script>
<script src="bootM/popper.min.js"></script>
<script src="bootM/bootstrap(4.31).min.js"></script>

<script src="js/jquery.dataTables.js"></script>

<script src="datatables/jquery-3.2.1.min.js"></script>
<script src="datatables/bootstrap.min.js"></script>
<script src="datatables/jquery.dataTables.min.js"></script>

</body>
</html>